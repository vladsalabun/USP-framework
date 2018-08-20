<?php 

    /*
        TODO: скрипт сканує папки файли, які є в цій директорії, і якщо у них в index.php на початку міститься команда
        
        #   USP plugin: Landing elements
        #   Version: 1.0
        #   Author: ...
        #   Description: ...
        #   Activation: yes

        #   Menu: yes
        #   url: usp_money
        #   title: Money

        
        Ці дані беруться в CMS і плагін активується
        а строку "active: yes" можна в адмінці переписати на "active: no"
        
    */
    
    function getAllPluginsInfo() {
        
        global $usp;
        
        $pluginArray = array();
        $pagesArray = getFoldersArray($dir);
        
        foreach ($pagesArray as $pluginFolder) {
            
            // Дізнаюсь чи файл index.php існує:
            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$usp.'_cms/usp_plugins/'.$pluginFolder.'/index.php')) {
                // TODO: зчитати файл і дізнатись параметри
                $content = file($_SERVER['DOCUMENT_ROOT'].'/'.$usp.'_cms/usp_plugins/'.$pluginFolder.'/index.php');
                
                $pluginArray[] = array(
                    'pluginName' => readParam($content[2]),
                    'pluginVersion' => readParam($content[3]),
                    'pluginAuthor' => readParam($content[4]),
                    'pluginDescription' => readParam($content[5]),
                    'pluginActivation' => readParam($content[6]),
                    'pluginMenu' => readParam($content[8]),
                    'pluginUrl' => readParam($content[9]),
                    'pluginTitle' => readParam($content[10]),
                    'pluginFolder' => $pluginFolder,
                );
            }
            
        }
        
        return ($pluginArray);
        
    }
    
    // Беру список всіх плагінів:
    $pluginsArray = getAllPluginsInfo();
    
    // Включаю ті, які активовані: 
    foreach ($pluginsArray as $key => $value) {
        
        if ($value['pluginActivation'] == 'yes') {
            require_once $_SERVER['DOCUMENT_ROOT'].'/'.$usp.'_cms/usp_plugins/'.$value['pluginFolder'].'/index.php';
        
        }
        
    }    


