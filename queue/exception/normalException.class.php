<?php
require_once dirname(__FILE__).'/abstractException.class.php';

class NormalException extends AbstractException{

	public function run(){
		$this->show_msg();
		$this->store_msg();
		$rst = CommonMemcache::get($this->code);
		if ($rst === false){
			CommonMemcache::set($this->code, 1, 0, 3600*3);
		}else{
			CommonMemcache::set($this->code, $rst+1, 0, 3600*3);
		}
	}
}
?>