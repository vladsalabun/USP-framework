<?php
    
    function checkPage() {
        
        if ($_POST) {
            
        }
        
        // Якщо був запит:
        if (isset($_GET['page'])) {
            
            if ($_GET['page'] == '') {
                
                // якщо пусто, то йдем на головну:
                return 'index';
                
            } else {
                
                // Дізнатись, які є файли у папці view
                $pagesArray = getFilesArray('usp_view');
               
                // Дізнаюсь, чи запитувана сторінка є у масиві:
                if (in_array($_GET['page'].'.php',$pagesArray)) {
                    return $_GET['page'];
                } else {
                    // якщо немає, то 404
                    return '404';
                } 
                
            }            
        } else {
            // якщо ні, то йдем на головну:
            return 'index';
        }
        
        return '404';
    }
    
    function checkThemePage() {
        return 'index';
    }