<?php
require_once "alert.class.php";
$config = get_queue_config();
$admin_array = explode(',', $config['MONITOR']['admin']);
//print_r($admin_array);exit;
$qc = new QC();
foreach ($admin_array as $admin){
	$param = array(
				"Sender" => "QueueMonitor",
				"Receiver" => $admin,
				"Title" => "QueueAlarm",
				"MsgInfo" => "test"
	);
	$param = GBKtoUTF8($param);
	$qc->SendSMS($param);
}
echo "ok";
?>