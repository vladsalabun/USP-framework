<?php 

    /*
        TODO: скрипт сканує папки файли, які є в цій директорії, і якщо у них в index.php на початку міститься команда
        
        #   USP plugin: Landing elements
        #   Version: 1.0
        #   Author: ...
        #   Description: ...
        #   Activation: yes

        
        Ці дані беруться в CMS і плагін активується
        а строку "active: yes" можна в адмінці переписати на "active: no"
        
    */
    
    function getAllPluginsInfo() {
        
        global $usp;
        $pluginArray = array();
        $pagesArray = getFoldersArray($dir);
        
        foreach ($pagesArray as $pluginFolder) {
            
            // TODO: зчитати файл і дізнатись параметри
            $content = file($usp.'_plugins/'.$pluginFolder.'/index.php');
            
            $pluginArray[] = array(
                'pluginName' => $content[2],
                'pluginVersion' => $content[3],
                'pluginAuthor' => $content[4],
                'pluginDescription' => $content[5],
                'pluginActivation' => $content[6],
                'pluginFolder' => $pluginFolder,
            );
        }
        return ($pluginArray);
    }

    function plugPlugins($pluginsArray) {
        foreach ($pluginsArray as $key => $value) {
            
            if (readParam($value['pluginActivation']) == 'yes') {
                require_once $value['pluginFolder'].'/index.php';
            }
        }
    }
    
    // Беру список всіх плагінів:
    $pluginsArray = getAllPluginsInfo();
    
    // Включаю ті, які активовані:
    plugPlugins($pluginsArray);

?>