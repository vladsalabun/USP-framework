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
        
        
        
        
        // --------------> Функція активації/деактивації плагінів:
        
        public function pluginPlugger() {
            
            global $webSiteUrl;
            global $usp;
            
            // Дізнаюсь конфігурацію:
            $pluginConfig = json_decode(checkUSPconfig('plugins')['value'],true);
            
            if($_POST['turn'] == 'on') {
                
                $from = 'deactivated';
                $to = 'activated';
               
            } else if($_POST['turn'] == 'off') {
                
                $from = 'activated';
                $to = 'deactivated';
            
            }

            // додаю:
            $pluginConfig[$to][$_POST['pluginFolder']] = array(
                'menu' => 'yes',
                'subMenu' => 'yes',
                'footerMenu' => 'yes'
            );
            
            // видаляю:
            unset($pluginConfig[$from][$_POST['pluginFolder']]);
            
            // оновляю інформацію в базі:
            updatePluginsConfig(json_encode($pluginConfig));
            
            // ще раз оновляю сторінку, щоб не залипали кнопки:
            $link = $webSiteUrl.$usp.'_cms/?page=plugins';
            header("Location: $link");
            exit();
        }
        
        // <------------- Функція активації/деактивації плагінів:
        
        
        
        
        
        
        
        
        
    }