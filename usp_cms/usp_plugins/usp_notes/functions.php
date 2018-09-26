<?php 

    require_once 'plugin_database.php';
    
    $className = basename(pathinfo(__FILE__)['dirname']);
    $tmpObj = new $className; 

    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'plugin') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['pluginFolder'] == basename(pathinfo(__FILE__)['dirname'])) {
            
            // тільки тоді виконую якусь дію:
            if (isset($_POST['action'])) {
                
                ##############################################
                
                // Дія:
                if ($_POST['action'] == 'addNote') {
                    
                    // update in db:
                    $array = array(
                    "INSERT INTO" => $tmpObj->tablesNames[0],
                        "COLUMNS" => array(
                            "text" => nl2br($_POST['text'])
                            )                            
                    );
                            
                    $db->insert($array); 
                    
                    $link = $pluginConfigUrl;
                    
                    header ("Location: $pluginConfigUrl");
                    exit();
                    
                } // <-- Дія
                
                // Дія:
                if ($_POST['action'] == 'moderate') {
                    
                    $array = array(
                        "UPDATE" => $tmpObj->tablesNames[0],
                        "SET" => array(
                            "moderation" => $_POST['moderation'],
                        ),
                        "WHERE" => array(
                            "ID" => $_POST['ID']
                        ),
                    );
                            
                    $db->update($array); 
                    
                    $link = $_POST['url'];
                    
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія                
 
                // Дія:
                if ($_POST['action'] == 'editNote') {
                    
                    $array = array(
                        "UPDATE" => $tmpObj->tablesNames[0],
                        "SET" => array(
                            "text" => nl2br($_POST['text']),
                        ),
                        "WHERE" => array(
                            "ID" => $_POST['ID']
                        ),
                    );
                            
                    $db->update($array); 
                    
                    $link = $_POST['url'];
                    
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія  
                
            } // <-- кінець виконання дій
        } // <-- кінець перевірки папки плагіну
    } // <-- кінець перевірки запиту до плагіну
     
   
     
    function getNotesCount($type) {
        
        global $db;
        
        $className = basename(pathinfo(__FILE__)['dirname']);
        $tmpObj = new $className; 

        if($type == 'onModeration') {
            $array = array(
                "SELECT" => "*",
                "FROM" => $tmpObj->tablesNames[0],
                "WHERE" => "moderation = 0",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return count($db->select($array));
        } else if ($type == 'Approved') {
            $array = array(
                "SELECT" => "*",
                "FROM" => $tmpObj->tablesNames[0],
                "WHERE" => "moderation = 2",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return count($db->select($array));
        } else if ($type == 'Deleted') {
            $array = array(
                "SELECT" => "*",
                "FROM" => $tmpObj->tablesNames[0],
                "WHERE" => "moderation = 1",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return count($db->select($array));
            
        }
    }
    
    function getNotes($type) {
        
        global $db;
        
        $className = basename(pathinfo(__FILE__)['dirname']);
        $tmpObj = new $className; 
        
        if($type == 'onModeration') {
            
            $array = array(
                "SELECT" => "*",
                "FROM" => $tmpObj->tablesNames[0],
                "WHERE" => "moderation = 0",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return $db->select($array);
            
        } else if ($type == 'Approved') {
            $array = array(
                "SELECT" => "*",
                "FROM" => $tmpObj->tablesNames[0],
                "WHERE" => "moderation = 2",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return $db->select($array);
        } else if ($type == 'Deleted') {
             $array = array(
                "SELECT" => "*",
                "FROM" => $tmpObj->tablesNames[0],
                "WHERE" => "moderation = 1",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return $db->select($array);
        }
    }    