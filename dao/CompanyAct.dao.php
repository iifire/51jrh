<?php
class CompanyActDAO extends AbstractDao {
    protected $m_tableName = 'my_company_act';
    
    function __construct($isdebug = false) {
        parent::__construct($isdebug, 1);
    }
    public function getList($companyId='',$num=8,$page=0) {
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "SELECT * FROM {$this->m_tableName} WHERE 1 ";
        if ($companyId) {
        	$sql .= " and act_company={$companyId} ";
        }
        $sql .= " limit {$num}";
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
