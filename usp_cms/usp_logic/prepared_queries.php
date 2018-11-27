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
    
    /* Отримати конфіг з бази даних: */
    function checkUSPconfig($name) {
       
        global $db;
        global $usp;
       
        $array = array(
            "SELECT" => "*",
            "FROM" => $usp . "_configuration",
            "WHERE" => "name = '".$name."'",
            "fetch" => 1,
        );
        return $db->select($array, null);
       
    }

    /* Взяти іфнормацію про користувача по логіну: */
    function checkUSPuserByLogin($login) {
       
        if (strlen($login) < 1 or strlen($login) > 20) {
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

    // Запити до плагінів:
    require_once 'prepared_queries/plugin_queries.php';
    