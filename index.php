<?php
    
    # Підключаю конфігурацію:
    require_once 'usp_cms/usp_configs/index.php';

    # Підключаю логіку:
    require_once 'usp_cms/'.$usp.'_logic/index.php';

    # Підключаю плагіни:
    require_once 'usp_cms/'.$usp.'_plugins/index.php';
    
    /* TODO: тут роутер */
    $maintance = false;
    
    /* TODO: дізнатись яка тема вибрата у нашалтуваннях */
    $theme = 'salabun';
    
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
