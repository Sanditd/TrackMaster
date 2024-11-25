<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Event Requests</title>
    <link rel="stylesheet" href="../../../Public/css/Event/event.css">
    <script>
        function handleRequest(action, eventName) {
            alert(`You have ${action} the request for the event: ${eventName}`);
        }
    </script>
</head>
<body>
    <h1>School Event Requests</h1>
    <table class="event-list">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Coach Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Football Championship</td>
                <td>Coach John Doe</td>
                <td>
                    <button class="btn approve-btn" onclick="handleRequest('approved', 'Football Championship')">Approve</button>
                    <button class="btn decline-btn" onclick="handleRequest('declined', 'Football Championship')">Decline</button>
                </td>
            </tr>
            <tr>
                <td>Basketball Tournament</td>
                <td>Coach Jane Smith</td>
                <td>
                    <button class="btn approve-btn" onclick="handleRequest('approved', 'Basketball Tournament')">Approve</button>
                    <button class="btn decline-btn" onclick="handleRequest('declined', 'Basketball Tournament')">Decline</button>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
