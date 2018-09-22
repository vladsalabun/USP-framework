<?php

    /*

        TODO: ф-ї, які треба виконати, якщо надійшов пост-запит

    */
    
    class postHandler {
        
        public $db;
        
        function __construct() 
        {
            $this->db = new database;
        }
        
        
        // --------------> Функція зміни пароля:
        
        public function changePassword() {
            
            global $usp;
            global $userINFO;
            
            if($this->userINFO['password'] == md5($_POST['oldPassword']) 
                and $_POST['newPassword'] === $_POST['newPassword2']){
                    
                $array = array(
                    "UPDATE" => $usp . "_users",
                    "SET" => array(
                        "password" => md5($_POST['newPassword']),
                        ),
                    "WHERE" => array(
                        "ID" => $userINFO['ID']
                    )
                );
                
                $this->db->update($array); 
                
                setcookie("password",md5($_POST['newPassword']),time()+31536000,'/');
                
            }
        }
        
        // <---------------   Функція зміни пароля
        
    }