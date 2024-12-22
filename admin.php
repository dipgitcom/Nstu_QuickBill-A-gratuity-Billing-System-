<?php
// Start session
session_start();

// Include database connection
require 'db.php';

// Validate if the logged-in user is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php'); // Redirect to login if not an admin
    exit;
}

// Handle form submissions (Add, Update, Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;
    $userId = $_POST['user_id'] ?? null;

    try {
        if ($action === 'add' && $name && $email && $role) {
            $query = "INSERT INTO user (name, email, role) VALUES (:name, :email, :role)";
            $stmt = $conn->prepare($query);
            $stmt->execute(['name' => $name, 'email' => $email, 'role' => $role]);
        } elseif ($action === 'update' && $userId && $name && $email && $role) {
            $query = "UPDATE user SET name = :name, email = :email, role = :role WHERE user_id = :user_id";
            $stmt = $conn->prepare($query);
            $stmt->execute(['name' => $name, 'email' => $email, 'role' => $role, 'user_id' => $userId]);
        } elseif ($action === 'delete' && $userId) {
            $query = "DELETE FROM user WHERE user_id = :user_id";
            $stmt = $conn->prepare($query);
            $stmt->execute(['user_id' => $userId]);
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
}

// Fetch users
$users = [];
try {
    $stmt = $conn->query("SELECT user_id, name, email, role FROM user");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
}
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

// Handle adding a new user and sending notification email
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add') {
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;

    if ($name && $email && $role) {
        try {
            // Insert the user into the database
            $query = "INSERT INTO user (name, email, role, verification_status) VALUES (:name, :email, :role, 0)";
            $stmt = $conn->prepare($query);
            $stmt->execute(['name' => $name, 'email' => $email, 'role' => $role]);

            // Generate a verification link
            $verificationLink = "http://yourdomain.com/set_password.php?email=" . urlencode($email);

            // Send notification email
            sendUserAddedEmail($name, $email, $verificationLink);

            echo "User added successfully and email sent.";
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            echo "Error adding user.";
        }
    } else {
        echo "All fields are required.";
    }
}

// Function to send notification email
function sendUserAddedEmail($name, $email, $verificationLink)
{
    $mail = new PHPMailer(true);
    try {
        // SMTP server configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'serverns787@gmail.com';
        $mail->Password = 'jgtsmdiaxtxajgaz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('your_email@example.com', 'NSTU QuickBill System');
        $mail->addAddress($email, $name);

        // Email content
        $mail->Subject = 'Welcome to QuickBill System';
        $mail->Body = "Hello $name,\n\nYou have been added to the QuickBill system. Please verify your email and set your password to log in:\n\n$verificationLink\n\nThank you,\nNSTU QuickBill Team";

        $mail->send();
    } catch (Exception $e) {
        error_log("Email error: " . $mail->ErrorInfo);
        echo "Error sending email.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - NSTU QuickBill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
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
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer a {
            color: #f8d210;
        }

        .footer a:hover {
            color: #ff9f1c;
            text-decoration: none;
        }

        .container {
            margin-top: 50px;
        }

        .btn-danger, .btn-success {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">NSTU QuickBill</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-5">User Management</h1>

        <!-- Add User Form -->
        <div class="card mb-4">
            <div class="card-header">Add User</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="action" value="add">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-md-4">
                            <select name="role" class="form-control" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="user">User</option>
                                <option value="exam">Exam</option>
                                <option value="admin">Admin</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>

        <!-- User List -->
        <h2>Existing Users</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <!-- Update Form -->
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                            <select name="role" required>
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                <option value="exam" <?= $user['role'] === 'exam' ? 'selected' : '' ?>>Exam</option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="office" <?= $user['role'] === 'office' ? 'selected' : '' ?>>Office</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </form>

                        <!-- Delete Form -->
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <p>&copy; 2024 NSTU QuickBill. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>