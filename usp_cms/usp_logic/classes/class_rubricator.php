<?php
    
    // версія 1.1 (5 листопада 2018)
    
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
                    "description" => "VARCHAR( 200 ) NULL",
                    "uri" => "VARCHAR( 100 ) NULL",
                    "count" => "INT( 11 ) DEFAULT '0'",
                    "position" => "INT( 11 ) DEFAULT '0'", // колонка для трьохколончої верстки
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
        
        public static function addNewCategory()
        {
           
            global $db;

            // якщо це корінна категорія:
            $array = array(
            "INSERT INTO" => $_POST['tableName'],
                "COLUMNS" => array(
                    "parentID" => $_POST['parentCategory'][0],
                    "name" => $_POST['categoryName'],
                    "description" => $_POST['description'][0],
                    "position" => $_POST['position'][0],
                    "uri" => CyryllicNameToLatin($categoryName),
                 )                           
            );
                    
            $db->insert($array); 

            
        } 
        
        public static function getCategories($tableName)
        {
            global $db;           
            
            $array = array(
                "SELECT" => "*",
                "FROM" => $tableName,
                "WHERE" => "moderation = 0",
                "ORDER" => "count",
                "SORT" => "DESC",
            );
            
            $categoriesArray = $db->select($array);
           
            return $categoriesArray;
            
        } 
        
        public static function editCategory($array,$tableName)
        {
            echo $tableName;
        }
        
        public static function showCategoriesTree($tableName)
        {
            
        }
        
        public static function showCategoriesTree3($tableName)
        {
            
        }

        
    }
    
