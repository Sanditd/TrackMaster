<?php
require_once __DIR__ . '/../libraries/Database.php';
    class sportModel{
        private $db;

        public function __construct() {
            $this->db=new database();
        }

        //check the sport already available in db
        public function findSportByName($sportName){
            $this->db->query('SELECT * FROM sports WHERE sportName = :sportName');

            $this->db->bind(':sportName', $sportName);

            $row=$this->db->single();

            if($this->db->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }


        public function addTeamSport($data) {
            try {
                // Check if the sport already exists
                $this->db->query('SELECT sport_id FROM sports WHERE sport_name = :sport_name');
                $this->db->bind(':sport_name', $data['sportName']);
                $existingSport = $this->db->single();
        
                if ($existingSport) {
                    return ['success' => false, 'error' => "Sport already exists in the database."];
                }
        
                // Insert into sports table
                $this->db->query('INSERT INTO sports (sport_name, sport_type, scoring_method, num_of_players, positions) 
                                  VALUES (:sport_name, :sport_type, :scoring_method, :num_of_players, :positions)');
                
                $this->db->bind(':sport_name', $data['sportName']);
                $this->db->bind(':sport_type', $data['sportType']);
                $this->db->bind(':scoring_method', $data['scoring_method']);
                $this->db->bind(':num_of_players', $data['numOfPlayers']);
                $this->db->bind(':positions', json_encode($data['positions']));
        
                if (!$this->db->execute()) {
                    return ['success' => false, 'error' => "Failed to insert into sports table."];
                }
        
                // Retrieve the last inserted sport ID
                $sport_id = $this->db->lastInsertId();
        
                if (!$sport_id) {
                    return ['success' => false, 'error' => "Could not retrieve last inserted sport ID."];
                }
        
                error_log("New Sport ID: " . $sport_id);
        
                // Insert game types
                $gameTypeResult = $this->addGameType($sport_id, $data);
                if ($gameTypeResult !== true) {
                    return ['success' => false, 'error' => "Failed to insert game types: " . $gameTypeResult];
                }
        
                // Insert game rules
                $gameRulesResult = $this->addGameRules($sport_id, $data);
                if ($gameRulesResult !== true) {
                    return ['success' => false, 'error' => "Failed to insert game rules: " . $gameRulesResult];
                }
        
                return ['success' => true];
            } catch (PDOException $e) {
                error_log("SQL Error in addTeamSport: " . $e->getMessage());
                return ['success' => false, 'error' => $e->getMessage()];
            } catch (Exception $e) {
                error_log("General Error in addTeamSport: " . $e->getMessage());
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
        
        
        
        

        
        public function addGameType($sport_id, $data) {
            try {
                if (!isset($data['Gtypes']) || !is_array($data['Gtypes'])) {
                    throw new Exception("Gtypes array is missing or invalid.");
                }
        
                foreach ($data['Gtypes'] as $index => $game_type) {
                    if (!isset($data['durationType'][$index]) || !isset($data['duration'][$index])) {
                        throw new Exception("DurationType or Duration is missing for index: $index.");
                    }
        
                    error_log("Inserting Game Type: " . $game_type . " for sport_id: " . $sport_id);
        
                    $this->db->query('INSERT INTO game_types (sport_id, game_format, duration_type, duration_value) 
                                      VALUES (:sport_id, :game_format, :duration_type, :duration_value)');
        
                    $this->db->bind(':sport_id', $sport_id);
                    $this->db->bind(':game_format', $game_type);
                    $this->db->bind(':duration_type', $data['durationType'][$index]);
                    $this->db->bind(':duration_value', $data['duration'][$index]);
        
                    if (!$this->db->execute()) {
                        throw new Exception("Failed to insert game type: $game_type for sport_id: $sport_id.");
                    }
                }
                return true;
            } catch (PDOException $e) {
                error_log("SQL Error in addGameType: " . $e->getMessage());
                return "SQL Error: " . $e->getMessage();
            } catch (Exception $e) {
                error_log("General Error in addGameType: " . $e->getMessage());
                return "Error: " . $e->getMessage();
            }
        }
        
        
        
        public function addGameRules($sport_id, $data) {
            try {
                if (!isset($data['rules']) || !is_array($data['rules'])) {
                    throw new Exception("Rules array is missing or invalid.");
                }
        
                foreach ($data['rules'] as $index => $rule) {
                    error_log("Inserting Rule: " . $rule . " for sport_id: " . $sport_id);
        
                    $this->db->query('INSERT INTO rules (sport_id, rule) VALUES (:sport_id, :rule)');
                    $this->db->bind(':sport_id', $sport_id);
                    $this->db->bind(':rule', $rule);
        
                    if (!$this->db->execute()) {
                        throw new Exception("Failed to insert rule: $rule for sport_id: $sport_id.");
                    }
                }
                return true;
            } catch (PDOException $e) {
                error_log("SQL Error in addGameRules: " . $e->getMessage());
                return false;
            } catch (Exception $e) {
                error_log("General Error in addGameRules: " . $e->getMessage());
                return false;
            }
        }
        
        
        
    
        public function getLastSportId() {
            try {
                return $this->db->lastInsertId(); // Use PDO's built-in method
            } catch (PDOException $e) {
                error_log("SQL Error in getLastSportId: " . $e->getMessage());
                return null;
            }
        }
        
        
        
        
        public function getSports(){
            $this->db->query('SELECT * FROM sports');
            $result = $this->db->resultset();
            return $result;
        }
        
        public function addindSportForm($idata) {
            // Generate the new sportId for the sport table
            $newSportId = $this->db->generateSportId();
            
            // Insert into sport table first
            $this->db->query('INSERT INTO sports (sportId, sportName, sportType) VALUES(:sportId, :sportName, :sportType)');
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
            $this->db->query("SELECT * FROM sports WHERE sportId = :sportId");
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

        public function updateIndField($sportId, $fieldName, $fieldValue){
            $allowedFields = ['sportType', 'durationMinutes', 'isIndoor', 'created_at', 'updated_at', 'equipment', 'categories', 'scoringSystem', 'rulesLink'];
            if (in_array($fieldName, $allowedFields)) {
                $this->db->query("UPDATE indsport SET fieldName = :fieldValue WHERE sportId= :sportId");
                $this->db->bind(':fieldValue', $fieldValue);
                $this->db->bind(':sportId', $sportId);
                return true;
            }
            return false;
        }

        public function indsportEdit($data) {
        
            
            // Prepare the query
            $this->db->query("UPDATE indsport SET 
                    durationMinutes = :duration,
                    isIndoor = :isIndoor,
                    equipment = :equipment,
                    categories = :categories,
                    scoringSystem = :scoringSystem,
                    rulesLink = :rulesLink,
                    updated_at = :updated_at
                WHERE 
                    sportId = :sport_id");
            
            // Bind the data to the query parameters
            $this->db->bind(':duration', $data['duration']);
            $this->db->bind(':isIndoor', $data['isIndoor']);
            $this->db->bind(':equipment', $data['equipment']);
            $this->db->bind(':categories', $data['categoriesJson']);
            $this->db->bind(':scoringSystem', $data['scoringSystem']);
            $this->db->bind(':rulesLink', $data['rulesLink']);
            $this->db->bind(':sport_id', $data['sportId']);
            $this->db->bind(':updated_at', date('Y-m-d H:i:s'));
            
            // Execute the query
            return $this->db->execute();
        }

        public function teamsportEdit($data) {
        
            
            // Prepare the query
            $this->db->query("UPDATE teamsport SET 
                    numPlayers = :numPlayers,
                    positions = :positions,
                    teamFormation = :teamFormation,
                    durationMinutes = :durationMinutes,
                    halfTimeDuration = :halfTimeDuration,
                    isOutdoor = :isOutdoor,
                    equipment = :equipment,
                    rulesLink = :rulesLink,
                    updated_at = :updated_at
                WHERE 
                    sportId = :sport_id");
            
            // Bind the data to the query parameters
            $this->db->bind(':numPlayers', $data['numPlayers']);
            $this->db->bind(':positions', $data['positionsJson']);
            $this->db->bind(':teamFormation', $data['teamFormation']);
            $this->db->bind(':durationMinutes', $data['durationMinutes']);
            $this->db->bind(':halfTimeDuration', $data['halfTimeDuration']);
            $this->db->bind(':isOutdoor', $data['isOutdoor']);
            $this->db->bind(':equipment', $data['equipment']);
            $this->db->bind(':rulesLink', $data['rulesLink']);
            $this->db->bind(':sport_id', $data['sportId']);
            $this->db->bind(':updated_at', date('Y-m-d H:i:s'));
            
            // Execute the query
            return $this->db->execute();
        }

        public function deleteSportById($sportId) {

            $this->db->query("DELETE FROM sport WHERE sportId = :sportId");
            $this->db->bind(':sportId', $sportId);
            $this->db->execute();
        }



    }
        
?>