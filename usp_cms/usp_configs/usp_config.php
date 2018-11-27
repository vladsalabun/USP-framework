<?php

    # CMS version:
    $version = '2.7.1';

    # Встановлення USP:
    $uspInstaller = 0; // після першого запуску можна поставити 0
    
    # Логін та пароль адміна, які встановлюються по замовчуванню:
    $defaultAdmin = 'usp';
    $defaultPassword = 'marketing';

    # Посилання:
    $webSiteUrl = accessDetail::URL;  // <- Треба редагувати при встановленні   
    

    ##############################################################
    #
    #   Дальше редагувати нічого не треба!
    #
    ##############################################################
    

    # CMS prefix:
    $usp = 'usp';

    # CMS статус:
    $debug = 1;
    $showErrors = 0;   
    
    /* Фішки для перевірки правильності URL:  */  
    
    // скрипт який знаходить папку, у якій встановлено CMS:
    $rootArray = explode('/',$webSiteUrl);
    
    if(substr($webSiteUrl, -1) != '/') {
        $webSiteUrl = $webSiteUrl . '/';
    }
    
    /* папка, у якій знаходиться CMS, тут нічого міняти не потрібно */
    for ($i = 3; $i < count($rootArray); $i++) {
        if(strlen($rootArray[$i])>= 1) {
            $rootFolder .= $rootArray[$i].'/';
        }
    }
   
    if(strlen($rootFolder)>= 1) {
        $rootFolder = '/'.$rootFolder;
    } else {
        $rootFolder = '';
    }
  
    $rootFolder = '/'.$rootFolder; // <- внутрішня папка, у якій встановлено CMS
    
    $licensedPrograms = array(
        'usp_yandex_donation'
    );
    
    $apiRequestsURL = 'http://api.salabun.com/';
    
    # Модулі:
    $cmsStylesArray = array(
        $webSiteUrl.'usp_cms/usp_css/basic4.css',
        $webSiteUrl.'usp_cms/usp_css/usefull.css',
        $webSiteUrl.'usp_cms/usp_css/navbar_style.css',
        $webSiteUrl.'usp_cms/usp_css/modal_style.css',
        $webSiteUrl.'usp_cms/usp_css/cms_style.css',
        $webSiteUrl.'usp_cms/usp_css/links_style.css',
        $webSiteUrl.'usp_cms/usp_css/tables_style.css',
        $webSiteUrl.'usp_cms/usp_css/forms_style.css',
        $webSiteUrl.'usp_cms/usp_css/ul-treefree.css',
    );
    $cmsImg = $webSiteUrl.'usp_cms/usp_img/';
    $cmsJsArray = array(
        //$webSiteUrl.'usp_cms/usp_js/jQuery_v1.12.4.js',
        $webSiteUrl.'usp_cms/usp_js/jQuery_v1.9.1.js',
        $webSiteUrl.'usp_cms/usp_js/fade.js',
        $webSiteUrl.'usp_cms/usp_js/ul-drop.js',
        $webSiteUrl.'usp_cms/usp_js/bootstrap.js'
    );

    // TODO: set config in DB
    $elementsPerPage = 10;

    $cmsFonts = $webSiteUrl.'usp_cms/usp_fonts/';
    
