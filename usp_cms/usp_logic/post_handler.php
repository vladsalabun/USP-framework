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
        
        
        // --------------> Функція входу:
        public function login() {

            global $usp;
            global $webSiteUrl;
        
            if (md5($_POST['password']) === checkUSPuserByLogin($_POST['login'])['password']) {
               
               // Якщо пароль вірний, то ставлю куки:
               setcookie("login",$_POST['login'],time()+31536000,'/');
               setcookie("password",md5($_POST['password']),time()+31536000,'/');
               
               $link = $webSiteUrl.$usp.'_cms';
               
               header("Location: $link");
               exit();

            } else {
               // Якщо пароль не вірний, то редірект на головну:
               $link = $webSiteUrl.$usp.'_cms';
               header("Location: $link");
               exit();
            }
           
        }
        // <---------------   Функція входу
        
        
        
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
                
                # Підключаю плагіни:
                require_once './'.$usp.'_plugins/'.$_POST['pluginFolder'].'/plugin_database.php';
                // активую створення таблиць плагіну:
                $tmpObj = new $_POST['pluginFolder'];
                $tmpObj->reinstall();

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
        
        
        
         // --------------> Функція зміни параметрів плагіна:
        
        public function changePluginConfig() {
            
            global $usp;
            global $webSiteUrl;
            
            $pluginConfigs = json_decode(checkUSPconfig('plugins')['value'],true);
            
            if(isset($pluginConfigs['activated'][$_POST['pluginFolder']])) {
                
                //
                if(isset($_POST['pluginMenu']) == 1) {
                    $pluginConfigs['activated'][$_POST['pluginFolder']]['menu'] = 'yes';
                } else {
                    $pluginConfigs['activated'][$_POST['pluginFolder']]['menu'] = 'no';
                }
                //
                if(isset($_POST['pluginSubMenu'])) {
                    $pluginConfigs['activated'][$_POST['pluginFolder']]['subMenu'] = 'yes';
                } else {
                    $pluginConfigs['activated'][$_POST['pluginFolder']]['subMenu'] = 'no';
                }
                //
                if(isset($_POST['pluginFooterMenu'])) {
                    $pluginConfigs['activated'][$_POST['pluginFolder']]['footerMenu'] = 'yes';
                } else {
                    $pluginConfigs['activated'][$_POST['pluginFolder']]['footerMenu'] = 'no';
                }
                //
                if(strlen($_POST['pluginTitle']) > 0) {
                    $pluginConfigs['activated'][$_POST['pluginFolder']]['pluginTitle'] = $_POST['pluginTitle'];
                } else {
                    unset($pluginConfigs['activated'][$_POST['pluginFolder']]['pluginTitle']);
                }
                
            }
            if(isset($pluginConfigs['deactivated'][$_POST['pluginFolder']])) {
                
                //
                if(isset($_POST['pluginMenu']) == 1) {
                    $pluginConfigs['deactivated'][$_POST['pluginFolder']]['menu'] = 'yes';
                } else {
                    $pluginConfigs['deactivated'][$_POST['pluginFolder']]['menu'] = 'no';
                }
                //
                if(isset($_POST['pluginSubMenu'])) {
                    $pluginConfigs['deactivated'][$_POST['pluginFolder']]['subMenu'] = 'yes';
                } else {
                    $pluginConfigs['deactivated'][$_POST['pluginFolder']]['subMenu'] = 'no';
                }
                //
                if(isset($_POST['pluginFooterMenu'])) {
                    $pluginConfigs['deactivated'][$_POST['pluginFolder']]['footerMenu'] = 'yes';
                } else {
                    $pluginConfigs['deactivated'][$_POST['pluginFolder']]['footerMenu'] = 'no';
                }
                //
                if(strlen($_POST['pluginTitle']) > 0) {
                    $pluginConfigs['deactivated'][$_POST['pluginFolder']]['pluginTitle'] = $_POST['pluginTitle'];
                } else {
                    unset($pluginConfigs['deactivated'][$_POST['pluginFolder']]['pluginTitle']);
                }
                
            }
            
            $array = array(
                "UPDATE" => $usp . "_configuration",
                "SET" => array(
                    "value" => json_encode($pluginConfigs),
                    ),
                "WHERE" => array(
                    "name" => 'plugins'
                )
            );
                
            $this->db->update($array); 
            
            $link = $webSiteUrl.$usp.'_cms/?page=plugins';
            header("Location: $link");
            exit();

        }
        
        // <---------------   Функція зміни параметрів плагіна      
        
        
        // -------------->    Функція додавання нової категорії в плагін:
        
        public function addNewCategory() { 

            rubricator::addNewCategory();
            
            $link = $_POST['url'];
            header("Location: $link");
            exit();
        }
        
        // <---------------   Функція додавання нової категорії в плагін          
        
        
        // -------------->    Зміна мови CMS
        
        public function changeLanguage() { 

            var_dump($_POST);
            exit();
            
            $link = $_POST['url'];
            header("Location: $link");
            exit();
        }
        
        // <---------------   Зміна мови CMS       
        
        
    }