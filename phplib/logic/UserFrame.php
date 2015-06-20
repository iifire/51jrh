<?php

//**********************************************************
// Description: 客户端cgi框架
//**********************************************************
//
abstract class UserFrame extends CommApp {
	const PARAMNAME_NEED_LOGIN = "need_login";
	const PARAMNAME_LOGIN_AID = "login_aid";
	protected $m_psession;

	abstract function StartApp();

	protected function Start() {
		try {
			$this->InitSession();
			$this->StartApp();
		} catch (UserNotLoginException $e) {
			$this->HandleUserNotLoginException($e);
		}
	}

	public function GetSessionPtr() {
		if (!($this->IsCheckLogin())) {
			throw new UserNotLoginException("对不起，您没有登录，请登录后重试！\n");
		}
		return $this->m_psession;
	}

	public function GetUin() {
		if (!($this->IsCheckLogin())) {
			throw new UserNotLoginException("对不起，您没有登录，请登录后重试！\n");
		}
		return $this->m_psession->GetUin();
	}

	public function GetNickName() {
		if (!($this->IsCheckLogin())) {
			throw new UserNotLoginException("对不起，您没有登录，请登录后重试！\n");
		}
		return $this->m_psession->GetNickName();
	}

	private function InitSession() {
		if ($this->IsCheckLogin()) {
			$this->m_psession = new UserSessionPtlogin2V4($this->GetLoginAID());
			if (!($this->m_psession->IsLogin())) {
				throw new UserNotLoginException("对不起，您没有登录，请登录后重试！\n");
			}
		}
	}

	protected function IsCheckLogin() {
		//$config = $this->GetConfig();
		//$login = $config[$this->GetConfigNode()][self::PARAMNAME_NEED_LOGIN];
		$login = $this->GetParamValue($this->GetConfigNode(), self :: PARAMNAME_NEED_LOGIN);
		if ($login)
			return true;
		else
			return false;
	}

	protected function HandleUserNotLoginException(UserNotLoginException $e) {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, $e);
		ob_start();
		//$this->CgiOutput->MessageBox($e->GetUserVisibleMsg());
		$this->CgiOutput->MessageBox("对不起，您没有登陆，请登陆后再试！");
		$this->CgiOutput->GoUrl();
		ob_flush();
		return false;
	}

}
?>