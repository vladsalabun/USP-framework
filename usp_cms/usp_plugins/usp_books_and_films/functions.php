<?php 

    // To add a column to an existing table the syntax would be:
    // mysql_query("ALTER TABLE birthdays ADD street CHAR(30)");
    
    // You can also specify where you want to add the field.
    // mysql_query("ALTER TABLE birthdays ADD street CHAR(30) AFTER birthday");
    /*
    mysql_query("ALTER TABLE birthdays
ADD street CHAR(30) AFTER birthday,
Add city CHAR(30) AFTER street,
ADD state CHAR(4) AFTER city,
ADD zipcode CHAR(20) AFTER state,
ADD phone CHAR(20) AFTER zipcode");
*/

/*
Column definitions can be modified using the ALTER method. The following code would change the existing birthday column from 7 to 15 characters.

    mysql_query("ALTER TABLE birthdays CHANGE birthday birthday VARCHAR(15)");
*/

/*
Columns can be removed from an existing table. The next example of code would remove the lastname column.
mysql_query("ALTER TABLE birthdays DROP lastname");
*/

    // TODO: чи видно змінні з одного плагіну в іншому?
    
    require_once 'plugin_database.php';

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
                
                ##############################################
                
                // Дія:
                if ($_POST['action'] == 'addNew') {
                    
                    if(strlen($_POST['name']) > 0) {
                        // update in db:
                        $array = array(
                        "INSERT INTO" => $booksAndFilmsTablesArray[0],
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
                            "UPDATE" => $booksAndFilmsTablesArray[0],
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
                            "UPDATE" => $booksAndFilmsTablesArray[0],
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
        
        $array = array(
            "SELECT" => "*",
            "FROM" => $booksAndFilmsTablesArray[0],
            "WHERE" => "type = '".$type."' AND moderation = 0",
            "ORDER" => "date",
            "SORT" => "DESC",
        );
        return $db->select($array, null);
    }
