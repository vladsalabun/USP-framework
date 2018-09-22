<?php 
     
    $booksAndFilmsTablesArray = array(
        0 => $usp . "_booksAndFilms",
    );
     
    // All tables:
    $booksAndFilmsTables = array(
        
        $booksAndFilmsTablesArray[0] => array ( 
            "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
            "type" => "INT( 11 ) DEFAULT '0'", // 0 - book, 1 - film
            "name" => "VARCHAR( 300 ) NULL",
            "author" => "VARCHAR( 300 ) NULL",
            "year" => "INT( 11 ) DEFAULT '0'",
            "date" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            "moderation" => "INT( 11 ) DEFAULT '0'"
        ),
        
        
    );
   
    $reinstallPluginNotes = 0;
    
    // Create tables:
    if($reinstallPluginNotes == 1 ) {
        $db->createAllTables($booksAndFilmsTables);        
    }
    
