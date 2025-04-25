document.addEventListener("DOMContentLoaded", function () {
    const notificationIcon = document.querySelector('.notification-icon');
    const notificationPanel = document.querySelector('.notification-panel');
    const notificationCount = document.querySelector('.notification-count');
    const notificationList = document.querySelector('.notification-list');
    const markAllReadBtn = document.querySelector('.mark-all-read');

    if (!notificationIcon) {
        console.error('Notification elements not found');
        return;
    }

    // Toggle panel
    notificationIcon.addEventListener('click', function (e) {
        if (e.target !== markAllReadBtn && !markAllReadBtn.contains(e.target)) {
            notificationPanel.style.display = notificationPanel.style.display === 'none' || !notificationPanel.style.display ? 'block' : 'none';

            // if (notificationPanel.style.display === 'block') {
            //     loadNotifications();
            // }
        }
    });

    // Close panel on outside click
    document.addEventListener('click', function (e) {
        if (!notificationIcon.contains(e.target) && !notificationPanel.contains(e.target)) {
            notificationPanel.style.display = 'none';
        }
    });

    // Mark all as read
    markAllReadBtn.addEventListener('click', function (e) {
        e.stopPropagation();

        fetch('notification_ajax.php?action=mark_all_as_read', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notificationCount.textContent = '0';
                loadNotifications();
            }
        })
        .catch(error => {
            console.error('Error marking all as read:', error);
        });
    });

    // Load notifications
    // function loadNotifications() {
    //     fetch('notification_ajax.php?action=get_notifications')
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.error) {
    //                 console.error(data.error);
    //                 return;
    //             }

    //             notificationCount.textContent = data.count;
    //             notificationList.innerHTML = '';

    //             if (data.notifications.length === 0) {
    //                 notificationList.innerHTML = '<div class="no-notifications">No notifications</div>';
    //             } else {
    //                 data.notifications.forEach(notification => {
    //                     const notificationItem = document.createElement('div');
    //                     notificationItem.className = `notification-item type-${notification.type}`;
    //                     if (notification.active === '1') {
    //                         notificationItem.classList.add('unread');
    //                     }

    //                     const date = new Date(notification.datetime);
    //                     const formattedDate = date.toLocaleString();

    //                     notificationItem.innerHTML = `
    //                         <div class="title">${notification.title}</div>
    //                         <div class="description">${notification.description}</div>
    //                         <div class="time">${formattedDate}</div>
    //                         ${notification.active === '1' ? `<button class="mark-read-btn" data-id="${notification.n_id}">Mark as read</button>` : ''}
    //                     `;

    //                     notificationItem.addEventListener('click', function () {
    //                         markAsRead(notification.n_id)
    //                             .then(data => {
    //                                 if (data.success) {
    //                                     handleNotificationAction(notification.n_id, notification.type);
    //                                 }
    //                             });
    //                     });

    //                     notificationList.appendChild(notificationItem);
    //                 });
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error loading notifications:', error);
    //             notificationList.innerHTML = '<div class="no-notifications">Error loading notifications</div>';
    //         });
    // }

    // Mark a single notification as read
    // function markAsRead(notificationId) {
    //     const formData = new FormData();
    //     formData.append('notification_id', notificationId);
    //     console.log(notificationId);

    //     return fetch('notification_ajax.php?action=mark_as_read', {
    //         method: 'POST',
    //         body: formData
    //     }).then(response => response.json());
    // }

    // Handle redirect after notification click
    // function handleNotificationAction(notificationId, type) {
    //     const formData = new FormData();
    //     formData.append('notification_id', notificationId);
    //     formData.append('type', type);

    //     fetch('notification_ajax.php?action=handle_action', {
    //         method: 'POST',
    //         body: formData
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if (data.success && data.redirect) {
    //             window.location.href = data.redirect;
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error handling notification action:', error);
    //     });
    // }

    // Use event delegation for dynamically loaded "Mark as read" buttons
    // Use event delegation for dynamically loaded "Mark as read" buttons
// document.addEventListener('click', function (e) {
//     if (e.target && e.target.classList.contains('mark-read-btn')) {
//         e.preventDefault();
//         e.stopPropagation(); // Prevent triggering the parent notification item click
        
//         const button = e.target;
//         const notificationId = button.getAttribute('data-id');
//         const notificationItem = button.closest('.notification-item');

//         console.log(notificationId);
        
//         markAsRead(notificationId)
//             .then(data => {
//                 if (data.success) {
//                     // Update UI to show notification as read
//                     button.style.display = 'none';
//                     notificationItem.classList.remove('unread');
                    
//                     // Update the notification count
//                     const currentCount = parseInt(notificationCount.textContent) || 0;
//                     if (currentCount > 0) {
//                         notificationCount.textContent = currentCount - 1;
//                     }
//                 } else {
//                     console.error('Failed to mark as read:', data.error);
//                 }
//             })
//             .catch(error => {
//                 console.error('Error marking notification as read:', error);
//             });
//     }
// });

    // Check for new notifications every 30 seconds
    setInterval(() => {
        if (notificationPanel.style.display !== 'block') {
            fetch('notification_ajax.php?action=get_notifications')
                .then(response => response.json())
                .then(data => {
                    if (!data.error) {
                        notificationCount.textContent = data.count;
                    }
                })
                .catch(error => {
                    console.error('Error checking for notifications:', error);
                });
        }
    }, 30000);

    // Initial load of count
    fetch('notification_ajax.php?action=get_notifications')
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                notificationCount.textContent = data.count;
            }
        })
        .catch(error => {
            console.error('Error loading initial notifications:', error);
        });
});
