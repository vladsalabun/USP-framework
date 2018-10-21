<?php 

    if($postFunctionSecret != 'fHeyYoGsgeOKksncs47dkj') {
        exit();
    }
  
    require_once 'plugin_database.php';
    
    $usp_links_abyss = new usp_links_abyss;   
    
    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'plugin') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['pluginFolder'] == basename(pathinfo(__FILE__)['dirname'])) {
            
            // тільки тоді виконую якусь дію:
            if (isset($_POST['action'])) {
                
                ##############################################
                
                // Дія:
                if ($_POST['action'] == 'addNew') {
                    
                    if(strlen($_POST['anchor']) > 0) {
                        // update in db:
                        $array = array(
                        "INSERT INTO" => $usp_links_abyss->tablesNames[0],
                            "COLUMNS" => array(
                                "anchor" => $_POST['anchor'],
                                "url" => $_POST['url']
                            )                            
                        );
                                
                        $db->insert($array); 
                        
                    }
                    header ("Location: $pluginConfigUrl");
                    exit();
                }
                
                // Дія:
                if ($_POST['action'] == 'edit') {
                    
                    if(isset($_POST['delete'])) {
                        // update in db:
                        $array = array(
                            "UPDATE" => $usp_links_abyss->tablesNames[0],
                            "SET" => array(
                                "moderation" => 1,
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            ),
                        );                            
                        $db->update($array); 
                    }
                    
                    if(strlen($_POST['anchor']) > 0) {
                        // update in db:
                        $array = array(
                            "UPDATE" => $usp_links_abyss->tablesNames[0],
                            "SET" => array(
                                "anchor" => $_POST['anchor'],
                                "url" => $_POST['url'],
                                "date" => $_POST['date']
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            ),
                        );                            
                        $db->update($array); 
                    }
                    header ("Location: $pluginConfigUrl");
                    exit();
                }
                
            } // <-- кінець виконання дій
        } // <-- кінець перевірки папки плагіну
    } // <-- кінець перевірки запиту до плагіну
     
   
    function getLinksList(){
        
        global $db;
        
        $className = basename(pathinfo(__FILE__)['dirname']);
        $usp_links_abyss = new $className; 
        
        $array = array(
            "SELECT" => "*",
            "FROM" => $usp_links_abyss->tablesNames[0],
            "WHERE" => "moderation = 0",
            "ORDER" => "date",
            "SORT" => "DESC",
        );
        return $db->select($array, null);
    }
