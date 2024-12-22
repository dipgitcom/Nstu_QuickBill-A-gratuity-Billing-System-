<?php
// Include database connection
include_once 'db.php';

// Handle POST request to save committee data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data) || !isset($data['committee'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid data received']);
        exit;
    }

    try {
        $conn->beginTransaction();

        // Insert into exam_committee table
        $query = "INSERT INTO exam_committee (batch_id, term, session, chairman, member1, member2, member3, external_member) 
                  VALUES (:batch, :term, :session, :chairman, :member1, :member2, :member3, :external_member)";
        $stmt = $conn->prepare($query);

        // Bind values from the received data
        $stmt->bindValue(':batch', $data['batch'], PDO::PARAM_INT);
        $stmt->bindValue(':term', $data['term'], PDO::PARAM_STR);
        $stmt->bindValue(':session', $data['session'], PDO::PARAM_STR);
        $stmt->bindValue(':chairman', $data['committee']['Chairman'], PDO::PARAM_INT);
        $stmt->bindValue(':member1', $data['committee']['Member 1'], PDO::PARAM_INT);
        $stmt->bindValue(':member2', $data['committee']['Member 2'], PDO::PARAM_INT);
        $stmt->bindValue(':member3', $data['committee']['Member 3'], PDO::PARAM_INT);
        $stmt->bindValue(':external_member', $data['committee']['External Member'], PDO::PARAM_INT);

        $stmt->execute();

        // Update the role for the chairman in the user table
        if (!empty($data['committee']['Chairman'])) {
            $updateRoleQuery = "UPDATE user SET role = 'exam' WHERE user_id = :teacher_id";
            $updateRoleStmt = $conn->prepare($updateRoleQuery);
            $updateRoleStmt->bindValue(':teacher_id', $data['committee']['Chairman'], PDO::PARAM_INT);
            $updateRoleStmt->execute();
        }

        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        $conn->rollBack();
        error_log("Database error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error saving data: ' . $e->getMessage()]);
    }

    exit;
}
