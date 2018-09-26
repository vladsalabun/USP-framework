<?php 
    
    // Клас повинен співпадати з назвою папки:
    class usp_corporateBlog {
        
        public $usp;
        public $tablesNames;      
        public $tables;      
        
        function __construct()
        {
            global $usp;
            $this->usp = $usp;
            
            // Тут треба вказати назви таблиць:
            $this->tablesNames = array(
                0 => $this->usp . "_corporateBlogTitle",
                1 => $this->usp . "_corporateBlogContent",
                2 => $this->usp . "_corporateBlogCategory",
                3 => $this->usp . "_corporateBlogCategoryMatching",
                4 => $this->usp . "_corporateBlogAccessMatching"
            );
            
            // Тут треба вказати структуру таблиць:
            $this->tables = array(
                $this->tablesNames[0] => array ( 
                    "ID" => "INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                    "postTitle" => "VARCHAR( 1000 )",
                    "postTitleDescription" => "VARCHAR( 1000 )",
                    "titleParentID" => "INT( 11 ) DEFAULT '0'",
                    "titlePriority" => "INT( 11 ) DEFAULT '0'",
                    "priority" => "INT( 11 ) DEFAULT '0'",
                    "author" => "INT( 11 ) DEFAULT '0'",
                    "date" => "DATETIME",
                    "moderation" => "INT( 11 ) DEFAULT '0'" // 0 - на модерації, 1 - активно, 2 видалено
                ),
                $this->tablesNames[1] => array (
                    "ID" => "INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                    "contentText" => "TEXT", // параграф, 1 ідея - 1 параграф
                    "contentNote" => "TEXT DEFAULT NULL", // примітка (справа)
                    "parentTitleID" => "INT( 11 ) DEFAULT '0'", // до якого заголовку належить
                    "contentType" => "INT( 11 ) DEFAULT '0'", // 1 - текст, 2 - важливе, 3 - цитата
                    "priority" => "INT( 11 ) DEFAULT '0'",
                    "wide" => "INT( 11 ) DEFAULT '0'", // 1 - широкий параграф і широка примітка
                    "moderation" => "INT( 11 ) DEFAULT '0'" // 0 - нема відповіді, 1 - зафіксована відповідь, 2 - видалено
                ),
                $this->tablesNames[2] => array (
                    "ID" => "INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                    "categoryName" => "TEXT", // назва категорії
                    "categoryURL" => "VARCHAR( 100 )", // URL категорії
                    "parentCategoryID" => "INT( 11 ) DEFAULT '0'", // підкатегорія
                    "priority" => "INT( 11 ) DEFAULT '0'",
                    "moderation" => "INT( 11 ) DEFAULT '0'" // 0 - нема відповіді, 1 - зафіксована відповідь, 2 - видалено
                ),
                $this->tablesNames[3] => array (
                    "titleID" => "INT( 11 )",
                    "categoryID" => "INT( 11 )"
                ),
                $this->tablesNames[4] => array (
                    "titleID" => "INT( 11 )",
                    "accessLevel" => "INT( 11 )",
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
