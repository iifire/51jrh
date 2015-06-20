<?php
require_once dirname(__FILE__).'/../basic/common.php';
require_once dirname(__FILE__).'/../../lib/Memcache.class.php';

abstract class AbstractException extends Exception{

	public function show_msg(){
		queue_out_put('Error'.$this->getCode().': '.$this->getMessage()."\r\n");
	}
	public function store_msg(){
		try{
			$filename = ERROR_LOG_PATH.'/'.ERROR_LOG_FILE;
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
			$n = fwrite($fp, "{".__FILE__."][" .__LINE__."]ERROR: ".$this->getMessage()."\n");
			if (!$n){
				throw new Exception("fwrite log file error");
				return;
			}
			fclose($fp);
		}catch(Exception $e){
			OSS_LOG(__FILE__, __LINE__, LP_ERROR, 'STORE_ERROR:' . $e->getMessage() . "\n");
		}
	}
	abstract public function run();
}
?>