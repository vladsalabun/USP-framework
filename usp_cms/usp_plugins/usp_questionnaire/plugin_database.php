<?php 
    
    // Клас повинен співпадати з назвою папки:
    class usp_questionnaire {
        
        public $usp;
        public $tablesNames;      
        public $tables;      
        
        function __construct()
        {
            global $usp;
            $this->usp = $usp;
            
            // Тут треба вказати назви таблиць:
            $this->tablesNames = array(
                0 => $this->usp . "_customerQuestions",
                1 => $this->usp . "_customerAnswers"
            );
            
            // Тут треба вказати структуру таблиць:
            $this->tables = array(
                $this->tablesNames[0] => array ( 
                    "ID" => "INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                    "questionText" => "TEXT",
                    "answerForm" => "TEXT",
                    "priority" => "INT( 11 ) DEFAULT '0'",
                    "moderation" => "INT( 11 ) DEFAULT '0'" // 0 - на модерації, 1 - активно, 2 видалено
                ),
                $this->tablesNames[1] => array ( 
                    "ID" => "INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                    "projectID" => "INT( 11 ) DEFAULT '0'",
                    "questionID" => "INT( 11 ) DEFAULT '0'",
                    "userID" => "INT( 11 ) DEFAULT '0'", // хто додав інфу в базу
                    "answer" => "TEXT",
                    "date" => "DATETIME",
                    "moderation" => "INT( 11 ) DEFAULT '0'" // 0 - нема відповіді, 1 - зафіксована відповідь, 2 - видалено
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

    
 
    // TODO: скрипт для обробки відповідей роби окремо, просто повідом менеджера на екрані, якщо для конкретного питання немає ще скрипта для обробки. Привязка по ID