<?php
    
    /*
        
        TODO: корисні функції, які використовуються багато разів у різних місцях:
    
    */
    
    function getFilesArray($dir) {
        
        $array = array();
        // беру файли з директорії:
        $files = scandir('usp_view');
        
        // проходжу по масиву і беру тільки php файли:
        foreach ($files as $key => $string) {
            // якщо розширення .php:
            if(substr($string, -4) == '.php') {
                // додаю файл в масив:
                $array[] = $string;
            }
        }
        
        return $array;
        
    }

    function getFoldersArray($dir) {
        
        $array = array();
        // беру файли з директорії:
        $files = scandir('usp_plugins');

        // проходжу по масиву і беру тільки php файли:
        foreach ($files as $key => $string) {
            // якщо розширення .php:
            if(substr($string, -4) == '.php') {
                // додаю файл в масив:
                
            } else if($string == '.' or $string == '..') {
                
            } else {
                $array[] = $string;
            }
        }
        
        return $array; 
        
    }
    
    function readParam($sting) {
        $status = explode(':',$sting);
        return trim($status[1]);
    }