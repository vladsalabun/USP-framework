<?php 
    
    require_once 'plugin_database.php';
    
    // назву файлу з датою, щоб не могли підібрати
    if($userINFO['ID'] < 1) {
        die();
        exit();
    }
    
    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'plugin') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['pluginFolder'] == basename(pathinfo(__FILE__)['dirname'])) {
            
            // тільки тоді виконую якусь дію:
            if (isset($_POST['action'])) {
                
                ##############################################
                
                // Дія:
                if ($_POST['action'] == 'createBackup') {
                    
                    $string = 'mysqldump --user='.configuration::DB_USER.' --password='.configuration::DB_PASSWORD.' --host=localhost '.configuration::DB_NAME.' > '.__DIR__.'/plugin_uploads/'.configuration::DB_NAME.'_'.date('Y-m-d_H-i-s').'.sql';

                    // створити бекап:
                    exec($string);

                    header ("Location: $pluginConfigUrl");
                    exit();
                    
                } // <-- Дія
                
                // Дія:
                if ($_POST['action'] == 'deleteBackup') {
                    // видаляю файли:
                    unlink(__DIR__.'/plugin_uploads/'.$_POST['fileName']);
                    header ("Location: $pluginConfigUrl");
                    exit();
                    
                } // <-- Дія                
                
            } // <-- кінець виконання дій
        } // <-- кінець перевірки папки плагіну
    } // <-- кінець перевірки запиту до плагіну
     
   