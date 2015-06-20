<?php
/**
 * 对队列的总体操作
 * 初始化：new MqManager($curBusiness = "cf", $iTableCount = 100)
 * 消息格式[iUin, actId, type]
 */
require_once dirname(__FILE__).'/basic/myServer.class.php';
require_once dirname(__FILE__).'/../lib/Memcache.class.php';

class MqManager{
	private $server_name;
	private $need_sub_queue;
	private $queue_name;
	private $sub_queue_name;
	private $server;
	private $msg_array;
	private $tmp_sql;

	public function __construct($server_name){
		$config = get_queue_config();
		$this->server_name = $server_name;
		$this->need_sub_queue = $config['MQMANAGER']['need_sub_queue'];
		$this->queue_name = $config['MQMANAGER']['queue_name'];
		$this->sub_queue_name = $config['MQMANAGER']['sub_queue_name'];
		$this->server = new MyServer($this->server_name);
		unset($config);
	}

	public function push_msg($array){
		//将消息插入到主队列
		//如果主队列已满并且需要备用队列，就重新插入到备用队列中
		$queue_data = serialize($array);
		try{
			$rst = $this->server->put_msg($this->queue_name, $queue_data);
			if ($rst === 'HTTPSQS_PUT_END' && $this->need_sub_queue){
				//判断队列已满并且需要备用队列
				$rst = $this->server->put_msg($this->sub_queue_name, $queue_data);
			}
			return $rst;
		}catch (Exception $e){
			//	OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'Error '.$e->getCode().': '.$e->getMessage(). "\n");
			$this->_handle_exception($e);
		}
	}

	public function pull_msg($count){
		//consumer中调用的出多个消息的方法，首先出备用队列，再出主队列
		try{
			if ($this->need_sub_queue){
				$pre_unread = CommonMemcache::get($this->server_name.'_SubQueueUnread');
				if (!$pre_unread) $pre_unread = 0;
				$num = $this->_get_msg(0, $count, $this->sub_queue_name);
				$unread = $this->server->get_unread_count($this->sub_queue_name);
				$push_num = $unread - $pre_unread + $num;
				$n = CommonMemcache::get($this->server_name.'_SubQueuePush');
				if (!$n) $n = 0;
				CommonMemcache::set($this->server_name.'_SubQueuePush', $n+$push_num, 0, 3600*3);
				$n = CommonMemcache::get($this->server_name.'_SubQueuePull');
				if (!$n) $n = 0;
				CommonMemcache::set($this->server_name.'_SubQueuePull', $n+$num, 0, 3600*3);
				CommonMemcache::set($this->server_name.'_SubQueueUnread', $unread, 0, 3600*3);
			}else {
				$num = 0;	//如果不需要备用队列，则$num缺少初始化
			}

			$pre_unread = CommonMemcache::get($this->server_name.'_MainQueueUnread');
			if (!$pre_unread) $pre_unread = 0;
			$num = $this->_get_msg($num, $count, $this->queue_name);
			$unread = $this->server->get_unread_count($this->queue_name);
			$push_num = $unread - $pre_unread + $num;
			$n = CommonMemcache::get($this->server_name.'_MainQueuePush');
			if (!$n) $n = 0;
			CommonMemcache::set($this->server_name.'_MainQueuePush', $n+$push_num, 0, 3600*3);
			$n = CommonMemcache::get($this->server_name.'_MainQueuePull');
			if (!$n) $n = 0;
			CommonMemcache::set($this->server_name.'_MainQueuePull', $n+$num, 0, 3600*3);
			CommonMemcache::set($this->server_name.'_MainQueueUnread', $unread, 0, 3600*3);

			$this->_process_msg();
		}catch (Exception $e){
			//	OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'Error '.$e->getCode().': '.$e->getMessage(). "\n");
			$this->_handle_exception($e);
		}
		return $this->tmp_sql;
	}

	private function _get_msg($num, $count, $queue_name){
		//拉取、统计消息，结果储存在$this->msg_array
		$num = $this->server->getn_msg($queue_name, $count-$num, $array);
		//这是更新后的httpsqs服务器才指出的方法
		foreach ($array as $msg){
			if (isset($this->msg_array[$msg])){
				$this->msg_array[$msg]++;
			}else{
				$this->msg_array[$msg] = 1;
			}
		}
		return $num;
	}

	private function _process_msg(){
		//在这里合成sql语句
		$this->tmp_sql = '';
		$where_sql_array = array();
		foreach($this->msg_array as $msg_str => $msg_count){
			$msg = unserialize($msg_str);
			$table_name = $msg['tableName'];
			/*if(strpos($table_name, "lol") !== false ){
				continue;
			}
			if(strpos($table_name, "webtips") !== false ){
				continue;
			}*/
			
			$iUin = $msg['iUin'];
			$actId = $msg['actId'];

			if (!isset($msg['type'])){
				break;
			}else{
				$type = $msg['type'];
			}
			if (isset($msg['iArea'])){
				$iArea = $msg['iArea'];
			}else{
				$iArea = 0;
			}
			if (isset($msg['isPrized'])){
				$isPrized = $msg['isPrized'];
			}else{
				$isPrized = 1;
			}
			if (isset($msg['isPoped'])){
				$isPoped = $msg['isPoped'];
			}else{
				$isPoped = 1;
			}
			if ($type == TYPE0){
				//UpdateUserPackageStatus:
				$value = "(iUin=$iUin and iActivityId=$actId and isPrized=0)";
				if (!isset($where_sql_array[$type][$table_name])){
					$where_sql_array[$type][$table_name] =
					"update $table_name set isPrized=1, dtPopDate=now() where $value";
				}else{
					$where_sql_array[$type][$table_name] .= " or $value";
				}
			}elseif ($type == TYPE1){
				//UpdateUserPackageClickStatus:
				$value = "(iUin=$iUin and iActivityId=$actId and isPrized=0)";
				if (!isset($where_sql_array[$type][$table_name])){
					$where_sql_array[$type][$table_name] =
					"update $table_name set isPrized=1 where $value";
				}else{
					$where_sql_array[$type][$table_name] .= " or $value";
				}
			}elseif ($type == TYPE2){
				//UpdateUserPopedStatus:
				$sql = 'UPDATE `' . $table_name .
				 '` SET isPoped=1, iPopUpCount=iPopUpCount+'.$msg_count.
				 ', dtPopDate=NOW() WHERE `iUin`=' .
				$iUin .' AND iActivityId='.$actId;
			}elseif ($type == TYPE3){
				//UpdateUserPackageStatusByArea:
				$value = "(iUin=$iUin and iActivityId=$actId and isPrized=0 and iArea=$iArea)";
				if (!isset($where_sql_array[$type][$table_name])){
					$where_sql_array[$type][$table_name] =
					"update $table_name set isPrized=1 where $value";
				}else{
					$where_sql_array[$type][$table_name] .= " or $value";
				}
			}elseif ($type == TYPE4){
				//UpdateUserPopedStatusByArea:
				$sql = 'UPDATE `' . $table_name
				. '` SET isPoped=1, iPopUpCount=iPopUpCount+'.$msg_count
				.', dtPopDate=NOW() WHERE `iUin`=' .
				$iUin .' AND iActivityId='.$actId.' AND iArea='.$iArea;
			}elseif ($type == TYPE5){
				//UpdateGacUserPopedStatus:
				$sql = 'UPDATE `' . $table_name . '` SET isPoped='.$pop
				.', iPopUpCount=iPopUpCount+'.$msg_count
				.', dtPopDate=NOW() WHERE `iUin`="' . $iUin
				.'" AND iActivityId='.$actId;
			}elseif ($type == TYPE6){
				//UpdateGacUserPackageStatus:
				$sql = 'UPDATE `' . $table_name . '` SET isPrized='.$isPrized
				.' WHERE `iUin`="' . $iUin .'" AND iActivityId='.$actId;

			}else{
				//这里这个消息出错了
				echo "$msg_str;";
				throw new NormalException(GET_MSG_ERROR, GET_MSG_ERROR_CODE);
			}
			if (isset($sql)){
				$sql .= ";".DIR_WORD;
				$this->tmp_sql .= $sql;
			}
		}

		foreach($where_sql_array as $mid_sql_array){
			foreach ($mid_sql_array as $where_sql ){
				$where_sql .= ";".DIR_WORD;
				$this->tmp_sql .= $where_sql;
			}
		}

		unset($this->msg_array);
		/*if ($type == TYPE0){
		 //UpdateUserPackageStatus:
		 $value = "(iUin=$iUin and iActivityId=$actId and isPrized=0)";
		 if (!isset($where_sql_array[$type][$table_name])){
		 $where_sql_array[$type][$table_name] =
		 "update $table_name set isPrized=1, dtPopDate=now() where $value";
		 }else{
		 $where_sql_array[$type][$table_name] .= " or $value";
		 }
			}elseif ($type == TYPE1){
			//UpdateUserPackageClickStatus:
			$value = "(iUin=$iUin and iActivityId=$actId and isPrized=0)";
			if (!isset($where_sql_array[$type][$table_name])){
			$where_sql_array[$type][$table_name] =
			"update $table_name set isPrized=1 where $value";
			}else{
			$where_sql_array[$type][$table_name] .= " or $value";
			}
			}elseif ($type == TYPE2){
			//UpdateUserPopedStatus:
			$value = "(iUin=$iUin and iActivityId=$actId)";
			if (!isset($where_sql_array[$type][$table_name])){
			$where_sql_array[$type][$table_name] =
			"update $table_name set isPoped=1,dtPopDate=now() where $value";
			}else{
			$where_sql_array[$type][$table_name] .= " or $value";
			}
			if (!isset($when_sql_array[$type][$table_name])){
			$when_sql_array[$type][$table_name]="update $table_name set iPopUpCount= (case ";
			}
			$when_sql_array[$type][$table_name] .= "when iUin=$iUin and iActivityId=".
			"$actId then iPopUpCount+$msg_count ";
			}elseif ($type == TYPE3){
			//UpdateUserPackageStatusByArea:
			$value = "(iUin=$iUin and iActivityId=$actId and isPrized=0 and iArea=$iArea)";
			if (!isset($where_sql_array[$type][$table_name])){
			$where_sql_array[$type][$table_name] =
			"update $table_name set isPrized=1 where $value";
			}else{
			$where_sql_array[$type][$table_name] .= " or $value";
			}
			}elseif ($type == TYPE4){
			//UpdateUserPopedStatusByArea:
			$value = "(iUin=$iUin and iActivityId=$actId and iArea=$iArea)";
			if (!isset($where_sql_array[$type][$table_name])){
			$where_sql_array[$type][$table_name] =
			"update $table_name set isPoped=1,dtPopDate=now() where $value";
			}else{
			$where_sql_array[$type][$table_name] .= " or $value";
			}
			if (!isset($when_sql_array[$type][$table_name])){
			$when_sql_array[$type][$table_name]="update $table_name set iPopUpCount= (case ";
			}
			$when_sql_array[$type][$table_name] .= "when iUin=$iUin and iActivityId=".
			"$actId and iArea=$iArea then iPopUpCount+$msg_count ";

			}elseif ($type == TYPE5){
			//UpdateGacUserPopedStatus:
			$value = "(iUin=$iUin and iActivityId=$actId)";
			if (!isset($where_sql_array[$type][$table_name])){
			$where_sql_array[$type][$table_name] =
			"update $table_name set dtPopDate=now() where $value";
			}else{
			$where_sql_array[$type][$table_name] .= " or $value";
			}
			if (!isset($when_sql_array[$type][$table_name])){
			$when_sql_array[$type][$table_name]="update $table_name set iPopUpCount= (case ";
			}
			$when_sql_array[$type][$table_name] .= "when iUin=$iUin and iActivityId=".
			"$actId then iPopUpCount+$msg_count ";
			if (!isset($pop_when_sql_array[$type][$table_name])){
			$pop_when_sql_array[$type][$table_name]="update $table_name set isPoped= (case ";
			}
			$pop_when_sql_array[$type][$table_name] .= "when iUin=$iUin and iActivityId=".
			"$actId then $isPoped ";
			}elseif ($type == TYPE6){
			//UpdateGacUserPackageStatus:
			$value = "(iUin=$iUin and iActivityId=$actId)";
			if (!isset($where_sql_array[$type][$table_name])){
			$where_sql_array[$type][$table_name] =
			"update $table_name set dtPopDate=now() where $value";
			}else{
			$where_sql_array[$type][$table_name] .= " or $value";
			}
			if (!isset($prize_when_sql_array[$type][$table_name])){
			$prize_when_sql_array[$type][$table_name]="update $table_name set isPrized= (case ";
			}
			$prize_when_sql_array[$type][$table_name] .= "when iUin=$iUin and iActivityId=".
			"$actId then $isPrized ";
			}else{
			//这里这个消息出错了
			echo "$msg_str;";
			throw new NormalException(GET_MSG_ERROR, GET_MSG_ERROR_CODE);
			}
			}
			foreach($where_sql_array as $mid_sql_array){
			foreach ($mid_sql_array as $where_sql ){
			$where_sql .= ";".DIR_WORD;
			$this->tmp_sql .= $where_sql;
			}
			}
			foreach($when_sql_array as $mid_sql_array){
			foreach ($mid_sql_array as $when_sql ){
			$when_sql .= "end);".DIR_WORD;
			$this->tmp_sql .= $when_sql;
			}
			}
			foreach($pop_when_sql_array as $mid_sql_array){
			foreach ($mid_sql_array as $pop_when_sql ){
			$pop_when_sql .= "end);".DIR_WORD;
			$this->tmp_sql .= $pop_when_sql;
			}
			}
			foreach($prize_when_sql_array as $mid_sql_array){
			foreach ($mid_sql_array as $prize_when_sql ){
			$prize_when_sql .= "end);".DIR_WORD;
			$this->tmp_sql .= $prize_when_sql;
			}
			}*/
	}

	public function reset_queue (){
		try{
			$this->server->reset_queue($this->queue_name);
			$this->server->reset_queue($this->sub_queue_name);
		}catch (Exception $e){
			//	OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'Error '.$e->getCode().': '.$e->getMessage(). "\n");
			$this->_handle_exception($e);
		}
	}

	public function get_string_status(){
		try{
			$rst['MainQueue'] = $this->server->get_queue_status($this->queue_name);
			if ($this->need_sub_queue){
				$rst['SubQueue'] = $this->server->get_queue_status($this->sub_queue_name);
			}
			return $rst;
		}catch (Exception $e){
			//	OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'Error '.$e->getCode().': '.$e->getMessage(). "\n");
			$this->_handle_exception($e);
		}
	}

	public function get_json_status(){
		try{
			$rst['MainQueue'] = $this->server->get_queue_status_json($this->queue_name);
			if ($this->need_sub_queue){
				$rst['SubQueue'] = $this->server->get_queue_status_json($this->sub_queue_name);
			}
			return $rst;
		}catch (Exception $e){
			//	OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'Error '.$e->getCode().': '.$e->getMessage(). "\n");
			$this->_handle_exception($e);
		}
	}

	public function get_push_num(){
		$num['MainQueue'] = CommonMemcache::get($this->server_name.'_MainQueuePush');
		if ($this->need_sub_queue){
			$num['SubQueue'] = CommonMemcache::get($this->server_name.'_SubQueuePush');
		}
		return $num;
	}

	public function get_pull_num(){
		$num['MainQueue'] = CommonMemcache::get($this->server_name.'_MainQueuePull');
		if ($this->need_sub_queue){
			$num['SubQueue'] = CommonMemcache::get($this->server_name.'_SubQueuePull');
		}
		return $num;
	}

	private function _handle_exception($e){
		if($e instanceof AbstractException){
			$e->run();
		}
	}

}

?>