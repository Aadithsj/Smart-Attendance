<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['student_id'];
    $encoding = $_POST['encoding'];
    $timestamp = date('Y-m-d H:i:s');
    
    // Insert the student ID and encoding data into the face_recognition table
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
    
    $stmt = $conn->prepare("INSERT INTO face_recognition (student_id, face_encoding, created_at, updated_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $studentID, $encoding, $timestamp, $timestamp);
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
    echo json_encode(['message' => 'Data uploaded successfully']);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}

?>
