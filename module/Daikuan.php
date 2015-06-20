<?php
class Daikuan extends AbstractAction {
    public function __construct($params) {
    	
        parent::__construct($params);
        global $TPL;
    	$TPL->assign('menu_flag','daikuan');
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
    	$TPL->assign('submenu_flag',true);
    	$TPL->assign('submenu_code','yongtu');
    	//sidebar
    	$TPL->assign('wiki_artile',$wikiArticle);
    	
        $TPL->display( "daikuan/index.html" );
    }
    public function yongtuAction()
    {
    	global $TPL;
    	$this->_init();
    	$categoryId = (int)$this->params['id'];
    	$category = $this->getDao('CategoryDAO')->getDetail($categoryId);
    	$product = $this->getDao('ProductLoanDAO');
        $productList = $product->getList($categoryId);
        
        $TPL->assign('submenu_flag',true);
         $TPL->assign('submenu_code','yongtu');
        $TPL->assign('category',$category);
        $TPL->assign('product',$productList);
        $TPL->display( "daikuan/yongtu.html" );
    }
    public function xiaofeidaiAction()
    {
    	global $TPL;
    	$this->_init();
    	$categoryId = (int)$this->params['id'];
    	$category = $this->getDao('CategoryDAO')->getDetail($categoryId);
    	$product = $this->getDao('ProductLoanDAO');
        $productList = $product->getList($categoryId);
        
        $TPL->assign('submenu_flag',false);
         $TPL->assign('submenu_code','xiaofeidai');
        $TPL->assign('category',$category);
        $TPL->assign('product',$productList);
        $TPL->display( "daikuan/xiaofeidai.html" );
    }
    
    public function leibieAction()
    {
    	global $TPL;
    	$this->_init();
    	$categoryId = (int)$this->params['id'];
    	$category = $this->getDao('CategoryDAO')->getDetail($categoryId);
    	$product = $this->getDao('ProductLoanDAO');
        $productList = $product->getList($categoryId);
        
        $TPL->assign('submenu_flag',true);
         $TPL->assign('submenu_code','leibie');
        $TPL->assign('category',$category);
        $TPL->assign('product',$productList);
        $TPL->display( "daikuan/leibie.html" );
    }
    
    public function jigouAction()
    {
    	global $TPL;
    	$this->_init();
    	$categoryId = (int)$this->params['id'];
    	$category = $this->getDao('CategoryDAO')->getDetail($categoryId);
    	$product = $this->getDao('ProductLoanDAO');
        $productList = $product->getList($categoryId);
        
        $TPL->assign('submenu_flag',true);
         $TPL->assign('submenu_code','jigou');
        $TPL->assign('category',$category);
        $TPL->assign('product',$productList);
        $TPL->display( "daikuan/jigou.html" );
    }
}
?>
