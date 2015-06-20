<?php
/**
 * 管理端应用框架
 * @author gary (yanggaojiao@qq.com)
 * @date 2014-11-30 
 */
abstract class AdminAbstract extends AppAbstract {
	protected $m_psession;

	abstract function start();

	protected function init() {
		try {
			$this->initSession();
			$this->start();
		} catch (AdminNotLoginException $e) {
			$this->handleAdminNotLoginException($e);
		} catch (AdminNoValidException $e) {
			$this->handleAdminNoValidException($e);
		}
	}

	public function getSessionPtr() {
		if (!($this->isCheckLogin())) {
			throw new AdminNotLoginException("对不起，您没有登录，请登录后重试！\n");
		}
		return $this->m_psession;
	}

	private function initSession() {
		$this->m_psession = new AdminSession();
		if (!$this->m_psession->isLogin()) {
			throw new AdminNotLoginException("对不起，您没有登录，请登录后重试！\n");
		}
		if (!$this->m_psession->isValidAdmin()) {
			throw new AdminNoValidException("对不起，您没有操作权限！");
		}

	}
	protected function handleAdminNotLoginException(AdminNotLoginException $e) {
		G_LOG(__FILE__, __LINE__, LP_ERROR, $e);
		ob_start();
		$this->cgiOutput->messageBox($e->getUserVisibleMsg());
		$this->cgiOutput->GoUrl();
		ob_flush();
		return false;
	}

}
?>
