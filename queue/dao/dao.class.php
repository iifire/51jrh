<?php
/**
 * 类QueueDao，对队列信息、出库的消息入库操作
 */
require_once dirname(dirname(__FILE__)).'/basic/common.php';

class QueueDao{

	protected $db;
	protected $db_array;
	protected $host;
	protected $user;
	protected $password;
	protected $database;
	protected $port;
	protected $debug;

	public function __construct($type, $debug=true){
		$this->debug = $debug;
		$config = get_queue_config();
		if ($this->debug){
			//使用DBMysql
			$this->host = $config[$type]['host'];
			$this->user = $config[$type]['user'];
			$this->password = $config[$type]['password'];
			$this->database = $config[$type]['database'];
			$this->port = $config[$type]['port'];
			unset($config);
			$this->db = new DBMysql(
			$this->host,
			$this->user,
			$this->password,
			$this->database,
			$this->port
			);
		}else{
			//预先新建出所有的DBProxy
			$comm_config = GetCommonConfig();
			$nodeConfig = $config[$type];

			foreach ($nodeConfig as $nodeName => $dbName){
				$ip = $comm_config[$dbName]["db_ip"];
				$port = $comm_config[$dbName]["db_port"];
				$this->db[$nodeName] = new DBMysql($ip, "oss", "oss_da", 'dbCFClientPopJensenZhang', $port);
			}
			$ip = $comm_config["6205_ieod_cf_gpm_db"]["proxy_ip"];
			$port = $comm_config["6205_ieod_cf_gpm_db"]["proxy_port"];
			$this->db['default'] = new DBMysql($ip, "oss", "oss_da", 'dbCFClientPopJensenZhang',  $port);
		}
	}

	public function update($sql, $type = "default"){
		try{
			if ($this->debug){//DBMysql的更新
				$rst = $this->db->ExecUpdate($sql);
			}else{//DBProxy的更新
				$nodeName = $type . '_nodename';
				if (isset($this->db[$nodeName])){
					$rst = $this->db[$nodeName]->ExecUpdate($sql);
				}else{
					$rst = $this->db['default']->ExecUpdate($sql);
				}
			}
			return $rst;
		}catch (Exception $e){
			OSS_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: $sql\n");
		}
	}
}
?>