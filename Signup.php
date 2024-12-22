<?php
session_start();
require 'db.php'; // Database connection
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";

// Clear session on fresh page load
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    unset($_SESSION['email']);
    unset($_SESSION['verified']);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['verify_email'])) {
        $email = trim($_POST['email']);
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['verification_status'] == 1) {
                $message = "This email is already verified. You can set your password or log in.";
            } else {
                $verification_code = rand(100000, 999999);
                $stmt = $conn->prepare("UPDATE user SET verification_code = :code WHERE email = :email");
                $stmt->bindParam(':code', $verification_code);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'serverns787@gmail.com';
                    $mail->Password = 'jgtsmdiaxtxajgaz';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('your_email@example.com', 'QuickBill System');
                    $mail->addAddress($email);
                    $mail->Subject = 'Email Verification Code';
                    $mail->Body = "Your verification code is: $verification_code";

                    $mail->send();
                    $_SESSION['email'] = $email;
                    $_SESSION['verified'] = false;
                    $message = "Verification code sent to your email. Please enter the code.";
                } catch (Exception $e) {
                    $message = "Email could not be sent. Error: " . $mail->ErrorInfo;
                }
            }
        } else {
            $message = "Email not found in our system.";
        }
    } elseif (isset($_POST['submit_code'])) {
        $code = trim($_POST['verification_code']);
        $email = $_SESSION['email'] ?? '';
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email AND verification_code = :code");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':code', $code);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt = $conn->prepare("UPDATE user SET verification_status = 1 WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $_SESSION['verified'] = true;
            $message = "Verification successful. Please set your password.";
        } else {
            $message = "Invalid verification code.";
        }
    } elseif (isset($_POST['set_password'])) {
        if ($_SESSION['verified'] === true) {
            $password = trim($_POST['password']);
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE user SET password = :password WHERE email = :email");
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':email', $_SESSION['email']);
            $stmt->execute();

            unset($_SESSION['email'], $_SESSION['verified']);
            $message = "Password set successfully! You can now log in.";
            header('Location: login.php?message=Password+set+successfully');
            exit;
        } else {
            $message = "Unauthorized action. Please verify your email first.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup & Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ECEBDE;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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

        .container {
            margin: 50px auto;
            max-width: 450px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .btn {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            border: none;
            color: #ffffff;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
        }

        .btn:hover {
            background: linear-gradient(to left, #ff7e5f, #feb47b);
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
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="../images/Logo.png" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
            NSTU-Quickbill
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: white;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                    <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Email Verification</h2>
        <?php if (!empty($message)) : ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="Signup.php" method="POST">
            <?php if (!isset($_SESSION['email'])) : ?>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <button type="submit" name="verify_email" class="btn btn-gradient w-100">Send Verification Code</button>
            <?php elseif (!$_SESSION['verified']) : ?>
                <div class="mb-3">
                    <input type="text" name="verification_code" class="form-control" placeholder="Enter verification code" required>
                </div>
                <button type="submit" name="submit_code" class="btn btn-gradient w-100">Verify Code</button>
            <?php else : ?>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Set your password" required>
                </div>
                <button type="submit" name="set_password" class="btn btn-gradient w-100">Set Password</button>
            <?php endif; ?>
        </form>
    </div>

    <footer class="footer">
        <div class="text-center">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
