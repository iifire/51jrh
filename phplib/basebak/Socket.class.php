<?php

//**********************************************************
// File name: Socket.class.php
// Class name: Socket
// Create date: 2011/3/28
// Update date: 2011/3/28
// Author: gary
// Description: socket类
//**********************************************************

class Socket {
	const INVALID_HANDLE = -1;

	public function Close() {
		if ($this->IsOpen()) {
			socket_close($this->_iHandle);
		}
		$this->_iHandle = self :: INVALID_HANDLE;
	}

	public function GetLocalAddr(& $sAddr, & $iPort) {
		if (socket_getsockname($this->_iHandle, $sAddr, $iPort) === false) {
			return -1;
		}
		return 0;
	}

	public function GetRemoteAddr(& $sAddr, & $iPort) {
		if (socket_getpeername($this->_iHandle, $sAddr, $iPort) === false) {
			return -1;
		}
		return 0;
	}

	public function IsOpen() {
		return ($this->_iHandle !== self :: INVALID_HANDLE);
	}

	public function SetSockOption($iLevel, $iOption, $optval) {
		if (socket_set_option($this->_iHandle, $iLevel, $iOption, $optval) === false) {
			return -1;
		}
		return 0;
	}

	public function GetSockOption($iLevel, $iOption, & $optval) {
		$optval = socket_get_option($this->_iHandle, $iLevel, $iOption);
		if ($optval === false) {
			return -1;
		}
		return 0;
	}

	protected function __construct($iType, $iFamily = AF_INET, $iProtocol = 0) {
		$this->_iType = $iType;
		$this->_iFamily = $iFamily;
		$this->_iProtocol = $iProtocol;
		$this->_iHandle = self :: INVALID_HANDLE;
	}

	protected function __destruct() {
		$this->Close();
	}

	protected function Open($sAddr = "0.0.0.0", $iPort = 0, $bReuseAddr = true) {
		$bIsResource = is_resource($sAddr);

		if ($this->IsOpen()) {
			return -2;
		}

		// 如果是socket
		if ($bIsResource) {
			$this->_iHandle = $sAddr;
		} else {
			$sock = socket_create($this->_iFamily, $this->_iType, $this->_iProtocol);
			if ($sock === false) {
				return -1;
			}
			$this->_iHandle = $sock;
		}

		if (!$this->IsOpen()) {
			return -1;
		}

		// 如果不是socket
		if (!$bIsResource) {
			if ($bReuseAddr) {
				if ($this->SetSockOption(SOL_SOCKET, SO_REUSEADDR, 1) === false) {
					$this->Close();
					return -1;
				}
			}

			if ($this->Bind($sAddr, $iPort) == -1) {
				$this->Close();
				return -1;
			}
		}
		return 0;
	}

	protected function SetBlock($bBlock) {
		if ($bBlock === true) {
			if (socket_set_block($this->_iHandle) === false) {
				return -1;
			}
		} else {
			if (socket_set_nonblock($this->_iHandle) === false) {
				return -1;
			}
		}
		return 0;
	}

	protected function GetHandle() {
		return $this->_iHandle;
	}

	private function Bind($sAddr, $iPort = 0) {
		if (socket_bind($this->_iHandle, $sAddr, $iPort) === false) {
			return -1;
		}
		return 0;
	}

	private $_iType;

	private $_iFamily;

	private $_iProtocol;

	private $_iHandle;
}
?>
