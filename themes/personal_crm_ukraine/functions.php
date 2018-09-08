<?php

    // TODO: тут функції теми
    
   
    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'theme') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['themeFolder'] == 'personal_crm_ukraine') {
            
           if (md5($_POST['login']) === $userAdmin and md5($_POST['password']) === $passwordAdmin) {
               
               // Якщо пароль вірний, то ставлю куки:
               setcookie("login",$userAdmin,time()+31536000,'/');
               setcookie("password",$passwordAdmin,time()+31536000,'/');
               /*
               var_dump($_COOKIE);
               var_dump($_POST);
               exit();
               */
               $link = $webSiteUrl.$usp.'_cms';
               
               header("Location: $link");
               exit();

           } else {
               // Якщо пароль не вірний, то редірект на головну:
               header("Location: $webSiteUrl");
               exit();
           }
        }
        
    }