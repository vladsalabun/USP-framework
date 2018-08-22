<?php   
    
    class configuration
    {    
        # Реквізити доступу до бази даних:
        const VER = 2.3;
        const HOST = 'localhost';           // <- Треба редагувати при встановленні
        const DB_NAME = 'usp_system';       // <- Треба редагувати при встановленні
        const DB_USER = 'mysql';            // <- Треба редагувати при встановленні
        const DB_PASSWORD = 'mysql';        // <- Треба редагувати при встановленні
        
        # Префікс бази даних:
        const PREFIX = 'usp';               // <- Треба редагувати при встановленні
        
        # На випадок, якщо треба буде вайпнути базу даних:
        const REINSTALL = 0;                // 2 - вайп
    }
    
