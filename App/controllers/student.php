<?php
class Student extends Controller {
    private $studentModel;
    
    public function __construct() {
        $this->studentModel = $this->model('StudentModel');
    }

    public function index() {
        header('Location: ' . URLROOT . '/Student/studentDashboard');
        exit();
    }

    public function studentDashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }
    
        $userId = $_SESSION['user_id'];
    
        $medicalModel = $this->model('MedicalModel');
        $medicalStatus = $medicalModel->index($userId);
        $trainingStatus = $this->studentModel->getTrainingStatus($userId);
        $sports = $this->studentModel->getRegisteredSports($userId);

        $data = [
            'currentStatus' => $medicalStatus,
            'trainingStatus' => $trainingStatus,
            'sports' => $sports,
            'message' => isset($_SESSION['message']) ? $_SESSION['message'] : null,
            'message_type' => isset($_SESSION['message_type']) ? $_SESSION['message_type'] : null
        ];
    
        $this->view('Student/dashboard', $data);
    }

    public function updateStatus() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'status' => trim($_POST['status'] ?? ''),
                'errors' => []
            ];

            $validStatuses = ['Practicing', 'In a Meet', 'At Rest', 'Injured'];
            if (empty($data['status'])) {
                $data['errors'][] = 'Please select a training status.';
            } elseif (!in_array($data['status'], $validStatuses)) {
                $data['errors'][] = 'Invalid training status selected.';
            }

            if (empty($data['errors'])) {
                if ($this->studentModel->updateTrainingStatus($data)) {
                    $_SESSION['message'] = 'Training status updated successfully.';
                    $_SESSION['message_type'] = 'success';
                } else {
                    $_SESSION['message'] = 'Failed to update training status. Please try again.';
                    $_SESSION['message_type'] = 'error';
                }
            } else {
                $_SESSION['message'] = implode(' ', $data['errors']);
                $_SESSION['message_type'] = 'error';
            }

            header('Location: ' . URLROOT . '/Student/studentDashboard');
            exit();
        } else {
            $_SESSION['message'] = 'Invalid request method.';
            $_SESSION['message_type'] = 'error';
            header('Location: ' . URLROOT . '/Student/studentDashboard');
            exit();
        }
    }

    public function editStudentProfile() {
        $data = [];
        $this->view('Student/editStudentProfile');
    }

    public function saveAchievement() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => trim($_POST['user_id']),
                'place' => trim($_POST['place']),
                'level' => trim($_POST['level']),
                'description' => trim($_POST['description']),
                'date' => trim($_POST['date'])
            ];

            if ($this->studentModel->addAchievement($data)) {
                header('Location: ' . URLROOT . '/Student/studentAchievements');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('Student/addAchievement');
        }
    }

    public function editAchievement($achievement_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $achievement_id,
                'place' => trim($_POST['place']),
                'level' => trim($_POST['level']),
                'description' => trim($_POST['description']),
                'date' => trim($_POST['date']),
                'errors' => []
            ];
    
            if (empty($data['place'])) $data['errors'] = 'Place is required.';
            if (empty($data['level'])) $data['errors'] = 'Level is required.';
            if (empty($data['description'])) $data['errors'] = 'Description is required.';
            if (empty($data['date'])) $data['errors'] = 'Date is required.';
    
            if (empty($data['errors'])) {
                if ($this->studentModel->updateAchievement($data)) {
                    header('Location: ' . URLROOT . '/Student/studentAchievements');
                    exit();
                } else {
                    $data['errors'] = 'Something went wrong while updating the achievement.';
                    $this->view('Student/editAchievement', $data);
                }
            } else {
                $this->view('Student/editAchievement', $data);
            }
        } else {
            $achievement = $this->studentModel->getAchievementById($achievement_id);
            $data = empty($achievement) ? ['error' => "Achievement is empty"] : ['achievement' => $achievement];
            $this->view('Student/editAchievement', $data);
        }
    }

    public function deleteAchievement($id = null) {
        if ($id === null) {
            header('Location: ' . URLROOT . '/Student/studentAchievements');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->studentModel->deleteAchievement($id)) {
                header('Location: ' . URLROOT . '/Student/studentAchievements');
            } else {
                die('Something went wrong');
            }
        } else {
            header('Location: ' . URLROOT . '/Student/studentAchievements');
        }
    }

    public function studentAchievements() {
        $achievements = $this->studentModel->getAchievements();
        $data = ['achievements' => $achievements];
        $this->view('Student/studentAchievements', $data);
    }

    public function studentprofile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }
    
        $userDetails = $this->studentModel->getUserDetails($_SESSION['user_id']);
        if (!$userDetails) {
            $_SESSION['message'] = 'Unable to fetch user details.';
            $_SESSION['message_type'] = 'error';
            header('Location: ' . URLROOT . '/Student/studentDashboard');
            exit();
        }
    
        $sports = $this->studentModel->getRegisteredSports($_SESSION['user_id']);
        $school = $this->studentModel->getSchoolByPlayerId($_SESSION['user_id']);
        $role = $this->studentModel->getPlayerRole($_SESSION['user_id']);
    
        $data = [
            'user' => $userDetails,
            'sports' => $sports,
            'school' => $school,
            'role' => $role,
            'message' => isset($_SESSION['message']) ? $_SESSION['message'] : null,
            'message_type' => isset($_SESSION['message_type']) ? $_SESSION['message_type'] : null
        ];
        $this->view('Student/studentprofile', $data);
    }

    public function updateProfile() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in.']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
            exit();
        }

        // Log the incoming request data
        error_log('updateProfile called with POST data: ' . print_r($_POST, true));
        if (!empty($_FILES)) {
            error_log('updateProfile called with FILES data: ' . print_r($_FILES, true));
        }

        // Handle file upload
        $profilePicturePath = null;
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['profile_photo'];
            error_log('Profile photo upload detected. File size: ' . $file['size']);

            // Validate file size (2MB limit)
            if ($file['size'] > 2 * 1024 * 1024) {
                echo json_encode(['success' => false, 'message' => 'Profile picture size exceeds 2MB limit.']);
                exit();
            }

            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = $file['type'];
            if (!in_array($fileType, $allowedTypes)) {
                echo json_encode(['success' => false, 'message' => "Invalid file type ($fileType). Only JPEG, PNG, or GIF files are allowed."]);
                exit();
            }

            // Define upload directory
            $uploadDir = __DIR__ . '/../public/Uploads/';
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    error_log('Failed to create upload directory: ' . $uploadDir);
                    echo json_encode(['success' => false, 'message' => 'Failed to create upload directory.']);
                    exit();
                }
            }

            // Check if directory is writable
            if (!is_writable($uploadDir)) {
                error_log('Upload directory is not writable: ' . $uploadDir);
                echo json_encode(['success' => false, 'message' => 'Upload directory is not writable.']);
                exit();
            }

            // Generate unique file name
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $profilePicturePath = $uploadDir . uniqid() . '.' . $fileExtension;
            error_log('Attempting to move uploaded file to: ' . $profilePicturePath);

            // Move the uploaded file
            if (!move_uploaded_file($file['tmp_name'], $profilePicturePath)) {
                error_log('Failed to move uploaded file to: ' . $profilePicturePath);
                echo json_encode(['success' => false, 'message' => 'Failed to upload profile picture.']);
                exit();
            }

            // Convert absolute path to relative path for storage
            $profilePicturePath = str_replace(__DIR__ . '/../public', '', $profilePicturePath);
            error_log('Profile picture uploaded successfully: ' . $profilePicturePath);
        } elseif (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] != UPLOAD_ERR_NO_FILE) {
            // Log file upload errors
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.',
                UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded.',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
                UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.'
            ];
            $errorCode = $_FILES['profile_photo']['error'];
            $errorMessage = $uploadErrors[$errorCode] ?? 'Unknown file upload error.';
            error_log('File upload error: ' . $errorMessage . ' (Code: ' . $errorCode . ')');
            echo json_encode(['success' => false, 'message' => 'File upload error: ' . $errorMessage]);
            exit();
        }

        // Sanitize and validate form data
        $data = [
            'user_id' => $_SESSION['user_id'],
            'firstname' => trim($_POST['firstname'] ?? ''),
            'lname' => trim($_POST['lname'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phonenumber' => trim($_POST['phonenumber'] ?? ''),
            'gender' => trim($_POST['gender'] ?? ''),
            'dob' => trim($_POST['dob'] ?? '') ?: null, // Allow empty DOB to be NULL
            'bio' => trim($_POST['bio'] ?? ''),
            'errors' => []
        ];

        // Validate inputs
        if (empty($data['firstname'])) {
            $data['errors'][] = 'First name is required.';
        }
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['errors'][] = 'Valid email is required.';
        }
        if (empty($data['phonenumber'])) {
            $data['errors'][] = 'Phone number is required.';
        }
        if (empty($data['gender']) || !in_array($data['gender'], ['Male', 'Female'])) {
            $data['errors'][] = 'Valid gender is required.';
        }

        if (!empty($data['errors'])) {
            $errorMessage = implode(' ', $data['errors']);
            error_log('Validation errors: ' . $errorMessage);
            echo json_encode(['success' => false, 'message' => $errorMessage]);
            exit();
        }

        // Log the data being sent to the model
        error_log('Data to updateUserProfile: ' . print_r($data, true));
        if ($profilePicturePath) {
            error_log('Profile picture path to save: ' . $profilePicturePath);
        }

        // Update profile in the database
        if ($this->studentModel->updateUserProfile($data, $profilePicturePath)) {
            echo json_encode([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'photo' => $profilePicturePath ? basename($profilePicturePath) : null
            ]);
        } else {
            error_log('Failed to update profile in the database.');
            echo json_encode(['success' => false, 'message' => 'Failed to update profile in the database.']);
        }
        exit();
    }

    public function financialStatus() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }

        $applications = $this->studentModel->getFinancialApplications();
        $latest_application = !empty($applications) ? $applications[0] : null;

        $data = [
            'applications' => $applications,
            'status' => $latest_application ? $latest_application->application_status : 'No Application',
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->view('Student/financialStatus', $data);
    }

    public function submitApplication() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['message'] = 'Invalid CSRF token.';
                $_SESSION['message_type'] = 'error';
                header('Location: ' . URLROOT . '/Student/financialStatus');
                exit();
            }

            $file_path = null;
            if (isset($_FILES['financialReports']) && $_FILES['financialReports']['error'] == UPLOAD_ERR_OK) {
                $file = $_FILES['financialReports'];
                if ($file['size'] > 5 * 1024 * 1024) {
                    $_SESSION['message'] = 'File size exceeds 5MB limit.';
                    $_SESSION['message_type'] = 'error';
                    header('Location: ' . URLROOT . '/Student/financialStatus');
                    exit();
                }
                if ($file['type'] !== 'application/pdf') {
                    $_SESSION['message'] = 'Only PDF files are allowed.';
                    $_SESSION['message_type'] = 'error';
                    header('Location: ' . URLROOT . '/Student/financialStatus');
                    exit();
                }

                $upload_dir = __DIR__ . '/../public/uploads/financial_reports/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $file_path = $upload_dir . uniqid() . '.pdf';
                move_uploaded_file($file['tmp_name'], $file_path);
            } else {
                $_SESSION['message'] = 'Financial report is required.';
                $_SESSION['message_type'] = 'error';
                header('Location: ' . URLROOT . '/Student/financialStatus');
                exit();
            }

            $data = [
                'user_id' => $_SESSION['user_id'],
                'student_name' => trim($_POST['studentName']),
                'guardian_name' => trim($_POST['guardianName']),
                'annual_income' => trim($_POST['annualIncome']),
                'application_date' => trim($_POST['date']),
                'reason' => trim($_POST['reason']),
                'notes' => trim($_POST['notes']),
                'financial_report_path' => $file_path,
                'errors' => []
            ];

            if (empty($data['student_name'])) $data['errors'][] = 'Student name is required.';
            if (empty($data['guardian_name'])) $data['errors'][] = 'Guardian name is required.';
            if (empty($data['annual_income']) || !is_numeric($data['annual_income']) || $data['annual_income'] <= 0) {
                $data['errors'][] = 'Valid annual income is required.';
            }
            if (empty($data['application_date'])) $data['errors'][] = 'Application date is required.';
            if (empty($data['reason'])) $data['errors'][] = 'Reason for applying is required.';

            if (!empty($data['errors'])) {
                $_SESSION['message'] = implode(' ', $data['errors']);
                $_SESSION['message_type'] = 'error';
                header('Location: ' . URLROOT . '/Student/financialStatus');
                exit();
            }

            if ($this->studentModel->addFinancialApplication($data)) {
                $_SESSION['message'] = 'Application submitted successfully.';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong while submitting the application.';
                $_SESSION['message_type'] = 'error';
            }

            header('Location: ' . URLROOT . '/Student/financialStatus');
            exit();
        } else {
            header('Location: ' . URLROOT . '/Student/financialStatus');
            exit();
        }
    }

    public function viewApplication($id) {
        $application = $this->studentModel->getFinancialApplicationById($id);
        if (!$application) {
            $_SESSION['message'] = 'Application not found or unauthorized access.';
            $_SESSION['message_type'] = 'error';
            header('Location: ' . URLROOT . '/Student/financialStatus');
            exit();
        }

        $data = ['application' => $application];
        $this->view('Student/viewApplication', $data);
    }

    public function medicalStatus() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'medical_condition' => trim($_POST['medical_condition']),
                'medication' => trim($_POST['medication']),
                'notes' => trim($_POST['notes']),
                'date' => date('Y-m-d'),
                'errors' => []
            ];

            if (empty($data['medical_condition'])) {
                $data['errors'][] = 'Medical condition is required.';
            }

            if (!empty($data['errors'])) {
                $_SESSION['message'] = implode(' ', $data['errors']);
                $_SESSION['message_type'] = 'error';
                $this->view('Student/medicalStatus', $data);
            } else {
                if ($this->studentModel->updateMedicalStatus($data)) {
                    $_SESSION['message'] = 'Medical status updated successfully.';
                    $_SESSION['message_type'] = 'success';
                    header('Location: ' . URLROOT . '/Student/studentDashboard');
                    exit();
                } else {
                    $_SESSION['message'] = 'Failed to update medical status.';
                    $_SESSION['message_type'] = 'error';
                    $this->view('Student/medicalStatus', $data);
                }
            }
        } else {
            $data = [];
            $this->view('Student/medicalStatus');
        }
    }

    public function coachProfile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }
    
        $userId = $_SESSION['user_id'];
        $coach = $this->studentModel->getCoachByPlayerId($userId);
    
        if (!$coach) {
            $_SESSION['message'] = 'No coach assigned or unable to fetch coach details.';
            $_SESSION['message_type'] = 'error';
            header('Location: ' . URLROOT . '/Student/studentDashboard');
            exit();
        }
    
        $data = [
            'coach' => $coach,
            'message' => isset($_SESSION['message']) ? $_SESSION['message'] : null,
            'message_type' => isset($_SESSION['message_type']) ? $_SESSION['message_type'] : null
        ];
        $this->view('Student/coachProfile', $data);
    }

    public function parentProfile() {
        $data = [];
        $this->view('Student/parentProfile');
    }

    public function studentSchedule() {
        $data = [];
        $this->view('Student/studentSchedule');
    }

    public function schoolProfile() {
        $data = [];
        $this->view('Student/schoolProfile');
    }

    public function Playerperformance() {
        $data = [];
        $this->view('Student/Playerperformance');
    }

    public function saveCalendarNote() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in.']);
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            
            $data = [
                'user_id' => $_SESSION['user_id'],
                'note_date' => isset($input['note_date']) ? trim($input['note_date']) : '',
                'note_text' => isset($input['note_text']) ? trim($input['note_text']) : '',
                'errors' => []
            ];
    
            if (empty($data['note_date']) || !strtotime($data['note_date'])) {
                $data['errors'][] = 'Valid date is required.';
            }
            if (empty($data['note_text'])) {
                $data['errors'][] = 'Note text is required.';
            }
    
            if (empty($data['errors'])) {
                if ($this->studentModel->addCalendarNote($data)) {
                    echo json_encode(['success' => true, 'message' => 'Note saved successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to save note.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => implode(' ', $data['errors'])]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
        exit();
    }
    
    public function getCalendarNotes($month, $year) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $notes = $this->studentModel->getCalendarNotes($userId, $month, $year);
        echo json_encode(['success' => true, 'notes' => $notes]);
        exit();
    }

    private function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}