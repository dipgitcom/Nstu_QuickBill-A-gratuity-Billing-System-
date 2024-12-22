<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nstu_QuickBill</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #82c0ab;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: hwb(0 4% 96%);
            font-weight: bold;
            font-family: 'Arial', sans-serif;
        }

        .navbar-custom .nav-link:hover {
            color: #cccccc;
        }
        .user-section {
            text-align: right;
            color: #343a40;
            margin-right: 15px;
            margin-top: 15px;
        }

        .user-section img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .button-section {
            margin-top: 20px;
        }

        .button-section .btn {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            font-size: 18px;
            padding: 15px 20px;
            font-family: 'Arial', sans-serif;
            border-radius: 5px;
            background-color: #82c0ab;
            border: none;
            color: black;
            font-weight: bold;
        }

        .button-section .btn:hover {
            background-color: #1ca79e;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .footer {
            background-color: #061e6d;
            color: #e6dddd;
            padding: 10px 0;
            font-size: 14px;
        }

        .footer a {
            color: hsl(0, 9%, 94%);
        }

        .footer a:hover {
            color: hwb(0 90% 5%);
            text-decoration: none;
        }

        .footer .social-icons a {
            margin: 0 10px;
            color: #f1ecec;
        }

        .container {
            padding-bottom: 60px;
        }

        .user-section h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .button-image {
            text-align: center;
        }

        .button-image img {
            width: 100%;
            max-width: 300px;
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
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 user-section">
                <h2
                    style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                    Hello User!</h2>
                <h2
                    style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                    Create A Bill For?</h2>
                <p
                    style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                </p>
            </div>
        </div>
        <div class="row button-section">
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="examBill()">Exam Bill</button>
                <button class="btn btn-primary" onclick="courseExpense()">Course Expenses</button>
                <button class="btn btn-primary" onclick="researchFund()">Research Fund</button>
                <button class="btn btn-primary" onclick="postageCharges()">Postage Charges</button>
                <button class="btn btn-primary" onclick="insertionOfTestResult()">Insertion Of Test Result </button>
            </div>
            <div class="col-md-6 button-image">
                <img src="../GIF/bill2.gif" alt="bill">
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
    <script>
        function examBill() {
            alert('Exam Bill button clicked');
        }
        function courseExpense() {
            alert('Course Expenses button clicked');
        }
        function researchFund() {
            alert('Research Fund button clicked');
        }
        function postageCharges() {
            alert('Postage Charges button clicked');
        }
        function insertionOfTestResult() {
            alert('Insertion Of Test Result button clicked');
        }
    </script>
</body>

</html>
