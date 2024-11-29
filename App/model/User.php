<?php
require_once __DIR__ . '/../libraries/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    
    
    public function createUser($data) {
        $query = "INSERT INTO users 
                  (firstname, lname, phonenumber, address, email, password, username, photo, age, dob, role, gender)
                  VALUES (:firstname, :lname, :phonenumber, :address, :email, :password, :username, :photo, :age, :dob, 'coach', :gender)";
        $this->db->query($query);
        
        // Bind parameters
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':phonenumber', $data['phonenumber']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':photo', $data['photo'], PDO::PARAM_LOB);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':gender', $data['gender']);
        
        return $this->db->execute();
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
    public function insertPlayer($userId, $sportId, $schoolId, $zone, $bio, $parentName) {
        $query = "INSERT INTO user_player (user_id, sport_id, school_id, zone, bio, parent_name)
                  VALUES (:user_id, :sport_id, :school_id, :zone, :bio, :parent_name)";
        
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':sport_id', $sportId);
        $this->db->bind(':school_id', $schoolId);
        $this->db->bind(':zone', $zone);
        $this->db->bind(':bio', $bio);
        $this->db->bind(':parent_name', $parentName);

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

    // Get sport_id by sport name



    }
?>
