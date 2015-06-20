<?php
class NewsDAO extends AbstractDao {
    protected $m_tableName = 'my_news';
    
    function __construct($isdebug = false) {
        parent::__construct($isdebug, 1);
    }
    public function getList($categoryId=null,$curpage=1,$pagesize=20) {
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        
        $sql = "SELECT * FROM {$this->m_tableName}";
        $where = ' WHERE 1 ';
        if ($categoryId) {
        	$where .= " and news_category={$categoryId} ";
        }
        
        $sql .= $where;
        $sql .= "limit ". (int)(($curpage-1) * $pagesize) . ',' . (int)$pagesize;
        
        $countSql = 'SELECT COUNT(*) AS `num` FROM `' . $this->m_tableName . '` '.$where;
        
        $this->dao->db->query($countSql);
        $result = $this->dao->db->fetch();
        $total = $result['num'];
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        $result = array();
        $statement = $this->dao->db->query($sql);
        //echo $sql;
        $result = $this->dao->db->fetchAll();
        if ($result) {
        	$return = array(
                    'page' => array('cur' => $curpage, 'size' => $pagesize, 'total' => $total),
                    'data' => $result,
                );
            return $return;
        } else {
            G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            //log
        }
    }
    
   
    public function getDetail($companyId) {
    	G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "SELECT * FROM {$this->m_tableName} WHERE news_id={$companyId} ";
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        $result = array();
        $statement = $this->dao->db->query($sql);
        $result = $this->dao->db->fetch();
        if ($result) {
            return $result;
        } else {
            G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            //log
        }
    }
    public function getHot($num=10) {
    	G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "SELECT * FROM {$this->m_tableName} WHERE 1 ";
    	$sql .= " and is_hot=1 order by position asc limit {$num}";
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        $result = array();
        //echo $sql;
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
