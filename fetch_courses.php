<?php
$conn = new mysqli("localhost", "username", "password", "database");
$data = json_decode(file_get_contents("php://input"), true);

$batch = $data['batch'];
$year = $data['year'];
$term = $data['term'];

$courses = $conn->query("SELECT code, name FROM courses WHERE year = $year AND term = $term")->fetch_all(MYSQLI_ASSOC);
$teachers = $conn->query("SELECT id, name FROM teachers")->fetch_all(MYSQLI_ASSOC);

echo json_encode(['courses' => $courses, 'teachers' => $teachers]);
?>
