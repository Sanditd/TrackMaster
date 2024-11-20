<?php
    class database{
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $dbname = 'trackmaster';

        private $dbh;
        private $stmt;
        private $error;

        public function __construct(){
            $dsn = 'mysql:host'.$this->host.';dbname='.$this->dbname;

            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            //init pdo
            try{
                $this->dbh = new PDO($dsn,$this->user,$this->password, $options);
            }catch(PDOException $e){
                $this->error=$e->getMessage();
                echo $this->error;
            }
        }

        //prepare stmt
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);

        }

        //bind param
        public function bind($param, $value, $type = null){
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default :
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);

        }

        //excute the prepare stmt
        public function execute(){
            return $this->stmt->execute();
        }

        //get multiple as result
        public function resultset(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);   
        }

        //get single as result
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //get row count
        public function rowCount(){
            return $this->stmt->rowCount();
        }

           // Get the ID of the last inserted row
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    // Close the database connection
    public function close() {
        $this->dbh = null;
    }
    }

?>