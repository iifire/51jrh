<?php

class Main extends AbstractAction {
    public function __construct($params) {
        parent::__construct($params);
    }
    //put your code here
    public function indexAction(){
        global $TPL;
        $category = $this->getDao('CategoryDAO');
        
        
        $TPL->display( "index.html" );
    }
}
?>
