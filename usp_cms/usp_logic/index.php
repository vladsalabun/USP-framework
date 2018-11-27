<?php
    
    /*
        TODO: тут головний контроллер 
    
    */
    
    # Підключаю логіку роботи з базою даних:
    require_once 'database/connection_to_database.php';
    
     # Підключаю логіку роботи з базою даних:
    require_once 'prepared_queries.php'; 

    # Підключаю корисні функції, які використовуються багато разів у різних місцях:
    require_once 'usefull.php';      
    
    # Дії, які слід виконати під час інсталяції CMS:
    require_once 'usp_installer.php';

    # Підключаю логіку роутера:
    require_once 'router_controller.php';
    
    # Обробник POST запитів:
    require_once 'post_handler.php';
            
    # Підключаю класи для допомоги в верстці:
    require 'classes/class_form.php';
    require 'classes/class_table.php';
    require 'classes/class_highlight.php';
    
    # Підключаю рубрикатор:
    require 'classes/class_rubricator.php';
    
    $table = new tableGenerator;
    $highlight = new highlight;
    $form = new formGenerator;