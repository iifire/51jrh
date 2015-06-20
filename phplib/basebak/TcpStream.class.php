<?php

//**********************************************************
// File name: TcpStream.class.php
// Class name: TcpStream
// Create date: 2011/3/29
// Update date: 2011/3/29
// Author: gary
// Description: TCP包装类
//**********************************************************

require_once ("Socket.class.php");

class TcpStream extends Socket {
	private $__friendClasses = array (
		'TcpAcceptor',
		'TcpConnector',
		'TcpStream'
	);

	public function __get($key) {
		$trace = debug_backtrace();
		if (isset ($trace[1]['class']) && in_array($trace[1]['class'], $this->__friendClasses)) {
			return $this-> $key;
		}

		trigger_error('Cannot access private property ' . __CLASS__ . '::$' . $key, E_USER_ERROR);
	}

	public function __set($key, $value) {
		$trace = debug_backtrace();
		if (isset ($trace[1]['class']) && in_array($trace[1]['class'], $this->__friendClasses)) {
			return $this-> $key = $value;
		}

		trigger_error('Cannot access private property ' . __CLASS__ . '::$' . $key, E_USER_ERROR);
	}

	public function __call($name, $arguments) {
		$trace = debug_backtrace();
		if (isset ($trace[1]['class']) && in_array($trace[1]['class'], $this->__friendClasses)) {
			return call_user_func_array(array (
				$this,
				$name
			), $arguments);
		}

		trigger_error('Cannot access private property ' . __CLASS__ . '::$' . $name, E_USER_ERROR);
	}

	public function __construct($iFamily = AF_INET) {
		parent :: __construct(SOCK_STREAM, $iFamily);
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function Open($sAddr = "0.0.0.0", $iPort = 0, $bReuseAddr = true) {
		if (parent :: Open($sAddr, $iPort, $bReuseAddr) == -1 || $this->SetBlock(false) == -1) {
			$this->Close();
			return -1;
		}
		return 0;
	}

	public function SendN($inBuf, $iLen, $iTimeout = -1, $iFlags = 0) {
		$inBuf .= "";
		$bufLen = strlen($inBuf);
		if ($iLen == 0 || $bufLen == 0) {
			return 0;
		}
		$iLen = min(array (
			$bufLen,
			$iLen
		));

		$iTimeoutSec = null;
		$iTimeoutUSec = null;
		if ($iTimeout >= 0) {
			$iTimeoutSec = floor($iTimeout / 1000);
			$iTimeoutUSec = ($iTimeout % 1000) * 1000;
		}

		$iSentLen = 0;
		$iTimeBegin = microtime(true) * 1000;

		for (;;) {
			$rfds = null;
			$wfds = array (
				$this->GetHandle()
			);
			$efds = null;

			$nfd_ready = socket_select($rfds, $wfds, $efds, $iTimeoutSec, $iTimeoutUSec);
			if ($nfd_ready < 0) {
				if (socket_last_error() != SOCKET_EINTR) {
					return -1;
				}
			} else
				if ($nfd_ready == 0) {
					break;
				} else {
					$iSent = socket_send($this->GetHandle(), substr($inBuf, $iSentLen), $iLen - $iSentLen, $iFlags);
					if ($iSent === false) {
						if (socket_last_error() != SOCKET_EWOULDBLOCK) {
							return -1;
						}
					} else {
						$iSentLen += $iSent;
						if ($iSentLen >= $iLen) {
							break;
						}
					}
				}
			if ($iTimeout > 0) {
				$iTimeout = $iTimeout + $iTimeBegin -microtime(true) * 1000;
				if ($iTimeout < 0) {
					$iTimeout = 0;
					$iTimeoutSec = 0;
					$iTimeoutUSec = 0;
				}
			}
		}
		return $iSentLen;
	}

	public function Recv(& $outBuf, $iMaxLen, $iTimeout = -1, $iFlags = 0) {
		if ($iMaxLen == 0) {
			return 0;
		}

		$iTimeoutSec = null;
		$iTimeoutUSec = null;
		if ($iTimeout >= 0) {
			$iTimeoutSec = floor($iTimeout / 1000);
			$iTimeoutUSec = ($iTimeout % 1000) * 1000;
		}

		$iRecvLen = 0;
		$iTimeBegin = microtime(true) * 1000;

		for (;;) {
			$rfds = array (
				$this->GetHandle()
			);
			$wfds = null;
			$efds = null;

			$nfd_ready = socket_select($rfds, $wfds, $efds, $iTimeoutSec, $iTimeoutUSec);
			if ($nfd_ready < 0) {
				if (socket_last_error() != SOCKET_EINTR) {
					return -1;
				}
			} else
				if ($nfd_ready == 0) {
					break; // 超时
				} else {
					$iRecvLen = socket_recv($this->GetHandle(), $outBuf, $iMaxLen, $iFlags);
					if ($iRecvLen === false) {
						if (socket_last_error() != SOCKET_EWOULDBLOCK) {
							return -1;
						}
					} else {
						break;
					}
				}
			if ($iTimeout > 0) {
				$iTimeout = $iTimeout + $iTimeBegin -microtime(true) * 1000;
				if ($iTimeout < 0) {
					$iTimeout = 0;
					$iTimeoutSec = 0;
					$iTimeoutUSec = 0;
				}
			}
		}
		return $iRecvLen;
	}

	public function RecvN(& $outBuf, $iLen, $iTimeout = -1, $iFlags = 0) {
		if ($iLen == 0) {
			return 0;
		}

		$buf = "";
		$iTimeoutSec = null;
		$iTimeoutUSec = null;
		if ($iTimeout >= 0) {
			$iTimeoutSec = floor($iTimeout / 1000);
			$iTimeoutUSec = ($iTimeout % 1000) * 1000;
		}

		$iRecvLen = 0;
		$iTimeBegin = microtime(true) * 1000;

		for (;;) {
			$rfds = array (
				$this->GetHandle()
			);
			$wfds = null;
			$efds = null;

			$nfd_ready = socket_select($rfds, $wfds, $efds, $iTimeoutSec, $iTimeoutUSec);
			if ($nfd_ready < 0) {
				if (socket_last_error() != SOCKET_EINTR) {
					return -1;
				}
			} else
				if ($nfd_ready == 0) {
					break; // 超时
				} else {
					$iRecv = socket_recv($this->GetHandle(), $buf, $iLen, $iFlags);
					if ($iRecv === false) {
						if (socket_last_error() != SOCKET_EWOULDBLOCK) {
							return -1;
						}
					} else
						if ($iRecv === 0) {
							break;
						} else {
							$outBuf .= $buf;
							$iRecvLen += $iRecv;
							if ($iRecvLen == $iLen) { // 全部接收
								break;
							}
						}
				}
			if ($iTimeout > 0) {
				$iTimeout = $iTimeout + $iTimeBegin -microtime(true) * 1000;
				if ($iTimeout < 0) {
					$iTimeout = 0;
					$iTimeoutSec = 0;
					$iTimeoutUSec = 0;
				}
			}
		}
		return $iRecvLen;
	}

	public function RecvLine(& $outBuf, $iMaxLen, $iTimeout = -1, $iFlags = 0) {
		if ($iMaxLen == 0) {
			return 0;
		}

		$iTimeoutSec = null;
		$iTimeoutUSec = null;
		if ($iTimeout >= 0) {
			$iTimeoutSec = floor($iTimeout / 1000);
			$iTimeoutUSec = ($iTimeout % 1000) * 1000;
		}

		$buf = "";
		$iRecvLen = 0;
		$iTimeBegin = microtime(true) * 1000;

		for (;;) {
			$rfds = array (
				$this->GetHandle()
			);
			$wfds = null;
			$efds = null;

			$nfd_ready = socket_select($rfds, $wfds, $efds, $iTimeoutSec, $iTimeoutUSec);
			if ($nfd_ready < 0) {
				if (socket_last_error() != SOCKET_EINTR) {
					return -1;
				}
			} else
				if ($nfd_ready == 0) {
					break; // 超时
				} else {
					$bFinished = false;

					do {
						$iRecv = socket_recv($this->GetHandle(), $buf, 1, $iFlags);
						if ($iRecv === false) {
							if (socket_last_error() != SOCKET_EWOULDBLOCK) {
								return -1;
							}
						} else
							if ($iRecv === 0) {
								$bFinished = true;
								break;
							} else {
								$outBuf .= $buf;
								$iRecvLen += $iRecv;

								// 如果接收到'\n'或者达到iMaxLen，则退出
								if ($iRecvLen == $iMaxLen || substr($outBuf, $iRecvLen -1, 1) == "\n") {
									$bFinished = true;
									break;
								}
							}
					} while (1);

					if ($bFinished) {
						break;
					}
				}
			if ($iTimeout > 0) {
				$iTimeout = $iTimeout + $iTimeBegin -microtime(true) * 1000;
				if ($iTimeout < 0) {
					$iTimeout = 0;
					$iTimeoutSec = 0;
					$iTimeoutUSec = 0;
				}
			}
		}
		return $iRecvLen;
	}
}
?>
