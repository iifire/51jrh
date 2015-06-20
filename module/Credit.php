<?php

class Credit extends AbstractAction {
    public function __construct($params) {
    	
        parent::__construct($params);
        global $TPL;
    	$TPL->assign('menu_flag','credit');
    }
    protected function _init() {
    	
    }
    //put your code here
    public function indexAction(){
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductDAO');
    	$productHot = $productDAO->getHot(6);
    	$companyHot = $this->getDao('CompanyDAO')->getHot(8);
    	$companyAct = $this->getDao('CompanyActDAO')->getList('',8);
    	
    	//sidebar
    	$wikiArticle = $this->getDao('WikiArticleDAO')->getList('',8);
    	
    	$TPL->assign('product_hot',$productHot);
    	$TPL->assign('company_hot',$companyHot);
    	$TPL->assign('company_act',$companyAct);
    	$TPL->assign('submenu_flag',false);
    	//sidebar
    	$TPL->assign('wiki_artile',$wikiArticle);
        $TPL->display( "credit/index.html" );
    }
}
?>
