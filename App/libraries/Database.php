<?php
    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASSWORD;
        private $dbname = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct(){
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;


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
        public function bind($param, $value, $type = null) {
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
                    case is_resource($value): // Check if it's a resource (used for LOBs)
                        $type = PDO::PARAM_LOB;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }
        

        public function singleArray(){
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
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

         // Function to generate a custom auto-incrementing sportId
        public function generateSportId() {
            // Query to get the last sportId
            $this->query("SELECT sportId FROM sport ORDER BY sportId DESC LIMIT 1");
            $lastSport = $this->single();

            if ($lastSport) {
                // Extract the numeric part of the last sportId and increment it
                $lastId = (int) substr($lastSport->sportId, 2); // Assuming format is "TS001"
                $newId = $lastId + 1;
            } else {
                // Start with TS001 if no records exist
                $newId = 1;
            }

            // Return the new sportId in the desired format
            return 'TS' . str_pad($newId, 3, '0', STR_PAD_LEFT); // Example: TS001
        }

        public function generateUserId() {
            // Query to get the last userId
            $this->query("SELECT userId FROM user ORDER BY userId DESC LIMIT 1");
            $lastUser = $this->single();
        
            if ($lastUser) {
                // Extract the numeric part of the last userId and increment it
                $lastId = (int) substr($lastUser->userId, 2); // Assuming format is "US001"
                $newId = $lastId + 1;
            } else {
                // Start with US001 if no records exist
                $newId = 1;
            }
        
            // Return the new userId in the desired format
            return 'US' . str_pad($newId, 3, '0', STR_PAD_LEFT); // Example: US001
        }
        

        public function generateCoachId() {
            // Query to get the last userId
            $this->query("SELECT coachId FROM coach ORDER BY coachId DESC LIMIT 1");
            $lastUser = $this->single();
        
            if ($lastUser) {
                // Extract the numeric part of the last userId and increment it
                $lastId = (int) substr($lastUser->coachId, 2); // Assuming format is "US001"
                $newId = $lastId + 1;
            } else {
                // Start with US001 if no records exist
                $newId = 1;
            }
        
            // Return the new userId in the desired format
            return 'COACH' . str_pad($newId, 3, '0', STR_PAD_LEFT); // Example: US001
        }
        

        public function generatePlayerId() {
            // Query to get the last userId
            $this->query("SELECT playerId FROM player ORDER BY playerId DESC LIMIT 1");
            $lastUser = $this->single();
        
            if ($lastUser) {
                // Extract the numeric part of the last userId and increment it
                $lastId = (int) substr($lastUser->playerId, 2); // Assuming format is "US001"
                $newId = $lastId + 1;
            } else {
                // Start with US001 if no records exist
                $newId = 1;
            }
        
            // Return the new userId in the desired format
            return 'PLY' . str_pad($newId, 3, '0', STR_PAD_LEFT); // Example: US001
        }

        public function generateSchoolId() {
            // Query to get the last userId
            $this->query("SELECT schoolId FROM school ORDER BY playerId DESC LIMIT 1");
            $lastUser = $this->single();
        
            if ($lastUser) {
                // Extract the numeric part of the last userId and increment it
                $lastId = (int) substr($lastUser->schoolId, 2); // Assuming format is "US001"
                $newId = $lastId + 1;
            } else {
                // Start with US001 if no records exist
                $newId = 1;
            }
        
            // Return the new userId in the desired format
            return 'SCL' . str_pad($newId, 3, '0', STR_PAD_LEFT); // Example: US001
        }

        public function generateParentId() {
            // Query to get the last userId
            $this->query("SELECT parentId FROM parent ORDER BY parentId DESC LIMIT 1");
            $lastUser = $this->single();
        
            if ($lastUser) {
                // Extract the numeric part of the last userId and increment it
                $lastId = (int) substr($lastUser->parentId, 2); // Assuming format is "US001"
                $newId = $lastId + 1;
            } else {
                // Start with US001 if no records exist
                $newId = 1;
            }
        
            // Return the new userId in the desired format
            return 'PRNT' . str_pad($newId, 3, '0', STR_PAD_LEFT); // Example: US001
        }
        
        public function generateAdminId() {
            // Query to get the last userId
            $this->query("SELECT adminId FROM admin ORDER BY parentId DESC LIMIT 1");
            $lastUser = $this->single();
        
            if ($lastUser) {
                // Extract the numeric part of the last userId and increment it
                $lastId = (int) substr($lastUser->adminId, 2); // Assuming format is "US001"
                $newId = $lastId + 1;
            } else {
                // Start with US001 if no records exist
                $newId = 1;
            }
        
            // Return the new userId in the desired format
            return 'ADMIN' . str_pad($newId, 3, '0', STR_PAD_LEFT); // Example: US001
        }
        


        public function lastInsertId() {
            return $this->dbh->lastInsertId();
        }

        // Get error information
    public function errorInfo() {
        return $this->stmt->errorInfo(); // Return PDOStatement error info
    }

    public function beginTransaction() {
        return $this->dbh->beginTransaction();
    }
    
    public function commit() {
        return $this->dbh->commit();
    }
    
    public function rollBack() {
        return $this->dbh->rollBack();
    }
    
}


?>

