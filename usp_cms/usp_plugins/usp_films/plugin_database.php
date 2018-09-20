<?php 
     
    $quickNotestablesArray = array(
        0 => $usp . "_QuickNotes",
    );
     
    // All tables:
    $quickNotesTables = array(
        
        $quickNotestablesArray[0] => array ( 
            "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
            "text" => "TEXT",
            "date" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            "moderation" => "INT( 11 ) DEFAULT '0'"
        ),
        
        
    );
   
    $reinstallPluginNotes = 1;
    
    // Create tables:
    if($reinstallPluginNotes == 1 ) {
        $db->createAllTables($quickNotesTables);        
    }
    
