<?php
require_once __DIR__ . '/../libraries/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    
    
    public function createUser($data) {
        error_log("Data received in createUser: " . print_r($data, true)); // Debugging
    
        $query = "INSERT INTO users 
                  (firstname, lname, phonenumber, address, email, password, username, photo, age, dob, role, gender, province, district,regDate, active)
                  VALUES (:firstname, :lastname, :phone, :address, :email, :password, :username, :photo, :age, :dob, :role, :gender, :province, :district, :regDate, :active)";
        
        $this->db->query($query);
        
        // Bind parameters (Updated key names)
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']); // Fixed
        $this->db->bind(':phone', $data['phone']);       // Fixed
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':photo', $data['photo'], PDO::PARAM_LOB);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':regDate', $data['created_at']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':active', '0'); // Default value for active

        if ($this->db->execute()) {
            return true;
        } else {
            // Log database errors
            // $errorInfo = $this->db->errorInfo();
            // error_log("Database error: " . $errorInfo[2]);
            return false;
        }
    }
    
    public function createSchoolUser($data) {
        error_log("Data received in createUser: " . print_r($data, true)); // Debugging
    
        $query = "INSERT INTO users 
                  (firstname, phonenumber, address, email, password, username, photo, role, province, district,regDate,active)
                  VALUES (:firstname, :phone, :address, :email, :password, :username, :photo,  :role, :province, :district, :regDate, :active)";
        
        $this->db->query($query);
        
        // Bind parameters (Updated key names)
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':phone', $data['phone']);       // Fixed
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':photo', $data['photo'], PDO::PARAM_LOB);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':regDate', $data['created_at']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':active', '0');

        if ($this->db->execute()) {
            return true;
        } else {
            // Log database errors
            $errorInfo = $this->db->errorInfo();
            error_log("Database error: " . $errorInfo[2]);
            return false;
        }
    }

    public function lastInsertId() {
        return $this->db->lastInsertId(); // Use the PDO instance's method
    }

    public function insertUser($firstname, $lastname, $email, $username, $password, $phone, $address, $dob, $gender, $age, $photo, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashing the password

        $query = "INSERT INTO users (firstname, lname, phonenumber, address, email, password, username, photo, age, dob, role, gender)
                  VALUES (:firstname, :lastname, :phonenumber, :address, :email, :password, :username, :photo, :age, :dob, :role, :gender)";
        
        $this->db->query($query);
        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':phonenumber', $phone);
        $this->db->bind(':address', $address);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':username', $username);
        $this->db->bind(':photo', $photo, PDO::PARAM_LOB);
        $this->db->bind(':age', $age);
        $this->db->bind(':dob', $dob);
        $this->db->bind(':role', $role);
        $this->db->bind(':gender', $gender);

        return $this->db->execute();
    }

    public function getSportIdByName($sportName) {
        $query = "SELECT sport_id FROM sports WHERE sport_name = :sport_name";
        $this->db->query($query);
        $this->db->bind(':sport_name', $sportName);
        $result = $this->db->single();

        
        return $result ? $result->sport_id : false; // Return sport_id or false if not found
    }
    
    public function getSportNameById($sport_id) {
        $query = "SELECT sport_name FROM sports WHERE sport_id = :sport_id";
        $this->db->query($query);
        $this->db->bind(':sport_id', $sport_id);
        $result = $this->db->single();

        
        return $result ? $result->sport_name : false; // Return sport_id or false if not found
    }

    public function getSchoolIdByName($schoolName) {
        $query = "SELECT school_id FROM user_school WHERE school_name = :school_name";
        $this->db->query($query);
        $this->db->bind(':school_name', $schoolName);
        $result = $this->db->single();
        return $result ? $result->school_id : false; // Return school_id or false if not found
    }

    // Function to insert player data into `user_player` table
    public function insertPlayer($data) {
        // Ensure proper type casting
        $user_id = (int) $data['user_id'];  // Assuming user_id is an integer
        $sport_id = (int) $data['sportName'];  // Ensure sport_id is an integer
        $school_id = (int) $data['school'];  // Ensure school_id is an integer
        $zone = (string) $data['zone'];  // Ensure zone is a string
        $bio = (string) $data['bio'];  // Ensure bio is a string
        $playerRole = (string) $data['playerRole'];  // Ensure bio is a string
    
        $query = "INSERT INTO user_player (user_id, sport_id, school_id, zone, bio,role)
                  VALUES (:user_id, :sport_id, :school_id, :zone, :bio,:role)";
        
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':sport_id', $sport_id);
        $this->db->bind(':school_id', $school_id);
        $this->db->bind(':zone', $zone);
        $this->db->bind(':bio', $bio);
        $this->db->bind(':role', $playerRole);
    
        return $this->db->execute();
    }
    

    public function getSports() {
        $this->db->query("SELECT sport_name FROM sports");
        $result = $this->db->resultset();
        return $result;

    }

    public function getSchools() {
        $this->db->query("SELECT school_name,zone FROM user_school");
        $result = $this->db->resultset();
        return $result;

    }

    Public function insertCoach($data) {
        $query = "INSERT INTO user_coach (user_id, sport_id, zone, coach_type, educational_qualifications, professional_playing_experience, coaching_experience, key_achievements, bio)
                  VALUES (:user_id, :sport_id, :zone, :coach_type, :educational_qualifications, :professional_playing_experience, :coaching_experience, :key_achievements, :bio)";
        
        $this->db->query($query);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':sport_id', $data['sportName']);
        $this->db->bind(':zone', $data['zone']);
        $this->db->bind(':coach_type', $data['coach_type']);
        $this->db->bind(':educational_qualifications', $data['educational_qualifications']);
        $this->db->bind(':professional_playing_experience', $data['professional_playing_experience']);
        $this->db->bind(':coaching_experience', $data['coaching_experience']);
        $this->db->bind(':key_achievements', $data['key_achievements']);
        $this->db->bind(':bio', $data['bio']);
        return $this->db->execute();
    }

    Public function insertSchool($data) {
        $query = "INSERT INTO user_school (user_id, school_name, bio, district, province, zone)
                  VALUES (:user_id, :school_name,:bio, :district, :province, :zone)";
        
        $this->db->query($query);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':school_name', $data['firstname']);
        $this->db->bind(':bio', $data['bio']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':province', $data['province']);
        $this->db->bind(':zone', $data['zone']);
        return $this->db->execute();
    }

    public function getMonthlySignups($month = null, $year = null) {
        // Use the current month and year if not provided
        if ($month === null || $year === null) {
            $month = date('m'); // Current month
            $year = date('Y');  // Current year
        }
    
        $query = "SELECT 
                    SUM(CASE WHEN role = 'Coach' AND isDelete = 0 THEN 1 ELSE 0 END) AS coaches,
                    SUM(CASE WHEN role = 'Player' AND isDelete = 0 THEN 1 ELSE 0 END) AS players,
                    SUM(CASE WHEN role = 'School' AND isDelete = 0 THEN 1 ELSE 0 END) AS schools,
                    SUM(CASE WHEN role = 'Parent' AND isDelete = 0 THEN 1 ELSE 0 END) AS parents,
                    SUM(CASE WHEN isDelete = 1 THEN 1 ELSE 0 END) AS deleted_accounts
                  FROM users
                  WHERE MONTH(regDate) = :month AND YEAR(regDate) = :year";
    
        $this->db->query($query);
        $this->db->bind(':month', $month, PDO::PARAM_INT);
        $this->db->bind(':year', $year, PDO::PARAM_INT);
        $this->db->execute();
    
        return $this->db->singleArray(); // Fetch a single row with aggregated results
    }
    
        //check the emails and user names are alraedy available on the db
        public function checkUserExists($email, $username) {
            $query = "SELECT * FROM users WHERE email = :email OR username = :username";
            $this->db->query($query);
            $this->db->bind(':email', $email);
            $this->db->bind(':username', $username);
            $this->db->execute();
    
            return $this->db->rowCount() > 0; // Returns true if a user exists, false otherwise
        }

        public function checkAdminExists($email, $username) {
            $this->db->query("SELECT * FROM admin WHERE email = :email OR username = :username");
            $this->db->bind(':email', $email);
            $this->db->bind(':username', $username);
            
            $row = $this->db->single(); // Fetch one matching row (if exists)
            return $row ? true : false;
        }
        

        public function getAllPlayers() {
            $this->db->query("SELECT id, name FROM users WHERE role = 'player'");
            return $this->db->resultSet();
        }
        


        public function createAdmin($data) {
            error_log("Data received in createUser: " . print_r($data, true)); // Debugging
        
            $query = "INSERT INTO admin 
                      (email, password, username, active)
                      VALUES (:email, :password, :username, :active)";
            
            $this->db->query($query);
            
            // Bind parameters (Updated key names)
        
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':active', '0');

    
            if ($this->db->execute()) {
                return true;
            } else {
                // Log database errors
                $errorInfo = $this->db->errorInfo();
                error_log("Database error: " . $errorInfo[2]);
                return false;
            }
        }

        public function getAdminUserIds(){
            $query = "SELECT admin_id FROM admin ";
            $this->db->query($query);
            $result = $this->db->resultset();
            return $result ? $result : false; // Return user_id or false if not found
        }

        public function getUsers(){
            $query = "SELECT * FROM users ";
            $this->db->query($query);
            $result = $this->db->resultset();
            return $result;
        }

        public function getPlayers(){
            $query = "SELECT * FROM user_player ";
            $this->db->query($query);
            $result = $this->db->resultset();
            return $result;
        }

        public function getCoaches(){
            $query = "SELECT * FROM user_coach ";
            $this->db->query($query);
            $result = $this->db->resultset();
            return $result;
        }

        public function getSchoolsData(){
            $query = "SELECT * FROM user_school ";
            $this->db->query($query);
            $result = $this->db->resultset();
            return $result;
        }

        public function countAllUsers(){
            $query = "SELECT COUNT(*) as total FROM users ";
            $this->db->query($query);
            $result = $this->db->single();
            return $result->total;
        }

        public function getPlayerIdByName($name) {
            $query = "SELECT user_id FROM users WHERE firstname = :name";
            $this->db->query($query);
            $this->db->bind(':name', $name);
            $user = $this->db->single();  // Now $user is an stdClass object
        
            // Check if user exists
            if ($user) {
                $user_id = $user->user_id;  // Access the user_id property
            } else {
                return null;  // Or handle the case where the user is not found
            }
        
            $query = "SELECT player_id FROM user_player WHERE user_id = :user_id";
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            $player = $this->db->single();  // Now $player is an stdClass object
        
            // Check if player exists
            if ($player) {
                return $player->player_id;  // Access the player_id property
            } else {
                return null;  // Or handle the case where the player is not found
            }
        }
        
        public function getUserInfo($user_id){
            $query = "SELECT * FROM users WHERE user_id = :user_id";
           
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            return  $this->db->resultset();
        }

        public function getSchoolInfo($school_id){
            $query = "SELECT * FROM user_school WHERE school_id = :school_id";
            
            $this->db->query($query);
            $this->db->bind(':school_id', $school_id);
            return $this->db->resultset();
        }

        public function countPlayers(){
            $query = "SELECT COUNT(*) as total FROM user_player";
            $this->db->query($query);
            $result = $this->db->single();
            return $result->total;
        }
        
        public function countCoaches(){
            $query = "SELECT COUNT(*) as total FROM user_coach";
            $this->db->query($query);
            $result = $this->db->single();
            return $result->total;
        }
        
        public function countSchools(){
            $query = "SELECT COUNT(*) as total FROM user_school";
            $this->db->query($query);
            $result = $this->db->single();
            return $result->total;
        }
        
        public function getPlayersName($school_id) {
            $query = "SELECT user_id, player_id, sport_id FROM user_player WHERE school_id = :school_id";
            $this->db->query($query);
            $this->db->bind(':school_id', $school_id);
            $userPlayers = $this->db->resultset();
        
            $players = [];
        
            foreach ($userPlayers as $row) {
                $userDetails = $this->getUserById($row->user_id); // still using existing function
                if ($userDetails) {
                    // Add player_id and sport_id to the returned user details
                    $userDetails->player_id = $row->player_id;
                    $userDetails->sport_id = $row->sport_id;
                    $players[] = $userDetails;
                }
            }
        
            return $players;
        }
        
        
        public function getUserById($user_id) {
            $query = "SELECT firstname, lname FROM users WHERE user_id = :user_id";
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            return $this->db->single();
        }
        
        
        public function getCoachesName() {
            try {
                $this->db->query("
                    SELECT uc.coach_id, u.firstname, u.lname
                    FROM user_coach uc
                    JOIN users u ON uc.user_id = u.user_id
                ");
                return $this->db->resultset();
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            }
        }

        public function findUserByName($fname, $lname){
            $this->db->query("
                SELECT *
                FROM users
                WHERE firstname = :firstname AND lname = :lname
            ");
            $this->db->bind(':firstname', $fname);
            $this->db->bind(':lname', $lname);
            return $this->db->single(); // 🔥 only return 1 row
        }
        

        public function getPlayerInfo($player_id){
            $this->db->query("
                    SELECT *
                    FROM user_player
                    WHERE player_id = :playerid
                ");
            $this->db->bind(':playerid',$player_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row;
        }

        public function getPlayerZoneId($user_id) {
            $this->db->query("
                SELECT zone 
                FROM user_player
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $user_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row ? $row->zone : null; // ✅ return only the zone value
        }

        public function getPlayerId($user_id){
            $this->db->query("
                SELECT player_id 
                FROM user_player
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $user_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row ? $row->player_id : null;
        }

        public function getCoachId($user_id){
            $this->db->query("
                SELECT coach_id 
                FROM user_coach
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $user_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row ? $row->coach_id : null;
        }
        
        public function getCoachInfo($coach_id){
            $this->db->query("
                    SELECT *
                    FROM user_coach
                    WHERE coach_id = :coach_id
                ");
            $this->db->bind(':coach_id',$coach_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row;
        }

        public function getCoachZoneId($user_id) {
            $this->db->query("
                SELECT zone 
                FROM user_coach
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $user_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row ? $row->zone : null; // ✅ return only the zone value
        }

        public function getSchoolZoneId($user_id) {
            $this->db->query("
                SELECT zone 
                FROM user_school
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $user_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row ? $row->zone : null; // ✅ return only the zone value
        }

        public function getSchoolId($user_id){
            $this->db->query("
                SELECT school_id 
                FROM user_school
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $user_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row ? $row->school_id : null;
        }

        public function getSchoolInfor($school_id){
            $this->db->query("
                    SELECT *
                    FROM user_school
                    WHERE school_id = :school_id
                ");
            $this->db->bind(':school_id',$school_id);
            $row = $this->db->single(); // ✅ get only one row
        
            return $row;
        }

        public function findSchoolByName($name){
            $this->db->query("
                SELECT *
                FROM users
                WHERE firstname = :firstname
            ");
            $this->db->bind(':firstname', $name);
            return $this->db->single(); // 🔥 only return 1 row
        }

        public function getAdminData($user_id){
            $query = "SELECT * FROM admin WHERE admin_id = :user_id";
            
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            return $this->db->resultset();
        }

        public function getAdmin(){
            $query = "SELECT * FROM admin ";
            $this->db->query($query);
            return $this->db->resultset();
        }

        public function inactiveUsers(){
            $query = "SELECT * FROM users WHERE active = '0' ";
            $this->db->query($query);
            return $this->db->resultset();
        }
        
        public function updateActiveStatus($userId, $action)
        {
            $this->db->query("UPDATE users SET active = :active WHERE user_id = :user_id");
            $this->db->bind(':active', $action);
            $this->db->bind(':user_id', $userId);
            return $this->db->execute();
        }


    }
?>
