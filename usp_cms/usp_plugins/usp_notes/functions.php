<?php 

    if($postFunctionSecret != 'fHeyYoGsgeOKksncs47dkj') {
        exit();
    }

    require_once 'plugin_database.php';
    
    $usp_notes  = new usp_notes;

    $monthNames = array (
		'01' => 'січ', 
		'02' => 'лют', 
		'03' => 'бер', 
		'04' => 'кві', 
		'05' => 'тра', 
		'06' => 'чер',
		'07' => 'лип', 
		'08' => 'сер', 
		'09' => 'вер', 
		'10' => 'жов', 
		'11' => 'лис', 
		'12' => 'гру'
	);
    
    $notesTypesArray = array(       
        'onmoderation',
        'approved',
        'deleted'
    );
    
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
                    "INSERT INTO" => $usp_notes->tablesNames[0],
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
                        "UPDATE" => $usp_notes->tablesNames[0],
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
                        "UPDATE" => $usp_notes->tablesNames[0],
                        "SET" => array(
                            "text" => nl2br($_POST['text'],false),
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
        $usp_notes = new $className; 
        
        if($type == 'onmoderation') {
            $array = array(
                "SELECT" => "*",
                "FROM" => $usp_notes->tablesNames[0],
                "WHERE" => "moderation = 0",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return count($db->select($array));
        } else if ($type == 'approved') {
            $array = array(
                "SELECT" => "*",
                "FROM" => $usp_notes->tablesNames[0],
                "WHERE" => "moderation = 2",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return count($db->select($array));
        } else if ($type == 'deleted') {
            $array = array(
                "SELECT" => "*",
                "FROM" => $usp_notes->tablesNames[0],
                "WHERE" => "moderation = 1",
                "ORDER" => "date",
                "SORT" => "DESC",
            );
            return count($db->select($array));
            
        }
    }
    
    function getNotes($type,$p) {
        
        global $db;
        global $elementsPerPage;
        
        if($p < 1) {
            $p = 1;
        }
        
        $usp_notes = new usp_notes; 
        
        if($type == 'onmoderation') {
            
            $array = array(
                "SELECT" => "*",
                "FROM" => $usp_notes->tablesNames[0],
                "WHERE" => "moderation = 0",
                "ORDER" => "date",
                "SORT" => "DESC",
                "LIMIT" => $elementsPerPage * ($p - 1).",".$elementsPerPage
            );
            return $db->select($array);
            
        } else if ($type == 'approved') {
            $array = array(
                "SELECT" => "*",
                "FROM" => $usp_notes->tablesNames[0],
                "WHERE" => "moderation = 2",
                "ORDER" => "date",
                "SORT" => "DESC",
                "LIMIT" => $elementsPerPage * ($p - 1).",".$elementsPerPage
            );
            return $db->select($array);
        } else if ($type == 'deleted') {
             $array = array(
                "SELECT" => "*",
                "FROM" => $usp_notes->tablesNames[0],
                "WHERE" => "moderation = 1",
                "ORDER" => "date",
                "SORT" => "DESC",
                "LIMIT" => $elementsPerPage * ($p - 1).",".$elementsPerPage
            );
            return $db->select($array);
        }
    } 

  