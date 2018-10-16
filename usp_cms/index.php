<?php
   
    # Підключаю конфігурацію:
    require_once 'usp_configs/index.php';

    # Підключаю логіку:
    require_once $usp.'_logic/index.php';

    # Перевіряю чи користувач авторизований:   
    $userINFO = checkUSPuserByLogin($_COOKIE['login']);
    // <-- Цю перевірку необхідно виконати до підключення плагінів, щоб захистити неавторизовані запити    
    
    # Підключаю плагіни:
    require_once $usp.'_plugins/index.php';
   
    
    // Якщо був запит на вхід:
    if(isset($_POST['action']) and $_POST['action'] == 'login') {
        $postObject = new postHandler; 
        $postObject->login(); 
    }
    
    # Якщо ні - на головну:
    if($userINFO == null) { 
        require 'usp_view/login_head.php';
        require 'usp_view/login_index.php';
        require 'usp_view/login_footer.php';
       exit();
    }
    
    
    
    # Якщо куки є, перевіряю їх:
    if($_COOKIE['password'] === $userINFO['password']) {
        $userID = $userINFO['ID'];
    } else {
        $userID = 0;
    }
   
   
    // Якщо користувач зареєстрований у системі, то його ID > 0 :
    if ($userINFO['ID'] > 0) {
        // то запускаю роутер:
        $need_page = checkPage($userINFO);
        
        // якщо вибрано логаут:
        if($need_page == 'logout') {
            
            // знищую куки:
            setcookie("login",null,-1,'/');
            setcookie("password",null,-1,'/');
            
            // і йду на головну:
            header("Location: $webSiteUrl");
            exit();
            
        }
        
        // if there is no POST request, we can show page:
        require 'usp_view/head.php';
        require 'usp_view/'.$need_page.'.php';
        require 'usp_view/footer.php';
    } else {
        // редірект на головну;
        echo '<h1>У вас недостатньо прав доступу, щоб переглядати цю сторінку.<h1>';
        exit();
    }