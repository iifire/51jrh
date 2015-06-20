<?php
class Licaip2p extends AbstractAction {
	protected $_pagesize = 10;
    public function __construct($params) {
        parent::__construct($params);
        global $TPL;
    	$TPL->assign('menu_flag','licai');
    }
    protected function _init() {
    	global $TPL;
        
    }
    public function indexAction(){}
    //put your code here
    public function pingtaiAction(){
    	global $TPL;
    	$this->_init();
    	$page = (int)$this->params['page'];
    	$page = $page ? $page : 1;
    	$companyHot = $this->getDao('CompanyDAO')->getHot(12);
    	$companyAct = $this->getDao('CompanyActDAO')->getList('',8);
    	$companyList = $this->getDao('CompanyDAO')->getList('',$page,$this->_pagesize);
    	
    	$page = array(
    		'totalnum' => $companyList['page']['total'],
            'total' => ceil($companyList['page']['total']/$companyList['page']['size']),
            'cur' => $companyList['page']['cur'],
            'size' => $companyList['page']['size'],
            //'sOrder' => $sOrderKey,
            //'sDirect' => $sDirect
        );
        $TPL->assign('submenu_flag',true);
        $TPL->assign('submenu_code','p2p');
         $TPL->assign('ssmenu_flag','pingtai');      
        $TPL->assign('company_hot',$companyHot);
    	$TPL->assign('company_act',$companyAct);
    	$TPL->assign( 'page',  $page);
    	$TPL->assign('company_list',$companyList['data']);

        $TPL->display( "licai/p2p/pingtai/index.html" );
    }
}
?>
