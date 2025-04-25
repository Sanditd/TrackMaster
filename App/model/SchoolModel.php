
<?php
require_once __DIR__ . '/../libraries/database.php';

class SchoolModel {
    private $db;

    public function __construct() {
        $this->db = new database();
    }

    // Retrieve school_id for the logged-in user
    public function getSchoolId($user_id) {
        $this->db->query("SELECT school_id FROM user_school WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);

        // Execute the query and return the result
        return $this->db->single();
    }

    // Retrieve players for a given school_id
    public function getPlayersForSchool($school_id) {
        $this->db->query("
            SELECT u.user_id, u.firstname
            FROM users u
            JOIN user_player up ON u.user_id = up.user_id
            WHERE up.school_id = :school_id
        ");
        $this->db->bind(':school_id', $school_id);

        // Execute the query and return the results
        return $this->db->resultSet();
    }

    public function getPlayerId($user_id) {
        $this->db->query("SELECT player_id FROM user_player WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
    public function getUserIdByFirstname($firstname) {
        $this->db->query("SELECT user_id FROM users WHERE firstname = :firstname");
        $this->db->bind(':firstname', $firstname);
        return $this->db->single();  // Returns the user record
    }
    


    public function insertRecord($data) {
        $this->db->query("INSERT INTO academic_records (player_id, grade, term, average, rank, notes)
        VALUES (:player_id, :grade, :term, :average, :rank, :notes)");
        $this->db->bind(':player_id', $data['player_id']);
        $this->db->bind(':grade', $data['grade']);
        $this->db->bind(':term', $data['term']);
        $this->db->bind(':average', $data['average']);
        $this->db->bind(':rank', $data['rank']);
        $this->db->bind(':notes', $data['notes']);

        return $this->db->execute();
    }

    public function getAcademicRecordsByPlayerId($school_id) {
        $this->db->query(" SELECT * from academic_records WHERE school_id = :school_id ");
        $this->db->bind(':school_id', $school_id);
        return $this->db->resultSet();   
    }
    
    
    public function getRecordByPlayerId($player_id) {
        $this->db->query("
            SELECT ar.grade, ar.term, ar.average, ar.rank, ar.notes, u.firstname
            FROM academic_records ar
            JOIN user_player up ON ar.player_id = up.player_id
            JOIN users u ON up.user_id = u.user_id
            WHERE ar.player_id = :player_id
        ");
        $this->db->bind(':player_id', $player_id);
        return $this->db->single();
    }

    public function updateRecord($data) {
    $this->db->query("UPDATE academic_records SET grade = :grade, term = :term, average = :average, rank = :rank, notes = :notes WHERE player_id = :player_id");
    $this->db->bind(':grade', $data['grade']);
    $this->db->bind(':term', $data['term']);
    $this->db->bind(':average', $data['average']);
    $this->db->bind(':rank', $data['rank']);
    $this->db->bind(':notes', $data['notes']);
    $this->db->bind(':player_id', $data['player_id']);

    return $this->db->execute();
}

public function deleteRecordByPlayerId($player_id) {
    $this->db->query("DELETE FROM academic_records WHERE player_id = :player_id");
    $this->db->bind(':player_id', $player_id);

    return $this->db->execute();
}


public function addFacility($data) {
    // Prepare SQL query to insert data into the 'facilities' table
    $sql = "INSERT INTO facilities (facility_type, other_facility, facility_name, location, date_established, size, `condition`, capacity, schedule_notes, remarks) 
            VALUES (:facilityType, :otherFacility, :facilityName, :location, :dateEstablished, :size, :condition, :capacity, :scheduleNotes, :remarks)";

    // Bind parameters
    $this->db->query($sql);
    $this->db->bind(':facilityType', $data['facilityType']);
    $this->db->bind(':otherFacility', $data['otherFacility']);
    $this->db->bind(':facilityName', $data['facilityName']);
    $this->db->bind(':location', $data['location']);
    $this->db->bind(':dateEstablished', $data['dateEstablished']);
    $this->db->bind(':size', $data['size']);
    $this->db->bind(':condition', $data['condition']);
    $this->db->bind(':capacity', $data['capacity']);
    $this->db->bind(':scheduleNotes', $data['scheduleNotes']);
    $this->db->bind(':remarks', $data['remarks']);

    // Execute the query and return the result
    return $this->db->execute();
}

public function getFacilityRequests($school_id) {
    $this->db->query(" SELECT event_name, event_date, time_from, time_to, facilities_required FROM event_requests WHERE school_id= :school_id   ");
    $this->db->bind(':school_id',$school_id);
    return $this->db->resultSet();
}

public function getExtraClassRequests() {
    $this->db->query("
        SELECT ecr.request_id, u.firstname as student_name, 
               ecr.subject_name, ecr.notes, ecr.status
        FROM extra_class_requests ecr
        JOIN users u ON ecr.student_id = u.user_id
        WHERE ecr.status = 'pending'
    ");
    return $this->db->resultSet();
}

public function updateFacilityRequestStatus($requestId, $status) {
    $this->db->query("
        UPDATE facility_requests 
        SET status = :status 
        WHERE request_id = :request_id
    ");
    $this->db->bind(':status', $status);
    $this->db->bind(':request_id', $requestId);
    return $this->db->execute();
}
public function addExtraClass($data) {
    $sql = "INSERT INTO extra_classes (players, subject, description, class_date, venue) 
            VALUES (:players, :subject, :description, :date, :venue)";

    // Prepare the query and bind the parameters
    $this->db->query($sql);
    $this->db->bind(':players', $data['players']);
    $this->db->bind(':subject', $data['subject']);
    $this->db->bind(':description', $data['description']);
    $this->db->bind(':date', $data['date']);
    $this->db->bind(':venue', $data['venue']);

    // Execute the query and return the result
    if ($this->db->execute()) {
        return $this->db->lastInsertId();
    }
    return false;
}

// Method to update the status of an extra class request
public function updateExtraClassRequestStatus($requestId, $status) {
    $this->db->query("
        UPDATE extra_class_requests 
        SET status = :status 
        WHERE request_id = :request_id
    ");
    $this->db->bind(':status', $status);
    $this->db->bind(':request_id', $requestId);

    // Execute the query and return whether a row was affected
    return $this->db->execute() && $this->db->rowCount() > 0;
}

public function getPlayersBySchoolId($schoolId) {
    // Query to fetch players associated with the school_id
    // Change 'full_name' to the correct column name
    $sql = "SELECT full_name FROM users WHERE school_id = :school_id AND role = 'player'";  // Update 'full_name' with the correct column name

    $this->db->query($sql);
    $this->db->bind(':school_id', $schoolId);
    
    // Fetch and return the result
    return $this->db->resultSet();  // Returns an array of player names
}


}
