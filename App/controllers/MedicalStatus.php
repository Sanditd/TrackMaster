    <?php
    class MedicalStatus extends Controller {
        private $medicalModel;

        public function __construct() {
            // Ensure session is started immediately
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        
            // Move this check after session start
            if (!isset($_SESSION['user_id'])) {
                header('Location: ' . URLROOT . '/users/login');
                exit;
            }
        
            $this->medicalModel = $this->model('MedicalModel');
            
        }

        public function index() {
            echo 'Reached MedicalStatus index!<br>';
        
            $userId = $_SESSION['user_id'];
            echo 'User ID: ' . $userId . '<br>';
        
            $data = $this->medicalModel->index($userId);
        
            echo '<pre>';
            print_r($data);
            echo '</pre>';
            exit;
        }

        public function saveMedicalStatus() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Sanitize and validate input
                $data = [
                    'date' => trim($_POST['date']),
                    'condition' => trim($_POST['condition']),
                    'medication' => trim($_POST['medication']),
                    'notes' => trim($_POST['notes']),
                    'errors' => []
                ];
        
                // Validate inputs
                if (empty($data['date'])) {
                    $data['errors']['date'] = 'Date is required';
                }
                if (empty($data['condition'])) {
                    $data['errors']['condition'] = 'Medical condition is required';
                }
        
                if (empty($data['errors'])) {
                    if ($this->medicalModel->addMedicalRecord($data)) {
                        flash('medical_message', 'Medical record added successfully', 'alert alert-success');
                    } else {
                        flash('medical_message', 'Failed to add medical record', 'alert alert-danger');
                    }
                } else {
                    // Store errors in session to display them
                    $_SESSION['medical_errors'] = $data['errors'];
                    $_SESSION['medical_form_data'] = $data;
                }
        
                header('Location: ' . URLROOT . '/MedicalStatus');
                exit();
            }
        }

        public function saveThingsToConsider() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Sanitize and validate input
                $data = [
                    'blood_type' => trim($_POST['bloodType']),
                    'allergies' => trim($_POST['allergies']),
                    'special_notes' => trim($_POST['specialNotes']),
                    'emergency_contact' => trim($_POST['emergencyContact']),
                    'errors' => []
                ];
        
                // Validate inputs
                if (empty($data['blood_type'])) {
                    $data['errors']['blood_type'] = 'Blood type is required';
                }
                if (empty($data['emergency_contact'])) {
                    $data['errors']['emergency_contact'] = 'Emergency contact is required';
                }
        
                if (empty($data['errors'])) {
                    if ($this->medicalModel->updateThingsToConsider($data)) {
                        flash('medical_message', 'Health information updated successfully', 'alert alert-success');
                    } else {
                        flash('medical_message', 'Failed to update health information', 'alert alert-danger');
                    }
                } else {
                    // Store errors in session to display them
                    $_SESSION['things_errors'] = $data['errors'];
                    $_SESSION['things_form_data'] = $data;
                }
        
                header('Location: ' . URLROOT . '/MedicalStatus');
                exit();
            }
        }

    }