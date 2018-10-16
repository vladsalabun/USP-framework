<?php 

    if($userINFO['ID'] < 1) {
        die();
        exit();
    }

    
    require_once 'plugin_database.php'; 
    
    $usp_books_and_films = new usp_books_and_films;
    
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

    
    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'plugin') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['pluginFolder'] == basename(pathinfo(__FILE__)['dirname'])) {
            
            // тільки тоді виконую якусь дію:
            if (isset($_POST['action'])) {
                
                $className = basename(pathinfo(__FILE__)['dirname']);
                $usp_books_and_films = new $className;
                
                ##############################################
                
                // Дія:
                if ($_POST['action'] == 'addNew') {
                    
                    if(strlen($_POST['name']) > 0) {
                        // update in db:
                        $array = array(
                        "INSERT INTO" => $usp_books_and_films->tablesNames[0],
                            "COLUMNS" => array(
                                "type" => $_POST['type'][0],
                                "name" => $_POST['name'],
                                "author" => $_POST['author'],
                                "year" => $_POST['year']
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
                            "UPDATE" => $usp_books_and_films->tablesNames[0],
                            "SET" => array(
                                "moderation" => 1,
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            ),
                        );                            
                        $db->update($array); 
                    }
                    
                    if(strlen($_POST['name']) > 0) {
                        // update in db:
                        $array = array(
                            "UPDATE" => $usp_books_and_films->tablesNames[0],
                            "SET" => array(
                                "name" => $_POST['name'],
                                "author" => $_POST['author'],
                                "year" => $_POST['year'],
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
     
   
    function getBooksList($type){
        
        global $db;
        global $booksAndFilmsTablesArray;
        
        $className = basename(pathinfo(__FILE__)['dirname']);
        $usp_books_and_films = new $className;
        
        $array = array(
            "SELECT" => "*",
            "FROM" => $usp_books_and_films->tablesNames[0],
            "WHERE" => "type = '".$type."' AND moderation = 0",
            "ORDER" => "date",
            "SORT" => "DESC",
        );
        return $db->select($array, null);
    }
