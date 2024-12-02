<?php
    require_once './app/controllers/products.controller.php';
    require_once './app/controllers/auth.controller.php';
    require_once './app/controllers/categories.controller.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] 
    . dirname($_SERVER['PHP_SELF']).'/');
    define('PRODUCTS', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/products');
    define('CATEGORIES', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/categories');

    if(!empty($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = '';
    }

    $params = explode('/', $action);

    switch($params[0]){
        
        case '':
            $prodController = new ProdController();
            $prodController->showHome();
            break;
        case 'filter':
            $prodController = new ProdController();
            $prodController->showFiltered();
            break;  
        case 'detail':
            $prodController = new ProdController();
            $prodController->showDetail($params[1]);
            break;
        case 'login':
            $authController = new AuthController();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $authController->login();
            }else{
            $authController->showLogin();
            }
            break;
        case 'logout':
            $authController = new AuthController();
            $authController->logout();

        case 'categories':
            $categoriesController = new CategoriesController();
            $categoriesController->showCategories();
            break; 
        case 'products':
            $prodController = new ProdController();
            $prodController->showEditProds();
            break; 
        case 'add':
        case 'delete':
        case 'update':
            if(!empty($params[1])){
                switch($params[1]){
                    case 'product':
                        $prodController = new ProdController();
                        $prodController->adminProduct($params[0]);
                        break;
                    case 'category':
                        $categoriesController = new CategoriesController();
                        $categoriesController->adminCategory($params[0]);
                        break;    
                }
            }
        break;         
        default:
            echo '404 not found';
        break;        
    }