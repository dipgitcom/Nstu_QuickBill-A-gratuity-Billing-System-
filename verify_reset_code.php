<?php
session_start();
require 'db.php'; // Database connection

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['verify_reset_code'])) {
        $reset_token = trim($_POST['reset_code']);
        $email = $_SESSION['email'];

        // Query to check if the reset token matches for the provided email
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email AND reset_token = :reset_token");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':reset_token', $reset_token);
        $stmt->execute();

        // If the reset code is valid, proceed to reset password
        if ($stmt->rowCount() > 0) {
            $_SESSION['reset_verified'] = true;
            $_SESSION['reset_token'] = $reset_token; // Store reset token in session
            // Redirect to reset password page
            header('Location: reset_password.php');
            exit; // Ensure the rest of the script doesn't execute after redirect
        } else {
            $message = "Invalid reset code.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Reset Code</title>
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
    <h2>Verify Reset Code</h2>
    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
    <form action="verify_reset_code.php" method="POST">
        <div class="form-group">
            <input type="text" name="reset_code" placeholder="Enter your reset code" required>
        </div>
        <button type="submit" name="verify_reset_code" class="btn">Verify Reset Code</button>
    </form>
</div>
</body>
</html>
