 <?php
require_once 'PEAR.php';

define('NET_SOCKET_READ', 1);
define('NET_SOCKET_WRITE', 2);
define('NET_SOCKET_ERROR', 4);

class Net_Socket extends PEAR {
	var $fp = null;

	var $blocking = true;

	var $persistent = false;

	var $addr = '';

	var $port = 0;

	var $timeout = false;

	var $lineLength = 2048;

	var $newline = "\r\n";

	function connect($addr, $port = 0, $persistent = null, $timeout = null, $options = null) {
		if (is_resource($this->fp)) {
			@ fclose($this->fp);
			$this->fp = null;
		}

		if (!$addr) {
			return $this->raiseError('$addr cannot be empty');
		}
		elseif (strspn($addr, '.0123456789') == strlen($addr) || strstr($addr, '/') !== false) {
			$this->addr = $addr;
		} else {
			$this->addr = @ gethostbyname($addr);
		}

		$this->port = $port % 65536;

		if ($persistent !== null) {
			$this->persistent = $persistent;
		}

		if ($timeout !== null) {
			$this->timeout = $timeout;
		}

		$openfunc = $this->persistent ? 'pfsockopen' : 'fsockopen';
		$errno = 0;
		$errstr = '';

		$old_track_errors = @ ini_set('track_errors', 1);

		if ($options && function_exists('stream_context_create')) {
			if ($this->timeout) {
				$timeout = $this->timeout;
			} else {
				$timeout = 0;
			}
			$context = stream_context_create($options);

			// Since PHP 5 fsockopen doesn't allow context specification
			if (function_exists('stream_socket_client')) {
				$flags = STREAM_CLIENT_CONNECT;

				if ($this->persistent) {
					$flags = STREAM_CLIENT_PERSISTENT;
				}

				$addr = $this->addr . ':' . $this->port;
				$fp = stream_socket_client($addr, $errno, $errstr, $timeout, $flags, $context);
			} else {
				$fp = @ $openfunc ($this->addr, $this->port, $errno, $errstr, $timeout, $context);
			}
		} else {
			if ($this->timeout) {
				$fp = @ $openfunc ($this->addr, $this->port, $errno, $errstr, $this->timeout);
			} else {
				$fp = @ $openfunc ($this->addr, $this->port, $errno, $errstr);
			}
		}

		if (!$fp) {
			if ($errno == 0 && !strlen($errstr) && isset ($php_errormsg)) {
				$errstr = $php_errormsg;
			}
			@ ini_set('track_errors', $old_track_errors);
			return $this->raiseError($errstr, $errno);
		}

		@ ini_set('track_errors', $old_track_errors);
		$this->fp = $fp;

		return $this->setBlocking($this->blocking);
	}

	function disconnect() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		@ fclose($this->fp);
		$this->fp = null;
		return true;
	}

	function setNewline($newline) {
		$this->newline = $newline;
		return true;
	}

	function isBlocking() {
		return $this->blocking;
	}

	function setBlocking($mode) {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$this->blocking = $mode;
		stream_set_blocking($this->fp, (int) $this->blocking);
		return true;
	}

	function setTimeout($seconds, $microseconds) {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		return socket_set_timeout($this->fp, $seconds, $microseconds);
	}

	function setWriteBuffer($size) {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$returned = stream_set_write_buffer($this->fp, $size);
		if ($returned == 0) {
			return true;
		}
		return $this->raiseError('Cannot set write buffer.');
	}

	function getStatus() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		return socket_get_status($this->fp);
	}

	function gets($size = null) {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		if (is_null($size)) {
			return @ fgets($this->fp);
		} else {
			return @ fgets($this->fp, $size);
		}
	}

	function read($size) {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		return @ fread($this->fp, $size);
	}

	function write($data, $blocksize = null) {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		if (is_null($blocksize) && !OS_WINDOWS) {
			return @ fwrite($this->fp, $data);
		} else {
			if (is_null($blocksize)) {
				$blocksize = 1024;
			}

			$pos = 0;
			$size = strlen($data);
			while ($pos < $size) {
				$written = @ fwrite($this->fp, substr($data, $pos, $blocksize));
				if (!$written) {
					return $written;
				}
				$pos += $written;
			}

			return $pos;
		}
	}

	function writeLine($data) {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		return fwrite($this->fp, $data . $this->newline);
	}

	function eof() {
		return (!is_resource($this->fp) || feof($this->fp));
	}

	function readByte() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		return ord(@ fread($this->fp, 1));
	}

	function readWord() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$buf = @ fread($this->fp, 2);
		return (ord($buf[0]) + (ord($buf[1]) << 8));
	}

	function readInt() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$buf = @ fread($this->fp, 4);
		return (ord($buf[0]) + (ord($buf[1]) << 8) + (ord($buf[2]) << 16) + (ord($buf[3]) << 24));
	}

	function readString() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$string = '';
		while (($char = @ fread($this->fp, 1)) != "\x00") {
			$string .= $char;
		}
		return $string;
	}

	function readIPAddress() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$buf = @ fread($this->fp, 4);
		return sprintf('%d.%d.%d.%d', ord($buf[0]), ord($buf[1]), ord($buf[2]), ord($buf[3]));
	}

	function readLine() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$line = '';

		$timeout = time() + $this->timeout;

		while (!feof($this->fp) && (!$this->timeout || time() < $timeout)) {
			$line .= @ fgets($this->fp, $this->lineLength);
			if (substr($line, -1) == "\n") {
				return rtrim($line, $this->newline);
			}
		}
		return $line;
	}

	function readAll() {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$data = '';
		while (!feof($this->fp)) {
			$data .= @ fread($this->fp, $this->lineLength);
		}
		return $data;
	}

	function select($state, $tv_sec, $tv_usec = 0) {
		if (!is_resource($this->fp)) {
			return $this->raiseError('not connected');
		}

		$read = null;
		$write = null;
		$except = null;
		if ($state & NET_SOCKET_READ) {
			$read[] = $this->fp;
		}
		if ($state & NET_SOCKET_WRITE) {
			$write[] = $this->fp;
		}
		if ($state & NET_SOCKET_ERROR) {
			$except[] = $this->fp;
		}
		if (false === ($sr = stream_select($read, $write, $except, $tv_sec, $tv_usec))) {
			return false;
		}

		$result = 0;
		if (count($read)) {
			$result |= NET_SOCKET_READ;
		}
		if (count($write)) {
			$result |= NET_SOCKET_WRITE;
		}
		if (count($except)) {
			$result |= NET_SOCKET_ERROR;
		}
		return $result;
	}

	function enableCrypto($enabled, $type) {
		if (version_compare(phpversion(), "5.1.0", ">=")) {
			if (!is_resource($this->fp)) {
				return $this->raiseError('not connected');
			}
			return @ stream_socket_enable_crypto($this->fp, $enabled, $type);
		} else {
			$msg = 'Net_Socket::enableCrypto() requires php version >= 5.1.0';
			return $this->raiseError($msg);
		}
	}

}