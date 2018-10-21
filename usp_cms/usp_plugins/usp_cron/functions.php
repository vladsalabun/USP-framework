<?php 

    if($postFunctionSecret != 'fHeyYoGsgeOKksncs47dkj') {
        exit();
    }
 
    require_once 'plugin_database.php';
    
    $usp_cron = new usp_cron; 

    
    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'plugin') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['pluginFolder'] == basename(pathinfo(__FILE__)['dirname'])) {
            
            // тільки тоді виконую якусь дію:
            if (isset($_POST['action'])) {
                
                ##############################################
                
                // Дія:
                if ($_POST['action'] == 'createBackup') {

                    header ("Location: $pluginConfigUrl");
                    exit();
                    
                } // <-- Дія
                
                // Дія:
                if ($_POST['action'] == 'deleteBackup') {
                    
                    // видаляю файли:
                    header ("Location: $pluginConfigUrl");
                    exit();
                    
                } // <-- Дія                
                
            } // <-- кінець виконання дій
        } // <-- кінець перевірки папки плагіну
    } // <-- кінець перевірки запиту до плагіну
     
   