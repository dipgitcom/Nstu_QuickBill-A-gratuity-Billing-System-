<?php
session_start();
require 'db.php';

// Ensure user is logged in
if (!isset($_SESSION['user']['email']) || !isset($_SESSION['user']['name'])) {
    header('Location: login.php');
    exit;
}

$email = $_SESSION['user']['email'];
$name = $_SESSION['user']['name'];

// Fetch terms from the exam_committee table
function getExamTerms($name) {
    global $conn;
    try {
        $query = "SELECT DISTINCT term FROM exam_committee WHERE name = :name";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching exam terms: " . $e->getMessage());
        return [];
    }
}

// Fetch assigned courses for the logged-in teacher
function getAssignedCourses($teacher_id) {
    global $conn;
    try {
        $query = "
            SELECT c.course_id, c.code, c.name 
            FROM assign_course ac
            JOIN course c ON ac.course_id = c.course_id
            WHERE ac.teacher_id = :teacher_id";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching assigned courses: " . $e->getMessage());
        return [];
    }
}

// Fetch teacher details
function getTeacherDetails($email, $name) {
    global $conn;
    try {
        $query = "SELECT * FROM teacher WHERE email = :email OR name = :name";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching teacher details: " . $e->getMessage());
        return null;
    }
}

// Fetch teacher details
$teacher = getTeacherDetails($email, $name);

if (!$teacher) {
    header('Location: error.php?message=Teacher not found');
    exit;
}

$teacher_id = $teacher['teacher_id'];
$exam_terms = getExamTerms($name);
$courses = getAssignedCourses($teacher_id);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Your Bill - NSTU QuickBill</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #ece9e6, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
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

        header h3 {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table thead th {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #fff;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .form-control {
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: box-shadow 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(32, 219, 194, 0.5);
            border-color: #20dbc2;
        }

        .btn-primary {
            background-color: #20dbc2;
            border: none;
            font-weight: bold;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0bb5a2;
        }

        .modal-content {
            text-align: center;
            border-radius: 8px;
        }

        .next-button-container .btn {
            background-color: #20dbc2;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .next-button-container .btn:hover {
            background-color: #0bb5a2;
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

    <!-- Header -->
    <header>
        <h3>Enter Your Bill Here:</h3>
    </header>

    <!-- Main Content -->
    <main class="container">
        <form>
            <!-- Personal and Exam Details -->
            <table class="table table-bordered">
                <tr>
                    <th>পরীক্ষকের নাম</th>
                    <td><input type="text" class="form-control" name="examiner_name" value="<?= htmlspecialchars($teacher['name']) ?>" readonly></td>
                    <th>বর্ষ</th>
                    <td><input type="number" class="form-control" name="year"></td>
                </tr>
                <tr>
                    <th>টার্ম</th>
                    <td>
                        <select class="form-control" name="term">
                            <option value="" disabled selected>Choose Term</option>
                            <?php foreach ($exam_terms as $term) : ?>
                                <option value="<?= htmlspecialchars($term['term']) ?>"><?= htmlspecialchars($term['term']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <th>পরীক্ষার সাল</th>
                    <td><input type="number" class="form-control" name="exam_year"></td>
                </tr>
            </table>

            <!-- Question Preparation -->
            <h4>১. প্রশ্নপত্র প্রণয়ন</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Hour</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control" name="course_code_1">
                                <option value="" disabled selected>Choose Course</option>
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['code']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="course_title_1">
                                <option value="" disabled selected>Choose Course</option>
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="hour_1"></td>
                    </tr>
                </tbody>
            </table>

            <h4>২. প্রশ্নের সমন্বয় সমাধান</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Codes</th>
                        <th># of Questions</th>
                        <th># of Members</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select multiple class="form-control" name="question_course_codes[]">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['code']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="number_of_questions"></td>
                        <td><input type="number" class="form-control" name="number_of_members"></td>
                    </tr>
                </tbody>
            </table>
            <h4>৩. ক্লাস টেস্ট</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th># of Students</th>
                        <th># of Tests</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control" name="class_test_course_code">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['code']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="class_test_course_title">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="class_test_students"></td>
                        <td><input type="number" class="form-control" name="class_test_tests"></td>
                    </tr>
                </tbody>
            </table>
            <h4>৪. উত্তর পত্র মূল্যায়ন</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Hour</th>
                        <th># of Students</th>
                        <th>Amount per Script</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control" name="evaluation_course_code">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['code']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="evaluation_course_title">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="evaluation_hour"></td>
                        <td><input type="number" class="form-control" name="evaluation_students"></td>
                        <td><input type="number" class="form-control" name="evaluation_amount"></td>
                    </tr>
                </tbody>
            </table>
            <h4>৫. ব্যবহারিক পরীক্ষা</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th># of Days</th>
                        <th># of Groups</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control" name="practical_course_code_1">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['code']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="practical_course_title_1">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="practical_days_1"></td>
                        <td><input type="number" class="form-control" name="practical_groups_1"></td>
                    </tr>
                </tbody>
            </table>
            <h4>৬. মৌখিক পরীক্ষা</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th># of Panels</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control" name="oral_course_code_1">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['code']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="oral_course_title_1">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="oral_panels_1"></td>
                    </tr>
                </tbody>
            </table>
            <h4>৭. পরীক্ষার ফল সন্নিবেশ করণ</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Codes</th>
                        <th># of Students</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select multiple class="form-control" name="result_course_codes[]">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['code']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="result_students"></td>
                    </tr>
                </tbody>
            </table>
            <h4>৮. উত্তরের পুনর্মূল্যায়ন</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Codes</th>
                        <th># of Students</th>
                        <th># of Courses</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select multiple class="form-control" name="revaluation_course_codes[]">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= htmlspecialchars($course['course_id']) ?>"><?= htmlspecialchars($course['code']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="revaluation_students"></td>
                        <td><input type="number" class="form-control" name="revaluation_courses"></td>
                    </tr>
                </tbody>
            </table>
            <h4>৯. পরীক্ষার পরিষদের সভাপতি / সদস্য(সম্মানি ভাতা)</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <textarea class="form-control" name="committee_honorarium_details" rows="3" placeholder="Enter details..."></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Repeat similar dropdown logic for other sections -->

            <!-- Submit Button -->
            <div class="next-button-container">
    <button type="button" class="btn btn-primary" onclick="redirectToPage()">Submit</button>
</div>

<script>
    function redirectToPage() {
        window.location.href = "invoice.php";
    }
</script>

        </form>
    </main>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>


</html>