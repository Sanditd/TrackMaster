document.addEventListener("DOMContentLoaded", function() {
    // Notification icon and panel
    const notificationIcon = document.querySelector('.notification-icon');
    const notificationPanel = document.querySelector('.notification-panel');
    const notificationCount = document.querySelector('.notification-count');
    const notificationList = document.querySelector('.notification-list');
    const markAllReadBtn = document.querySelector('.mark-all-read');
    
    // Toggle notification panel
    notificationIcon.addEventListener('click', function(e) {
        if (e.target !== markAllReadBtn && !markAllReadBtn.contains(e.target)) {
            notificationPanel.style.display = notificationPanel.style.display === 'none' || !notificationPanel.style.display ? 'block' : 'none';
            
            if (notificationPanel.style.display === 'block') {
                loadNotifications();
            }
        }
    });
    
    // Close notification panel when clicking outside
    document.addEventListener('click', function(e) {
        if (!notificationIcon.contains(e.target)) {
            notificationPanel.style.display = 'none';
        }
    });
    
    // Mark all notifications as read
    markAllReadBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        
        fetch('notification_ajax.php?action=mark_all_as_read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications();
                notificationCount.textContent = '0';
            }
        });
    });
    
    // Load notifications
    function loadNotifications() {
        fetch('notification_ajax.php?action=get_notifications')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    return;
                }
                
                // Update notification count
                notificationCount.textContent = data.count;
                
                // Clear current notifications
                notificationList.innerHTML = '';
                
                // Add notifications to panel
                if (data.notifications.length === 0) {
                    notificationList.innerHTML = '<div class="no-notifications">No notifications</div>';
                } else {
                    data.notifications.forEach(notification => {
                        const notificationItem = document.createElement('div');
                        notificationItem.className = `notification-item type-${notification.type}`;
                        if (notification.active === '1') {
                            notificationItem.classList.add('unread');
                        }
                        
                        const date = new Date(notification.datetime);
                        const formattedDate = date.toLocaleString();
                        
                        notificationItem.innerHTML = `
                            <div class="title">${notification.title}</div>
                            <div class="description">${notification.description}</div>
                            <div class="time">${formattedDate}</div>
                        `;
                        
                        notificationItem.addEventListener('click', function() {
                            handleNotificationClick(notification.n_id, notification.type);
                        });
                        
                        notificationList.appendChild(notificationItem);
                    });
                }
            });
    }
    
    // Handle notification click
    function handleNotificationClick(notificationId, type) {
        const formData = new FormData();
        formData.append('notification_id', notificationId);
        formData.append('type', type);
        
        fetch('notification_ajax.php?action=handle_action', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.redirect) {
                window.location.href = data.redirect;
            }
        });
    }
    
    // Check for new notifications periodically (every 30 seconds)
    setInterval(function() {
        if (notificationPanel.style.display !== 'block') {
            fetch('notification_ajax.php?action=get_notifications')
                .then(response => response.json())
                .then(data => {
                    if (!data.error) {
                        notificationCount.textContent = data.count;
                    }
                });
        }
    }, 30000);
    
    // Initial load
    fetch('notification_ajax.php?action=get_notifications')
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                notificationCount.textContent = data.count;
            }
        });
});