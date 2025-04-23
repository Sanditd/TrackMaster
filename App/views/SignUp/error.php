<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <style>
        .error-box {
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #e74c3c;
            background-color: #f9d6d5;
            color: #c0392b;
            width: 60%;
            font-family: Arial, sans-serif;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <h2>Error Occurred</h2>
        <?php if (!empty($data['error'])): ?>
            <p><?= $data['error']; ?></p>
        <?php else: ?>
            <p>Something went wrong, but no specific error was set.</p>
        <?php endif; ?>
        <a href="<?= ROOT ?>/home">← Back to Home</a>
    </div>
</body>
</html>
