<?php
session_start();
require 'db.php'; // Database connection
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['send_reset_code'])) {
        $email = trim($_POST['email']);
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate a random reset code
            $reset_token = rand(100000, 999999);

            // Save reset code in the database
            $stmt = $conn->prepare("UPDATE user SET reset_token = :reset_token WHERE email = :email");
            $stmt->bindParam(':reset_token', $reset_token);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Send the reset code via email
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0; // Disable verbose debug output
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'serverns787@gmail.com'; // Your email
                $mail->Password = 'jgtsmdiaxtxajgaz'; // Your email password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('your_email@example.com', 'QuickBill System');
                $mail->addAddress($email);
                $mail->Subject = 'Password Reset Code';
                $mail->Body = "Your password reset code is: $reset_token";

                $mail->send();

                // Store email and reset code session
                $_SESSION['email'] = $email;
                $_SESSION['reset_verified'] = false;

                // Redirect to verify reset code page
                header('Location: verify_reset_code.php');
                exit;  // Stop further execution after redirection
            } catch (Exception $e) {
                $message = "Email could not be sent. Error: " . $mail->ErrorInfo;
            }
        } else {
            $message = "Email not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
    <h2>Forgot Password</h2>
    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
    <form action="forgot_password.php" method="POST">
        <div class="form-group">
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <button type="submit" name="send_reset_code" class="btn">Send Reset Code</button>
    </form>
</div>
</body>
</html>
