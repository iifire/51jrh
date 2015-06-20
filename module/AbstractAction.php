<?php
abstract class AbstractAction {
    protected $params;
    protected $result;
    
    /**
     * 构造函数+初始化
     */
    public function __construct( $params ) {
        $this->params = $params;
        $this->loadCommonInit();
    }
    /**
     * 默认action
     */
    abstract public function indexAction();
    
    /**
     * 获取单实例DAO
     * @global string $name
     * @param string $name
     * @return \name
     */
    protected function getDao($name) {
        global $$name;

        if (isset($$name))
            return $$name;
        else {
            $$name = new $name(DEBUG,1);
            return $$name;
        }
    }
    /**
     * 统一日志记录
     */
    protected function setLog(){
      
    }
    /**
     * 参数验证
     */
    protected function validateParams( $validate_config ){
        $validator = new Validator($validate_config);
        try {
            $validator->Validate($this->m_params);
            return true;
        } catch (ValidateException $e) {
            OSS_LOG(__FILE__, __LINE__, LP_ERROR, $e->getMessage() . "\n");
            return false;
        }
    }
    /**
     * 公共初始化操作
     */
	protected function loadCommonInit() {
		global $TPL;
		$TPL->assign('host',HOST);
		$TPL->assign('MEDIA_PATH',MEDIA_PATH);
		$TPL->assign('JS_PATH',JS_PATH);
		$TPL->assign('CSS_PATH',CSS_PATH);
		$TPL->assign('IMG_PATH',IMG_PATH);
		
		$TPL->assign('loadCommonInit',true);

	}
	/**
	 * 统一URL处理
	 */
	protected function getUrl($url) {
		return $url;
	}

	/**
	 * JSON格式统一输出
	 */
    protected function outputJson($iRet, $sMsg, $data=array()) {
        $res = array(
            'iRet' => $iRet,
            'sMsg' => $sMsg,
            'data' => $data
        );
        echo json_encode(GBKtoUTF8($res));
    }

	/**
	 * 创建目录+权限判断
	 */
	protected function checkFile($path,$dir){
		if(!file_exists($path.'/'.$dir)){
			if(!mkdir($path.'/'.$dir,0777, true)){
				return array('iRet'=>-1,'sMsg'=>"无法创建".$dir."目录");
			}
		}
		if(!is_writable($path.'/'.$dir)){
			$this->echoErrorMsg( $dir."目录不可写<br />" );
			return array('iRet'=>-1,'sMsg'=>$dir."目录不可写");
		}
		return array('iRet'=>0,'sMsg'=>'');
	}
	/**
	 * 数组转PHP文件所需字符串
	 */
	protected function generatePHP( $arrInfo ){
        $strArr = var_export( $arrInfo, true );
        $outputStr = "<?php \n";
        $outputStr .= "return ";
        $outputStr .= $strArr;
        $outputStr .= ";";
        return $outputStr;
    }
	/**
	 * CURL请求
	 */
    protected function doCurlPost($url, $keysArr) {
    	if (stristr($url,'?')){
    		$lastStr = substr($url,strlen($url)-1,1);
    	    if ($lastStr == '&'){
                $url .= '_t='.time();
            }else {
                $url .='&_t='.time();
            }
    	} else {
    		$url .='?_t='.time();
    	}
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //如果不是POST 会报参数错误
		if ($keysArr){
			curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $keysArr);
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		$ret = curl_exec($ch);
        if($ret === false){
            var_dump(curl_error($ch));exit;
        }
		$error = curl_error($ch);
		curl_close($ch);
		return $error ? $error : $ret;

	}
	/**
	 * 获取每周一的日期
	 */
    public function getThisWeekStart() {
        $week = date("W",time());
        $year = date("Y",time());
        $from = date("Y-m-d", strtotime("{$year}-W{$week}-1")); //Returns the date of monday in week
        return $from;
    }
}

?>
