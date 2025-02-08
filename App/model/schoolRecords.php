<?php
require_once __DIR__ . '/../libraries/database.php';
    class schoolRecords {
        private $db;

        public function __construct() {
            $this->db=new database();
        }


        public function findSchoolId($schoolName) {
            $query = "SELECT school_id FROM user_school WHERE school_name = :schoolName";
            $this->db->query($query);
            $this->db->bind(':schoolName', $schoolName);
            return $this->db->single();
        }
    }