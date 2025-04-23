<?php
class MedicalStatus extends Controller {
    private $medicalModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit;
        }

        $this->medicalModel = $this->model('MedicalModel');
    }

    public function index() {
        $userId = $_SESSION['user_id'];
    
        $data = $this->medicalModel->index($userId);
    
        $this->view('Student/medicalStatus', $data);
    }

    public function saveMedicalStatus() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'date' => $_POST['date'],
            'condition' => trim($_POST['condition']),
            'medication' => trim($_POST['medication']),
            'notes' => trim($_POST['notes'])
        ];

        if ($this->medicalModel->addMedicalRecord($data)) {
            flash('medical_message', 'Medical record added successfully');
        } else {
            flash('medical_message', 'Failed to add medical record', 'alert alert-danger');
        }

        // Redirect to refresh data
        header('Location: ' . URLROOT . '/MedicalStatus');
        exit;
    }
}

public function saveThingsToConsider() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'blood_type' => trim($_POST['bloodType']),
            'allergies' => trim($_POST['allergies']),
            'special_notes' => trim($_POST['specialNotes']),
            'emergency_contact' => trim($_POST['emergencyContact'])
        ];

        if ($this->medicalModel->updateThingsToConsider($data)) {
            flash('medical_message', 'Health information updated successfully');
        } else {
            flash('medical_message', 'Failed to update health information', 'alert alert-danger');
        }

        // Redirect to refresh data
        header('Location: ' . URLROOT . '/MedicalStatus');
        exit;
    }
}   

}