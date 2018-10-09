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
    
    $rootRoot = $_SERVER['DOCUMENT_ROOT'].$rootFolder;
    
    $pluginNameCall = $_GET['name'];
    $pathToPluginView = $rootRoot.'/'.$usp.'_cms/usp_plugins/'.$pluginNameCall.'/plugin_view/';
 
    $pluginConfigUrl = $webSiteUrl.$usp.'_cms/?page=plugin&name='.$pluginNameCall;
    $pluginWebURL = $webSiteUrl.$usp.'_cms/usp_plugins/';
 
    
    function getAllPluginsInfo() {
        
        global $usp;
        global $rootRoot;
        
        $pluginArray = array();
        $pagesArray = getFoldersArray($dir);
        
        foreach ($pagesArray as $pluginFolder) {
            
            // Дізнаюсь чи файл index.php існує:
            if (file_exists($rootRoot.'/'.$usp.'_cms/usp_plugins/'.$pluginFolder.'/index.php')) {
                
                // TODO: зчитати файл і дізнатись параметри
                $content = file($rootRoot.'/'.$usp.'_cms/usp_plugins/'.$pluginFolder.'/index.php');
                
                foreach ($content as $line) {
                    
                    //echo "Строка: $line\n";
                    $pos = strpos($line, '#');
                    
                    if ($pos !== false) {
                        
                        // Знаходжу коментар:
                        $commentArray = explode('#',$line);
                        $paramLine = trim($commentArray[1]);
                        
                        // Знаходжу параметри плагіну:
                        $pluginParamArray = explode(':',$paramLine);
                        
                        // Кладу у масив параметри плагінів:
                        $pluginArray[$pluginFolder][pluginConfig::$pluginParams[strtolower($pluginParamArray[0])]] = trim($pluginParamArray[1]);
                        
                        // і назву папки тоже кладу:
                        $pluginArray[$pluginFolder]['pluginFolder'] = trim($pluginFolder);
                        
                    }
                }
                
            } // <-- якщо файл index.php існує:
            
        }
        
        return ($pluginArray);
        
    }
    
    // Беру список всіх плагінів з папки:
    $pluginsArray = getAllPluginsInfo();

    // беру список всіх плагінів з бази:
    $pluginsInfo = checkUSPconfig('plugins');  
        
    // якщо раптом налаштування збились на null:
    if($pluginsInfo['value'] == null or $pluginsInfo['value'] == 'null') {
        setPluginsFromFolderAsDeactivated($pluginsArray);
    }
  
    // якщо немає інформації про плагіни в базі даних:
    if($pluginsInfo == false) {

        // то додаю всі плагіни з папки як виключені:
        setPluginsFromFolderAsDeactivated($pluginsArray);
        
    } else {

        // якщо є, то кладу всі плагіни в масиви:
        $pluginStatus = json_decode($pluginsInfo['value'],true); 
        
    }
     
    // Різниця між існуючими плагінами, та зареєстрованими у базі:
    $registeredPlugins = array_merge($pluginStatus['deactivated'], $pluginStatus['activated']);
    $unRegisteredPlugins = array_diff(array_keys($pluginsArray), array_keys($registeredPlugins));
    
    // Якщо є незареєстровані плагіни, то додаю їх в базу: 
    if(count($unRegisteredPlugins) > 0) {
        
        foreach ($unRegisteredPlugins as $$unRegisteredPluginID => $unRegisteredPluginFolder) {
            $pluginStatus['deactivated'][$unRegisteredPluginFolder] = array(
                'menu' => 'yes',
                'subMenu' => 'yes',
                'footerMenu' => 'yes'
            );
            
        }

        updatePluginsConfig(json_encode($pluginStatus));
    }
    
    // Підключаю все активовані плагіни:
    foreach ($pluginsArray as $key => $value) {
           
        // Підключаю все активовані плагіни:
        if (isset($pluginStatus['activated'][$value['pluginFolder']])) {
            
            // Підключаю плагіни:
            //if(isset($_GET['name'])) {
                require_once $rootRoot.'/'.$usp.'_cms/usp_plugins/'.$value['pluginFolder'].'/index.php';
            //}
            
            $activatedPlugins[$key] = $value;
            
            // Записую також параметри з бази даних:
            $activatedPlugins[$key]['pluginMenu'] = $pluginStatus['activated'][$value['pluginFolder']]['menu'];
            $activatedPlugins[$key]['pluginSubMenu'] = $pluginStatus['activated'][$value['pluginFolder']]['subMenu'];
            $activatedPlugins[$key]['pluginFooterMenu'] = $pluginStatus['activated'][$value['pluginFolder']]['footerMenu'];
            
            if(isset($activatedPlugins[$key]['pluginTitle'])) {
                $activatedPlugins[$key]['pluginTitle'] = $pluginStatus['activated'][$value['pluginFolder']]['pluginTitle'];
            }
            
            // І в загальний масив теж записую:
            $pluginsArray[$key]['pluginMenu'] = $pluginStatus['activated'][$value['pluginFolder']]['menu'];
            $pluginsArray[$key]['pluginSubMenu'] = $pluginStatus['activated'][$value['pluginFolder']]['subMenu'];
            $pluginsArray[$key]['pluginFooterMenu'] = $pluginStatus['activated'][$value['pluginFolder']]['footerMenu'];
            
            
            if(isset($pluginStatus['activated'][$value['pluginFolder']]['pluginTitle'])) {
                $pluginsArray[$key]['pluginTitle'] = $pluginStatus['activated'][$value['pluginFolder']]['pluginTitle'];
                $activatedPlugins[$key]['pluginTitle'] = $pluginStatus['activated'][$value['pluginFolder']]['pluginTitle'];
            } else {
                $activatedPlugins[$key]['pluginTitle'] = $pluginsArray[$value['pluginFolder']]['pluginTitle'];
            }          
            
        } else {
            
            // І в загальний масив теж записую:
            $pluginsArray[$key]['pluginMenu'] = $pluginStatus['deactivated'][$value['pluginFolder']]['menu'];
            $pluginsArray[$key]['pluginSubMenu'] = $pluginStatus['deactivated'][$value['pluginFolder']]['subMenu'];
            $pluginsArray[$key]['pluginFooterMenu'] = $pluginStatus['deactivated'][$value['pluginFolder']]['footerMenu'];
            
        }
        
        
        
    }    
