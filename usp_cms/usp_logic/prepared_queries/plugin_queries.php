<?php
    
    /* Встановити всі плагіни з папки як неактивні: */
    function setPluginsFromFolderAsDeactivated($allPluginsArray) {
       
        global $db;
        global $usp;

        $pluginJson = array();
        $pluginJson['activated'] = array();
        
        // Формую масив відключених плагінів:
        foreach ($allPluginsArray as $pluginFolderName => $value) {
            $pluginJson['deactivated'][$pluginFolderName] = array(
                'menu' => 'yes',
                'subMenu' => 'yes',
                'footerMenu' => 'yes'
            );
        }
        
        // Перевіряю чи не створене вже поле з конфігами плагінів:
        $pluginsInfo = checkUSPconfig('plugins'); 
        // якщо ні, то додаю:
        if($pluginsInfo == null) {
        
        // Вставляю в базу:
        $array = array(
            "INSERT INTO" => $usp . "_configuration",
            "COLUMNS" => array(
                "name" => 'plugins',
                "value" => json_encode($pluginJson)
             )
        );
        $db->insert($array);
        
        } else {
            // обновляю:
            $array = array(
                "UPDATE" => $usp . "_configuration",
                "SET" => array(
                    "value" => json_encode($pluginJson)
                ),
                "WHERE" => array(
                    "name" => 'plugins'
                )
            );
                
            $db->update($array);  
        }
       
    }    

    /* Оновити інформацію про плагіни: */
    function updatePluginsConfig($pluginJson) {
       
        global $db;
        global $usp;
        
        $array = array(
            "UPDATE" => $usp . "_configuration",
            "SET" => array(
                "value" => $pluginJson
            ),
            "WHERE" => array(
                "name" => 'plugins'
            )
        );
            
        $db->update($array);    
       
    }

    
    /* Взяти інформацію про встановлений плагін: */
    function getPluginConfig($pluginFolderName) {
       
       global $db;
       
       echo $name;
       
    }
 
    