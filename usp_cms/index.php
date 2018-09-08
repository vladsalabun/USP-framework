<?php
   
   # Підключаю конфігурацію:
   require_once 'usp_configs/index.php';
   
   # Підключаю логіку:
   require_once $usp.'_logic/index.php';
   
   # Підключаю плагіни:
   require_once $usp.'_plugins/index.php';
   
   
    # TODO: Перевіряю чи користувач авторизований:
    if($_COOKIE['login'] === $userAdmin and $_COOKIE['password'] === $passwordAdmin) {
        $userID = 1000000;
    } else {
        $userID = 0;
    }
   
   # TODO: Перевіряю права доступа 
   $userAccess = 1000000;
   
   // Якщо користувач зареєстрований у системі:
   if ($userID > 0) {
        // то запускаю роутер:
        $need_page = checkPage();
        
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
        header("Location: $webSiteUrl");
   }