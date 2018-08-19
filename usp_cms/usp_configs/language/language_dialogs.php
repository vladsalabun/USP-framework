<?php
     
    # Діалоги:
      
    function language_dialogs() { 
    
        $dialogs = array(
            100 => array(
                'ukraine' => 'Вітаємо у системі USP!',
                'russian' => 'Добро пожаловать в систему USP!',
                'poland' => 'Witamy w systemie USP!',
                'english' => 'Welcom to USP system!',
            ),
                101 => array(
                    'ukraine' => 'При підключенні до бази даних сталась помилка ',
                    'russian' => 'При подключении к базе данных произошла ошибка ',
                    'poland' => '',
                    'english' => '',
                ),  
                102 => array(
                    'ukraine' => 'Дякую за те, що користуєтесь USP CMS!',
                    'russian' => 'Спасибо за то, что используете USP CMS!',
                    'poland' => '',
                    'english' => '',
                ),
                103 => array(
                    'ukraine' => 'З питань розробки програмного забезпечення пишіть на електронну пошту: <a href="mailto:salabunvlad@gmail.com" class="email">salabunvlad@gmail.com</a>',
                    'russian' => 'По вопросам разработки програмного обеспечения пишите на електронную почту: <a href="mailto:salabunvlad@gmail.com" class="email">salabunvlad@gmail.com</a>',
                    'poland' => '© 2018 Web Cybernetica',
                    'english' => '© 2018 Web Cybernetica',
                ), 
                104 => array(
                    'ukraine' => '© 2018 Web Cybernetica',
                    'russian' => '© 2018 Web Cybernetica',
                    'poland' => '© 2018 Web Cybernetica',
                    'english' => '© 2018 Web Cybernetica',
                ), 
                105 => array(
                    // TODO: текст: про цю програму
                    'ukraine' => 'Про програму USP',
                    'russian' => 'О программе USP',
                    'poland' => '',
                    'english' => 'About USP',
                ),                               
            200 => array(
                'ukraine' => 'Вхід <u>тільки</u> для працівників веб-студії',
                'russian' => 'Вход <u>только</u> для сотрудников веб-студии',
                'poland' => '',
                'english' => '',
            ),
                201 => array(
                    'ukraine' => '(реєстрації чи відновлення пароля тут немає)',
                    'russian' => 'Добро пожаловать в систему USP!',
                    'poland' => 'Witamy w systemie USP!',
                    'english' => 'Welcom to USP system!',
                ),            
                202 => array(
                    'ukraine' => 'Якщо Ви клієнт і забули як подивитись інформацію стосовно Вашого проекту, <br>то надішліть запит на пошту: <a href="mailto:salabunvlad@gmail.com">salabunvlad@gmail.com</a>',
                    'russian' => 'Если Вы клиент и забыли как посмотреть информацию о Вашем проекте,<br>пришлите запрос на почту: <a href="mailto:salabunvlad@gmail.com">salabunvlad@gmail.com</a>!',
                    'poland' => '',
                    'english' => '',
                )                    
        );
        
        return $dialogs;
        
    }
    
