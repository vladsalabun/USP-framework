<?php 

    #   USP plugin: Money
    #   version: 2.1
    #   author: Vlad Salabun
    #   description: Облік моїх коштів 
    #   Activation: yes

    #   Menu: no
    #   url: usp_money
    #   title: Гроші

    /*
        TODO: Облік моїх коштів 
        1. Перевірити чи є таблиця і всі її поля
            якщо нема, створити, і додати поля
        2. Якщо є, то завантажити інформацію
    */

    require 'functions.php';
    require 'data.php';
    
    //var_dump($db);