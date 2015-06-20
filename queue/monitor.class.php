<?php
//获取队列长度
//获取队列未读消息数
//获取出入队列个数
//统计各类异常并告警

ini_set( 'display_errors', 'on');
error_reporting(E_ALL);

require_once dirname(__FILE__).'/mqManager.class.php';
require_once dirname(__FILE__).'/alert/alert.class.php';
require_once dirname(__FILE__).'/dao/dao.class.php';

define ('NORMAL_LIMIT', '100, 100, 100');
define ('UNREAD_LIMIT', 100000);

class Monitor extends AdminAppFrame{

	private $normal_limit;
	private $serious_codes;
	private $normal_codes;
	private $serious_msgs;
	private $normal_msgs;
	private $admins;
	private $dao;
	private $table_name;
	private $alert;

	public function __construct(){
		$this->normal_limit = explode(',', NORMAL_LIMIT);
		$this->serious_codes = explode(',', SERIOUS_CODES);
		$this->normal_codes = explode(',', NORMAL_CODES);
		$this->serious_msgs = explode(',', SERIOUS_MSGS);
		$this->normal_msgs = explode(',', NORMAL_MSGS);
		$config = get_queue_config();
		$this->admins = explode(',', $config['MONITOR']['admin']);
		$this->table_name = $config['MONITOR']['table_name'];
		unset($config);
		$this->dao = new QueueDao('QUEUE_INFO', true);
		$this->alert = new Alert();
	}

	function HandleAppException(AppException $e) {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
		//$this->output(-100, "APP_EXCEPTION");
		return -1;
	}

	function HandleOssException(OssException $e) {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
		//$this->output(-100, "OSS_EXCEPTION");
		return -1;
	}

	function HandleStdException(Exception $e) {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
		//$this->output(-100, "STD_EXCEPTION");
		return -1;
	}

	function HandleUnknownException() {
		OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
		//$this->output(-100, "UNKNOWN_ERROR");
		return -1;
	}

	public function GetConfig() {
		return GetGlobalConfig();
	}

	private function _alert_exception(){
		foreach ($this->serious_codes as $key => $code){
			$count = CommonMemcache::get($code);
			if ($count && $count>0){
				$this->alert->send_alert($this->admins, "Queue Exception: ".$this->serious_msgs[$key]);
				CommonMemcache::set($code, 0);
			}
		}
		foreach ($this->normal_codes as $key => $code){
			$count = CommonMemcache::get($code);
			if ($count && $count>$this->normal_limit[$key]){
				$this->alert->send_alert($this->admins, "Queue Exception: ".$this->normal_msgs[$key]);
				CommonMemcache::set($code, 0);
			}
		}
	}

	private function _view_queue($server_name){
		$mq = new MqManager($server_name);
		$rst = $mq->get_string_status();
		$rst_json = $mq->get_json_status();
		$push_num = $mq->get_push_num();
		$pull_num = $mq->get_pull_num();		
		foreach ($rst as $key=>$var){
			$ob_info = json_decode($rst_json[$key]);
			$queue_name = $ob_info->name;
			$queue_length = $ob_info->maxqueue;
			$unread_count = $ob_info->unread;
			$push_count = $push_num[$key];
			$pull_count = $pull_num[$key];
			//如果不能从CMEM中获取到入队出队量，就向库中插入-1
			if (!isset($push_count)){
				$push_count = -1;
			}
			if (!isset($pull_count)){
				$pull_count = -1;
			}
			$table_name = $this->table_name;
			$value = "(null, '$server_name', '$queue_name', $queue_length,".
			" $unread_count, $push_count, $pull_count, null)";
			$sql = "insert into $table_name values $value;";
			$this->dao->update($sql);
			queue_out_put($var);
			queue_out_put("push_count:$push_count;");
			queue_out_put("pull_count:$pull_count;");
			
			if ($unread_count > UNREAD_LIMIT){
				//如果未读消息数超过上限，需要告警
				$this->alert->send_alert($this->admins, "Queue Alert: [$server_name][$queue_name]".
				"Unread count($unread_count) beyond the limit(".UNREAD_LIMIT.");");
			}
		}
	}

	public function clear_mem(){
		CommonMemcache::set('HTTPSQS1_MainQueuePush', 0);
		CommonMemcache::set('HTTPSQS1_MainQueuePull', 0);
		CommonMemcache::set('HTTPSQS1_SubQueuePush', 0);
		CommonMemcache::set('HTTPSQS1_SubQueuePull', 0);
		CommonMemcache::set('HTTPSQS2_MainQueuePush', 0);
		CommonMemcache::set('HTTPSQS2_MainQueuePull', 0);
		CommonMemcache::set('HTTPSQS2_SubQueuePush', 0);
		CommonMemcache::set('HTTPSQS2_SubQueuePull', 0);
	}

	public function StartApp(){
		$this->_alert_exception();
		$this->_view_queue('HTTPSQS1');
		$this->_view_queue('HTTPSQS2');
		$this->clear_mem();
	}
}

RUN_APP('Monitor');
echo "completed\r\n";
?>