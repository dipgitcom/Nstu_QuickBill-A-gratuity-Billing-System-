<?php
$conn = new mysqli("localhost", "username", "password", "database");
$data = json_decode(file_get_contents("php://input"), true);

$batch = $data['batch'];
$year = $data['year'];
$term = $data['term'];
$courseData = $data['courseData'];

foreach ($courseData as $course) {
    $conn->query("INSERT INTO assign_course (batch_id, course_id, year, term, teacher_id, shared)
                  VALUES ('$batch', '{$course['courseCode']}', '$year', '$term', '{$course['courseTeacher']}', '{$course['shareTeacher']}')");
}

echo json_encode(['success' => true]);
?>
