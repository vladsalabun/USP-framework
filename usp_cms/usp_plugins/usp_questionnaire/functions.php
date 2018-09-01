<?php 

    // TODO: чи видно змінні з одного плагіну в іншому?
    
    require_once 'plugin_database.php';
 
    
    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'plugin') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['pluginFolder'] == 'usp_questionnaire') {
            
            // тільки тоді виконую якусь дію:
            if (isset($_POST['action'])) {
                
                ##############################################
                
                // Дія :
                if ($_POST['action'] == '') {

                    $link = $pluginConfigUrl."&plugin_config=money_config";
                    
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія
                
               
                
                
            } // <-- кінець виконання дій
            
        } // <-- кінець перевірки папки плагіну
        
    } // <-- кінець перевірки запиту до плагіну
    
    