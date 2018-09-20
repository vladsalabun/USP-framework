<?php

    // TODO: тут функції теми
    
   
    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'theme') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['themeFolder'] == 'personal_crm_ukraine') {
            
           // TODO: перевірити чи не підбирається пароль навмисно. Записуй кількість спроб.
           
           if (md5($_POST['password']) === checkUSPuserByLogin($_POST['login'])['password']) {
               
               // Якщо пароль вірний, то ставлю куки:
               setcookie("login",$_POST['login'],time()+31536000,'/');
               setcookie("password",md5($_POST['password']),time()+31536000,'/');
               
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