<?php 
     
    $questionnaireTable = array(
        0 => $usp . "_customerQuestions",
        1 => $usp . "_customerAnswers"
    );

    // TODO: скрипт для обробки відповідей роби окремо, просто повідом менеджера на екрані, якщо для конкретного питання немає ще скрипта для обробки. Привязка по ID 
    
    
    // All tables:
    $uspQuestionnaireTables = array(
        
        $questionnaireTable[0] => array ( 
            "ID" => "INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
            "questionText" => "TEXT",
            "answerForm" => "TEXT",
            "priority" => "INT( 11 ) DEFAULT '0'",
            "moderation" => "INT( 11 ) DEFAULT '0'" // 0 - на модерації, 1 - активно, 2 видалено
        ),
        
        $questionnaireTable[1] => array ( 
            "ID" => "INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
            "projectID" => "INT( 11 ) DEFAULT '0'",
            "questionID" => "INT( 11 ) DEFAULT '0'",
            "userID" => "INT( 11 ) DEFAULT '0'", // хто додав інфу в базу
            "answer" => "TEXT",
            "date" => "DATETIME",
            "moderation" => "INT( 11 ) DEFAULT '0'" // 0 - нема відповіді, 1 - зафіксована відповідь, 2 - видалено
        )
      
        
    );
   
    $reinstallPlugin = 1;
   
    // Create tables:
    if($reinstallPlugin == 1 ) {
        $db->createAllTables($uspQuestionnaireTables);  
    }
    
