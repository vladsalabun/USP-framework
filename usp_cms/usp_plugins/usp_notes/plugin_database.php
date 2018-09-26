<?php 
    
    // Клас повинен співпадати з назвою папки:
    class usp_notes {
        
        public $usp;
        public $tablesNames;      
        public $tables;      
        
        function __construct()
        {
            global $usp;
            $this->usp = $usp;
            
            // Тут треба вказати назви таблиць:
            $this->tablesNames = array(
                0 => $this->usp . "_QuickNotes"
            );
            
            // Тут треба вказати структуру таблиць:
            $this->tables = array(
                $this->tablesNames[0] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "text" => "TEXT",
                    "date" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
                    "moderation" => "INT( 11 ) DEFAULT '0'"
                )
            );
        }
  
        // Створення таблиць:
        public function reinstall() 
        {
            global $db;
            $db->createAllTables($this->tables);
        }
    }
