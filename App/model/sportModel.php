<?php
require_once __DIR__ . '/../libraries/database.php';
    class sportModel{
        private $db;

        public function __construct() {
            $this->db=new database();
        }

        //check the sport already available in db
        public function findSportByName($sportName){
            $this->db->query('SELECT * FROM sport WHERE sport_name = :sportName');
            $this->db->bind(':sportName', $sportName);

            $row=$this->db->single();

            if($this->db->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }

        public function addSport($data){
            $this->db->query('INSERT INTO ');
        }
    }
?>