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

// Restrict access to Director role
if ($userData['role'] !== 'office') {
    echo "Access denied. This page is restricted to Directors only.";
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
        body {
    background-image: url('data.png'); /* Replace with your image path */
    background-size: cover; /* Ensures the image covers the entire page */
    background-repeat: no-repeat; /* Prevents the image from repeating */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Keeps the image fixed during scroll */
    font-family: 'Arial', sans-serif;
    color: #333; /* Optional: Ensures text color is readable over the background */
}
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

        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
        }

        .button-section .btn {
            display: inline-block;
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

        footer.footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
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
                <a class="nav-link" href="office1.php"><i class="fas fa-home"></i> Home</a>
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

    <div class="center-content">
        <div class="button-section">
        <button class="btn btn-primary" onclick="redirectToOffice()">Assign Course Teacher</button>

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

    <script>
        function redirectToOffice() {
        window.location.href = 'office.php'; // Redirects to office.php
        }
    </script>

</body>

</html>
