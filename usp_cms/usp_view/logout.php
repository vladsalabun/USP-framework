<?php 
    setcookie("login",'',time()+31536000);
    setcookie("password",'',time()+31536000);
       
    header("Location: $webSiteUrl");
    
    var_dump($_COOKIE);
    exit();
?>