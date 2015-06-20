<?php
ini_set( 'display_errors', 'on');
error_reporting(E_ALL);

require_once dirname(__FILE__).'/mqManager.class.php';
require_once dirname(__FILE__).'/dao/dao.class.php';
require_once dirname(__FILE__).'/exception/normalException.class.php';

define('CONSUME_MSG_COUNT', 20000);

class TestConsumer extends AdminAppFrame{

	private $dao;
	private $host;
	private $user;
	private $password;
	private $database;

	public function __construct(){
		$config = get_queue_config();
		$this->host = $config['STORE_MSG']['host'];
		$this->user = $config['STORE_MSG']['user'];
		$this->password = $config['STORE_MSG']['password'];
		$this->database = $config['STORE_MSG']['database'];
		unset($config);

		$this->dao = new QueueDao('QUEUE_DB_NODE', false);
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

	private function _get_type($sql){
		$temp_array = explode(' ', $sql);
		$temp = $temp_array[1];
		$temp_array = explode('_', $temp);
		$len = count($temp_array);
		$type = $temp_array[$len-2];
		return $type;
	}

	public function StartApp(){
		$mq1 = new MqManager('HTTPSQS1');
		$sql1 = $mq1->pull_msg(CONSUME_MSG_COUNT);
		$mq2 = new MqManager('HTTPSQS2');
		$sql2 = $mq2->pull_msg(CONSUME_MSG_COUNT);

		$this->store($sql1);
		$this->store($sql2);

	}

	public function store($string){

		$sql_array = explode(DIR_WORD, $string);
		$sql_array = array_slice($sql_array, 0, count($sql_array)-1);
		foreach ($sql_array as $sql){
			try{
				if(strlen($sql) > 1){
					//	echo $sql;
					$type = $this->_get_type($sql);
					$rst = $this->dao->update($sql, $type);
					echo "SQL: $sql";
					if ($rst === null){
						echo "error<br />";
						throw new NormalException(STORE_MSG_ERROR, STORE_MSG_ERROR_CODE);
					}else{
						echo "$rst<br />";
					}
				}
			}catch(Exception $e){
				OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'STORE_SQL:' . $e->getMessage() . "\n");
				if($e instanceof AbstractException){
					$e->run();
				}
			}
		}

	}

	public function test_store($string){
		try{
			$filename = MQ_LOG_PATH.'/'.MQ_LOG_FILE;
			if (!is_file($filename)){
				throw new Exception("file not exist");
				return;
			}
			if (filesize($filename) > FILE_MAX_LENGTH){//文件过大，则清零重写
				$fp = fopen($filename, 'w+');
			}else{
				$fp = fopen($filename, 'a+');
			}
			if (!$fp){
				throw new Exception("fopen log file error");
				return;
			}
			$sql_array = explode(DIR_WORD, $string);
			$sql_array = array_slice($sql_array, 0, count($sql_array)-1);
			foreach($sql_array as $sql){
				if(strlen($sql) > 1){
					//	echo $sql;
					$n = fwrite($fp, "SQL: $sql\n");
					if (!$n){
					 throw new Exception("fwrite log file error");
					 return;
					}
				}
			}
			fclose($fp);
		}catch(Exception $e){
			OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'STORE_SQL:' . $e->getMessage() . "\n");
		}
		//	OSS_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: $sql\n");
	}
}

if (isset($argv[1]) && $argv[1] < 30){
	$n = $argv[1];
}else $n = 1;
for ($i=0; $i<$n; $i++){
	RUN_APP('TestConsumer');
}
echo "completed";
?>