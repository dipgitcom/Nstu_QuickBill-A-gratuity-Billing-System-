<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nstu_QuickBill</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
            font-weight: bold;
        }

        .navbar-custom .nav-link:hover {
            color: #f8d210;
        }

        .home-intro {
            background-color: white;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .introduction {
            width: 50%;
            text-align: center;
            color: #333;
        }

        .introduction h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .introduction p {
            font-size: 1.2rem;
            color: #4f4f4f;
            margin-top: 15px;
        }

        .button {
            display: inline-block;
            height: 50px;
            width: 160px;
            background-color: #3b1c32;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            margin-top: 20px;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            line-height: 50px;
        }

        .button:hover {
            background-color: #b3b4bd;
            /* transform: scale(1.05); */
        } 

        .home-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
        }

        .logo img {
            width: 100%;
            max-width: 500px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .home-intro {
                flex-direction: column;
            }

            .introduction, .home-logo {
                width: 100%;
            }
        }

        .footer {
            background: #333;
            color: white;
            padding: 20px 0;
            font-size: 14px;
            text-align: center;
        }

        .footer a {
            color: #f8d210;
        }

        .footer a:hover {
            color: #ff9f1c;
            text-decoration: none;
        }

        .footer .social-icons a {
            margin: 0 10px;
            color: white;
            font-size: 18px;
        }

        .footer .social-icons a:hover {
            color: #f8d210;
        }
        
    </style>
</head>

<body>
<?php
// Start the session
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="#">
        <img src="../images/Logo.png" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
        NSTU-Quickbill
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: white;">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contactus.php"><i class="fas fa-envelope"></i> Contact Us</a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Show Logout when user is logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            <?php else: ?>
                <!-- Show Login when user is not logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>


    <div class="home-intro">
        <div class="introduction">
            <h2>Welcome to NSTU-QuickBill</h2>
            <p>Sparking a new era in billing systems.</p>
            <p>Faculty bill submission made easy with real-time tracking and efficient communication, streamlining administrative processes at NSTU.</p>
            <a href="get_started.php" class="button" style="text-decoration: none">Get Started</a>
        </div>
        <div class="home-logo">
            <div class="logo">
                <img src="../GIF/indexpic.gif" alt="logo">
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2024 NSTU-Quickbill. All rights reserved.</p>
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            <div class="social-icons">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-linkedin-in"></a>
                <a href="#" class="fab fa-instagram"></a>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
