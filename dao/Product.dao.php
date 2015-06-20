<?php
class ProductDAO extends AbstractDao {
    protected $m_tableName = 'my_product';
    
    function __construct($isdebug = false) {
        parent::__construct($isdebug, 1);
    }
    
    public function getAllList($categoryId=null) {
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "SELECT * FROM {$this->m_tableName} WHERE 1 ";
        if ($categoryId) {
        	$sql .= " and product_category={$categoryId} ";
        }
        //echo $sql;
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
    
    public function getDetail($productId) {
    	G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "SELECT * FROM {$this->m_tableName} WHERE product_id={$productId} ";
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
    	$sql .= " and product_hot=1 limit {$num}";
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
    
    public function getList($where,$num=8) {
    	G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "SELECT * FROM {$this->m_tableName} WHERE 1 ";
        $sql .= $where;
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
    
    public function getSamePeriod($uint=0,$period)
    {
    	$where = " and product_period_unit={$uint} and product_period={$period}";
    	return $this->getList($where);
    }
    public function getSameCompany($company)
    {
    	$where = " and product_company={$company}";
    	return $this->getList($where);
    }
    public function getSameRate($rate)
    {
    	$where = " and product_rate>=({$rate}-0.5) and product_rate<=({$rate}+0.5)";
    	return $this->getList($where);
    }
    
    public function getCompanyProduct($companyId) {
    	$where = " and product_company={$companyId}";
    	return $this->getList($where);
    }
    
    public function getHotDefault($num=8) {
    	$where = " and 1=1 ";
    	
    	return $this->getList($where,$num);
    }
    public function getHotHighrate($num=8) {
    	$where = " and 1";
    	return $this->getList($where,$num);
    }
    public function getHotShortperiod($num=8) {
    	$where = " and 1";
    	return $this->getList($where,$num);
    }
    
}
