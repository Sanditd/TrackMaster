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
        
        /* Footer styles */
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
        
        .footer-links {
            flex: 1 1 250px;
            margin: 1rem;
        }
        
        .footer-links h3 {
            font-size: 1.2rem;
            margin-bottom: 1.2rem;
            position: relative;
            padding-bottom: 0.5rem;
            color: #ffffff;
        }
        
        .footer-links h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: #ffffff;
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.6rem;
            transition: transform 0.3s;
        }
        
        .footer-links li:hover {
            transform: translateX(5px);
        }
        
        .footer-links a {
            color: #cccccc;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: #ffffff;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-icon {
            background-color: rgba(255, 255, 255, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .social-icon:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }
        
        .social-icon svg {
            stroke: #ffffff;
        }

        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
            }
            
            .footer-links {
                margin: 1rem 0;
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