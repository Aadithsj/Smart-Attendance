<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$action_type = $_POST['action_type'];

if ($action_type == 'add') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO users (email, password,role_id,created_at,updated_at) VALUES ('".$email."', '".$password."',2,Now(),Now())";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($action_type == 'delete') {
    $userid = $_POST['userid'];
    
    // delete from users table
    $sql = "DELETE FROM users WHERE id=".$userid;
    if ($conn->query($sql) !== TRUE) {
      echo "Error deleting from users: " . $sql . "<br>" . $conn->error;
    }

    // // delete from teachers table
    // $sql = "DELETE FROM teachers WHERE user_id=".$userid;
    // if ($conn->query($sql) !== TRUE) {
    //   echo "Error deleting from teachers: " . $sql . "<br>" . $conn->error;
    // }

    // // delete from students table
    // $sql = "DELETE FROM students WHERE user_id=".$userid;
    // if ($conn->query($sql) !== TRUE) {
    //   echo "Error deleting from students: " . $sql . "<br>" . $conn->error;
    // }

    // // delete from parents table
    // $sql = "DELETE FROM parents WHERE user_id=".$userid;
    // if ($conn->query($sql) !== TRUE) {
    //   echo "Error deleting from parents: " . $sql . "<br>" . $conn->error;
    // }

    // // delete from attendance table
    // $sql = "DELETE FROM attendance WHERE student_id=".$userid;
    // if ($conn->query($sql) !== TRUE) {
    //   echo "Error deleting from attendance: " . $sql . "<br>" . $conn->error;
    // }

    // // delete from face_recognition table
    // $sql = "DELETE FROM face_recognition WHERE student_id=".$userid;
    // if ($conn->query($sql) !== TRUE) {
    //   echo "Error deleting from face_recognition: " . $sql . "<br>" . $conn->error;
    // }

    echo "Record deleted successfully";
}

header( "refresh:2;url=../admin/admin menu.html" );


$conn->close();
?>
