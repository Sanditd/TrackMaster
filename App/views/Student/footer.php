<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }
        
        .footer {
            background-color: #000000;
            color: #ffffff;
            padding: 3rem 0;
            border-top: 3px solid #ffffff;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 2rem;
        }
        
        .footer-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
            flex: 1 1 100%;
        }
        
        .footer-logo img {
            max-width: 200px;
            margin-bottom: 1rem;
            filter: grayscale(100%) brightness(200%);
        }
        
        .footer-tagline {
            text-align: center;
            max-width: 500px;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            color: #cccccc;
        }
        
        .footer-divider {
            width: 60%;
            border: none;
            height: 1px;
            background-color: rgba(255, 255, 255, 0.3);
            margin: 1rem auto;
        }
        
        .footer-copyright {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 1rem;
            color: #888888;
        }
      

        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
            }
        }
    </style>
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
                <p class="footer-copyright">© 2024 TrackMaster. All rights reserved.</p>
            </div>
              
        </div>
    </footer>
</body>
</html>