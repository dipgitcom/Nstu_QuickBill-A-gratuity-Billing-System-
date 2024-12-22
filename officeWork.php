<?php
header('Content-Type: application/json');

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quickbill"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Retrieve JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Invalid data received."]);
    exit;
}

// Prepare SQL statement
$stmt = $conn->prepare("
    INSERT INTO office (batch, term, courseCode, courseTeacher, shareCourseTeacher)
    VALUES (?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Error preparing statement: " . $conn->error]);
    exit;
}

// Iterate through the data and insert each record
foreach ($data as $row) {
    $batch = $row['batch'];
    $term = $row['term'];
    $courseCode = $row['courseCode'];
    $courseTeacher = $row['courseTeacher'];
    $shareCourseTeacher = $row['shareCourseTeacher'];

    $stmt->bind_param("sssss", $batch, $term, $courseCode, $courseTeacher, $shareCourseTeacher);

    if (!$stmt->execute()) {
        echo json_encode(["success" => false, "message" => "Error inserting data: " . $stmt->error]);
        exit;
    }
}

// Close statement and connection
$stmt->close();
$conn->close();

echo json_encode(["success" => true, "message" => "Data saved successfully."]);
?>
