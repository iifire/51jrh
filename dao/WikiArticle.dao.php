<?php
class WikiArticleDAO extends AbstractDao {
    protected $m_tableName = 'my_wiki_article';
    
    function __construct($isdebug = false) {
        parent::__construct($isdebug, 1);
    }
    public function getList($categoryId='',$num=8,$page=0) {
        G_LOG(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "SELECT * FROM {$this->m_tableName} WHERE 1 ";
        if ($categoryId) {
        	$sql .= " and article_category={$categoryId} ";
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
