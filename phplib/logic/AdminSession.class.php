 <?php
//**********************************************************
// Description: 管理员登录类
//**********************************************************

class AdminSession {

	private $m_sAdminCode;

	private $m_sAdminName;

	private $m_bIsUserLogin;

	private $m_vAdminCodeArray;

	function OssAdminSession($sAdminCode) {

		$this->m_sAdminCode = $sAdminCode;
		$this->m_bIsUserLogin = false;

		//判断是否是整数并在指定的某个范围
		if (!is_numeric($this->m_sAdminCode) || intval($this->m_sAdminCode) < 0 || intval($this->m_sAdminCode) > 999999) {
			return false;
		}

		$this->m_sAdminName = $_COOKIE["ossadmin"];
		$sArrOssOp = $_COOKIE["sArrOssOp"];
		//mark by garyzou at 2010-04-22
		//if(!empty($this->m_sAdminName) && !empty($sArrOssOp))
		if (!empty ($this->m_sAdminName)) {
			$this->m_bIsUserLogin = true;
			$this->m_vAdminCodeArray = explode("|", $_COOKIE["sArrOssOp"]);
		}
		return false;
	}

	//function ~OssAdminSession()

	public function IsLogin() {
		return $this->m_bIsUserLogin;
	}

	function IsValidAdmin() {
		if (!$this->IsLogin()) {
			return false;
		}

		if ($this->CheckAdminCode($this->m_sAdminCode) || $this->CheckAdminCode(substr($this->m_sAdminCode, 0, 4) .
			"00") || $this->CheckAdminCode(substr($this->m_sAdminCode, 0, 2) .
			"0000") || $this->CheckAdminCode("000000")) {
			return true;
		}

		return false;
	}

	function GetAdminName() {
		if (!$this->IsLogin()) {
			return false;
		}

		return $this->m_sAdminName;
	}

	function Log($sLogMsg) {
		/*if ( !IsLogin() ) {
		return -1;
		}
		
		try {
		UnixConfig cOssConfig(CONFIG_FILE_PATH);
		
		SqlTpl cSqlTpl("select iLogFlag from tbOssOpCfg where sOperate = '[$]'");
		cSqlTpl << _sAdminCode;
		
		DBConnectionPtr pDBConn = DBFactory::CreateMySqlDBConnection(cOssConfig["host"]("Oss"), "root", "root1234", "dbOssAdminDB");
		DBConnection::ResultSet vResultSet;
		
		pDBConn->Connect();
		if ( pDBConn->ExecQuery(cSqlTpl.GetSql(), vResultSet) == 0 ||
		TypeTransform::StringToInt(vResultSet[0][0]) == 0 )
		{
		return -1;
		}
		
		cSqlTpl = SqlTpl("insert into tbAdminOpLog(sId,sOperate,sIP,sMemo,dtDate) values ('[$]','[$]','[$]','[$]', now())");
		cSqlTpl << _sAdminName << _sAdminCode << CGIEnv::Instance()->GetRemoteAddr() << sLogMsg;
		
		pDBConn->ExecUpdate(cSqlTpl.GetSql());
		}
		catch ( OssException & e ) {
		return -1;
		}
		
		return 0;*/
	}

	function GetAdminRole() {
		if (!$this->IsLogin()) {
			return false;

		}
		return $_COOKIE["ossadminType"];

	}

	private function CheckAdminCode($sAdminCode) {
		foreach ($this->m_vAdminCodeArray as $value) {
			if ($value == $sAdminCode)
				return true;
		}
		return false;
	}

}
?>
