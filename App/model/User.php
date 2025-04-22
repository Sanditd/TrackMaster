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
                  (firstname, lname, phonenumber, address, email, password, username, photo, age, dob, role, gender, province, district,regDate)
                  VALUES (:firstname, :lastname, :phone, :address, :email, :password, :username, :photo, :age, :dob, :role, :gender, :province, :district, :regDate)";
        
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
                  (firstname, phonenumber, address, email, password, username, photo, role, province, district,regDate,zone)
                  VALUES (:firstname, :phone, :address, :email, :password, :username, :photo,  :role, :province, :district, :regDate, :zone)";
        
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
        $this->db->bind(':zone', $data['zone']);
        $this->db->bind(':role', $data['role']);

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
        $this->db->query("SELECT school_name FROM user_school");
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

        public function createAdmin($data) {
            error_log("Data received in createUser: " . print_r($data, true)); // Debugging
        
            $query = "INSERT INTO admin 
                      (email, password, username)
                      VALUES (:email, :password, :username)";
            
            $this->db->query($query);
            
            // Bind parameters (Updated key names)
        
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':username', $data['username']);

    
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
    }
?>
