<?php
require_once '../libraries/Database.php';
require_once '../controllers/NotificationController.php';
require_once '../model/Notification.php';

// Create database connection
$database = new database();
$model = new Notification();

// Create notification controller
$notificationController = new NotificationController();

// Handle different AJAX requests
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'get_notifications':
        $notificationController->getAdminNotifications();
        break;
    
    case 'mark_as_read':
        $notificationId = $_POST['notification_id'] ?? null;

        if ($notificationId) {
            // $result = $notificationController->markAsRead($notificationId);
            echo json_encode($result);
        } else {
            echo json_encode(['success' => false, 'error' => 'Missing notification ID']);
        }
        break;

    
    case 'mark_all_as_read':
    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['error' => 'User not logged in']);
        break;
    }
    
    $userId = $_SESSION['user_id'];
    $success = $model->markAllAsRead($userId);
    
    echo json_encode(['success' => $success]);
    break;
    
    case 'handle_action':
        $notificationController->handleNotificationAction();
        break;
    
    default:
        echo json_encode(['error' => 'Invalid action']);
}

?>