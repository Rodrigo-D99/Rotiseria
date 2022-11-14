<?php

include_once './libs/smarty-4.2.1/libs/Smarty.class.php';

class LoginView{
    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }

    function login($error = null){
        $this->smarty->assign('error', $error);
        $this->smarty->display('login.tpl');
    }

        
}