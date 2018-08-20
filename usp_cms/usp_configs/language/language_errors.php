<?php
     
    # Підписи навігації:
      
    function language_errors() {
         
        $dialogs = array(
            40000 => array(
                'ukraine' => 'Потрібно створити папку plugin_view',
                'russian' => 'Нужно создать папку plugin_view',
                'poland' => '',
                'english' => '',
            ),
            40001 => array(
                'ukraine' => 'Потрібно створити index.php у папці plugin_view',
                'russian' => 'Нужно создать index.php в папке plugin_view',
                'poland' => '',
                'english' => '',
            ),
            40002 => array(
                'ukraine' => 'Такої сторінки немає у папці plugin_view',
                'russian' => 'Нет такой страницы в папке plugin_view',
                'poland' => '',
                'english' => '',
            )             
        ); 

        return $dialogs;
        
    }  

    
