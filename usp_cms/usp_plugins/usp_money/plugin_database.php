<?php 
    
    // Клас повинен співпадати з назвою папки:
    class usp_money {
        
        public $usp;
        public $tablesNames;      
        public $tables;      
        
        function __construct()
        {
            global $usp;
            $this->usp = $usp;
            
            // Тут треба вказати назви таблиць:
            $this->tablesNames = array(
                0 => $this->usp . "_vladMoneyUAH",
                1 => $this->usp . "_vladMoneyUSD",
                2 => $this->usp . "_vladMoneyCategory",
                3 => $this->usp . "_vladMoney",
                4 => $this->usp . "_wishlist",
            );
            
            // Тут треба вказати структуру таблиць:
            $this->tables = array(
                $this->tablesNames[0] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "money" => "INT( 11 ) DEFAULT '0'",
                    "operation" => "INT( 11 ) DEFAULT '0'",
                    "category" => "INT( 11 ) DEFAULT '0'",
                    "date" => "DATETIME",
                    "moderation" => "INT( 11 ) DEFAULT '0'"
                ),
                $this->tablesNames[1] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "money" => "INT( 11 ) DEFAULT '0'",
                    "operation" => "INT( 11 ) DEFAULT '0'",
                    "category" => "INT( 11 ) DEFAULT '0'",
                    "date" => "DATETIME",
                    "moderation" => "INT( 11 ) DEFAULT '0'"
                ),
                $this->tablesNames[2] => array ( 
                    "categoryID" => "INT( 11 ) DEFAULT '0'",
                    "categoryName" => "VARCHAR( 100 ) NULL",
                    "moderation" => "INT( 11 ) DEFAULT '0'"
                ),
                $this->tablesNames[3] => array ( 
                    "moneyUAH" => "INT( 11 ) DEFAULT '0'",
                    "moneyUSD" => "INT( 11 ) DEFAULT '0'",
                    "uahToUsd" => "FLOAT(8,2) DEFAULT '0'",
                    "usdToUah" => "FLOAT(8,2) DEFAULT '0'"
                ),
                $this->tablesNames[4] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "wishName" => "TEXT",
                    "wishCategory" => "INT( 11 ) DEFAULT '0'",
                    "wishPrice" => "INT( 11 ) DEFAULT '0'",
                    "done" => "INT( 11 ) DEFAULT '0'"
                ),
            );
        }
  
        // Створення таблиць:
        public function reinstall() 
        {
            global $db;
            $db->createAllTables($this->tables);
        }
    }
