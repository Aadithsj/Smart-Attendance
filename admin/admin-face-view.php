<?php
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
echo '<meta name="description" content="Colorlib Templates">';
echo '<meta name="author" content="Colorlib">';
echo '<meta name="keywords" content="Colorlib Templates">';
echo '<!-- Title Page-->';
echo '<title>PMS-Admin Table</title>';
echo '<!-- CSS -->';
echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
echo '<script src="https://kit.fontawesome.com/b8c6c27289.js" crossorigin="anonymous"></script>';
echo '<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">';
echo '<link href="https://fonts.googleapis.com/css2?family=Lato&family=Merienda+One&family=Permanent+Marker&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">';
echo '<link rel="stylesheet" href="../css/css.css">';
echo '<!-- fonts -->';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
echo '<link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Yesteryear&display=swap" rel="stylesheet">';
echo '<!-- bootstrap -->';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">';
echo '<!-- Icons font CSS-->';
echo '<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">';
echo '<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">';
echo '<!-- Font special for pages-->';
echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">';
echo '<!-- Vendor CSS-->';
echo '<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">';
echo '<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">';
echo '<!-- Main CSS-->';
echo '<link href="../css/main.css" rel="stylesheet" media="all">';
echo '</head>';
echo '<body style="
overflow-x: hidden;">';
echo '<!-- navbar -->';
echo '<div id="navbox">';
echo '<br>';
echo '<nav class="navbar navbar-expand-lg navbar-light ">';
echo '<h2><a href="../index.html" style="text-decoration: none; color:royalblue"><img style="margin-top: -25x;margin-left: 30px;" src="../images/hom.png" height="80px"><span style="margin-left: -2px;margin-top:30px;font-size:40px">SMART ATTENDANCE PORTAL</span></a></h2>';
echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">';
echo '<ul class="navbar-nav ms-auto mt-2 mt-lg-0">';
echo '<li class="nav-item" style="align-items: right;">';
echo '<a class="nav-link" href="admin menu.html">Home</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="mailto:asvanthc@gmail.com">Contact</a>';
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="../index.html">Logout</a>';
echo '</li>';
echo '</ul>';
echo '<form class="form-inline my-2 my-lg-0">';
echo '</form>';
echo '</div>';
echo '</nav>';
echo '<br>';
echo '</div>';
echo '<div class="row filter bg"  style=" background: linear-gradient(to right, #a8ff78, #78ffd6);">';
echo '<div class=" col-lg-5 mx-auto d-flex justify-content-around mt-5 sortBtn flex-wrap">';
echo '<i class="btn" style="margin-left:19px;font-size:37px;background: #C6FFDD; background: #8E0E00; background: -webkit-linear-gradient(to right, #1F1C18, #8E0E00);';
echo 'background: linear-gradient(to right, #1F1C18, #8E0E00); " >Face Id verification</i>';
echo '</div>';
echo '</div>';
echo '<div class="page-wrapper bg-gra-03 p-t-45 p-b-50" style=" background: linear-gradient(to right, #a8ff78, #78ffd6);font-size: 18px;">';
echo '<div class="wrapper wrapper--w790" style="margin-left:400px;">';
echo '<table class="table table-dark table-hover">';
echo '<tr>';
    echo '<th>Sudent Id</th>';
    echo '<th>Face ID</th>';
    echo '<th>Created On</th>';
    echo '<th>Last Updated</th>';
    echo '</tr>';
$link = mysqli_connect("localhost", "root", "", "sap");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$sql = "SELECT * FROM face_recognition";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['student_id'] . "</td>";
                echo "<td>" . substr($row['face_encoding'], 0, 20) . "....</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>" . $row['updated_at'] . "</td>";

            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
echo '<br><div class="row justify-content-center mt-3">';
echo '<div class="col-lg-6 d-flex justify-content-center">';
echo '<a href="../test/register_face.html" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#add-record-modal" style="background-color: #8E0E00; border-color: #FFFFFF; font-size: 24px; padding: 12px 30px;">Add New Face ID</a>';
echo '</div>';
echo '</div>';

echo '<div class="row justify-content-center mt-3">';
echo '<div class="col-lg-6 d-flex justify-content-center">';
echo '<a href="../test/update_face.html" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#add-record-modal" style="background-color: #4169E1; border-color: #FFFFFF; font-size: 24px; padding: 12px 30px; text-decoration: none; color: #FFFFFF;">Update Existing Face ID</a>';
echo '</div>';
echo '</div>';





// Close connection
mysqli_close($link);
?>