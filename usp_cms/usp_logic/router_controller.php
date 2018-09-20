<?php
    
    function checkPage($userINFO) {

        global $webSiteUrl;
                
        if ($_POST) {
            
            // якщо не було вказано, що запит йде до плагіну, чи до конкретної теми, то він йде до CMS:
            
            if($_COOKIE['password'] === $userINFO['password']) {
                
                $postObject = new postHandler; 
                // Передаю рівень доступу поточного користувача:
                $postObject->userINFO = $userINFO;
                $postObject->usp = $usp;
                // Вказую метод, який повинен виконатись:
                if (method_exists($postObject, $_POST['action'])) {
                    $postObject->$_POST['action']();
                } else {
                    // якщо метода не існує, то на головну:
                    header("Location: $webSiteUrl");
                    exit();
                }
            } else {
                // Silence.
            }
            
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