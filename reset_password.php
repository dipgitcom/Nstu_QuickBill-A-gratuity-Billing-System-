<?php
session_start();
require 'db.php'; // Database connection

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['set_new_password'])) {
    if ($_SESSION['reset_verified'] === true) {
        // Get the new password from the form
        $password = trim($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $email = $_SESSION['email'];

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE user SET password = :password, reset_token = NULL WHERE email = :email");
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Clear session data after successful password reset
        unset($_SESSION['email'], $_SESSION['reset_verified']);

        // Set the success message in the query parameter for the login page
        header('Location: login.php?message=Password+reset+successfully');
        exit; // Ensure the rest of the code does not execute after redirection
    } else {
        $message = "Please verify your reset code first.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .message {
            margin: 15px 0;
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Set New Password</h2>
    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
    <form action="reset_password.php" method="POST">
        <div class="form-group">
            <input type="password" name="password" placeholder="Enter your new password" required>
        </div>
        <button type="submit" name="set_new_password" class="btn">Set New Password</button>
    </form>
</div>
</body>
</html>
