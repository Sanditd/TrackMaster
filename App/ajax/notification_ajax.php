<?php
require_once '../libraries/Database.php';
require_once '../controllers/NotificationController.php';

// Create database connection
$database = new database();

// Create notification controller
$notificationController = new NotificationController($database);

// Handle different AJAX requests
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'get_notifications':
        $notificationController->getNotifications();
        break;
    
    case 'mark_as_read':
        $notificationController->markAsRead();
        break;
    
    case 'mark_all_as_read':
        $notificationController->markAllAsRead();
        break;
    
    case 'handle_action':
        $notificationController->handleNotificationAction();
        break;
    
    default:
        echo json_encode(['error' => 'Invalid action']);
}

?>