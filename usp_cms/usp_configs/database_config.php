<?php   
    
    class configuration
    {    
        # Реквізити доступу до бази даних:
        const VER = 2.3;
        const HOST = accessDetail::HOST;           // <- Треба редагувати при встановленні
        const DB_NAME = 'usp_'.accessDetail::DB_NAME;       // <- Треба редагувати при встановленні
        const DB_USER = accessDetail::DB_USER;            // <- Треба редагувати при встановленні
        const DB_PASSWORD = accessDetail::DB_PASSWORD;        // <- Треба редагувати при встановленні
        
        # Префікс бази даних:
        const PREFIX = 'usp';               // <- Треба редагувати при встановленні
        
        # На випадок, якщо треба буде вайпнути базу даних:
        const REINSTALL = 0;                // 2 - вайп
    }
    
