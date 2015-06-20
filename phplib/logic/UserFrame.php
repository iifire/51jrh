<?php

//**********************************************************
// Description: �ͻ���cgi���
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
			throw new UserNotLoginException("�Բ�����û�е�¼�����¼�����ԣ�\n");
		}
		return $this->m_psession;
	}

	public function GetUin() {
		if (!($this->IsCheckLogin())) {
			throw new UserNotLoginException("�Բ�����û�е�¼�����¼�����ԣ�\n");
		}
		return $this->m_psession->GetUin();
	}

	public function GetNickName() {
		if (!($this->IsCheckLogin())) {
			throw new UserNotLoginException("�Բ�����û�е�¼�����¼�����ԣ�\n");
		}
		return $this->m_psession->GetNickName();
	}

	private function InitSession() {
		if ($this->IsCheckLogin()) {
			$this->m_psession = new UserSessionPtlogin2V4($this->GetLoginAID());
			if (!($this->m_psession->IsLogin())) {
				throw new UserNotLoginException("�Բ�����û�е�¼�����¼�����ԣ�\n");
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
		$this->CgiOutput->MessageBox("�Բ�����û�е�½�����½�����ԣ�");
		$this->CgiOutput->GoUrl();
		ob_flush();
		return false;
	}

}
?>