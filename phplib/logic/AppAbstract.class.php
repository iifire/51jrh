<?php
abstract class AppAbstract {
	const DEFAULT_USER_VISIBLE_MSG = "对不起，系统繁忙，请稍后再试！";
	const NODENAME_FRAMEWORK_DEFAULT = "FRAMEWORK_DEFAULT";
	const PARAMNAME_LOG_FILE_PATH = "log_file_path";
	const PARAMNAME_LOG_FILE_NAME = "log_file_name";
	const PARAMNAME_LOG_TYPE = "log_type";
	const PARAMNAME_ROLL_LOG_SIZE = "roll_log_size";
	const PARAMNAME_ROLL_LOG_NUM = "roll_log_num";
	const PARAMNAME_RUNTIME_DEBUG = "runtime_debug";
	const PARAMNAME_LOGIN_AID = "login_aid";
	protected $CgiOutput;

	public function Run() {
		if (ENVIRONMENT === 'development') {
			$this->InitLog();
			$this->Start();
		} else {
			try {
				$this->InitLog();
				$this->Start();
			} catch (OssException $e) {
				$this->HandleOssException($e);
			} catch (AppException $e) {
				$this->HandleAppException($e);
			} catch (Exception $e) {
				$this->HandleStdException($e);
			}
		}
		//catch (...)
		//{
		// $this->HandleUnknownException();
		//}

		return 0;

	}

	function __construct() {
		$this->CgiOutput = new CGIOutput();
		//$this->CgiOutput->SetContentType();
	}

	function __destruct() {
	}

	abstract protected function Init();

	abstract public function GetConfig();

	protected function GetConfigNode() {
		return self :: NODENAME_FRAMEWORK_DEFAULT;
	}

	protected function GetParamValue($nodename, $param) {
		$config = $this->GetConfig();
		if (!$config) {
			throw new OssException(__FILE__, __LINE__, "config doesn't exist");
		}
		if ($config[$nodename] && array_key_exists($param, $config[$nodename])) {
			return $config[$nodename][$param];
		}
		if ($config[$this->GetConfigNode()] && array_key_exists($param, $config[$this->GetConfigNode()])) {
			return $config[$this->GetConfigNode()][$param];
		}
		return $config[self :: NODENAME_FRAMEWORK_DEFAULT][$param];
	}

	protected function GetLogPath() {
		return $this->GetParamValue($this->GetConfigNode(), self :: PARAMNAME_LOG_FILE_PATH);
	}

	protected function GetLogName() {
		return $this->GetParamValue($this->GetConfigNode(), self :: PARAMNAME_LOG_FILE_NAME);
	}

	protected function GetLogType() {
		$logtype = $this->GetParamValue($this->GetConfigNode(), self :: PARAMNAME_LOG_TYPE);
		if ($logtype == "roll_file")
			return 1;
		else
			if ($logtype == "date_file")
				return 2;
			else
				if ($logtype == "direct_echo")
					return 3;
		return 1;
	}

	protected function GetRollLogSize() {
		return $this->GetParamValue($this->GetConfigNode(), self :: PARAMNAME_ROLL_LOG_SIZE);
	}

	protected function GetRollLogNum() {
		return $this->GetParamValue($this->GetConfigNode(), self :: PARAMNAME_ROLL_LOG_NUM);
	}

	protected function GetLoginAID() {
		return $this->GetParamValue($this->GetConfigNode(), self :: PARAMNAME_LOGIN_AID);
	}

	protected function IsRuntimeDebug() {
		$runtime_debug = $this->GetParamValue($this->GetConfigNode(), self :: PARAMNAME_RUNTIME_DEBUG);
		if ($runtime_debug == true)
			return true;
		else
			return false;
	}

	protected function InitLog() {
		if ($this->GetLogType() == DATE_FILE_LOGGER) {
			G_INIT_LOGGER(DATE_FILE_LOGGER, $this->GetLogPath(), $this->GetLogName());
		} else
			if ($this->GetLogType() == DIRECT_ECHO) {
				G_INIT_LOGGER(DIRECT_ECHO, NULL, NULL);
			} else {
				G_INIT_LOGGER(ROLL_FILE_LOGGER, $this->GetLogPath(), $this->GetLogName(), $this->GetRollLogSize(), $this->GetRollLogNum());
			}

		if (!($this->IsRuntimeDebug())) {
			G_SET_NULL_LOGGER(LP_BASE | LP_TRACE | LP_DEBUG);
		}
	}

	protected function HandleAppException(AppException $e) {
		// 捕获异常
		G_LOG($e->getFile(), $e->getLine(), LP_ERROR, $e);
		ob_start();
		$this->CgiOutput->MessageBox($e->getMessage());
		$this->CgiOutput->GoUrl();
		ob_flush();
		return false;
	}

	protected function HandleOssException(OssException $e) {
		// 捕获异常
		G_LOG($e->getFile(), $e->getLine(), LP_ERROR, $e);
		ob_start();
		$this->CgiOutput->MessageBox("对不起，系统繁忙，请稍后再试！");
		//$this->CgiOutput->MessageBox($e->getMessage());
		$this->CgiOutput->GoUrl();
		ob_flush();
		return false;
	}

	protected function HandleStdException(Exception $e) {
		G_LOG($e->getFile(), $e->getLine(), LP_ERROR, $e);
		ob_start();
		$this->CgiOutput->MessageBox($e->getMessage());
		$this->CgiOutput->GoUrl();
		ob_flush();
		return false;
	}

	protected function HandleUnknownException() {
		G_LOG(__FILE__, __LINE__, LP_ERROR, "Unknow Error!\n");
		ob_start();
		$this->CgiOutput->MessageBox(self :: DEFAULT_USER_VISIBLE_MSG);
		$this->CgiOutput->GoUrl();
		ob_flush();
		return false;
	}

}
?>
