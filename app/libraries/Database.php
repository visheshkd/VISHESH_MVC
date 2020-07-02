<?php
/*
    *PDO DATABASE CLASS
    * Connect to database
    * create prepared statements
    * bind values
    * return rows and results

    */
    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct(){
            //Set DSN
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true, //persistent connection.
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                //way of handling errors
            );

            //create new PDO instance and constructor handles the connection of the database

            try{
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            } catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Need a method to create queries 
        //Prepare statement with query

        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        //bind values

        public function bind($param, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);

        }
         // Execute the prepared statement after binding values to it
        public function execute(){
            return $this->stmt->execute();
        }
        /*
        -->connect to database using constructor
        First , prepare a statement.
        second , bind the values ,
        third , execute the prepared statement */
        
        //Two methods to fetch and show the results.

        // Get result set as array of objects(pdo-fetch-obj)

        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        //Get single record  as object
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ); 
        }
        //Get row count
        public function rowCount(){
            return $this->stmt->rowCount();
        }
        //done database class

    }