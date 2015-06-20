<?php
class Licai extends AbstractAction {
    public function __construct($params) {
        parent::__construct($params);
        global $TPL;
    	$TPL->assign('menu_flag','licai');
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
    	$companyHot = $this->getDao('CompanyDAO')->getHot(8);
    	$companyAct = $this->getDao('CompanyActDAO')->getList('',8);
    	
    	//sidebar
    	$wikiArticle = $this->getDao('WikiArticleDAO')->getList('',8);
    	
    	$TPL->assign('product_hot',$productHot);
    	$TPL->assign('company_hot',$companyHot);
    	$TPL->assign('company_act',$companyAct);
    	$TPL->assign('submenu_flag',false);
    	$TPL->assign('submenu_code',false);
    	//sidebar
    	$TPL->assign('wiki_artile',$wikiArticle);
    	
        $TPL->display( "licai/index.html" );
    }
    
    public function p2pAction()
    {
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductDAO');
        $productList = $productDAO->getAllList();
        $hotDefault = $productDAO->getHotDefault(8);
        $hotHighrate = $productDAO->getHotHighrate(8);
        $hotShortperiod = $productDAO->getHotShortperiod(8);
        
        $companyAct = $this->getDao('CompanyActDAO')->getList('',8);
        $companyHot = $this->getDao('CompanyDAO')->getHot(8);
        //
        $hotNews = $this->getDao('NewsDAO')->getHot(5);
        $TPL->assign('submenu_flag',true);
        $TPL->assign('submenu_code','p2p');
        $TPL->assign('product',$productList);
        
        $TPL->assign('company_hot',$companyHot);
    	$TPL->assign('company_act',$companyAct);
    	
        $TPL->assign('hot_default',$hotDefault);
        $TPL->assign('hot_highrate',$hotHighrate);
        $TPL->assign('hot_shortperiod',$hotShortperiod);
        
        $TPL->assign('hot_news',$hotNews); 
        $TPL->display( "licai/p2p.html" );
    }
    /**
     * 互联网理财首页
     */
    public function netAction()
    {
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductNetDAO');
        $productList = $productDAO->getList();
        
        $productHot = $this->getDao('ProductNetDAO')->sortByRateWeek(8);
        //
        $hotNews = $this->getDao('NewsDAO')->getHot(5);
        $TPL->assign('submenu_flag',true);
        $TPL->assign('submenu_code','net');
        $TPL->assign('all_product',$productList['data']);
        
        $TPL->assign('hot_product',$productHot);
        
        $TPL->assign('hot_news',$hotNews); 
        $TPL->display( "licai/net.html" );
    }
    
    /**
     * 银行理财首页
     */
    public function bankAction()
    {
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductBankDAO');
        $productList = $productDAO->getList();
        
        $productHot = $this->getDao('ProductBankDAO')->sortByRateWeek(8);
        //
        $hotNews = $this->getDao('NewsDAO')->getHot(5);
        $TPL->assign('submenu_flag',true);
        $TPL->assign('submenu_code','bank');
        $TPL->assign('all_product',$productList['data']);
        
        $TPL->assign('hot_product',$productHot);
        
        $TPL->assign('hot_news',$hotNews); 
        $TPL->display( "licai/bank.html" );
    }
    
    /**
     * 信托首页
     */
    public function trustAction()
    {
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductNetDAO');
        $productList = $productDAO->getList();
        
        $productHot = $this->getDao('ProductNetDAO')->sortByRateWeek(8);
        //
        $hotNews = $this->getDao('NewsDAO')->getHot(5);
        $TPL->assign('submenu_flag',true);
        $TPL->assign('submenu_code','trust');
        $TPL->assign('all_product',$productList['data']);
        
        $TPL->assign('hot_product',$productHot);
        
        $TPL->assign('hot_news',$hotNews); 
        $TPL->display( "licai/trust.html" );
    }
    /**
     * 资管首页
     */
    public function ziguanAction()
    {
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductNetDAO');
        $productList = $productDAO->getList();
        
        $productHot = $this->getDao('ProductNetDAO')->sortByRateWeek(8);
        //
        $hotNews = $this->getDao('NewsDAO')->getHot(5);
        $TPL->assign('submenu_flag',true);
        $TPL->assign('submenu_code','ziguan');
        $TPL->assign('all_product',$productList['data']);
        
        $TPL->assign('hot_product',$productHot);
        
        $TPL->assign('hot_news',$hotNews); 
        $TPL->display( "licai/ziguan.html" );
    }
    /**
     * 基金首页
     */
    public function fundAction()
    {
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductNetDAO');
        $productList = $productDAO->getList();
        
        $productHot = $this->getDao('ProductNetDAO')->sortByRateWeek(8);
        //
        $hotNews = $this->getDao('NewsDAO')->getHot(5);
        $TPL->assign('submenu_flag',true);
        $TPL->assign('submenu_code','fund');
        $TPL->assign('all_product',$productList['data']);
        
        $TPL->assign('hot_product',$productHot);
        
        $TPL->assign('hot_news',$hotNews); 
        $TPL->display( "licai/fund.html" );
    }
    /**
     * 保险首页
     */
    public function insuranceAction()
    {
    	global $TPL;
    	$this->_init();
    	$productDAO = $this->getDao('ProductNetDAO');
        $productList = $productDAO->getList();
        
        $productHot = $this->getDao('ProductNetDAO')->sortByRateWeek(8);
        //
        $hotNews = $this->getDao('NewsDAO')->getHot(5);
        $TPL->assign('submenu_flag',true);
        $TPL->assign('submenu_code','insurance');
        $TPL->assign('all_product',$productList['data']);
        
        $TPL->assign('hot_product',$productHot);
        
        $TPL->assign('hot_news',$hotNews); 
        $TPL->display( "licai/insurance.html" );
    }
    
    public function listAction()
    {
    	global $TPL;
    	$this->_init();
    	$product = $this->getDao('ProductDAO');
        $productList = $product->getAllList();
        $TPL->assign('product',$productList);
        $TPL->display( "licai/p2p.html" );
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
