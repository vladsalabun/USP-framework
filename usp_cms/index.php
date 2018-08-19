<?php
   
   # Підключаю конфігурацію:
   require_once 'usp_configs/index.php';
   
   # Підключаю логіку:
   require_once $usp.'_logic/index.php';
   
   # Підключаю плагіни:
   require_once $usp.'_plugins/index.php';
   
   
   # TODO: Перевіряю чи користувач авторизований:
   $userID = 1;
   
   # TODO: Перевіряю права доступа 
   $userAccess = 10;
   
   // Якщо користувач зареєстрований у системі:
   if ($userID > 0) {
        // то запускаю роутер:
        $need_page = checkPage();
        
        // if there is no POST request, we can show page:
        require 'usp_view/head.php';
        require 'usp_view/'.$need_page.'.php';
        require 'usp_view/footer.php';
   } else {
        require 'usp_view/head.php';
        require 'usp_view/gateway.php';
        require 'usp_view/footer.php';
   }