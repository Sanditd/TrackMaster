<?php
require_once __DIR__ . '/../libraries/database.php';

class SchoolModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    } 

    public function getSchoolId($user_id) {
        $this->db->query("SELECT school_id FROM user_school WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function getPlayersForSchool($school_id) {
        $this->db->query("
            SELECT u.user_id, u.firstname
            FROM users u
            JOIN user_player up ON u.user_id = up.user_id
            WHERE up.school_id = :school_id
        ");
        $this->db->bind(':school_id', $school_id);
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
        return $this->db->single();
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
        $this->db->query("
        SELECT u.firstname, ar.grade, ar.term, ar.average, ar.rank, ar.notes, ar.player_id
        FROM academic_records ar
        JOIN user_player up ON ar.player_id = up.player_id
        JOIN users u ON up.user_id = u.user_id
        WHERE up.school_id = :school_id
        ");
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
        $sql = "INSERT INTO facilities (facility_type, other_facility, facility_name, location, date_established, size, `condition`, capacity, schedule_notes, remarks) 
                VALUES (:facilityType, :otherFacility, :facilityName, :location, :dateEstablished, :size, :condition, :capacity, :scheduleNotes, :remarks)";
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
        return $this->db->execute();
    }

    public function getFacilityRequests() {
        $this->db->query("
            SELECT fr.request_id, fr.event_name, fr.coach_name, 
                   fr.date, fr.start_time, fr.end_time, fr.status
            FROM facility_requests fr
            WHERE fr.status = 'pending'
        ");
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

 

    public function updateExtraClassRequestStatus($requestId, $status) {
        $this->db->query("
            UPDATE extra_class_requests 
            SET status = :status 
            WHERE request_id = :request_id
        ");
        $this->db->bind(':status', $status);
        $this->db->bind(':request_id', $requestId);
        return $this->db->execute() && $this->db->rowCount() > 0;
    }

    public function getPlayersBySchoolId($schoolId) {
        $sql = "SELECT firstname AS full_name FROM users WHERE school_id = :school_id AND role = 'player'";
        $this->db->query($sql);
        $this->db->bind(':school_id', $schoolId);
        return $this->db->resultSet();
    }

    public function getStudyPerformance($school_id) {
        $this->db->query("
            SELECT u.firstname AS name, AVG(ar.average) AS average
            FROM academic_records ar
            JOIN user_player up ON ar.player_id = up.player_id
            JOIN users u ON up.user_id = u.user_id
            WHERE up.school_id = :school_id
            GROUP BY u.user_id, u.firstname
        ");
        $this->db->bind(':school_id', $school_id);
        return $this->db->resultSet();
    }

    public function getUpcomingSessions($school_id) {
        $this->db->query("
            SELECT subject AS session_name, class_date AS session_date
            FROM extra_classes
            WHERE class_date >= CURDATE()
            AND players IN (
                SELECT u.firstname
                FROM users u
                JOIN user_player up ON u.user_id = up.user_id
                WHERE up.school_id = :school_id
            )
            ORDER BY class_date ASC
            LIMIT 5
        ");
        $this->db->bind(':school_id', $school_id);
        return $this->db->resultSet();
    }

 
    
        // Fetch players (users with role 'player') for a specific school, including their player_id, firstname, and lastname
        public function getPlayerForSchool($school_id) {
            $this->db->query("
                SELECT u.user_id, u.firstname, u.lastname, up.player_id
                FROM users u
                JOIN user_player up ON u.user_id = up.user_id
                WHERE up.school_id = :school_id AND u.role = 'player'
            ");
            $this->db->bind(':school_id', $school_id);
            $result = $this->db->resultSet();
            error_log("Players query result: " . json_encode($result));
            return $result;
        }
    
        // Get player_id for a given user_id
        public function getPlayerIdByUserId($user_id) {
            $this->db->query("
                SELECT player_id 
                FROM user_player 
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $user_id);
            return $this->db->single();
        }
    
        // Insert an extra class with the list of player_ids
        public function addExtraClass($data) {
            $sql = "INSERT INTO extra_classes (players, subject, description, class_date, venue, school_id) 
                    VALUES (:players, :subject, :description, :class_date, :venue, :school_id)";
            $this->db->query($sql);
            $this->db->bind(':players', $data['players']);
            $this->db->bind(':subject', $data['subject']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':class_date', $data['class_date']);
            $this->db->bind(':venue', $data['venue']);
            $this->db->bind(':school_id', $data['school_id']);
            if ($this->db->execute()) {
                return $this->db->lastInsertId();
            }
            return false;
        }
    
        // Get the school_id for a given user_id (school admin) using the user_school table
        public function getSchlId($user_id) {
            $this->db->query("SELECT school_id FROM user_school WHERE user_id = :user_id");
            $this->db->bind(':user_id', $user_id);
            $result = $this->db->single();
            return $result ? $result->school_id : null;
        }
    
        // ... other existing methods ...
    }
?>