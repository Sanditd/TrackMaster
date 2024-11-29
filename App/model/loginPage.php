<?php
require_once __DIR__ . '/../libraries/database.php';
    class loginPage{
        private $db;

        public function __construct() {
            $this->db=new database();
        }

         // Check if the username and password exist in the database
         public function checkLoginCredentials($username, $password) {
            // Prepare the query to fetch user details by username
            $this->db->query("SELECT * FROM users WHERE username = :username");
            $this->db->bind(':username', $username);
    
            // Execute the query
            $user = $this->db->single();
    
            // If user exists, verify password
            if ($user && password_verify($password, $user->password)) {
                return $user; // Return user data if login is successful
            } else {
                return false; // Return false if credentials are incorrect
            }
        }

    // Insert new user into the database for signup
    public function signUpUser($data) {

        $newUserId = $this->db->generateUserId();
        $newCoachId = $this->db->generateCoachId();
        $newPlayerId = $this->db->generatePlayerId();
        $newSchoolId = $this->db->generateSchoolId();
        $newParentId = $this->db->generateParentId();
        $newAdminId = $this->db->generateAdminId();
    
        // Hash the password
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
        try {
    
            // Insert new user into the user table
            $this->db->query("INSERT INTO user (userId, userName, role, fName, lName, address, PhoneNumber, email, cPassword) 
                               VALUES (:userId, :username, :role, :fname, :lname, :address, :phone_number, :email, :password)");
    
            $this->db->bind(':userId', $newUserId);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':phone_number', $data['pnum']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $hashedPassword);
    
            $this->db->execute();
    
            // Handle role-specific table inserts
            if ($data['role'] === 'Coach') {
                $this->db->query("INSERT INTO coach (userId, coachId, coach_type, description, proPhoto, sportId) 
                                   VALUES (:userId, :coachId, :coach_type, :description, :proPhoto, :sportId)");
                $this->db->bind(':userId', $newUserId);
                $this->db->bind(':coachId', $newCoachId);
                $this->db->bind(':coach_type', $data['coach_type']);
                $this->db->bind(':description', $data['description']);
                $this->db->bind(':proPhoto', $data['proPhoto']);
                $this->db->bind(':sportId', $data['sportId']);
                $this->db->execute();
            } elseif ($data['role'] === 'Player') {
                $this->db->query("INSERT INTO player (userId, playerId, sportId, schoolId, age, proPhoto, DOB, level) 
                                   VALUES (:userId, :playerId, :sportId, :schoolId, :age, :proPhoto, :DOB, :level)");
                $this->db->bind(':userId', $newUserId);
                $this->db->bind(':playerId', $newPlayerId);
                $this->db->bind(':sportId', $data['sportId']);
                $this->db->bind(':schoolId', $data['schoolId']);
                $this->db->bind(':age', $data['age']);
                $this->db->bind(':proPhoto', $data['proPhoto']);
                $this->db->bind(':DOB', $data['dob']);
                $this->db->bind(':level', $data['level']);
                $this->db->execute();
            } elseif ($data['role'] === 'School') {
                $this->db->query("INSERT INTO school (userId, schoolId, proPhoto) 
                                   VALUES (:userId, :schoolId, :proPhoto)");
                $this->db->bind(':userId', $newUserId);
                $this->db->bind(':schoolId', $newSchoolId);
                $this->db->bind(':proPhoto', $data['proPhoto']);
                $this->db->execute();
            } elseif ($data['role'] === 'Parent') {
                $this->db->query("INSERT INTO parent (userId, parentId, playerId) 
                                   VALUES (:userId, :parentId, :playerId)");
                $this->db->bind(':userId', $newUserId);
                $this->db->bind(':parentId', $newParentId);
                $this->db->bind(':playerId', $data['playerId']);
                $this->db->execute();
            } elseif ($data['role'] === 'Admin') {
                $this->db->query("INSERT INTO admin (userId, adminId, proPhoto) 
                                   VALUES (:userId, :adminId, :proPhoto)");
                $this->db->bind(':userId', $newUserId);
                $this->db->bind(':adminId', $newAdminId);
                $this->db->bind(':proPhoto', $data['proPhoto']);
                $this->db->execute();
            }
    
            // Redirect to login page
            header("Location: /login");
            exit;
    
        } catch (Exception $e) {
            // Handle the error (e.g., log it and show a friendly message)
            error_log($e->getMessage());
            echo "An error occurred during signup. Please try again.";
        }
    }
    

    
    // Method to check if the username already exists
    public function checkUsernameExists($username) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        $result = $this->db->single();
        return ($result) ? true : false;
    }

    // Method to check if the email already exists
    public function checkEmailExists($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $result = $this->db->single();
        return ($result) ? true : false;
    }


public function getUserByUsername($username) {
    // Prepare the SQL query to get user details by username
    $this->db->query("SELECT * FROM user WHERE userName = :username LIMIT 1");
    
    // Bind the username parameter
    $this->db->bind(':username', $username);
    
    // Execute the query and fetch the result
    $result = $this->db->singleArray();
    
    // Return the result, which is either the user data or false if not found
    return $result ? $result : false;
}

public function getDiv(){
    $this->db->query("SELECT * FROM divisions");
    $result = $this->db->resultSet();
    return $result;
}

public function getProv(){
    $this->db->query("SELECT * FROM provinces");
    $result = $this->db->resultSet();
    return $result;
}

public function getSports(){
    $this->db->query("SELECT * FROM sport");
    $result = $this->db->resultSet();
    return $result;
}

public function getSchools(){
    $this->db->query("SELECT * FROM school");
    $result = $this->db->resultSet();
    return $result;
}


    }

?>
