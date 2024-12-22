<?php
// Include database connection
include_once 'db.php'; // Adjust the path to your database connection file

// Fetch exam committees
function getExamCommittees() {
    global $conn;
    try {
        $query = "
            SELECT 
                ec.id, 
                b.batch_no AS batch, 
                ec.term, 
                ec.session, 
                t1.name AS chairman, 
                t2.name AS member1, 
                t3.name AS member2, 
                t4.name AS member3, 
                t5.name AS external_member 
            FROM exam_committee ec
            INNER JOIN batch b ON ec.batch_id = b.id
            INNER JOIN teacher t1 ON ec.chairman = t1.teacher_id
            INNER JOIN teacher t2 ON ec.member1 = t2.teacher_id
            INNER JOIN teacher t3 ON ec.member2 = t3.teacher_id
            INNER JOIN teacher t4 ON ec.member3 = t4.teacher_id
            INNER JOIN teacher t5 ON ec.external_member = t5.teacher_id
        ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

// Handle committee withdrawal
if (isset($_POST['withdraw_id'])) {
    $withdrawId = $_POST['withdraw_id'];
    try {
        // Fetch chairman ID to update the role
        $stmt = $conn->prepare("SELECT chairman FROM exam_committee WHERE id = :id");
        $stmt->bindValue(':id', $withdrawId, PDO::PARAM_INT);
        $stmt->execute();
        $chairmanId = $stmt->fetchColumn();

        if ($chairmanId) {
            // Delete committee
            $deleteStmt = $conn->prepare("DELETE FROM exam_committee WHERE id = :id");
            $deleteStmt->bindValue(':id', $withdrawId, PDO::PARAM_INT);
            $deleteStmt->execute();

            // Update chairman's role to 'user'
            $updateStmt = $conn->prepare("UPDATE user SET role = 'user' WHERE user_id = :id");
            $updateStmt->bindValue(':id', $chairmanId, PDO::PARAM_INT);
            $updateStmt->execute();

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Chairman not found']);
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error withdrawing committee']);
    }
    exit;
}

// Fetch exam committees for display
$committees = getExamCommittees();
?>

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
if ($userData['role'] !== 'director') {
    echo "Access denied. This page is restricted to Directors only.";
    exit;
}

// Sanitize data for output
$name = htmlspecialchars($userData['name']);
$email = htmlspecialchars($userData['email']);
$photo = !empty($userData['photo']) ? htmlspecialchars($userData['photo']) : 'director.jpg';
$role = htmlspecialchars($userData['role']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Committees</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <a class="nav-link" href="director1.php"><i class="fas fa-home"></i> Home</a>
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
    <h1 class="text-center">Exam Committees</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Batch</th>
            <th>Term</th>
            <th>Session</th>
            <th>Chairman</th>
            <th>Member 1</th>
            <th>Member 2</th>
            <th>Member 3</th>
            <th>External Member</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($committees as $committee): ?>
            <tr>
                <td><?= htmlspecialchars($committee['batch']) ?></td>
                <td><?= htmlspecialchars($committee['term']) ?></td>
                <td><?= htmlspecialchars($committee['session']) ?></td>
                <td><?= htmlspecialchars($committee['chairman']) ?></td>
                <td><?= htmlspecialchars($committee['member1']) ?></td>
                <td><?= htmlspecialchars($committee['member2']) ?></td>
                <td><?= htmlspecialchars($committee['member3']) ?></td>
                <td><?= htmlspecialchars($committee['external_member']) ?></td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="withdrawCommittee(<?= $committee['id'] ?>)">Withdraw</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
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

<script>
function withdrawCommittee(id) {
    if (confirm('Are you sure you want to withdraw this committee?')) {
        $.ajax({
            url: '',
            method: 'POST',
            data: { withdraw_id: id },
            success: function (response) {
                const data = JSON.parse(response);
                if (data.success) {
                    alert('Committee withdrawn successfully!');
                    location.reload(); // Reload page to reflect changes
                } else {
                    alert('Failed to withdraw committee: ' + (data.message || 'Unknown error'));
                }
            },
            error: function () {
                alert('Error withdrawing committee.');
            }
        });
    }
}
</script>
</body>
</html>
