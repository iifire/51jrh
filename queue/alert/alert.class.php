<?php
require_once dirname(__FILE__).'/../basic/common.php';
require_once dirname(__FILE__).'/../../lib/Tof.class.php';

/*define ('RTX_PATH', '/usr/local/ieod-web/mon/bin/');
 define ('RTX_NAME', 'rtx');*/

class Alert{

	public function send_alert($admin_array, $msg){
		$qc = new QC();
		foreach($admin_array as $admin){
			$param = array(
				"Sender" => "QueueMonitor",
				"Receiver" => $admin,
				"Title" => "QueueException",
				"MsgInfo" => $msg
			);
			$param = GBKtoUTF8($param);
			$qc->SendRTX($param);
			$qc->SendSMS($param);
		}
	}
}

?>