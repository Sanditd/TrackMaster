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
                $this->db->query('INSERT INTO sports (sport_name, sport_type, scoring_method, num_of_players, positions,types) 
                                  VALUES (:sport_name, :sport_type, :scoring_method, :num_of_players, :positions, :types)');
                
                $this->db->bind(':sport_name', $data['sportName']);
                $this->db->bind(':sport_type', $data['sportType']);
                $this->db->bind(':scoring_method', $data['scoring_method']);
                $this->db->bind(':num_of_players', $data['numOfPlayers']);
                $this->db->bind(':positions', json_encode($data['positions']));
                $this->db->bind(':types', json_encode($data['types']));
        
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


        //add class to the individual sport
        public function addClassType($sport_id, $data) {
            try {
                if (!isset($data['weightClass']) || !is_array($data['weightClass'])) {
                    throw new Exception("weightClass array is missing or invalid.");
                }
        
                foreach ($data['weightClass'] as $index => $game_type) {
                    if (!isset($data['minWeight'][$index]) || !isset($data['maxWeight'][$index])) {
                        throw new Exception("minWeight or maxWeight is missing for index: $index.");
                    }
        
                    error_log("Inserting classes: " . $game_type . " for sport_id: " . $sport_id);
        
                    $this->db->query('INSERT INTO game_types (sport_id, game_format, max, min) 
                                      VALUES (:sport_id, :game_format, :max, :min)');
        
                    $this->db->bind(':sport_id', $sport_id);
                    $this->db->bind(':game_format', $game_type);
                    $this->db->bind(':max', $data['maxWeight'][$index]);
                    $this->db->bind(':min', $data['minWeight'][$index]);
        
                    if (!$this->db->execute()) {
                        throw new Exception("Failed to insert class: $game_type for sport_id: $sport_id.");
                    }
                }
                return true;
            } catch (PDOException $e) {
                error_log("SQL Error in addClassType: " . $e->getMessage());
                return "SQL Error: " . $e->getMessage();
            } catch (Exception $e) {
                error_log("General Error in addCLassType: " . $e->getMessage());
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
        
        
        public function addIndSport($data) {
            try {
                // Check if the sport already exists
                $this->db->query('SELECT sport_id FROM sports WHERE sport_name = :sport_name');
                $this->db->bind(':sport_name', $data['sportName']);
                $existingSport = $this->db->single();
        
                if ($existingSport) {
                    return ['success' => false, 'error' => "Sport already exists in the database."];
                }
        
                // Insert into sports table
                $this->db->query('INSERT INTO sports (sport_name, sport_type, scoring_method, base) 
                                  VALUES (:sport_name, :sport_type, :scoring_method, :base)');
                
                $this->db->bind(':sport_name', $data['sportName']);
                $this->db->bind(':sport_type', $data['sportType']);
                $this->db->bind(':base', $data['base']);
                $this->db->bind(':scoring_method', $data['scoring_method']);
                $this->db->bind(':base', $data['base']);
        
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
                $classTypeResult = $this->addClassType($sport_id, $data);
                if ($classTypeResult !== true) {
                    return ['success' => false, 'error' => "Failed to insert game types: " . $classTypeResult];
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

        //get sport by id
        public function getSportById($sportId) {
            $this->db->query("SELECT * FROM sports WHERE sport_id = :sportId");
            $this->db->bind(':sportId', $sportId);

            return $this->db->singleArray(); // Fetch single record
        }
    
        //get team sport details
        public function getTeamSportDetails($sportId) {
            try {
                $result = [];
        
                // 1. Fetch sport details
                $this->db->query("SELECT * FROM sports WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                $sports = $this->db->resultset();
                if (empty($sports)) {
                    throw new Exception("No sport found with ID: $sportId");
                }
                $result['sport'] = $sports[0]; // ✅ return single object, not array
        
                // 2. Fetch game types
                $this->db->query("SELECT * FROM game_types WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                $gameTypes = $this->db->resultset();
                if (empty($gameTypes)) {
                    throw new Exception("No game types found for sport ID: $sportId");
                }
                $result['game_types'] = $gameTypes;
        
                // 3. Fetch rules
                $this->db->query("SELECT * FROM rules WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                $rules = $this->db->resultset();
                if (empty($rules)) {
                    throw new Exception("No rules found for sport ID: $sportId");
                }
                $result['rules'] = $rules;
        
                return $result;
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            } catch (Exception $e) {
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }
        
        
        
    
        //get ind sport details
        public function getIndSportDetails($sportId) {
            try {
                $result = [];
        
                // 1. Fetch sport details
                $this->db->query("SELECT * FROM sports WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                $sports = $this->db->resultset();
                if (empty($sports)) {
                    throw new Exception("No sport found with ID: $sportId");
                }
                $result['sport'] = $sports[0]; // ✅ return single object, not array
        
                // 2. Fetch game types
                $this->db->query("SELECT * FROM game_types WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                $gameTypes = $this->db->resultset();
                if (empty($gameTypes)) {
                    throw new Exception("No game types found for sport ID: $sportId");
                }
                $result['game_types'] = $gameTypes;
        
                // 3. Fetch rules
                $this->db->query("SELECT * FROM rules WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                $rules = $this->db->resultset();
                if (empty($rules)) {
                    throw new Exception("No rules found for sport ID: $sportId");
                }
                $result['rules'] = $rules;
        
                return $result;
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            } catch (Exception $e) {
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }

       

        public function updateTeamSport($data) {
            try {
                // Ensure sport_id is provided in the data array
                if (!isset($data['sport_id'])) {
                    return ['success' => false, 'error' => "Sport ID is required."];
                }
                
                $sport_id = $data['sport_id']; // Extract sport_id from the data array
        
                // First, check if the sport exists
                $this->db->query('SELECT sport_id FROM sports WHERE sport_id = :sport_id');
                $this->db->bind(':sport_id', $sport_id);
                $existingSport = $this->db->single();
        
                if (!$existingSport) {
                    return ['success' => false, 'error' => "Sport not found in the database."];
                }
        
                // Update sport details
                $this->db->query('UPDATE sports 
                                  SET sport_name = :sport_name, sport_type = :sport_type, scoring_method = :scoring_method, 
                                      num_of_players = :num_of_players, positions = :positions, types = :types 
                                  WHERE sport_id = :sport_id');
                
                $this->db->bind(':sport_name', $data['sportName']);
                $this->db->bind(':sport_type', $data['sportType']);
                $this->db->bind(':scoring_method', $data['scoring_method']);
                $this->db->bind(':num_of_players', $data['numOfPlayers']);
                $this->db->bind(':positions', json_encode($data['positions']));
                $this->db->bind(':types', json_encode($data['types']));
                $this->db->bind(':sport_id', $sport_id);
        
                if (!$this->db->execute()) {
                    return ['success' => false, 'error' => "Failed to update sport details."];
                }
        
                // Update game types
                $gameTypeResult = $this->updateGameType($sport_id, $data);
                if ($gameTypeResult !== true) {
                    return ['success' => false, 'error' => "Failed to update game types: " . $gameTypeResult];
                }
        
                // Update game rules
                $gameRulesResult = $this->updateGameRules($sport_id, $data);
                if ($gameRulesResult !== true) {
                    return ['success' => false, 'error' => "Failed to update game rules: " . $gameRulesResult];
                }
        
                return ['success' => true];
            } catch (PDOException $e) {
                error_log("SQL Error in updateTeamSport: " . $e->getMessage());
                return ['success' => false, 'error' => $e->getMessage()];
            } catch (Exception $e) {
                error_log("General Error in updateTeamSport: " . $e->getMessage());
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }

        public function updateIndSport($data) {
            try {
                if (!isset($data['sport_id'])) {
                    return ['success' => false, 'error' => "Sport ID is required."];
                }
        
                $sport_id = $data['sport_id'];
        
                // Check if sport exists
                $this->db->query('SELECT sport_id FROM sports WHERE sport_id = :sport_id');
                $this->db->bind(':sport_id', $sport_id);
                $existingSport = $this->db->single();
        
                if (!$existingSport) {
                    return ['success' => false, 'error' => "Sport not found in the database."];
                }
        
                // Update sport table
                $this->db->query('UPDATE sports 
                                  SET sport_name = :sport_name, sport_type = :sport_type, scoring_method = :scoring_method, 
                                      base = :base
                                  WHERE sport_id = :sport_id');
                
                $this->db->bind(':sport_name', $data['sportName']);
                $this->db->bind(':sport_type', $data['sportType']); // should be "IndSport"
                $this->db->bind(':scoring_method', $data['scoring_method']);
                $this->db->bind(':base', $data['base']);
                $this->db->bind(':sport_id', $sport_id);
        
                if (!$this->db->execute()) {
                    return ['success' => false, 'error' => "Failed to update sport details."];
                }
        
                // Validate game type input before proceeding
                if (!isset($data['weightClass'], $data['min'], $data['max']) ||
                    !is_array($data['weightClass']) || !is_array($data['min']) || !is_array($data['max'])) {
                    return ['success' => false, 'error' => "Invalid weight class data format."];
                }
        
                // Update weight classes
                $gameTypeResult = $this->updateIndGameType($sport_id, $data);
                if ($gameTypeResult !== true) {
                    return ['success' => false, 'error' => "Failed to update weight classes: " . $gameTypeResult];
                }
        
                // Update rules
                $gameRulesResult = $this->updateGameRules($sport_id, $data);
                if ($gameRulesResult !== true) {
                    return ['success' => false, 'error' => "Failed to update rules: " . $gameRulesResult];
                }
        
                return ['success' => true];
            } catch (PDOException $e) {
                error_log("SQL Error in updateIndSport: " . $e->getMessage());
                return ['success' => false, 'error' => $e->getMessage()];
            } catch (Exception $e) {
                error_log("General Error in updateIndSport: " . $e->getMessage());
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
        
        
        public function updateIndGameType($sport_id, $data) {
            try {
                // Check required keys exist and are arrays
                if (!isset($data['weightClass'], $data['min'], $data['max']) ||
                    !is_array($data['weightClass']) || !is_array($data['min']) || !is_array($data['max'])) {
                    return "Missing or invalid input arrays.";
                }
        
                $classes = $data['weightClass'];
                $mins = $data['min'];
                $maxes = $data['max'];
        
                if (count($classes) !== count($mins) || count($classes) !== count($maxes)) {
                    return "Mismatch in weightClass, min, and max count.";
                }
        
                // First, delete old entries
                $this->db->query('DELETE FROM game_types WHERE sport_id = :sport_id');
                $this->db->bind(':sport_id', $sport_id);
                $this->db->execute();
        
                // Now insert the new ones
                for ($i = 0; $i < count($classes); $i++) {
                    $class = trim($classes[$i]);
                    $min = $mins[$i];
                    $max = $maxes[$i];
        
                    // Optional: Skip empty or invalid rows
                    if ($class === '' || !is_numeric($min) || !is_numeric($max)) {
                        continue;
                    }
        
                    $this->db->query('INSERT INTO game_types (sport_id, game_format, min, max) 
                                      VALUES (:sport_id, :game_format, :min, :max)');
                    $this->db->bind(':sport_id', $sport_id);
                    $this->db->bind(':game_format', $class);
                    $this->db->bind(':min', $min);
                    $this->db->bind(':max', $max);
        
                    if (!$this->db->execute()) {
                        error_log("Failed inserting row $i for sport_id $sport_id");
                        return "Failed at row $i";
                    }
                }
        
                return true;
            } catch (Exception $e) {
                error_log("Error in updateIndGameType: " . $e->getMessage());
                return $e->getMessage();
            }
        }
        
        

        public function deleteSportById($sportId) {
            try {
                // Delete from rules table
                $this->db->query("DELETE FROM rules WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                if (!$this->db->execute()) {
                    return ['success' => false, 'error' => "Failed to delete from rules table."];
                }
        
                // Delete from game_types table
                $this->db->query("DELETE FROM game_types WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                if (!$this->db->execute()) {
                    return ['success' => false, 'error' => "Failed to delete from game_types table."];
                }
        
                // Delete from sports table
                $this->db->query("DELETE FROM sports WHERE sport_id = :sportId");
                $this->db->bind(':sportId', $sportId);
                if (!$this->db->execute()) {
                    return ['success' => false, 'error' => "Failed to delete from sports table."];
                }
        
                return ['success' => true];
            } catch (PDOException $e) {
                error_log("Error in deleteSportById: " . $e->getMessage());
                return ['success' => false, 'error' => $e->getMessage()];
            }
        }
        


        public function updateGameType($sport_id, $data) {
            try {
                // Check if the Gtypes array exists and is valid
                if (!isset($data['Gtypes']) || !is_array($data['Gtypes'])) {
                    throw new Exception("Gtypes array is missing or invalid.");
                }
        
                // Delete existing game types for the sport
                $this->db->query('DELETE FROM game_types WHERE sport_id = :sport_id');
                $this->db->bind(':sport_id', $sport_id);
                if (!$this->db->execute()) {
                    throw new Exception("Failed to delete existing game types for sport_id: $sport_id.");
                }
        
                // Insert new game types
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
                error_log("SQL Error in updateGameType: " . $e->getMessage());
                return "SQL Error: " . $e->getMessage();
            } catch (Exception $e) {
                error_log("General Error in updateGameType: " . $e->getMessage());
                return "Error: " . $e->getMessage();
            }
        }
        
        public function updateGameRules($sport_id, $data) {
            try {
                // Check if the rules array exists and is valid
                if (!isset($data['rules']) || !is_array($data['rules'])) {
                    throw new Exception("Rules array is missing or invalid.");
                }
        
                // Delete existing game rules for the sport
                $this->db->query('DELETE FROM rules WHERE sport_id = :sport_id');
                $this->db->bind(':sport_id', $sport_id);
                if (!$this->db->execute()) {
                    throw new Exception("Failed to delete existing game rules for sport_id: $sport_id.");
                }
        
                // Insert new rules
                foreach ($data['rules'] as $rule) {
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
                error_log("SQL Error in updateGameRules: " . $e->getMessage());
                return false;
            } catch (Exception $e) {
                error_log("General Error in updateGameRules: " . $e->getMessage());
                return false;
            }
        }
        
        public function getZones() {
            try {
                $this->db->query("SELECT zoneId,zoneName,provinceName,DisName FROM zone");
                $zones = $this->db->resultset();
        
                if (empty($zones)) {
                    throw new Exception("No zone found in the database.");
                }
        
                return $zones;
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            } catch (Exception $e) {
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }
        
        public function getSports() {
            try {
                $this->db->query("SELECT sport_id,sport_name,sport_type FROM sports");
                $sports = $this->db->resultset();
        
                if (empty($sports)) {
                    throw new Exception("No sports found in the database.");
                }
        
                return $sports;
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            } catch (Exception $e) {
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }
        
        public function getZonalSports(){
            try {
                $this->db->query("SELECT * FROM zonal_sports");
                $zonalSports = $this->db->resultset();
        
                if (empty($zonalSports)) {
                    throw new Exception("No sports assign to this school.");
                }
        
                return $zonalSports;
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            } catch (Exception $e) {
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }

        public function getCoaches(){
            try {
                $this->db->query("SELECT user_id,firstname,lname FROM users WHERE role = 'coach'");
                $coaches = $this->db->resultset();
        
                if (empty($coaches)) {
                    throw new Exception("No sports assign to this school.");
                }
        
                return $coaches;
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            } catch (Exception $e) {
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }

        public function getCoachName($coach_id) {
            $user = $this->getCoachUserId($coach_id);
        
            if (!$user || !isset($user['user_id'])) {
                return false; // or return []; or handle as needed
            }
        
            $this->db->query("SELECT firstname, lname FROM users WHERE user_id = :user_id");
            $this->db->bind(':user_id', $user['user_id']);
            return $this->db->resultSet(); // note: "resultSet" not "resultset"
        }
        

        public function getCoachUserId($coach_id){
            $this->db->query("SELECT user_id FROM user_coach WHERE coach_id = :coach_id");
            $this->db->bind(':coach_id', $coach_id);
            return $this->db->singleArray();
        }

        public function getFromCoaches(){
            try {
                $this->db->query("SELECT coach_id,user_id,zone FROM user_coach");
                $fromCoaches = $this->db->resultset();
        
                if (empty($fromCoaches)) {
                    throw new Exception("Some Thing is wrong on coach table.");
                }
        
                return $fromCoaches;
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            } catch (Exception $e) {
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }

        public function assignCoachToSport($zoneId, $sportId, $coachId) {
            try {
                // First check if a record already exists for this zone & sport
                $this->db->query("SELECT zs_id FROM zonal_sports WHERE zone_id = :zoneId AND sport_id = :sportId");
                $this->db->bind(':zoneId', $zoneId);
                $this->db->bind(':sportId', $sportId);
                $existing = $this->db->single();
        
                if ($existing) {
                    // Update the existing record
                    $this->db->query("UPDATE zonal_sports SET coach_id = :coachId WHERE zs_id = :zs_id");
                    $this->db->bind(':coachId', $coachId);
                    $this->db->bind(':zs_id', $existing->zs_id);
                    $this->db->execute();
                } else {
                    // Insert a new record
                    $this->db->query("INSERT INTO zonal_sports (zone_id, sport_id, coach_id) VALUES (:zoneId, :sportId, :coachId)");
                    $this->db->bind(':zoneId', $zoneId);
                    $this->db->bind(':sportId', $sportId);
                    $this->db->bind(':coachId', $coachId);
                    $this->db->execute();
                }
        
                return [
                    'error' => false,
                    'message' => 'Coach assigned successfully.'
                ];
        
            } catch (PDOException $e) {
                return [
                    'error' => true,
                    'message' => 'Database error: ' . $e->getMessage()
                ];
            } catch (Exception $e) {
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }

        public function getCoachId($userId)
{
    try {
        $this->db->query("SELECT coach_id FROM user_coach WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        $row = $this->db->single();

        if ($row && isset($row->coach_id)) {
            return $row->coach_id;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Optional: Log error or return debug info
        return false;
    }
}

        

    }
        
?>