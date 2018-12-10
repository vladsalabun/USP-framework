<?php

    /*

        TODO: ф-ї, які треба виконати під час інсталяції:

    */

   
   
   /* нижче функції: */
   
   
   function installUSPConfigurationTable() {
        
        global $webSiteUrl;
        global $usp;
        global $db;
        
        $uspConfigTables = array(
        
            $usp . "_configuration" => array ( 
                "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                "name" => "VARCHAR( 1000 ) NULL",
                "value" => "VARCHAR( 1000 ) NULL"
            ),
            $usp . "_users" => array ( 
                "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                "Name" => "VARCHAR( 60 ) NULL",
                "Surname" => "VARCHAR( 60 ) NULL",
                "login" => "VARCHAR( 60 ) NULL",
                "password" => "VARCHAR( 255 ) NULL",
                "email" => "VARCHAR( 255 ) NULL",
                "privilege" => "INT( 11 ) DEFAULT '0'",
                "moderation" => "INT( 11 ) DEFAULT '0'"
            )
            
        );
        
        $db->createAllTables($uspConfigTables); 
        
        if(checkUSPuserByLogin('admin') == false) {
        
            // Вставляю адмінський пароль:
            $array = array(
                "INSERT INTO" => $usp . "_users",
                "COLUMNS" => array(
                    "Name" => 'Админ',
                    "Surname" => 'Админ',
                    "login" => 'admin',
                    "password" => '21232f297a57a5a743894a0e4a801fc3',
                    "email" => '',
                    "privilege" => 1000000,
                 )
            );
            $db->insert($array);
        }
        
        header("Location: $webSiteUrl");
        
   }
   
