<?php

    /*
    
        TODO: тут всі параметри, які не можна міняти в адмінці
        
        1) Надписи в адмінці на українській, російській, польській, англійській
        1) Таблиці баз даних, якісь початкові дані для заповнення
        
        Кожен розділ в окремий файл!

    */

    require_once 'usp_config.php';
    require_once 'language_config.php';
    require_once 'plugin_config.php';
    
    
    
    if($theme == null) {
        $theme = 'YandexMoneyAPP_'.$language;
    }
    