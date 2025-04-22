<?php
require_once 'models/Notification.php';

class NotificationController extends Controller{
    private $notificationModel;
    
    public function __construct($database) {
        $this->notificationModel = $this->model('Notification');
    }
    
    // Create a new notification
    public function createNotification($title, $description, $type, $toWhom) {
        return $this->notificationModel->createNotification($title, $description, $type, $toWhom);
    }
    
    // Get notifications for the current user (AJAX endpoint)
    public function getNotifications() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['error' => 'User not logged in']);
            return;
        }
        
        $userId = $_SESSION['user_id'];
        $notifications = $this->notificationModel->getUserNotifications($userId);
        $count = $this->notificationModel->getUnreadCount($userId);
        
        echo json_encode([
            'notifications' => $notifications,
            'count' => $count
        ]);
    }
    
    // Mark notification as read (AJAX endpoint)
    public function markAsRead() {
        if (!isset($_POST['notification_id'])) {
            echo json_encode(['error' => 'Notification ID required']);
            return;
        }
        
        $notificationId = $_POST['notification_id'];
        $success = $this->notificationModel->markAsRead($notificationId);
        
        echo json_encode(['success' => $success]);
    }
    
    // Mark all notifications as read (AJAX endpoint)
    public function markAllAsRead() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['error' => 'User not logged in']);
            return;
        }
        
        $userId = $_SESSION['user_id'];
        $success = $this->notificationModel->markAllAsRead($userId);
        
        echo json_encode(['success' => $success]);
    }
    
    // Handle notification click based on type
    public function handleNotificationAction() {
        if (!isset($_POST['notification_id']) || !isset($_POST['type'])) {
            echo json_encode(['error' => 'Notification ID and type required']);
            return;
        }
        
        $notificationId = $_POST['notification_id'];
        $type = $_POST['type'];
        
        // Mark as read first
        $this->notificationModel->markAsRead($notificationId);
        
        // Return the appropriate redirect URL based on notification type
        $redirectUrl = '';
        switch ($type) {
            case 'message':
                $redirectUrl = 'messages.php';
                break;
            case 'task':
                $redirectUrl = 'tasks.php';
                break;
            case 'alert':
                $redirectUrl = 'alerts.php';
                break;
            default:
                $redirectUrl = 'dashboard.php';
        }
        
        echo json_encode(['success' => true, 'redirect' => $redirectUrl]);
    }
}
?>