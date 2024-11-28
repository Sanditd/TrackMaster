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
        // Hash the password
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
        // Prepare the query to insert the new user
        $this->db->query("INSERT INTO user (userId,userName,role, fName, lName, address, PhoneNumber, email, cPassword) 
                           VALUES (:userId,:username,:role, :fname, :lname, :address, :phone_number, :email, :password)");
    
        // Bind parameters
        $this->db->bind(':userId', $newUserId);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone_number', $data['pnum']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $hashedPassword);
    
        // Execute the query and return the result
        return $this->db->execute(); // Returns true if successful, false otherwise
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
        $this->db->query("SELECT * FROM users WHERE username = :username LIMIT 1");

        // Bind the username parameter
        $this->db->bind(':username', $username);

        // Execute the query and fetch the result
        $result = $this->db->single();

        // Return the result, which is either the user data or false if not found
        return $result ? $result : false;
    }
}
?>
