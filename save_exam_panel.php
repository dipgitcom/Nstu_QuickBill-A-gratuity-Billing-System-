<?php
// Include database connection
include_once 'db.php'; // Adjust the path to your database connection file

// Get the POST data
$batch = isset($_POST['batch']) ? $_POST['batch'] : null;
$year = isset($_POST['year']) ? $_POST['year'] : null;
$term = isset($_POST['term']) ? $_POST['term'] : null;
$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
$examiners = isset($_POST['examiners']) ? $_POST['examiners'] : [];

header('Content-Type: application/json');

if (!$batch || !$year || !$term || !$course_id || count($examiners) != 4) {
    echo json_encode(['success' => false, 'message' => 'Please fill all required fields.']);
    exit;
}

try {
    // Insert the exam panel data into the `exam_panels` table
    $query = "INSERT INTO exam_panels (batch, year, term, ac_id, first_examiner, second_examiner, third_examiner, external_examiner)
              VALUES (:batch, :year, :term, :ac_id, :first_examiner, :second_examiner, :third_examiner, :external_examiner)";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':batch', $batch, PDO::PARAM_STR);
    $stmt->bindValue(':year', $year, PDO::PARAM_INT);
    $stmt->bindValue(':term', $term, PDO::PARAM_INT);
    $stmt->bindValue(':ac_id', $course_id, PDO::PARAM_INT);
    $stmt->bindValue(':first_examiner', $examiners[0], PDO::PARAM_INT);
    $stmt->bindValue(':second_examiner', $examiners[1], PDO::PARAM_INT);
    $stmt->bindValue(':third_examiner', $examiners[2], PDO::PARAM_INT);
    $stmt->bindValue(':external_examiner', $examiners[3], PDO::PARAM_INT);
    
    $stmt->execute();
    
    echo json_encode(['success' => true, 'message' => 'Exam panel saved successfully!']);
} catch (PDOException $e) {
    // Handle error and return a failure message
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Failed to save exam panel.']);
}
?>
