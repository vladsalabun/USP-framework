<?php 
     
    $moneytablesArray = array(
        0 => $usp . "_vladMoneyUAH",
        1 => $usp . "_vladMoneyUSD",
        2 => $usp . "_vladMoneyCategory",
        3 => $usp . "_vladMoney",
        4 => $usp . "_wishlist",
    );
     
    // All tables:
    $uspMoneyTables = array(
        
        $moneytablesArray[0] => array ( 
            "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
            "money" => "INT( 11 ) DEFAULT '0'",
            "operation" => "INT( 11 ) DEFAULT '0'",
            "category" => "INT( 11 ) DEFAULT '0'",
            "date" => "DATETIME",
            "moderation" => "INT( 11 ) DEFAULT '0'"
        ),
        
        $moneytablesArray[1] => array ( 
            "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
            "money" => "INT( 11 ) DEFAULT '0'",
            "operation" => "INT( 11 ) DEFAULT '0'",
            "category" => "INT( 11 ) DEFAULT '0'",
            "date" => "DATETIME",
            "moderation" => "INT( 11 ) DEFAULT '0'"
        ),
        
        $moneytablesArray[2]=> array ( 
            "categoryID" => "INT( 11 ) DEFAULT '0'",
            "categoryName" => "VARCHAR( 100 ) NULL",
            "moderation" => "INT( 11 ) DEFAULT '0'"
        ),

        $moneytablesArray[3] => array ( 
            "moneyUAH" => "INT( 11 ) DEFAULT '0'",
            "moneyUSD" => "INT( 11 ) DEFAULT '0'",
            "uahToUsd" => "FLOAT(8,2) DEFAULT '0'",
            "usdToUah" => "FLOAT(8,2) DEFAULT '0'"
        ),
        
        $moneytablesArray[4] => array ( 
            "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
            "wishName" => "TEXT",
            "wishCategory" => "INT( 11 ) DEFAULT '0'",
            "wishPrice" => "INT( 11 ) DEFAULT '0'",
            "done" => "INT( 11 ) DEFAULT '0'"
        )
        
    );
   
    // Create tables:
    if($reinstallPlugin == 1 ) {
        $db->createAllTables($uspMoneyTables);  
    }
    
