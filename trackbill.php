<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Bill - NSTU-QuickBill</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
            padding-bottom: 60px; /* Ensure space for footer */
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
    
        .container {
            margin-top: 20px;
        }

        .timeline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            padding: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #20dbc2;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            z-index: 1;
        }

        .stage {
            position: relative;
            width: 24px;
            height: 24px;
            border: 2px solid #ff6347;
            border-radius: 50%;
            background-color: white;
            z-index: 2;
        }

        .stage.verified {
            background-color: #28a745;
            border-color: #28a745;
        }

        .stage.rejected {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .details-box {
            margin-top: 20px;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .details-box h4 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .details-box p {
            margin: 5px 0;
            font-size: 14px;
        }

       
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="../images/Logo.png" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
            NSTU-Quickbill
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                <li class="nav-item">
                    <a class="nav-link" href="trackbilllogin.php"><i class="fas fa-search"></i> Track Bill</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i> Notifications <span class="badge badge-danger" id="notification-count">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="notification-list">
                        <a class="dropdown-item" href="#" data-notification-id="1">Director Submitted the bills</a>
                        <a class="dropdown-item" href="#" data-notification-id="2">Exam Control Office forward the bill</a>
                        <a class="dropdown-item" href="#" data-notification-id="3">Treasurer submitted the bill.</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    
    <div class="content container">
        <h2 class="text-center classic-font">Track Bill</h2>
        <p>Bill no: <span id="bill-no">8905</span></p>
        
        <div class="timeline">
            <div class="stage verified" id="head"></div>
            <div class="stage verified" id="register-officer"></div>
            <div class="stage" id="daa-office"></div>
            <div class="stage" id="exam-controller"></div>
            <div class="stage" id="treasurer"></div>
            <div class="stage" id="vc"></div>
        </div>

        <div class="details-box">
            <h4>Head (Chairman)</h4>
            <p>Date: 3/5/2023</p>
            <p>Time: 03:30 PM</p>
            <p>Status: Forwarded from Director</p>
        </div>
        <div class="details-box">
            <h4>Register Officer</h4>
            <p>Date: 8/5/2023</p>
            <p>Time: 11:30 AM</p>
            <p>Status: Verified by Register</p>
        </div>
        <div class="details-box">
            <h4>DAA Office</h4>
            <p>Date: </p>
            <p>Time: </p>
            <p>Status: </p>
        </div>
        <div class="details-box">
            <h4>Exam Controller</h4>
            <p>Date: </p>
            <p>Time: </p>
            <p>Status: </p>
        </div>
        <div class="details-box">
            <h4>Treasurer</h4>
            <p>Date: </p>
            <p>Time: </p>
            <p>Status: </p>
        </div>
        <div class="details-box">
            <h4>VC</h4>
            <p>Date: </p>
            <p>Time: </p>
            <p>Status: </p>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 NSTU-Quickbill. All rights reserved.</p>
            <p><a href="#">Privacy Policy | Terms Of Service</a></p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script
