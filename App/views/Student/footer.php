<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'TrackMaster'; ?></title>
    <link rel="stylesheet" href="/TrackMaster/Public/css/footer.css">
</head>
<body>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="/TrackMaster/Public/img/logo.png" alt="TrackMaster Logo">
                <div class="footer-tagline">
                    <p>The Ultimate Platform Designed to Transform the Way Schools, Coaches, Students, and Parents Collaborate in Nurturing Athletic Excellence.</p>
                </div>
                <hr class="footer-divider">
                <p class="footer-copyright">© <?php echo date('Y'); ?> TrackMaster. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>