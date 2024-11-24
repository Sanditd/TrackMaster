<?php
class Student extends Controller {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addData() {
        if (isset($_POST['place']) && isset($_POST['level']) && isset($_POST['description']) && isset($_POST['date'])) {
            $place = $_POST['place'];
            $level = $_POST['level'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $student_id = $_SESSION['id'];
            $conn = $this->db->getConnection(); // Assuming there's a method to get the DB connection
            $achievement = $this->model('achievement');
            $result = $achievement::addAchievement($conn, $student_id, $place, $level, $description, $date);
            if ($result) {
                echo "Achievement added successfully";
            } else {
                echo "Failed to add achievement";
            }
        }
    }

}