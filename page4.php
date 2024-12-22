<?php
session_start();
require 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Fetch user ID from session
$user = $_SESSION['user'];
$userId = $user['user_id'];

// Fetch user data from the database
$stmt = $conn->prepare("SELECT * FROM user WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $userId);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle case where no user is found
if (!$userData) {
    echo "User not found! Please contact support.";
    exit;
}

// Sanitize data for output
$name = htmlspecialchars($userData['name']);
$email = htmlspecialchars($userData['email']);
$photo = !empty($userData['photo']) ? htmlspecialchars($userData['photo']) : 'default-photo.jpg';
$role = htmlspecialchars($userData['role']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSTU-QuickBill</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
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
            margin-top: 0px;
        }

        .button-section .btn {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            font-size: 18px;
            padding: 15px 20px;
            font-family: 'Arial', sans-serif;
            border-radius: 5px;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            border: none;
            color: white;
            font-weight: bold;
        }

        .button-section .btn:hover {
            background-color: black;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .dropdown-menu {
            min-width: 300px;
        }

        .dropdown-menu a {
            color: black;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .footer {
            background: #333;
            color: #e0d3d3;
            padding: 10px 0;
            font-size: 14px;
        }

        .footer a {
            color: hsl(0, 25%, 98%);
        }

        .footer a:hover {
            color: hwb(0 95% 5%);
            text-decoration: none;
        }

        .footer .social-icons a {
            margin: 0 10px;
            color: #fffefe;
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

        @media screen and (max-width: 414px) {
    /* Adjust container width for small devices */
    .container {
        padding: 10px;
    }

    .user-section h2 {
        font-size: 18px;
    }

    .button-section .btn {
        font-size: 14px;
        padding: 10px;
    }

    .footer {
        font-size: 10px;
    }
}

@media screen and (min-width: 1284px) and (max-width: 1290px) and (min-height: 2780px) and (max-height: 2796px) {
    /* Targeting iPhone 15 Pro Max */
    .navbar-custom .navbar-brand img {
        width: 40px;
        height: 40px;
    }

    .user-section h2 {
        font-size: 24px;
    }

    .button-section .btn {
        font-size: 18px;
        padding: 15px;
    }
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
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: white;">
        <span class="navbar-toggler-icon" style="color: #333;"></span>
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

            <!-- User Name and Logout Button (if logged in) -->
            <li class="nav-item">
            <a href="profile.php" style="text-decoration: none;">
                <button class="btn btn-outline-light nav-link" id="userNameButton">
                    <?php echo $name; ?>
                </button>
            </a>

            </li>
            <li class="nav-item">
                <a class="btn btn-outline-light nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 user-section">
                <h2 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                    Hello <?php echo $name; ?>! 
                </h2>
                <h2 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                    Welcome To Nstu_QuickBill
                </h2>
                <p style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                    Sparking a new era in billing system
                </p>
            </div>
        </div>
        <div class="row button-section">
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="createBill()"><a href="createbill.php" class style="color: white;">Create Bill</a></button>
                <!-- <button class="btn btn-primary" onclick="addDocument()"><a href="addDocument.php" class style="color: white;">Add Document</a></button> -->
                <button class="btn btn-primary" onclick="trackBill()"><a href="trackbilllogin.php" class style="color: white;" >Track Bill</a></button>
                <button class="btn btn-primary" onclick="billHistory()"><a href="billhistory.php" class style="color: white;">Bill History</a></button>
            </div>
            <div class="col-md-6 button-image">
                <img src="../GIF/bill2.gif" alt="logo">
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2024 NSTU-QuickBill. All rights reserved.</p>
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
        function createBill() {
            alert('Create Bill button clicked');
        }
        function addDocument() {
            alert('Add Document button clicked');
        }
        function trackBill() {
            alert('Track Bill button clicked');
        }
        function billHistory() {
            alert('Bill History button clicked');
        }
    </script>

    <!-- Sidebar Notification -->
    <!-- <div class="sidebar-notification" id="sidebarNotification">
        <div class="sidebar-notification-header">
            Notification
            <span class="close-sidebar" onclick="closeSidebar()">&times;</span>
        </div>
        <div class="sidebar-notification-body">
            <p id="notificationDetails">Notification details will appear here.</p>
        </div>
    </div> -->

    <script>
        function fetchNotifications() {
            $.ajax({
                url: '/api/notifications/1', // Replace with the appropriate user ID
                method: 'GET',
                success: function (data) {
                    let notificationCount = data.length;
                    $('#notification-count').text(notificationCount);
                    let notificationList = $('#notification-list');
                    notificationList.empty();
                    if (notificationCount > 0) {
                        data.forEach(notification => {
                            notificationList.append('<a class="dropdown-item" href="#" data-notification-id="' + notification.id + '">' + notification.message + '</a>');
                        });
                    } else {
                        notificationList.append('<a class="dropdown-item" href="#">No new notifications</a>');
                    }
                }
            });
        }

        function openSidebar(notificationId) {
            $('#sidebarNotification').addClass('open');
            $('#notificationDetails').text('Loading...');
            // Simulate fetching notification details from an API
            setTimeout(function () {
                $('#notificationDetails').text('Notification ID ' + notificationId + ' details loaded.');
            }, 500); // Adjust timing as per your API response time
        }

        function closeSidebar() {
            $('#sidebarNotification').removeClass('open');
        }

        $(document).ready(function () {
            fetchNotifications();

            // Click event for notification items
            $('#notification-list').on('click', '.dropdown-item', function (e) {
                e.preventDefault();
                let notificationId = $(this).data('notification-id');
                openSidebar(notificationId);
            });

            // Periodic refresh of notifications
            setInterval(fetchNotifications, 30000); // Refresh every 30 seconds
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
