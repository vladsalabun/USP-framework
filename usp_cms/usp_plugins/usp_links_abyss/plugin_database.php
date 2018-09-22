<?php 
     
    $linksAbyssTablesArray = array(
        0 => $usp . "_linksAbyss",
    );
     
    // All tables:
    $linksAbyssTables = array(
        
        $linksAbyssTablesArray[0] => array ( 
            "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
            "anchor" => "VARCHAR( 300 ) NULL",
            "url" => "TEXT",
            "date" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            "moderation" => "INT( 11 ) DEFAULT '0'"
        ),
        
        
    );
   
    $reinstallPluginNotes = 0;
    
    // Create tables:
    if($reinstallPluginNotes == 1 ) {
        $db->createAllTables($linksAbyssTables);        
    }
    
