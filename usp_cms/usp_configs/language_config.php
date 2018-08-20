<?php
     
    # Мова CMS по замовчуванню:
    $language = 'ukraine';                       // <- Треба редагувати при встановленні
         
    
    /*  Усі надписи в адмінці на всіх мовах: */
    
    function dialogs($id,$language) {
        
        $dialogs = array();
        
        require_once 'language/language_navigation.php';
        require_once 'language/language_dialogs.php';
        require_once 'language/language_errors.php';
        
        $dialogs += language_navigation();
        $dialogs += language_dialogs();
        $dialogs += language_errors();
        
        return $dialogs[$id][$language];
        
    }
    
