<?php
// Database connection
include 'db_connection.php';

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted data
    $face_encodings = json_decode($_POST['face_encodings']);

    // Find the student with the most similar face encoding
    $sql = "SELECT student_id, face_encoding FROM face_recognition";
    $result = $conn->query($sql);
    $best_student_id = null;
    $best_similarity = 0;

    while ($row = $result->fetch_assoc()) {
        $db_face_encoding = json_decode($row['face_encoding']);
        $similarity = face_recognition_compare($face_encodings, $db_face_encoding);

        if ($similarity > $best_similarity) {
            $best_similarity = $similarity;
            $best_student_id = $row['student_id'];
        }
    }

    // Mark attendance for the student
    if ($best_student_id !== null && $best_similarity > 0.6) { // 0.6 is the similarity threshold
        $teacher_id = $_POST['teacher_id'];
        $date = date('Y-m-d');
        $time_in = date('H:i:s');

        $sql = "INSERT INTO attendance (student_id, teacher_id, date, time_in) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $best_student_id, $teacher_id, $date, $time_in);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["status" => "success", "message" => "Attendance marked successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "No matching student found."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}

// Function to compare two face encodings
function face_recognition_compare($face_encoding1, $face_encoding2) {
    // Compute the Euclidean distance between the two encodings
    $distance = 0;
    for ($i = 0; $i < count($face_encoding1); $i++) {
        $distance += pow($face_encoding1[$i] - $face_encoding2[$i], 2);
   
    }
    $distance = sqrt($distance);

    // Compute the similarity score (0-1) between the two encodings
    $similarity = 1 - ($distance / sqrt(2));

    return $similarity;
}
?>
