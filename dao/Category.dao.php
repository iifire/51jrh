<?php
class CategoryDAO extends AbstractDao {
    protected $m_tableName = 'my_category';  //数据库的表名
    
    const TYPE_INVEST = 0;
    const TYPE_LOAN = 1;
    
    function __construct($isdebug = false) {
        parent::__construct($isdebug, 1);
    }
    public function getLoanList() {
        return $this->getList(self::TYPE_LOAN);
    }
    public function getInvestList() {
        return $this->getList(self::TYPE_INVEST);
    }
    public function getList($type)
    {
    	G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        
        $sql = "SELECT * FROM {$this->m_tableName} WHERE category_type={$type} ";
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
    public function getDetail($categoryId) {
    	G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $type = self::TYPE_LOAN;
        $sql = "SELECT * FROM {$this->m_tableName} WHERE category_id={$categoryId} ";
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
}
