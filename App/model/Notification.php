<?php
class Notification {
    private $db;
    
    public function __construct() {
        $this->db=new database();
    }
    
    // Create a new notification
    public function createNotification($data) {
        try {
            $this->db->query("INSERT INTO notifications (title, description, type, toWhom, active, date) 
                              VALUES (:title, :description, :type, :toWhom, 1, NOW())");
    
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':toWhom', $data['toWhom']);
    
            if (!$this->db->execute()) {
                return ['success' => false, 'error' => 'Failed to create notification.'];
            }
    
            $id = $this->db->lastInsertId();
            return ['success' => true, 'notificationId' => $id];
        } catch (PDOException $e) {
            error_log("SQL Error in createNotification: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        } catch (Exception $e) {
            error_log("General Error in createNotification: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    
    // Get notifications for a specific user
    public function getUserNotifications($userId, $limit = 10) {
        try {
            $this->db->query("SELECT * FROM notifications 
                              WHERE toWhom = :userId AND active = 1 
                              ORDER BY datetime DESC 
                              LIMIT :limit");
    
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            $this->db->bind(':limit', $limit, PDO::PARAM_INT);
    
            $notifications = $this->db->resultSet();
    
            return ['success' => true, 'notifications' => $notifications];
        } catch (PDOException $e) {
            error_log("SQL Error in getUserNotifications: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    
    // Get unread notification count
    public function getUnreadCount($userId) {
        try {
            $this->db->query("SELECT COUNT(*) as count FROM notifications 
                              WHERE toWhom = :userId AND active = 1");
    
            $this->db->bind(':userId', $userId);
            $row = $this->db->single();
    
            return ['success' => true, 'count' => $row['count']];
        } catch (PDOException $e) {
            error_log("SQL Error in getUnreadCount: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    
    // Mark notification as read (set active = 0)
    public function markAsRead($notificationId) {
        try {
            $this->db->query("UPDATE notifications SET active = 0 WHERE n_id = :id");
            $this->db->bind(':id', $notificationId);
    
            if ($this->db->execute()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'error' => 'Failed to mark notification as read.'];
            }
        } catch (PDOException $e) {
            error_log("SQL Error in markAsRead: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    
    // Mark all notifications as read for a user
    public function markAllAsRead($userId) {
        try {
            $this->db->query("UPDATE notifications SET active = 0 WHERE toWhom = :userId AND active = 1");
            $this->db->bind(':userId', $userId);
    
            if ($this->db->execute()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'error' => 'Failed to mark all notifications as read.'];
            }
        } catch (PDOException $e) {
            error_log("SQL Error in markAllAsRead: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
}
?>