<?php
class Jigou extends AbstractAction {
    public function __construct($params) {
    	
        parent::__construct($params);
        global $TPL;
    	$TPL->assign('menu_flag','jigou');
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
    	
        $TPL->display( "jigou/index.html" );
    }
    /***
     * 证券类
     */
    public function zhengquanAction()
    {
    	global $TPL;
    	$this->_init();
    	$product = $this->getDao('ProductLoanDAO');
        $productList = $product->getList('');
        
        $TPL->assign('submenu_flag',true);
         $TPL->assign('submenu_code','zhengquan');
        $TPL->assign('product',$productList);
        $TPL->display( "jigou/zhengquan.html" );
    }
    
    /***
     * 信托
     */
    public function xintuoAction()
    {
    	global $TPL;
    	/*****信托相关********/
		//股东背景
		$xintuoBackground = array(
			0 => "中央企业控股",
			1 => "地方企业控股",
			2 => "金融机构控股",
			3 => "省级政府控股",
			4 => "市级政府控股",
		);
		//经营风格
		$xintuoStyle = array(
			0 => "成熟专业",
			1 => "传统保守",
			2 => "激进前卫",
			3 => "敬业创新",
			4 => "稳健严谨",
			5 => "严谨高效",
			6 => "与时俱进",
			 
		);
    	$this->_init();
    	$product = $this->getDao('ProductLoanDAO');
        $productList = $product->getList('');
        
        $TPL->assign('submenu_flag',false);
        $TPL->assign('submenu_code','xintuo');
        $TPL->assign('xintuo_background',$xintuoBackground);
        $TPL->assign('xintuo_style',$xintuoStyle);
        
        $TPL->assign('product',$productList);
        $TPL->display( "jigou/xintuo.html" );
    }
    
}
?>
