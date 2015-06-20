<?php

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4 |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license, |
// | that is bundled with this package in the file LICENSE, and is |
// | available at through the world-wide-web at |
// | http://www.php.net/license/2_02.txt. |
// | If you did not receive a copy of the PHP license and are unable to |
// | obtain it through the world-wide-web, please send a note to |
// | license@php.net so we can mail you a copy immediately. |
// +----------------------------------------------------------------------+
// | Authors: Chuck Hagenbuch <chuck@horde.org> |
// | Jon Parise <jon@php.net> |
// | Damian Alejandro Fernandez Sosa <damlists@cnba.uba.ar> |
// +----------------------------------------------------------------------+
//
// $Id: SMTP.php 311427 2011-05-26 04:25:19Z jon $

require_once 'PEAR.php';
require_once 'Net/Socket.php';

class Net_SMTP {
	var $host = 'localhost';

	var $port = 25;

	var $localhost = 'localhost';

	var $auth_methods = array ();

	var $pipelining = false;

	var $_pipelined_commands = 0;

	var $_debug = false;

	var $_debug_handler = null;

	var $_socket = null;

	var $_socket_options = null;

	var $_timeout = 0;

	var $_code = -1;

	var $_arguments = array ();

	var $_greeting = null;

	var $_esmtp = array ();

	function Net_SMTP($host = null, $port = null, $localhost = null, $pipelining = false, $timeout = 0, $socket_options = null) {
		if (isset ($host)) {
			$this->host = $host;
		}
		if (isset ($port)) {
			$this->port = $port;
		}
		if (isset ($localhost)) {
			$this->localhost = $localhost;
		}
		$this->pipelining = $pipelining;

		$this->_socket = new Net_Socket();
		$this->_socket_options = $socket_options;
		$this->_timeout = $timeout;

		/* Include the Auth_SASL package. If the package is available, we
		* enable the authentication methods that depend upon it. */
		if ((@ include_once 'Auth/SASL.php') === true) {
			$this->setAuthMethod('CRAM-MD5', array (
				$this,
				'_authCram_MD5'
			));
			$this->setAuthMethod('DIGEST-MD5', array (
				$this,
				'_authDigest_MD5'
			));
		}

		/* These standard authentication methods are always available. */
		$this->setAuthMethod('LOGIN', array (
			$this,
			'_authLogin'
		), false);
		$this->setAuthMethod('PLAIN', array (
			$this,
			'_authPlain'
		), false);
	}

	function setTimeout($seconds, $microseconds = 0) {
		return $this->_socket->setTimeout($seconds, $microseconds);
	}

	function setDebug($debug, $handler = null) {
		$this->_debug = $debug;
		$this->_debug_handler = $handler;
	}

	function _debug($message) {
		if ($this->_debug) {
			if ($this->_debug_handler) {
				call_user_func_array($this->_debug_handler, array (
					& $this,
					$message
				));
			} else {
				echo "DEBUG: $message\n";
			}
		}
	}

	function _send($data) {
		$this->_debug("Send: $data");

		$result = $this->_socket->write($data);
		if (!$result || PEAR :: isError($result)) {
			$msg = ($result) ? $result->getMessage() : "unknown error";
			return PEAR :: raiseError("Failed to write to socket: $msg", null, PEAR_ERROR_RETURN);
		}

		return $result;
	}

	function _put($command, $args = '') {
		if (!empty ($args)) {
			$command .= ' ' . $args;
		}

		if (strcspn($command, "\r\n") !== strlen($command)) {
			return PEAR :: raiseError('Commands cannot contain newlines', null, PEAR_ERROR_RETURN);
		}

		return $this->_send($command . "\r\n");
	}

	function _parseResponse($valid, $later = false) {
		$this->_code = -1;
		$this->_arguments = array ();

		if ($later) {
			$this->_pipelined_commands++;
			return true;
		}

		for ($i = 0; $i <= $this->_pipelined_commands; $i++) {
			while ($line = $this->_socket->readLine()) {
				$this->_debug("Recv: $line");

				/* If we receive an empty line, the connection was closed. */
				if (empty ($line)) {
					$this->disconnect();
					return PEAR :: raiseError('Connection was closed', null, PEAR_ERROR_RETURN);
				}

				/* Read the code and store the rest in the arguments array. */
				$code = substr($line, 0, 3);
				$this->_arguments[] = trim(substr($line, 4));

				/* Check the syntax of the response code. */
				if (is_numeric($code)) {
					$this->_code = (int) $code;
				} else {
					$this->_code = -1;
					break;
				}

				/* If this is not a multiline response, we're done. */
				if (substr($line, 3, 1) != '-') {
					break;
				}
			}
		}

		$this->_pipelined_commands = 0;

		/* Compare the server's response code with the valid code/codes. */
		if (is_int($valid) && ($this->_code === $valid)) {
			return true;
		}
		elseif (is_array($valid) && in_array($this->_code, $valid, true)) {
			return true;
		}

		return PEAR :: raiseError('Invalid response code received from server', $this->_code, PEAR_ERROR_RETURN);
	}

	function command($command, $valid) {
		if (PEAR :: isError($error = $this->_put($command))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse($valid))) {
			return $error;
		}

		return true;
	}

	function getResponse() {
		return array (
			$this->_code,
			join("\n", $this->_arguments)
		);
	}

	function getGreeting() {
		return $this->_greeting;
	}

	function connect($timeout = null, $persistent = false) {
		$this->_greeting = null;
		$result = $this->_socket->connect($this->host, $this->port, $persistent, $timeout, $this->_socket_options);
		if (PEAR :: isError($result)) {
			return PEAR :: raiseError('Failed to connect socket: ' .
			$result->getMessage());
		}

		/*
		* Now that we're connected, reset the socket's timeout value for
		* future I/O operations. This allows us to have different socket
		* timeout values for the initial connection (our $timeout parameter)
		* and all other socket operations.
		*/
		if ($this->_timeout > 0) {
			if (PEAR :: isError($error = $this->setTimeout($this->_timeout))) {
				return $error;
			}
		}

		if (PEAR :: isError($error = $this->_parseResponse(220))) {
			return $error;
		}

		/* Extract and store a copy of the server's greeting string. */
		list (, $this->_greeting) = $this->getResponse();

		if (PEAR :: isError($error = $this->_negotiate())) {
			return $error;
		}

		return true;
	}

	function disconnect() {
		if (PEAR :: isError($error = $this->_put('QUIT'))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(221))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_socket->disconnect())) {
			return PEAR :: raiseError('Failed to disconnect socket: ' .
			$error->getMessage());
		}

		return true;
	}

	function _negotiate() {
		if (PEAR :: isError($error = $this->_put('EHLO', $this->localhost))) {
			return $error;
		}

		if (PEAR :: isError($this->_parseResponse(250))) {
			/* If we receive a 503 response, we're already authenticated. */
			if ($this->_code === 503) {
				return true;
			}

			/* If the EHLO failed, try the simpler HELO command. */
			if (PEAR :: isError($error = $this->_put('HELO', $this->localhost))) {
				return $error;
			}
			if (PEAR :: isError($this->_parseResponse(250))) {
				return PEAR :: raiseError('HELO was not accepted: ', $this->_code, PEAR_ERROR_RETURN);
			}

			return true;
		}

		foreach ($this->_arguments as $argument) {
			$verb = strtok($argument, ' ');
			$arguments = substr($argument, strlen($verb) + 1, strlen($argument) - strlen($verb) - 1);
			$this->_esmtp[$verb] = $arguments;
		}

		if (!isset ($this->_esmtp['PIPELINING'])) {
			$this->pipelining = false;
		}

		return true;
	}

	function _getBestAuthMethod() {
		$available_methods = explode(' ', $this->_esmtp['AUTH']);

		foreach ($this->auth_methods as $method => $callback) {
			if (in_array($method, $available_methods)) {
				return $method;
			}
		}

		return PEAR :: raiseError('No supported authentication methods', null, PEAR_ERROR_RETURN);
	}

	function auth($uid, $pwd, $method = '', $tls = true, $authz = '') {
		/* We can only attempt a TLS connection if one has been requested,
		* we're running PHP 5.1.0 or later, have access to the OpenSSL
		* extension, are connected to an SMTP server which supports the
		* STARTTLS extension, and aren't already connected over a secure
		* (SSL) socket connection. */
		if ($tls && version_compare(PHP_VERSION, '5.1.0', '>=') && extension_loaded('openssl') && isset ($this->_esmtp['STARTTLS']) && strncasecmp($this->host, 'ssl://', 6) !== 0) {
			/* Start the TLS connection attempt. */
			if (PEAR :: isError($result = $this->_put('STARTTLS'))) {
				return $result;
			}
			if (PEAR :: isError($result = $this->_parseResponse(220))) {
				return $result;
			}
			if (PEAR :: isError($result = $this->_socket->enableCrypto(true, STREAM_CRYPTO_METHOD_TLS_CLIENT))) {
				return $result;
			}
			elseif ($result !== true) {
				return PEAR :: raiseError('STARTTLS failed');
			}

			/* Send EHLO again to recieve the AUTH string from the
			* SMTP server. */
			$this->_negotiate();
		}

		if (empty ($this->_esmtp['AUTH'])) {
			return PEAR :: raiseError('SMTP server does not support authentication');
		}

		/* If no method has been specified, get the name of the best
		* supported method advertised by the SMTP server. */
		if (empty ($method)) {
			if (PEAR :: isError($method = $this->_getBestAuthMethod())) {
				/* Return the PEAR_Error object from _getBestAuthMethod(). */
				return $method;
			}
		} else {
			$method = strtoupper($method);
			if (!array_key_exists($method, $this->auth_methods)) {
				return PEAR :: raiseError("$method is not a supported authentication method");
			}
		}

		if (!isset ($this->auth_methods[$method])) {
			return PEAR :: raiseError("$method is not a supported authentication method");
		}

		if (!is_callable($this->auth_methods[$method], false)) {
			return PEAR :: raiseError("$method authentication method cannot be called");
		}

		if (is_array($this->auth_methods[$method])) {
			list ($object, $method) = $this->auth_methods[$method];
			$result = $object-> {
				$method }
			($uid, $pwd, $authz, $this);
		} else {
			$func = $this->auth_methods[$method];
			$result = $func ($uid, $pwd, $authz, $this);
		}

		/* If an error was encountered, return the PEAR_Error object. */
		if (PEAR :: isError($result)) {
			return $result;
		}

		return true;
	}

	function setAuthMethod($name, $callback, $prepend = true) {
		if (!is_string($name)) {
			return PEAR :: raiseError('Method name is not a string');
		}

		if (!is_string($callback) && !is_array($callback)) {
			return PEAR :: raiseError('Method callback must be string or array');
		}

		if (is_array($callback)) {
			if (!is_object($callback[0]) || !is_string($callback[1]))
				return PEAR :: raiseError('Bad mMethod callback array');
		}

		if ($prepend) {
			$this->auth_methods = array_merge(array (
				$name => $callback
			), $this->auth_methods);
		} else {
			$this->auth_methods[$name] = $callback;
		}

		return true;
	}

	function _authDigest_MD5($uid, $pwd, $authz = '') {
		if (PEAR :: isError($error = $this->_put('AUTH', 'DIGEST-MD5'))) {
			return $error;
		}
		/* 334: Continue authentication request */
		if (PEAR :: isError($error = $this->_parseResponse(334))) {
			/* 503: Error: already authenticated */
			if ($this->_code === 503) {
				return true;
			}
			return $error;
		}

		$challenge = base64_decode($this->_arguments[0]);
		$digest = & Auth_SASL :: factory('digestmd5');
		$auth_str = base64_encode($digest->getResponse($uid, $pwd, $challenge, $this->host, "smtp", $authz));

		if (PEAR :: isError($error = $this->_put($auth_str))) {
			return $error;
		}
		/* 334: Continue authentication request */
		if (PEAR :: isError($error = $this->_parseResponse(334))) {
			return $error;
		}

		/* We don't use the protocol's third step because SMTP doesn't
		* allow subsequent authentication, so we just silently ignore
		* it. */
		if (PEAR :: isError($error = $this->_put(''))) {
			return $error;
		}
		/* 235: Authentication successful */
		if (PEAR :: isError($error = $this->_parseResponse(235))) {
			return $error;
		}
	}

	function _authCRAM_MD5($uid, $pwd, $authz = '') {
		if (PEAR :: isError($error = $this->_put('AUTH', 'CRAM-MD5'))) {
			return $error;
		}
		/* 334: Continue authentication request */
		if (PEAR :: isError($error = $this->_parseResponse(334))) {
			/* 503: Error: already authenticated */
			if ($this->_code === 503) {
				return true;
			}
			return $error;
		}

		$challenge = base64_decode($this->_arguments[0]);
		$cram = & Auth_SASL :: factory('crammd5');
		$auth_str = base64_encode($cram->getResponse($uid, $pwd, $challenge));

		if (PEAR :: isError($error = $this->_put($auth_str))) {
			return $error;
		}

		/* 235: Authentication successful */
		if (PEAR :: isError($error = $this->_parseResponse(235))) {
			return $error;
		}
	}

	function _authLogin($uid, $pwd, $authz = '') {
		if (PEAR :: isError($error = $this->_put('AUTH', 'LOGIN'))) {
			return $error;
		}
		/* 334: Continue authentication request */
		if (PEAR :: isError($error = $this->_parseResponse(334))) {
			/* 503: Error: already authenticated */
			if ($this->_code === 503) {
				return true;
			}
			return $error;
		}

		if (PEAR :: isError($error = $this->_put(base64_encode($uid)))) {
			return $error;
		}
		/* 334: Continue authentication request */
		if (PEAR :: isError($error = $this->_parseResponse(334))) {
			return $error;
		}

		if (PEAR :: isError($error = $this->_put(base64_encode($pwd)))) {
			return $error;
		}

		/* 235: Authentication successful */
		if (PEAR :: isError($error = $this->_parseResponse(235))) {
			return $error;
		}

		return true;
	}

	function _authPlain($uid, $pwd, $authz = '') {
		if (PEAR :: isError($error = $this->_put('AUTH', 'PLAIN'))) {
			return $error;
		}
		/* 334: Continue authentication request */
		if (PEAR :: isError($error = $this->_parseResponse(334))) {
			/* 503: Error: already authenticated */
			if ($this->_code === 503) {
				return true;
			}
			return $error;
		}

		$auth_str = base64_encode($authz . chr(0) . $uid . chr(0) . $pwd);

		if (PEAR :: isError($error = $this->_put($auth_str))) {
			return $error;
		}

		/* 235: Authentication successful */
		if (PEAR :: isError($error = $this->_parseResponse(235))) {
			return $error;
		}

		return true;
	}

	function helo($domain) {
		if (PEAR :: isError($error = $this->_put('HELO', $domain))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(250))) {
			return $error;
		}

		return true;
	}

	function getServiceExtensions() {
		return $this->_esmtp;
	}

	function mailFrom($sender, $params = null) {
		$args = "FROM:<$sender>";

		/* Support the deprecated array form of $params. */
		if (is_array($params) && isset ($params['verp'])) {
			/* XVERP */
			if ($params['verp'] === true) {
				$args .= ' XVERP';

				/* XVERP=something */
			}
			elseif (trim($params['verp'])) {
				$args .= ' XVERP=' . $params['verp'];
			}
		}
		elseif (is_string($params) && !empty ($params)) {
			$args .= ' ' . $params;
		}

		if (PEAR :: isError($error = $this->_put('MAIL', $args))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(250, $this->pipelining))) {
			return $error;
		}

		return true;
	}

	function rcptTo($recipient, $params = null) {
		$args = "TO:<$recipient>";
		if (is_string($params)) {
			$args .= ' ' . $params;
		}

		if (PEAR :: isError($error = $this->_put('RCPT', $args))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(array (
				250,
				251
			), $this->pipelining))) {
			return $error;
		}

		return true;
	}

	function quotedata(& $data) {
		/* Change Unix (\n) and Mac (\r) linefeeds into
		* Internet-standard CRLF (\r\n) linefeeds. */
		$data = preg_replace(array (
			'/(?<!\r)\n/',
			'/\r(?!\n)/'
		), "\r\n", $data);

		/* Because a single leading period (.) signifies an end to the
		* data, legitimate leading periods need to be "doubled"
		* (e.g. '..'). */
		$data = str_replace("\n.", "\n..", $data);
	}

	function data($data, $headers = null) {
		/* Verify that $data is a supported type. */
		if (!is_string($data) && !is_resource($data)) {
			return PEAR :: raiseError('Expected a string or file resource');
		}

		/* Start by considering the size of the optional headers string. We
		* also account for the addition 4 character "\r\n\r\n" separator
		* sequence. */
		$size = (is_null($headers)) ? 0 : strlen($headers) + 4;

		if (is_resource($data)) {
			$stat = fstat($data);
			if ($stat === false) {
				return PEAR :: raiseError('Failed to get file size');
			}
			$size += $stat['size'];
		} else {
			$size += strlen($data);
		}

		/* RFC 1870, section 3, subsection 3 states "a value of zero indicates
		* that no fixed maximum message size is in force". Furthermore, it
		* says that if "the parameter is omitted no information is conveyed
		* about the server's fixed maximum message size". */
		$limit = (isset ($this->_esmtp['SIZE'])) ? $this->_esmtp['SIZE'] : 0;
		if ($limit > 0 && $size >= $limit) {
			$this->disconnect();
			return PEAR :: raiseError('Message size exceeds server limit');
		}

		/* Initiate the DATA command. */
		if (PEAR :: isError($error = $this->_put('DATA'))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(354))) {
			return $error;
		}

		/* If we have a separate headers string, send it first. */
		if (!is_null($headers)) {
			$this->quotedata($headers);
			if (PEAR :: isError($result = $this->_send($headers . "\r\n\r\n"))) {
				return $result;
			}
		}

		/* Now we can send the message body data. */
		if (is_resource($data)) {
			/* Stream the contents of the file resource out over our socket
			* connection, line by line. Each line must be run through the
			* quoting routine. */
			while (strlen($line = fread($data, 8192)) > 0) {
				/* If the last character is an newline, we need to grab the
				* next character to check to see if it is a period. */
				while (!feof($data)) {
					$char = fread($data, 1);
					$line .= $char;
					if ($char != "\n") {
						break;
					}
				}
				$this->quotedata($line);
				if (PEAR :: isError($result = $this->_send($line))) {
					return $result;
				}
			}
		} else {
			/*
			* Break up the data by sending one chunk (up to 512k) at a time.
			* This approach reduces our peak memory usage.
			*/
			for ($offset = 0; $offset < $size;) {
				$end = $offset +512000;

				/*
				* Ensure we don't read beyond our data size or span multiple
				* lines. quotedata() can't properly handle character data
				* that's split across two line break boundaries.
				*/
				if ($end >= $size) {
					$end = $size;
				} else {
					for (; $end < $size; $end++) {
						if ($data[$end] != "\n") {
							break;
						}
					}
				}

				/* Extract our chunk and run it through the quoting routine. */
				$chunk = substr($data, $offset, $end - $offset);
				$this->quotedata($chunk);

				/* If we run into a problem along the way, abort. */
				if (PEAR :: isError($result = $this->_send($chunk))) {
					return $result;
				}

				/* Advance the offset to the end of this chunk. */
				$offset = $end;
			}
		}

		/* Finally, send the DATA terminator sequence. */
		if (PEAR :: isError($result = $this->_send("\r\n.\r\n"))) {
			return $result;
		}

		/* Verify that the data was successfully received by the server. */
		if (PEAR :: isError($error = $this->_parseResponse(250, $this->pipelining))) {
			return $error;
		}

		return true;
	}

	function sendFrom($path) {
		if (PEAR :: isError($error = $this->_put('SEND', "FROM:<$path>"))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(250, $this->pipelining))) {
			return $error;
		}

		return true;
	}

	function send_from($path) {
		return sendFrom($path);
	}

	function somlFrom($path) {
		if (PEAR :: isError($error = $this->_put('SOML', "FROM:<$path>"))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(250, $this->pipelining))) {
			return $error;
		}

		return true;
	}

	function soml_from($path) {
		return somlFrom($path);
	}

	function samlFrom($path) {
		if (PEAR :: isError($error = $this->_put('SAML', "FROM:<$path>"))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(250, $this->pipelining))) {
			return $error;
		}

		return true;
	}

	function saml_from($path) {
		return samlFrom($path);
	}

	function rset() {
		if (PEAR :: isError($error = $this->_put('RSET'))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(250, $this->pipelining))) {
			return $error;
		}

		return true;
	}

	function vrfy($string) {
		/* Note: 251 is also a valid response code */
		if (PEAR :: isError($error = $this->_put('VRFY', $string))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(array (
				250,
				252
			)))) {
			return $error;
		}

		return true;
	}

	function noop() {
		if (PEAR :: isError($error = $this->_put('NOOP'))) {
			return $error;
		}
		if (PEAR :: isError($error = $this->_parseResponse(250))) {
			return $error;
		}

		return true;
	}

	function identifySender() {
		return true;
	}

}