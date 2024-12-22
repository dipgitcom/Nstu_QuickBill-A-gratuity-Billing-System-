<?php
session_start();
require 'db.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Get user data from session
$user = $_SESSION['user'];
$userId = $user['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'];
        $photo = $_FILES['photo'];
        $uploadDir = 'uploads/';

        // Handle file upload
        if ($photo['tmp_name']) {
            // Generate a unique name for the uploaded file
            $photoPath = $uploadDir . uniqid() . "_" . basename($photo['name']);
            if (!move_uploaded_file($photo['tmp_name'], $photoPath)) {
                throw new Exception("Failed to upload the photo.");
            }
        } else {
            $photoPath = $user['photo']; // Keep the existing photo if no new file is uploaded
        }

        // Update user information in the database
        $stmt = $conn->prepare("UPDATE user SET name = :name, photo = :photo WHERE user_id = :user_id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':photo', $photoPath);
        $stmt->bindParam(':user_id', $userId);

        if ($stmt->execute()) {
            // Update session data
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['photo'] = $photoPath;

            // Redirect to profile page
            header('Location: profile.php');
            exit;
        } else {
            throw new Exception("Failed to update user data.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Pre-fill the form with current user data
$name = $user['name'];
$email = $user['email'];
$photo = $user['photo'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href = " style.css" >

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
    
    <div class="container mt-5">
        <h2>Edit Profile</h2>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email (fixed)</label>
                <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Profile Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
                <?php if ($photo) : ?>
                    <img src="<?php echo htmlspecialchars($photo); ?>" alt="Current Photo" style="width: 100px; margin-top: 10px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
