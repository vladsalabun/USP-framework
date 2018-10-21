<?php
    
    $db =  new database;
    
    class database extends PDO
    {
        public $conn;
        
        function __construct() 
        {
            $this->connecting();
            // $this->createAllTables();
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

        function firstStartCMS() {
            
            // Try a select statement against the table
            // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
            try {
                $result = $this->conn->query("SELECT * FROM usp_configuration LIMIT 1");
            } catch (Exception $e) {
                // We got an exception == table not found
                return FALSE;
            }

            // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
            return $result !== FALSE;
        }        
        
        public function createAllTables($tableToCreate = null, $wipe = null) 
        {
            
            if ($tableToCreate != null) {
                // Creating tables:
                if ($wipe == null) {
                    foreach ($tableToCreate AS $table_name => $value_array) {
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
                } elseif ($wipe == 'wipe') {
                    // Wipe database:
                    foreach ($tableToCreate AS $table_name => $value_array) {
                        $sql = "DROP TABLE $table_name";
                        $this->conn->exec($sql);
                    }
                }
            }    
        }        
        
       
        
        
        #
        ### SELECT:
        #
        
        public function select($query,$vars = null)
        {    
            if (isset($query['SELECT'])) { 
                $select = $query['SELECT'];
            } else {
                $select = '*';
            }
            if (isset($query['FROM'])) {
                $from = $query['FROM'];
            } else {
                return '<p>ERROR: you must set FROM what table you want select rows.</p>';
            }
            // TODO: what if we get user data? 
            // TODO: WEHRE ARRAY!
            if (isset($query['WHERE'])) {
                $where = 'WHERE '. $query['WHERE'];
            }
            if (isset($query['ORDER'])) {
                if (isset($query['SORT'])) {
                    $order = 'ORDER BY '.$query['ORDER'].' '.$query['SORT'];
                } else {
                    $order = 'ORDER BY '.$query['ORDER'].' ASC';
                }
            } 
            if (isset($query['LIMIT'])) {
                $limit = 'LIMIT '.$query['LIMIT'];
            }
              
            // TODO: ?
            if (is_array($vars)) {
            }
              
            $sql = "SELECT $select FROM $from $where $order $limit";
            $stmt = $this->conn->prepare($sql);    
            if (is_array($vars)) {
                $stmt->execute($vars);
            } else {
                $stmt->execute();
            }
            if ($query['fetch'] == 1) {   
                return $stmt->fetch(PDO::FETCH_ASSOC);  
            } else {
                return $stmt->fetchAll(PDO::FETCH_ASSOC); 
            }
            
        }
        
        ### /SELECT
        
        ### UPDATE:
        
        public function update($array) 
        {
            
            // check what table need to update: 
            if (!isset($array['UPDATE'])) {
                echo 'ERROR UPDATE: what table you want to update?';
                exit();
            }
            
            // TABLE to update:
            $sql .= "UPDATE ".$array['UPDATE']." ";
                
            if (count($array['SET']) < 1 or !isset($array['SET'])) {
                echo 'ERROR UPDATE: what columns in table <b>'.$array['UPDATE'].'</b> you want to update?';
                exit();
            }
            
            // make columns and values arrays:
            foreach ($array['SET'] as $key => $value) {
                $keys[] = $key;
                $values[] = $value;
            }
                
            $sql .= "SET ";
                
            // put columns to query:
            foreach ($keys as $key) {
                $set[] = $key . " = :".$key;
            }
                
            // put values to query:
            $sql .= implode($set,',');
                
            if (isset($array['WHERE'])) {
                    
                $sql .= " WHERE ";
                    
                foreach ($array['WHERE'] as $whereKey => $whereValue) {
                        $keys[] = $whereKey;
                        $whereKeys[] = $whereKey;
                        $values[] = $whereValue;
                }
                
                foreach ($whereKeys as $whereKey) {
                    $where[] = $whereKey . " = :".$whereKey;
                }

                $sql .= implode($where,' AND ');
                
            }
                
            // TODO manual query:
            if (isset($array['MANUAL_WHERE'])) {
                $sql .= " WHERE ...";  
            }
            
            // prepare:       
            $stmt = $this->conn->prepare($sql);
            // bind:
            foreach ($keys as $num => $val) {
                $stmt->bindParam(':'.$val, $values[$num]);
            }
            // and execute:
            $stmt->execute();
            
        }
        
        ### /UPDATE
        
        ### INSERT
        public function insert($array) 
        {           
            foreach($array['COLUMNS'] as $columns => $value) {
                $cols[] = $columns;
                $vals[] = $value;
                $questionmarks[] = '?';
            }
            
            // TODO: check for errors. Does the table has such columns? Does it exixts?
            
            $sql = "INSERT INTO ".$array['INSERT INTO']." (".implode($cols,',').") VALUES (".implode($questionmarks,',').")";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($vals);
            
        }
        ### /INSERT
        
        ### INSERT
        public function delete($string) 
        {           
            $stmt = $this->conn->prepare($string);
            $stmt->execute();           
        }
        ### /INSERT        
        
        
        
        
        
        
        
    } // <- end of class database
    
    