<?php
require_once __DIR__ . '/../libraries/database.php';
    class sportModel{
        private $db;

        public function __construct() {
            $this->db=new database();
        }

        //check the sport already available in db
        public function findSportByName($sportName){
            $this->db->query('SELECT * FROM sport WHERE sportName = :sportName');

            $this->db->bind(':sportName', $sportName);

            $row=$this->db->single();

            if($this->db->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }


        public function addSport($data) {
            // Generate the new sportId for the sport table
            $newSportId = $this->db->generateSportId();
            
            // Insert into sport table first
            $this->db->query('INSERT INTO sport (sportId, sportName, sportType) VALUES(:sportId, :sportName, :sportType)');
            $this->db->bind(':sportId', $newSportId);
            $this->db->bind(':sportName', $data['sportName']);
            $this->db->bind(':sportType', $data['sportType']);
            
            // Check if the sport insertion was successful
            if ($this->db->execute()) {
                // If sport was successfully added, insert into teamsport
                $this->db->query('INSERT INTO teamsport (sportId, numPlayers, positions, teamFormation, durationMinutes, halfTimeDuration, isOutdoor, equipment, rulesLink, created_at, updated_at) 
                                  VALUES(:sportId, :numPlayers, :positions, :teamFormation, :durationMinutes, :halfTimeDuration, :isOutdoor, :equipment, :rulesLink, :created_at, :updated_at)');
                
                // Bind the parameters for the teamsport table
                $this->db->bind(':sportId', $newSportId);  // Use the generated sportId
                $this->db->bind(':numPlayers', $data['numPlayers']);
                $this->db->bind(':positions', $data['playerPositions']);
                $this->db->bind(':teamFormation', $data['teamFormation']);
                $this->db->bind(':durationMinutes', $data['gameDuration']);
                $this->db->bind(':halfTimeDuration', $data['halftimeDuration']);
                $this->db->bind(':isOutdoor', $data['locationType']);
                $this->db->bind(':equipment', $data['equipment']);
                $this->db->bind(':rulesLink', $data['rulesURL']);
                $this->db->bind(':created_at', date('Y-m-d H:i:s'));
                $this->db->bind(':updated_at', date('Y-m-d H:i:s'));
                
                // Insert into teamsport table and return result
                try {
                    return $this->db->execute();
                } catch (PDOException $e) {
                    error_log("Add Sport Error: " . $e->getMessage());
                    echo "Error: " . $e->getMessage(); // For debugging
                    return false;
                }
            } else {
                // If sport insertion fails, return false
                return false;
            }
        }
        
        public function getSports(){
            $this->db->query('SELECT * FROM sport;');
            $result = $this->db->resultset();
            return $result;
        }
        
        public function addindSportForm($idata) {
            // Generate the new sportId for the sport table
            $newSportId = $this->db->generateSportId();
            
            // Insert into sport table first
            $this->db->query('INSERT INTO sport (sportId, sportName, sportType) VALUES(:sportId, :sportName, :sportType)');
            $this->db->bind(':sportId', $newSportId);
            $this->db->bind(':sportName', $idata['sportName']);
            $this->db->bind(':sportType', 'Individual Sport');
            
            // Check if the sport insertion was successful
            if ($this->db->execute()) {
                // If sport was successfully added, insert into teamsport
                $this->db->query('INSERT INTO indsport (sportId, durationMinutes, isIndoor, equipment, categories, scoringSystem, rulesLink, created_at, updated_at) 
                                  VALUES(:sportId, :durationMinutes, :isIndoor, :equipment, :category, :scoringSystem, :rulesLink, :created_at, :updated_at)');
                
                // Bind the parameters for the teamsport table
                $this->db->bind(':sportId', $newSportId);
                $this->db->bind(':durationMinutes', $idata['gameDuration']);
                $this->db->bind(':isIndoor', $idata['locationType']);
                $this->db->bind(':equipment', $idata['equipment']);
                $this->db->bind(':category', $idata['category']);
                $this->db->bind(':scoringSystem', $idata['scoring']);
                $this->db->bind(':rulesLink', $idata['rulesURL']);
                $this->db->bind(':created_at', date('Y-m-d H:i:s'));
                $this->db->bind(':updated_at', date('Y-m-d H:i:s'));
                
                // Insert into teamsport table and return result
                try {
                    return $this->db->execute();
                } catch (PDOException $e) {
                    error_log("Add Sport Error: " . $e->getMessage());
                    echo "Error: " . $e->getMessage(); // For debugging
                    return false;
                }
            } else {
                // If sport insertion fails, return false
                return false;
            }
        }

        //get sport by id
        public function getSportById($sportId) {
            $this->db->query("SELECT * FROM sport WHERE sportId = :sportId");
            $this->db->bind(':sportId', $sportId);
            return $this->db->singleArray(); // Fetch single record
        }
    
        //get team sport details
        public function getTeamSportDetails($sportId) {
            $this->db->query("SELECT * FROM teamsport WHERE sportId = :sportId");
            $this->db->bind(':sportId', $sportId);
            return $this->db->singleArray();
        }
    
        //get ind sport details
        public function getIndSportDetails($sportId) {
            $this->db->query("SELECT * FROM indsport WHERE sportId = :sportId");
            $this->db->bind(':sportId', $sportId);
            return $this->db->singleArray();
        }

    }
?>