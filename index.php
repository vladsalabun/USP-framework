<?php
    
    # Підключаю конфігурацію:
    require_once 'usp_cms/usp_configs/index.php';

    # Підключаю логіку:
    require_once 'usp_cms/'.$usp.'_logic/index.php';

    # Підключаю плагіни:
    require_once 'usp_cms/'.$usp.'_plugins/index.php';
    
    /* TODO: тут роутер */
    $maintance = false;
    
    /* TODO: дізнатись яка тема вибрата у налаштуваннях */
    $theme = 'personal_crm';
    
    if (isset($_GET['lang'])) {
        if(array_key_exists($_GET['lang'],$allowedLanguages)) {
            $theme = $theme.'_'.$allowedLanguages[$_GET['lang']];
        } else {
            // якщо такої мови немає, то перенаправляємо на 404
            $badLanguageRequest = 1;
            $theme = $theme.'_'.$language;
        }
    } else {
        $theme = $theme.'_'.$language;
    }
    

    if (file_exists('themes/'.$theme.'/view/index.php')) {
        if ($badLanguageRequest == 1) {
            // якщо був запит на не існуючу мову, то показую 404 з головної теми:
            require 'themes/'.$theme.'/functions.php';
            require 'themes/'.$theme.'/view/head.php';
            require 'themes/'.$theme.'/view/404.php';
            require 'themes/'.$theme.'/view/footer.php';
            
        } else {
            
            if ($maintance == false) {
                // то запускаю роутер:
                $need_page = checkThemePage();
                
                // if there is no POST request, we can show page:
                require 'themes/'.$theme.'/functions.php';
                require 'themes/'.$theme.'/view/head.php';
                require 'themes/'.$theme.'/view/'.$need_page.'.php';
                require 'themes/'.$theme.'/view/footer.php';
                
            } else {
                require 'themes/'.$theme.'/view/head.php';
                require 'themes/'.$theme.'/view/gateway.php';
                require 'themes/'.$theme.'/view/footer.php';
            }
            
        }
        
    } else {
        echo '<h2>Oh, something go bad with '.$language.' theme folder.</h2>';
    }
