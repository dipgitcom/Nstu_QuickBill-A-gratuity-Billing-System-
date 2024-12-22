<?php
// Include database connection
include_once 'db.php'; // Adjust the path to your database connection file

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $year = isset($_GET['year']) ? intval($_GET['year']) : null;
    $term = isset($_GET['term']) ? intval($_GET['term']) : null;

    if ($year === null || $term === null) {
        echo json_encode(['error' => 'Year and Term are required']);
        exit;
    }

    try {
        // Query to fetch courses based on year and term
        $query = "SELECT ac.course_id, c.course_code 
                  FROM assign_course ac
                  INNER JOIN course c ON ac.course_id = c.id
                  WHERE ac.year = :year AND ac.term = :term";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':year', $year, PDO::PARAM_INT);
        $stmt->bindValue(':term', $term, PDO::PARAM_INT);
        $stmt->execute();

        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the courses as JSON
        echo json_encode($courses);

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo json_encode(['error' => 'Failed to fetch courses']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
