<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - NSTU-Quickbill</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
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

        .container {
            margin-top: 50px;
            padding-bottom: 60px;
        }

        .about-content {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .about-content h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .about-content p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .about-content ul {
            list-style-type: none;
            padding: 0;
        }

        .about-content ul li {
            margin-bottom: 10px;
        }

        .about-content ul li i {
            color: #20dbc2;
            margin-right: 10px;
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

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="about-content">
            <h2>About Us</h2>
            <p>Welcome to NSTU-Quickbill, your reliable partner in managing and tracking your bills efficiently. We are dedicated to providing you with the best service to ensure that your billing process is smooth, secure, and transparent.</p>
            <p>At NSTU-Quickbill, our mission is to simplify the bill management process for our users. We understand that managing multiple bills can be overwhelming, so we've created a platform that brings everything together in one place, making it easier for you to keep track of your expenses.</p>
            <h4>Our Features:</h4>
            <ul>
                <li><i class="fas fa-check-circle"></i> Easy bill creation and management</li>
                <li><i class="fas fa-check-circle"></i> Real-time notifications and updates</li>
                <li><i class="fas fa-check-circle"></i> Detailed bill history and tracking</li>
                <li><i class="fas fa-check-circle"></i> Secure payment options</li>
                <li><i class="fas fa-check-circle"></i> User-friendly interface</li>
            </ul>
            <p>Our team is made up of experienced professionals who are passionate about technology and innovation. We work tirelessly to ensure that NSTU-Quickbill meets the highest standards of quality and security.</p>
            <p>Thank you for choosing NSTU-Quickbill. We look forward to serving you and making your bill management experience as seamless as possible.</p>
            <p>For any questions or support, please <a href="contactus.php">contact us</a>.</p>
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2024 NSTU-Quickbill. All rights reserved.</p>
            <p><a href="#">Privacy Policy|Terms and Service</a></p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
