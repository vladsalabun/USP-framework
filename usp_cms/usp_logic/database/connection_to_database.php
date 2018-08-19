<?php

    try {
        // Намагаюсь підключитись до бази даних:
        $connection = new PDO('mysql:host=localhost;dbname='.$dbname, $dbUser, $dbPassword);
        $connection->exec("set names utf8mb4");
    } catch (Exception $e) {
        // якщо спроба не вдалась, то показую на екран текст помилки:
        if ($debug == 1) {
            echo dialogs(101,$language) . $e->getMessage();
        }
    }
    
