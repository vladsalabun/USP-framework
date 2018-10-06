<?php
    
    // версія 1.0 (5 листопада 2018)
    
    class rubricator
    {
        
        // Створення таблиць:
        public static function reinstall($tables) 
        {
            global $db;
            $db->createAllTables($tables);
        }
        
        public static function createPluginCategoryTable($tableName)
        {
            // Таблиці рубрик всю ди однакові:
            $tables = array(
                $tableName => array ( 
                    "ID" => "INT( 11 ) AUTO_INCREMENT PRIMARY KEY",
                    "parentID" => "INT( 11 ) DEFAULT '0'",
                    "name" => "VARCHAR( 100 ) NULL",
                    "uri" => "VARCHAR( 100 ) NULL",
                    "count" => "INT( 11 ) DEFAULT '0'",
                    "moderation" => "INT( 1 ) DEFAULT '0'"
                )
            );
            
            // Створюю таблицю рубрик для плагіна, який щойно активували:
            self::reinstall($tables);
            
        }
        
        public static function createPluginCategoryRelationsTable($tableName)
        {
            // Таблиці рубрик всю ди однакові:
            $tables = array(
                $tableName => array ( 
                    "categoryID" => "INT( 11 ) DEFAULT '0'",
                    "itemID" => "INT( 11 ) DEFAULT '0'",
                )
            );
            // Створюю таблицю залежностей
            self::reinstall($tables);
        }
        
        public static function addNewCategory($array,$tableName)
        {
            echo $tableName;
        } 
        
        public static function getCategories($tableName)
        {
            global $db;           
            
            $array = array(
                "SELECT" => "*",
                "FROM" => $tableName,
                "WHERE" => "moderation = 0",
                "ORDER" => "date",
            );
            
            return $db->select($array);
            
        } 
        
        public static function editCategories($array,$tableName)
        {
            echo $tableName;
        }
        
    }
    