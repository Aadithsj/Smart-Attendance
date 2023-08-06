<?php
include('header.php');

if (isset($_POST['submit_mult'])) {{
  // Retrieve selected record IDs from checkboxes
  $selectedIDs = isset($_POST['selector']) ? $_POST['selector'] : [];
  $courseID = isset($_POST['course_id']) ? strtoupper($_POST['course_id']) : '';


  if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    echo "User ID: " . $user_id;
} else {
    echo "User ID cookie not set.";
}
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "sap";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $teacherId = '';
  $sql = "SELECT teacher_id FROM teachers WHERE mail = '$user_id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $teacherId = $row['teacher_id'];
  } else {
    echo "Teacher ID not found.";
  }
  // Insert selected record IDs into attendance table
  foreach ($selectedIDs as $id) {
    $id = intval($id); // Convert to integer for security

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO `attendance`(`id`,  `teacher_id`, `date`, `course_id`, `attendance`) VALUES ($id,' $teacherId',NOW(),'$courseID','P');";
    if ($conn->query($sql) !== TRUE) 
      echo "Error inserting record ID $id into attendance table: " . $conn->error;
    }
  }

  // Check for unselected records and insert them as absent in the attendance table
  $unselectedIDs = array_diff(getAllStudentIDs(), $selectedIDs);
  foreach ($unselectedIDs as $id) {
    $id = intval($id); // Convert to integer for security

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO `attendance`(`id`,  `teacher_id`, `date`, `course_id`, `attendance`) VALUES ($id,' $teacherId ',NOW(),'$courseID','A');";
    if ($conn->query($sql) !== TRUE) {
      echo "Error inserting absent record for ID $id into attendance table: " . $conn->error;
    }
  }

  // Close the database connection
  $conn->close();

  // Redirect back to main.php with success message as a query parameter
  header("Location: teacher-student-view.php?success=1");
  exit();
}

// Helper function to retrieve all student IDs
// Helper function to retrieve all student IDs
function getAllStudentIDs() {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "sap";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $myVariable = $_SESSION['user_id'];

  // Use the retrieved session variable
  echo "The value of myVariable is: " . $myVariable;
  // Retrieve all student IDs from the students table
  $sql = "SELECT `user_id` FROM `students`";
  $result = $conn->query($sql);

  $studentIDs = [];
  while ($row = $result->fetch_assoc()) {
    $studentIDs[] = $row['user_id'];
  }

  // Close the database connection
  $conn->close();

  return $studentIDs;
}

?>
