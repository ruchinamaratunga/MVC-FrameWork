<?php

class Home extends Controller{
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        
    }

    public function indexAction() {                   //queryParam will be passed into the method 
        $db = DB::getInstance();
        $contact =$db->delete('contacts',6);
        $this->view->render('home/index');
    }
}