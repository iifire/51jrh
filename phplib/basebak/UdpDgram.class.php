 <?php

//**********************************************************
// File name: UdpDgram.class.php
// Class name: UdpDgram
// Create date: 2011/3/28
// Update date: 2011/3/28
// Author: gary
// Description: UDP包装类
//**********************************************************

require_once ("Socket.class.php");

class UdpDgram extends Socket {
	public function __construct($iFamily = AF_INET) {
		parent :: __construct(SOCK_DGRAM, $iFamily);
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function Open($sAddr = "0.0.0.0", $iPort = 0, $bReuseAddr = false) {
		if (parent :: Open($sAddr, $iPort, $bReuseAddr) == -1 || $this->SetBlock(false) == -1) {
			$this->Close();
			return -1;
		}
		return 0;
	}

	public function SendTo($inBuf, $maxLen, $sAddr, $iPort, $iFlag = 0) {
		if (!$this->IsOpen()) {
			if ($this->Open() == -1) {
				return -1;
			}
		}
		$send_len = socket_sendto($this->GetHandle(), $inBuf . "", $maxLen, $iFlag, $sAddr, $iPort);
		if ($send_len === false) {
			return -1;
		}
		return $send_len;
	}

	public function RecvFrom(& $outBuf, $maxLen, & $sAddr, & $iPort, $iTimeout = -1, $iFlag = 0) {
		if (!$this->IsOpen()) {
			return -1;
		}

		$retcode = 0;
		if ($iTimeout < 0) {
			$retcode = $this->BlockRecvFrom($outBuf, $maxLen, $sAddr, $iPort, $iFlag);
		} else {
			$retcode = $this->NonBlockRecvFrom($outBuf, $maxLen, $sAddr, $iPort, $iTimeout, $iFlag);
		}
		return $retcode;
	}

	protected function BlockRecvFrom(& $outBuf, $maxLen, & $sAddr, & $iPort, $iFlag) {
		$this->SetBlock(true);

		$iRecvLen = 0;
		for (;;) {
			$iRecvLen = socket_recvfrom($this->GetHandle(), $outBuf, $maxLen, $iFlag, $sAddr, $iPort);
			if ($iRecvLen === false) {
				$errno = socket_last_error();
				if ($errno != SOCKET_EINTR) {
					$this->SetBlock(false);
					return -1;
				}
			} else {
				break;
			}
		}
		$this->SetBlock(false);
		return $iRecvLen;
	}

	protected function NonBlockRecvFrom(& $outBuf, $maxLen, & $sAddr, & $iPort, $iTimeout, $iFlag) {
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
					return 0; // 接收超时
				} else {
					$iRecvLen = socket_recvfrom($this->GetHandle(), $outBuf, $maxLen, $iFlag, $sAddr, $iPort);
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

}
?>
