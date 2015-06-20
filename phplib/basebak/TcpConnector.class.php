<?php

//**********************************************************
// File name: TcpConnector.class.php
// Class name: TcpConnector
// Create date: 2011/3/29
// Update date: 2011/3/29
// Author: gary
// Description: Tcp���ӽ�����װ��
//**********************************************************

require_once ("TcpStream.class.php");

class TcpConnector {
	public function Connect(TcpStream & $tcpStream, $sAddr, $iPort, $iTimeout = -1, $iSendBufferSize = -1) {
		$bIsOpen = $tcpStream->IsOpen();
		if (!$bIsOpen) {
			if ($tcpStream->Open() == -1) {
				return -1;
			}
		}

		$retcode = $this->NonBlockConnect($tcpStream, $sAddr, $iPort, $iTimeout, $iSendBufferSize);
		if ($retcode == -1) {
			if (!$bIsOpen && $tcpStream->IsOpen()) {
				$tcpStream->Close();
			}
		}
		return $retcode;
	}

	public function NonBlockConnect(TcpStream & $tcpStream, $sAddr, $iPort, $iTimeout, $iSendBufferSize) {
		$sock = $tcpStream->GetHandle();
		// ���÷��ͻ������Ĵ�С
		if ($iSendBufferSize >= 0) {
			if ($tcpStream->SetSockOption(SOL_SOCKET, SO_SNDBUF, $iSendBufferSize) == -1) {
				return -1;
			}
		}

		// �������ӣ�����trueֱ�ӷ��سɹ�
		if (@ socket_connect($sock, $sAddr, $iPort) === true) {
			return 0;
		} else {
			$errno = socket_last_error();

			if ($errno != SOCKET_EINPROGRESS && $errno != SOCKET_EALREADY) {
				return -1;
			}
		}

		$iTimeoutSec = null;
		$iTimeoutUSec = null;
		if ($iTimeout >= 0) {
			$iTimeoutSec = floor($iTimeout / 1000);
			$iTimeoutUSec = ($iTimeout % 1000) * 1000;
		}
		$iTimeBegin = microtime(true) * 1000;

		for (;;) {
			$rfds = array (
				$sock
			);
			$wfds = array (
				$sock
			);
			$efds = null;

			$nfd_ready = socket_select($rfds, $wfds, $efds, $iTimeoutSec, $iTimeoutUSec);

			if ($nfd_ready === false) {
				if (socket_last_error() != SOCKET_EINTR) {
					return -1;
				}
			} else
				if ($nfd_ready == 0) {
					return -2; // ���ӳ�ʱ
				} else {
					// ���ӳ���ʱ����ɼ��ɶ����ֿ�д
					if (in_array($sock, $rfds) && in_array($sock, $wfds)) {
						return -1;
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
		return 0;
	}
}
?>
