<?php 
    
    // Клас повинен співпадати з назвою папки:
    class usp_planner {
        
        public $usp;
        public $tablesNames;      
        public $tables;      
        
        function __construct()
        {
            global $usp;
            $this->usp = $usp;
            
            // Тут треба вказати назви таблиць:
            $this->tablesNames = array(
                0 => $this->usp . "_plannerTask",
                1 => $this->usp . "_plannerRerular",
                2 => $this->usp . "_plannerCategory",
                3 => $this->usp . "_plannerCategoryMathes",
                4 => $this->usp . "_plannerPayments",
                5 => $this->usp . "_plannerPosting",
            );
            
            // Тут треба вказати структуру таблиць:
            $this->tables = array(
            
                // В цій таблиці записуються задачі:
                $this->tablesNames[0] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "text" => "TEXT", // опис задачі
                    "comment" => "TEXT", // додаткова інформація по задачі
                    "date" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
                    "taskTime" => "INT( 11 ) DEFAULT '0'", // час на виконання задачі (+10 хвилин при плануванні наступної)
                    "priority" => "INT( 11 ) DEFAULT '0'", // 0 - нормальний, 1 - важливий, 2 - термінове завдання!
                    "parentID" => "INT( 11 ) DEFAULT '0'",
                    "overdue" => "INT( 11 ) DEFAULT '0'", // На скільки часу просрочено (щоб визначити невдале планування), [-5,+5] хв
                    "moderation" => "INT( 11 ) DEFAULT '0'"
                ),
                
                // з цієї таблиці можна взяти задачі в таблицю задач:
                $this->tablesNames[1] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "text" => "TEXT",
                    "day" => "INT( 11 ) DEFAULT '0'", // 0 - пн, 1 - вт ... 7 - нд
                    "hour" => "INT( 11 ) DEFAULT '0'", // 0-24
                    "min" => "INT( 11 ) DEFAULT '0'", // 0-60
                    "type" => "INT( 11 ) DEFAULT '0'", // 0 - рутина, 1 - платежі
                    "moderation" => "INT( 11 ) DEFAULT '0'"
                ),
                
                // категорії задач:
                $this->tablesNames[2] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "text" => "TEXT", // назва категорії
                    "uri" => "VARCHAR( 100 ) NULL", // ідентифікатор
                    "parentID" => "INT( 11 ) DEFAULT '0'", // для підкатегорій
                    "moderation" => "INT( 11 ) DEFAULT '0'"
                ),
                
                // звязок категорій з регулярними задачами:
                $this->tablesNames[3] => array ( 
                    "taskID" => "INT( 11 ) DEFAULT '0'",
                    "categoryID" => "INT( 11 ) DEFAULT '0'",
                ),
                
                // платежі:
                $this->tablesNames[4] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "text" => "TEXT", // назва платежа, інформація
                    "date" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP", // час, до якого треба виконати платіж
                    "moderation" => "INT( 11 ) DEFAULT '0'"
                ),
                
                // відкладений постинг:
                // крон буде брати звідси задачі
                $this->tablesNames[5] => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY", // ID задачі
                    "text" => "TEXT", // текст поста
                    "date" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP", // час публікації
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
