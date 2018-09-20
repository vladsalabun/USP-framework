<?php
    
   /*
   
        Готові запити до бази даних:
   
   */
    $passwordAdmin = checkUSPuserByLogin($_COOKIE['login'])['password']; 
 /*   
    var_dump($userAdmin);
    var_dump($passwordAdmin);
    checkUSPuserByLogin('admin')['password'];
    */
    
    function checkUSPconfig($name) {
       
       global $db;
       
       echo $name;
       
    }

    function checkUSPuserByLogin($login) {
       
       if (strlen($login) < 1) {
           return null;
       }
       
       global $db;
       global $usp;
       
        $array = array(
            "SELECT" => "*",
            "FROM" => $usp . "_users",
            "WHERE" => "login = '".$login."'",
            "fetch" => 1,
        );
        return $db->select($array, null);
    }
      