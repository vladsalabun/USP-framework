<?php
/*
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
  */  
    
    $db =  new database;
    
    class database extends PDO
    {
        public $conn;
        
        function __construct() 
        {
            $this->connecting();
            $this->createAllTables();
        }
        
        private function connecting() 
        {
            // Connectiong to db:
            try {
                $this->conn = new PDO('mysql:host='.CONFIGURATION::HOST.';dbname='.CONFIGURATION::DB_NAME, CONFIGURATION::DB_USER, CONFIGURATION::DB_PASSWORD);
                $this->conn->exec("set names utf8mb4");
            } catch (Exception $e) {
                echo dialogs(101,$language) . $e->getMessage();
            }
        }    

        private function createAllTables() 
        {
            // Creating tables:
            if (CONFIGURATION::REINSTALL == 1) {
                foreach (CONFIGURATION::MYSQL_TABLES AS $table_name => $value_array) {
                    try 
                    {
                        $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                        foreach ($value_array AS $row_name => $row_option) {
                            $table_params[] = $row_name . ' ' . $row_option;
                        }
        
                        $sql = 'CREATE TABLE IF NOT EXISTS '.$table_name.' ('.implode($table_params, ', ').') ;<br>'; // Create new!
                        $this->conn->exec($sql);
                    }
                    catch(PDOException $e) 
                    {
                        echo $e->getMessage(); // if something go wrong
                    }
                    unset($table_params);
                }
            } elseif (CONFIGURATION::REINSTALL == 2) {
                // Wipe database:
                foreach (CONFIGURATION::MYSQL_TABLES AS $table_name => $value_array) {
                    $sql = "DROP TABLE $table_name";
                    $this->conn->exec($sql);
                }
            }
        }        
        
        // TODO: Create indexes!
        
    } // <- end of class database
