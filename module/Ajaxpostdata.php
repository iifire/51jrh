<?php
class Ajaxpostdata extends AbstractAction {
    public function __construct($params) {
        parent::__construct($params);
    }
    protected function _init() {
    	$key = $this->params['skey'];
    	if (!$key || $key!='648adh923a2adanpsfk') {
    		die();
    	}
    }
    
    public function indexAction(){
    	global $TPL;
    	$url = 'http://jinrong.58.com/sh/daikuan/list/xiaofeidai/';
    	$html = file_get_contents($url);
    	$TPL->assign('html',$html);
        $TPL->display( "ajaxpostdata/index.html" );
    }
    
    public function postAction(){
    	$this->_init();
    	$tableName = $this->params['tablename'];
    	if (true || strpos($tableName,'_product_')>=0) {
    		$baseDAO = $this->getDao('BaseDAO');
    		$result = $baseDAO->getDescTable($tableName);
    		$fields = array();
    		foreach ($result as $row) {
    			array_push($fields,$row['Field']);
    		}
    		$baseDAO = $baseDAO->setTableName($tableName);
    		$data = array();
    		foreach ($this->params as $key=>$value) {
    			if (in_array($key,$fields)) {
    				$data[$key] = $value;
    			}
    		}
    		if (count($data)) {
    			
    			$baseDAO->setData('insert',array(),$data);
    		}
    	} else {
    		die();
    	}
    	
        
    }
}
?>
