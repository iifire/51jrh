<?php
/**
 * ÖØÖÃ¶ÓÁÐ
 */
require_once dirname(__FILE__).'/mqManager.class.php';

class ResetQueue extends AdminAppFrame{

	public function __construct(){
		$config = get_queue_config();
		unset($config);
	}

	function HandleAppException(AppException $e) {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
		$this->output(-100, "APP_EXCEPTION");
		return -1;
	}

	function HandleOssException(OssException $e) {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
		$this->output(-100, "OSS_EXCEPTION");
		return -1;
	}

	function HandleStdException(Exception $e) {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
		$this->output(-100, "STD_EXCEPTION");
		return -1;
	}

	function HandleUnknownException() {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
		$this->output(-100, "UNKNOWN_ERROR");
		return -1;
	}

	public function GetConfig() {
		return GetGlobalConfig();
	}

	public function StartApp(){
		$mq1 = new MqManager('HTTPSQS1');
		$mq2 = new MqManager('HTTPSQS2');
		$mq1->reset_queue();
		$mq2->reset_queue();
	}
}

RUN_APP('ResetQueue');
echo "completed";
?>