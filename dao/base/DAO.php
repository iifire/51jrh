<?php
/**
 * 数据操作类, 单例
 * @author gary yanggaojiao@qq.com
 * @date 2014-12-01
*/
class DAO
{
    public $db;
    public $dbservice;
	protected $_config = '';

    /**
     * singleton
     * @var type
     */
    private static $instance;

    private function __construct( $isdebug = true, $dbType ){
        $this->_config = GetGlobalConfig();
        if( true || DEBUG ){
            switch ( $dbType ){
	            case 1:
	                $this->db = new MyPdo(
	                    $this->_config["DB"]["host"],
	                    $this->_config["DB"]["user"],
	                    $this->_config["DB"]["password"],
	                    $this->_config["DB"]["database"],
	                    $this->_config["DB"]["port"]
	                );
	                break;
                default:
                	$this->db = new MyPdo(
                        $this->_config["DB"]["host"],
                        $this->_config["DB"]["user"],
                        $this->_config["DB"]["password"],
                        $this->_config["DB"]["database"],
                        $this->_config["DB"]["port"]
                    );
                break;

            }
        }
    }

    public static function getInstance( $isdebug = true, $config_db="DB", $dbType=0) {
    	if(!isset(self::$instance[$config_db])) {
    	    $c = __CLASS__;
    	    	self::$instance[$config_db] = new $c( $isdebug, $config_db, $dbType );
    	}
    	return self::$instance[$config_db];
    }

    protected function filterParams($param) {
        if (is_array($param)){
            foreach ($param as $k => $v){
                $param[$k] = $this->filterParams($v);
            }
        }
        elseif (is_string($param)){
            $trans = array(
                '<' => '&lt;',
                '>' => '&gt;'
            );
            $param = strtr($param,$trans);
            $param = mysql_real_escape_string($param);
        }
        return $param;
    }
}
?>
