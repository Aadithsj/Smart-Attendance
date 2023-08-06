<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['student_id'];
    $encoding = $_POST['encoding'];
    $timestamp = date('Y-m-d H:i:s');
    
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sap";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection error: ' . $conn->connect_error]);
        die();
    }
    
    // Check if the student ID already exists in the face_recognition table
    $stmt = $conn->prepare("SELECT COUNT(*) FROM face_recognition WHERE student_id = ?");
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    if ($count > 0) {
        // Update the existing face record for the student
        $stmt = $conn->prepare("UPDATE face_recognition SET face_encoding = ?, updated_at = ? WHERE student_id = ?");
        $stmt->bind_param("sss", $encoding, $timestamp, $studentID);
        $stmt->execute();

        if ($conn->errno) {
            http_response_code(500);
            echo json_encode(['error' => 'Database error: ' . $conn->error]);
            die();
        }

        $stmt->close();
        $conn->close();

        // Send a JSON response indicating success
        http_response_code(200);
        echo json_encode(['message' => 'Data updated successfully']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Student ID not found']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}

?>