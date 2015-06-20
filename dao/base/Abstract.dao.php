<?php
/**
 * 数据操作基类
 * @author gary yanggaojiao@qq.com
 * @date 2014-12-01
*/
abstract class AbstractDao
{
    protected $dao;
    protected $m_tableName;
    public function __construct( $isdebug = true,$dbType ){
        $this->dao = DAO::getInstance( $isdebug,$dbType);
    }
    protected function filterParams($param) {
        if (is_array($param)){
            foreach ($param as $k => $v){
                $param[$k] = $this->filterParams($v); //recursive
            }
        }
        elseif (is_string($param)){
            $param = htmlspecialchars($param);
            // 过滤引号
            $trans = array(
                "'" => '&apos;'
            );
            $param = strtr($param,$trans);
            //$param = mysql_real_escape_string($param);
        }
        return $param;
    }
    /**
     * 数据库Insert/update/delete操作
     */
    public function setData( $action, $primaryArr=array(), $data=array() ) {
        $data = $this->filterParams( $data );
        
        switch ($action) {
            case 'insert':
                $keys = array_keys($data);
                $values = array_values($data);
                foreach ($keys as &$v) {
                    $v = '`' . $v . '`';
                }
                foreach ($values as &$v) {
                   if( $v != 'NOW()' ){
                        $v = '"' . $v . '"';
                    }
                }
                $sql = 'INSERT INTO `' . $this->m_tableName . '` (' . implode(',', $keys) . ') VALUES (' . implode(',', $values) . ')';
                break;
            case 'update':
                $keys = array_keys($data);
                $values = array_values($data);
                foreach ($keys as &$v) {
                    $v = '`' . $v . '`';
                }
                foreach ($values as &$v) {
                    $v = '"' . $v . '"';
                }
                $setStr = '';
                for ($i = 0; $i < count($keys); $i++) {
                    $setStr .= $keys[$i] . '=' . $values[$i] . ',';
                }
                $setStr = substr($setStr, 0, -1);

                $sql = 'UPDATE `' . $this->m_tableName . '` SET ' . $setStr . ' WHERE `'.$primaryArr[0].'`="'.$primaryArr[1].'"';
                break;
            case 'delete':
                $sql = 'DELETE FROM ' . $this->m_tableName . ' WHERE `'.$primaryArr[0].'`="'.$primaryArr[1].'"';
                break;
        }
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        
        $ret = $this->dao->db->exec($sql);
        if ($ret >= 0) {
            if( $action == "insert" ){
            	$ret = $this->dao->db->lastInertId($ret);
            	return $ret;
            		
            }
            else{
                return true;
            }
        } else {
            G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            return false;
        }
    }
    
    public function getDescTable($tableName) {
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "desc {$tableName}";
        
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        $result = array();
        $statement = $this->dao->db->query($sql);
        $result = $this->dao->db->fetchAll();
        if ($result) {
            return $result;
        } else {
            G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            //log
        }
    }

}
?>