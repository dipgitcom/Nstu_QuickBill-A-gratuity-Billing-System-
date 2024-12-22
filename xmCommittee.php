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
    <title>Exam Committee Assignment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href = " style.css" >
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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


<!-- Debugging -->
<?php
if (isset($_SESSION['user_id'])) {
    echo "<script>console.log('User is logged in: " . $_SESSION['user_id'] . "');</script>";
} else {
    echo "<script>console.log('User is not logged in');</script>";
}
?>




<div class="container mt-5">
    <h1 class="text-center">Assign Exam Committee</h1>

    <!-- Batch Selection -->
    <div class="form-group">
        <label for="batch-select">Batch:</label>
        <select id="batch-select" class="form-control" onchange="fetchSession()">
            <option value="" disabled selected>Select Batch</option>
            <?php
            include 'db.php';
            $batches = $conn->query("SELECT id, batch_no, session FROM batch")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($batches as $batch) {
                echo "<option value='{$batch['id']}' data-session='{$batch['session']}'>{$batch['batch_no']}</option>";
            }
            ?>
        </select>
    </div>

    <!-- Term Selection -->
    <div class="form-group">
        <label for="term-select">Term:</label>
        <select id="term-select" class="form-control">
            <option value="" disabled selected>Select Term</option>
            <option value="1-1">1-1</option>
            <option value="1-2">1-2</option>
            <option value="2-1">2-1</option>
            <option value="2-2">2-2</option>
            <option value="3-1">3-1</option>
            <option value="3-2">3-2</option>
            <option value="4-1">4-1</option>
            <option value="4-2">4-2</option>
        </select>
    </div>

    <!-- Session (Auto-filled) -->
    <div class="form-group">
        <label for="session-input">Session:</label>
        <input type="text" id="session-input" class="form-control" readonly>
    </div>

    <!-- Committee Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $roles = ['Chairman', 'Member 1', 'Member 2', 'Member 3', 'External Member'];
            $teachers = $conn->query("SELECT teacher_id, name FROM teacher")->fetchAll(PDO::FETCH_ASSOC);

            foreach ($roles as $role) {
                echo "<tr>
                    <td>{$role}</td>
                    <td>
                        <select class='form-control teacher-select'>
                            <option value='' disabled selected>Select Teacher</option>";
                foreach ($teachers as $teacher) {
                    echo "<option value='{$teacher['teacher_id']}'>{$teacher['name']}</option>";
                }
                echo "</select>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Save Button -->
    <button class="btn btn-success btn-block" onclick="saveData()">Save Committee</button>
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
    function fetchSession() {
        const batchSelect = document.getElementById('batch-select');
        const selectedOption = batchSelect.options[batchSelect.selectedIndex];
        const session = selectedOption.getAttribute('data-session');
        document.getElementById('session-input').value = session || '';
    }

    function saveData() {
        const batch = $('#batch-select').val();
        const term = $('#term-select').val();
        const session = $('#session-input').val();

        if (!batch || !term || !session) {
            alert('Please select batch, term, and ensure session is filled.');
            return;
        }

        const committee = {};
        let allRolesFilled = true;

        $('.teacher-select').each(function () {
            const role = $(this).closest('tr').find('td:first').text();
            const teacherId = $(this).val();

            if (!teacherId) {
                allRolesFilled = false;
            } else {
                if (Object.values(committee).includes(teacherId)) {
                    alert('A teacher cannot be assigned to multiple roles.');
                    throw 'Duplicate teacher selection';
                }
                committee[role] = teacherId;
            }
        });

        if (!allRolesFilled) {
            alert('All roles must be filled.');
            return;
        }

        $.ajax({
            url: 'save_exam_committee.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                batch: batch,
                term: term,
                session: session,
                committee: committee
            }),
            success: function (response) {
                const data = JSON.parse(response);
                if (data.success) {
                    alert('Committee assigned successfully!');
                } else {
                    alert('Failed to assign committee: ' + data.message);
                }
            },
            error: function () {
                alert('Error saving data.');
            }
        });
    }
</script>
</body>
</html>
