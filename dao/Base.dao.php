<?php
class BaseDAO extends AbstractDao {
    function __construct($isdebug = false) {
        parent::__construct($isdebug, 1);
    }
    public function setTableName($tableName) {
    	$this->m_tableName = $tableName;
    	return $this;
    }
    public function getTableName($tableName) {
    	return $this->_m_tableName;
    }
}
