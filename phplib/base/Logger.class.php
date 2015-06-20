<?php

//**********************************************************
// File name: LogsClass.class.php
// Class name: ��־��¼��
// Create date: 2009/04/07
// Update date: 2009/04/07
// Author: garyzou
// Description: ��־��¼��
// Example: $log = new Logger();
// //$log->initLogger(DIRECT_ECHO);
// //$log->initLogger(DATE_FILE_LOGGER,"./log/");
// $log->initLogger(ROLL_FILE_LOGGER,"./log/","logtest.dddd",256,5);
// $log->setNullLoger(LP_BASE|LP_TRACE|LP_DEBUG);
// $log->writeLog(__FILE__,__LINE__,LP_BASE,"test log string\n");
//**********************************************************

/*//! \brief ������־��Ĭ���ļ����ֵΪ10MB 1024*1024*10
define(DEFAULT_LOG_MAX_SIZE, 1024*1024*10);
define(DEFALUT_LOG_SAVE_NUM, 5);

//��־����
define(ROLL_FILE_LOGGER, 1);
define(DATE_FILE_LOGGER, 2);
define(DIRECT_ECHO, 3);

//��־����
define(LP_BASE, 1);
define(LP_TRACE, LP_BASE << 1);
define(LP_DEBUG, LP_BASE << 2);
define(LP_INFO, LP_BASE << 3);
define(LP_USER1, LP_BASE << 4);
define(LP_USER2, LP_BASE << 5);
define(LP_WARNING, LP_BASE << 6);
define(LP_ERROR, LP_BASE << 7);
define(LP_CRITICAL, LP_BASE << 8);
define(LP_MAX, LP_CRITICAL);*/

//��־����,��Ӧ��ʹ�ô˺�
/*define(BASE, "__FILE__,__LINE__,LP_BASE");
define(TRACE, "__FILE__,__LINE__,LP_TRACE");
define(DEBUG, "__FILE__,__LINE__,LP_DEBUG");
define(INFO, "__FILE__,__LINE__,LP_INFO");
define(USER1, "__FILE__,__LINE__,LP_USER1");
define(USER2, "__FILE__,__LINE__,LP_USER2");
define(WARNING, "__FILE__,__LINE__,LP_WARNING");
define(ERROR, "__FILE__,__LINE__,LP_ERROR");
define(CRITICAL, "__FILE__,__LINE__,LP_CRITICAL");*/

static $Logger_pInstance = NULL;

class Logger {
	private $FilePath;
	private $FileName;
	private $FullFileName;
	private $MaxSize;
	private $FileNum;
	private $LogType;
	private $NullLog;

	function __construct() {
	}

	static function Instance() {
		global $Logger_pInstance;
		if ($Logger_pInstance == NULL) {
			$dispatcher = new Logger();
			;
			$Logger_pInstance = $dispatcher;
		}
		return $Logger_pInstance;
	}

	//����:��ʼ����־��¼��
	//����:�ļ���·��,Ҫд����ļ�������Ҫ����׺,��־������ROLL_FILE_LOGGER���������ļ���
	//���:��
	function initLogger($logtype = DIRECT_ECHO, $dir = NULL, $filename = NULL, $maxsize = DEFAULT_LOG_MAX_SIZE, $filenum = DEFALUT_LOG_SAVE_NUM) {
		$this->FilePath = $dir;
		$this->LogType = $logtype;
		if ($logtype == ROLL_FILE_LOGGER) {
			if ($filename == NULL) {
				//�׳��쳣��û��ָ���ļ�����
				throw new OssException("filename cannot be null.\n");
			} else {
				$pos = strrpos($filename, ".");
				if ($pos === false) {
					//not find
				} else {
					$filename = substr($filename, 0, $pos);
				}
			}
		} else
			if ($logtype == DATE_FILE_LOGGER) {
				$filename = $filename . date("Ymd");
			}
		$this->FileName = $filename;
		$this->FullFileName = $dir . "/" . $filename . ".log";
		$this->MaxSize = $maxsize;
		$this->FileNum = $filenum;
		$this->NullLog = 0;

		if ($logtype != DIRECT_ECHO) {
			//�ж��Ƿ���ڸ��ļ�
			if (!file_exists($this->FullFileName)) { //������
				//����Ŀ¼
				if (!$this->createFolder($this->FilePath)) {
					//����Ŀ¼���ɹ��Ĵ���
					throw new OssException("Create Directory Error.\n");
				}
				//�����ļ�
				if (!$this->createLogFile($this->FullFileName)) {
					//�����ļ����ɹ��Ĵ���
					throw new OssException("Create file Error.\n");
				}
			}
		}
	}

	//����:���ò�Ҫ��ӡ��־�ļ���
	//����:Ҫд��ļ�¼
	//���:��
	function setNullLoger($loglevel) {
		if ($loglevel > 0) {
			$this->NullLog = $loglevel;
		}
	}

	//����:д���¼
	//����:Ҫд��ļ�¼
	//���:��
	function writeLog($codefilename = __FILE__, $codefileline = __LINE__, $loglevel, $log) {
		if ((($this->NullLog) & $loglevel) >= LP_BASE) {
			//����Ҫ��ӡ��־
			return false;
		}

		if ($this->LogType == ROLL_FILE_LOGGER) {
			if (strlen($log) > $this->MaxSize) {
				//̫�����ܼ�¼
				throw new OssException("Log Content too long.\n");
			}
			if (filesize($this->FullFileName) + strlen($log) > $this->MaxSize) {
				$this->ShiftLogFile($this->FilePath);
			}
		}
		//[2009-04-03 18:18:51] [DEBUG] [xxxxx.php:149] logmessage
		//"/usr/local/xxx/yyy/abc.log"
		$codefilename = basename($codefilename); // $file is set to "abc.log"
		$log = "[" . date("Y-m-d H:i:s") . "] [" . $this->getDescribe($loglevel) . "] [pid " . getmypid() . "] [" . $codefilename . ":" . $codefileline . "] " . $log;
		if (($loglevel == LP_ERROR || gethostbyname($_SERVER["SERVER_NAME"]) == "172.27.129.153") && strpos($_SERVER["SERVER_NAME"], "qt.qq.com") === FALSE) {
			mt_srand(time());
			$_num = (mt_rand() + getmypid()) % 5;
			$ports = array (
				5550,
				5551,
				5552,
				5553,
				5554
			);

			$_udpLogPlat = new UdpLogger("172.27.134.213", $ports[$_num]);
			$_udpLogPlat->setLogType(0x00);
			$_udpLogPlat->setPlatName("PHP");
			$_udpLogPlat->logComm(0, "0", "0", $log);
		}
		//$log = oss_iconv(ICONV_FROM,ICONV_TO,$log);
		if ($this->LogType == DIRECT_ECHO) {
			//ֱ�Ӵ�ӡ��ҳ����
			echo nl2br($log);
		} else {
			$handle = fopen($this->FullFileName, "a+");
			//д��־
			if (!fwrite($handle, $log)) {
				//д��־ʧ��
				throw new OssException("Write Log to file Error.\n");
			}
			//�ر��ļ�
			fclose($handle);
		}
	}

	//����:д���¼
	//����:Ҫд��ļ�¼
	//���:��
	function writePlatLog($codefilename = __FILE__, $codefileline = __LINE__, $loglevel, $actid, $platname, $log) {
		if ((($this->NullLog) & $loglevel) >= LP_BASE) {
			//����Ҫ��ӡ��־
			return false;
		}

		if ($this->LogType == ROLL_FILE_LOGGER) {
			if (strlen($log) > $this->MaxSize) {
				//̫�����ܼ�¼
				throw new OssException("Log Content too long.\n");
			}
			if (filesize($this->FullFileName) + strlen($log) > $this->MaxSize) {
				$this->ShiftLogFile($this->FilePath);
			}
		}
		//[2009-04-03 18:18:51] [DEBUG] [xxxxx.php:149] logmessage
		//"/usr/local/xxx/yyy/abc.log"
		$codefilename = basename($codefilename); // $file is set to "abc.log"
		$log = "[" . date("Y-m-d H:i:s") . "] [" . $this->getDescribe($loglevel) . "] [pid " . getmypid() . "] [" . $codefilename . ":" . $codefileline . "] " . $log;
		if (strpos($_SERVER["SERVER_NAME"], "qt.qq.com") === FALSE) {
			mt_srand(time());
			$_num = (mt_rand() + getmypid()) % 5;
			$ports = array (
				5550,
				5551,
				5552,
				5553,
				5554
			);

			$_udpLogPlat = new UdpLogger("172.17.143.111", $ports[$_num]);
			$_udpLogPlat->setLogType(0x02);
			$_udpLogPlat->setPlatName($platname);
			$_udpLogPlat->logComm($actid, "0", "0", $log);
		}
		//$log = oss_iconv(ICONV_FROM,ICONV_TO,$log);
		if ($this->LogType == DIRECT_ECHO) {
			//ֱ�Ӵ�ӡ��ҳ����
			echo nl2br($log);
		} else {
			$handle = fopen($this->FullFileName, "a+");
			//д��־
			if (!fwrite($handle, $log)) {
				//д��־ʧ��
				throw new OssException("Write Log to file Error.\n");
			}
			//�ر��ļ�
			fclose($handle);
		}
	}

	private function ShiftLogFile($dir) {
		$needremovefile = $this->createFileName($this->FilePath, $this->FileName, ($this->FileNum - 1));
		if (file_exists($needremovefile)) {
			unlink($needremovefile);
		}
		for ($i = ($this->FileNum - 2); $i >= 0; $i--) {
			$oldlogfile = "";
			if ($i == 0) {
				$oldlogfile = $this->FullFileName;
			} else {
				$oldlogfile = $this->createFileName($this->FilePath, $this->FileName, $i);
			}
			if (file_exists($oldlogfile)) {
				$newlogfile = $this->createFileName($this->FilePath, $this->FileName, ($i +1));
				rename($oldlogfile, $newlogfile);
			}
		}
	}

	//��װ�ļ���
	private function createFileName($dir, $filename, $num) {
		return $dir . "/" . $filename . $num . ".log";
	}

	//����:����Ŀ¼
	//����:Ҫ������Ŀ¼
	//���:true | false
	private function createDir($dir) {
		return is_dir($dir) or ($this->createDir(dirname($dir)) and mkdir($dir, 0777));
	}

	//�������Ŀ¼
	//createFolder("2007/3/4");
	//�ڵ�ǰĿ¼�´���2007/3/4��Ŀ¼�ṹ��
	private function createFolder($dir) {
		return is_dir($dir) or ($this->createFolder(dirname($dir)) and mkdir($dir, 0777));
	}

	//����:������־�ļ�
	//����:Ҫ������Ŀ¼
	//���:true | false
	private function createLogFile($path) {
		$handle = fopen($path, "w"); //�����ļ�
		fclose($handle);
		return file_exists($path);
	}

	private function getDescribe($loglevel) {
		$LPDescribe = array (
			LP_BASE => "BASE",
			LP_TRACE => "TRACE",
			LP_DEBUG => "DEBUG",
			LP_INFO => "INFO",
			LP_USER1 => "USER1",
			LP_USER2 => "USER2",
			LP_WARNING => "WARNING",
			LP_ERROR => "ERROR",
			LP_CRITICAL => "CRITICAL",
			LP_MAX => "MAX"
		);
		return $LPDescribe[$loglevel];
	}
}
?>
