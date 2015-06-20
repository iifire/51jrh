<?php
class Wiki extends AbstractAction {
    public function __construct($params) {
        parent::__construct($params);
    }
    protected function _init() {
    	global $TPL;
    }
    //put your code here
    public function indexAction(){
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductDAO');
    	$productHot = $productDAO->getHot(6);
    	$companyHot = $this->getDao('CompanyDAO')->getHot(6);
    	$companyAct = $this->getDao('CompanyActDAO')->getList('',8);
    	
    	//sidebar
    	$wikiArticle = $this->getDao('WikiArticleDAO')->getList('',8);
    	
    	$TPL->assign('product_hot',$productHot);
    	$TPL->assign('company_hot',$companyHot);
    	$TPL->assign('company_act',$companyAct);
    	
    	//sidebar
    	$TPL->assign('wiki_artile',$wikiArticle);
    	
        $TPL->display( "licai/index.html" );
    }
    
    
    public function listAction()
    {
    	global $TPL;
    	$this->_init();
    	$product = $this->getDao('ProductDAO');
        $productList = $product->getAllList();
        $TPL->assign('product',$productList);
        $TPL->display( "licai/list.html" );
    }
    
    public function viewAction()
    {
    	global $TPL;
    	$this->_init();
    	$productId = (int)$this->params['id'];
    	$productDAO = $this->getDao('ProductDAO');
    	$product = $productDAO->getDetail($productId);
    	
    	$category = $this->getDao('CategoryDAO')->getDetail($product['product_category']);
    	$company = $this->getDao('CompanyDAO')->getDetail($product['product_company']);
    	$companyHot = $this->getDao('CompanyDAO')->getHot(6);
    	$productHot = $productDAO->getHot(6);

    	//同类产品
    	$samePeriodProdct = $productDAO->getSamePeriod($product['product_period_unit'],(int)$product['product_period']);
    	$sameCompanyProdct = $productDAO->getSameCompany($product['product_company']);
    	$sameRateProdct = $productDAO->getSameRate($product['product_rate']);
    	
    	$TPL->assign('same_period_product',$samePeriodProdct);
    	$TPL->assign('same_company_product',$sameCompanyProdct);
    	$TPL->assign('same_rate_product',$sameRateProdct);
    	
    	$TPL->assign('company',$company);
    	$TPL->assign('company_hot',$companyHot);
    	$TPL->assign('product_hot',$productHot);
        $TPL->assign('product',$product);
        $TPL->assign('category',$category);
        $TPL->display( "licai/view.html" );
    }
}
?>
