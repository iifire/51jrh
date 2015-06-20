<?php
require_once dirname(__FILE__).'/abstractException.class.php';

class SeriousException extends AbstractException{

	public function run(){
		$this->show_msg();
		$this->store_msg();
		if(CommonMemcache::get($this->code) === false){
			CommonMemcache::set($this->code, 1, 0, 3600*3);
		}else{
			CommonMemcache::set($this->code, 1, 0, 3600*3);
		}
	}
}
?>