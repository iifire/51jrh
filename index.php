<?php
/**
 * 引入公共初始化文件
 * @author gary (yanggaojiao@qq.com)
 * @date 2014-11-30 
 */
require_once 'bootstrap.php';
class Index extends AdminAbstract {
    public function __construct() {
        parent::__construct();
    }
    function handleAppException(AppException $e) {
        G_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
        $this->output(-100, "APP_EXCEPTION");
        return -1;
    }

    function handleLibException(LibException $e) {
        G_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
        $this->output(-100, "LIB_EXCEPTION");
        return -1;
    }

    function handleStdException(Exception $e) {
        G_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
        $this->output(-100, "STD_EXCEPTION");
        return -1;
    }

    function handleUnknownException() {
        G_LOG(__FILE__, __LINE__, LP_ERROR, 'SYSTEM:' . $e->getMessage() . "\n");
        $this->output(-100, "UNKNOWN_ERROR");
        return -1;
    }
    public function getConfig() {
        return getGlobalConfig();
    }

    function start()
    {
        $action = isset($_REQUEST['action']) ? cleanInput($_REQUEST['action']) : "main";
        //从前端传入一些相应的参数
        $params = array_merge($_POST, $_GET);
        
        $config = $this->getConfig();
        $isMaintain = intval($config['SYSTEM_MAINTAIN']['maintenance']);
        //管理端停服控制
        if($isMaintain == 1){
            $this->MaintainAccess();
        }
        //分发到对应文件
        try {
        	$request = new Request();
        	$pathInfoArr = explode('/',$request->getPathInfo());
        	$pathInfoCount = count($pathInfoArr);
        	$controllerName = 'main';
        	$actionName = 'index';
        	if ($pathInfoCount>=2 && $pathInfoArr[1]) {
        		$controllerName = $pathInfoArr[1];
        	}
			if ($pathInfoCount>=3 && $pathInfoArr[2]) {
        		$actionName = $pathInfoArr[2];
        		if (strpos($actionName,'-')) {
        			$temp = explode('-',$actionName);
        			$controllerName = $controllerName . $temp[0];
        			$actionName = $temp[1];
        		}
        	}
        	//判断类和方法是否存在，并和平阐述
        	if (class_exists($controllerName)) {
        		//array_slice
        		$pathParams = array_slice($pathInfoArr,3);
        		$pathParams = count($pathParams) && $pathParams[0] ? $this->parseParams($pathParams) : $pathParams;
        		$controller = new $controllerName(array_merge($pathParams, $params));
        		$actionName .= 'Action';
        		if (method_exists($controller,$actionName)) {
        			$res = $controller->$actionName();
        		} else {
        			$this->noRoute();
        		}
        		
        	} else {
        		$this->noRoute();
        	}
            
            
        } catch (Exception $e) {
        	//404页面
        }
    }
	protected function noRoute() {
		require_once "errors" .
				"/404.php";
	}
    protected function Output($iRet, $sMsg, $data=array()) {
        $res = array(
            'iRet' => $iRet,
            'sMsg' => $sMsg,
            'data' => $data
        );
        echo json_encode(GBKtoUTF8($res));
    }

    /**
     * 检查权限
     * @return type
     */
    private function CheckAccess(){
        global $TPL;
        if (false) {
        	$TPL->display( "invalid_access.html" );
        	exit();
        }
        return true;
    }

    /**
     * 系统维护期间限制访问
     * @return type
     */
	private function MaintainAccess(){
	    global $TPL; 
	    if (false) {
        	$TPL->display( "maintain.html" );
        	exit();
        }   
        return true;
	}
	private function parseParams($arr) {
		$params = array();
		for ($i=0;$i<count($arr);$i++) {
			$params[$arr[$i]] = $arr[$i+1];
			$i++;
		}
		return $params;
	}
}

RUN_APP('Index');
?>
