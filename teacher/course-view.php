<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Teacher menu</title>


    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <script src="https://kit.fontawesome.com/b8c6c27289.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Merienda+One&family=Permanent+Marker&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/main.min.css">
    <!-- fonts -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Yesteryear&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/2312f8d79b.js"></script><script src="https://use.fontawesome.com/2312f8d79b.js"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<style>
table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid #000;
}

th, td {
  padding: 8px;
}

table.dark-bordered {
  border-color: #000;
}
#example {
        width: 140%;
padding-left:100px;
    }

table.dark-bordered th,
table.dark-bordered td {
  border-color: #000;
}
</style></head>

<body>

    <!-- navbar -->
    <div id="navbox">
        <br>
        <nav class="navbar navbar-expand-lg navbar-light "><br>
            <h2>
                <a href="../index.html" style="text-decoration: none; color:royalblue"><img style="margin-top: -30x;margin-left: 30px;" src="../images/hom.png" height="70px"></a>

            </h2>
            <span style="margin-top:-5px;font-size: 33px;font-weight: bold; color:royalblue;">SMART ATTENDANCE PORTAL</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item" style="align-items: right;">
                        <a class="nav-link" href="teacher_menu.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:asvanthc@gmail.com">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Logout</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                </form>
            </div>
        </nav>
        <br>
    </div>


<?php



echo '<div class="row filter bg"  style=" background: #EFEFBB">';
echo '<div class=" col-lg-5 mx-auto d-flex justify-content-around mt-5 sortBtn flex-wrap">';
echo '<i class="btn" style="margin-left:19px;font-size:37px;background: #C6FFDD; color: white; background: #8E0E00; background: -webkit-linear-gradient(to right, #1F1C18, #8E0E00);';
echo 'background: linear-gradient(to right, #1F1C18, #8E0E00); ">Course List</i>';
echo '</div>';
echo '</div>';
echo '<div class="page-wrapper bg-gra-03 p-t-45 p-b-50" style=" background: #EFEFBB;font-size: 18px;">';
echo '<div class="wrapper wrapper--w790" style="margin-left:380px;">';


$link = mysqli_connect("localhost", "root", "", "sap");
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$teacherId = '';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    $stmt = $link->prepare("SELECT teacher_id FROM teachers WHERE mail = ?");
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $teacherId = $row['teacher_id'];
    
} else {
    echo "User ID cookie not set.";
}

$sql = "SELECT id, name, teacher_id, count(id) c FROM courses WHERE teacher_id = ? GROUP BY name";
$stmt = $link->prepare($sql);
$stmt->bind_param('s', $teacherId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<table  class="table table-striped table-bordered dark-bordered" id="example">';
    echo '<tr>';
    echo '<th>Course ID</th>';
    echo '<th>Course Name</th>';
    echo '<th>Teacher ID</th>';
    echo '<th>Number of Students Enrolled</th>';
    echo '</tr>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['teacher_id'] . "</td>";
        echo "<td>" . $row['c'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records matching your query were found.";
}

$stmt->close();
mysqli_close($link);
