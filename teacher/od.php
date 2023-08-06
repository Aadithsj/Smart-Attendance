
<head>
    <style>body {
    overflow-x: hidden;
}
.label-input-blend {
  display: inline-block;
  background-color: yellow;
  padding: 5px;
  border-radius: 5px;
  font-family: cursive;
  /* Add any other label styles */
}

.input-input-blend {
  border: 1px solid blue;
  background-color: lightblue;
  padding: 5px;
  border-radius: 5px;
  font-family: cursive;
  /* Add any other input styles */
}

#navbox {
    background-color: #2c3e50;
}

nav {
    margin-left: 2%;
    margin-right: 2%;
    background-color: #EFEFBB;
}

.navbar-brand {
    font-family: 'Grand Hotel', cursive;
    font-style: italic;
    font-size: x-large;
    margin-top: 1000px;
    margin-left: -20px;
}

.nav-item {
    font-size: 23px;
}
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

table.dark-bordered th,
table.dark-bordered td {
  border-color: #000;
}

</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Teacher menu</title>


    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <script src="https://kit.fontawesome.com/b8c6c27289.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Merienda+One&family=Permanent+Marker&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    <!-- fonts -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Yesteryear&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/2312f8d79b.js"></script>
    <script src="https://use.fontawesome.com/2312f8d79b.js"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body style="background: #EFEFBB;">

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
    <div class="alert alert-success" style="padding-top:50px;">
			<h2 style="text-align:center; font-family:cursive;">LEAVE REQUESTS</h2>
		</div>
        <div style="padding-left:100px;padding-right:100px;" >
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dark-bordered" id="example" >
    <thead>
        <tr>
            <th style="text-align:center; font-family:cursive; font-size:28px; color:blue;">ID</th>
            <th style="text-align:center; font-family:cursive; font-size:28px; color:blue;">Reason</th>
            <th style="text-align:center; font-family:cursive; font-size:28px; color:blue;">Slot</th>
            <th style="text-align:center; font-family:cursive; font-size:28px; color:blue;">Date</th>
            <th style="text-align:center; font-family:cursive; font-size:28px; color:blue;">Leave Type</th>
            <th style="text-align:center; font-family:cursive; font-size:28px; color:blue;">File Name</th>
            <th style="text-align:center; font-family:cursive; font-size:28px; color:blue;">File Type</th>
        </tr>
    </thead>
	<tbody>
    <?php
// Database connection details
$host = 'localhost';
$dbname = 'sap';
$username = 'root';
$password = '';
// Database connection details

// Create a new mysqli connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query
$query = "SELECT * FROM leave_requests";
$result = $conn->query($query);

// Check if the query was successful
if ($result === false) {
    die("Error executing the query: " . $conn->error);
}
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<tr style='text-align:center; font-family:cursive; font-size:22px; color:black;'>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['reason'] . "</td>";
        echo "<td>" . $row['slot'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['leave_type'] . "</td>";
        echo "<td>" . $row['file_name'] . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['file_data']) . "' alt='File' /></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "No records found.";
}

// Close the database connection
$conn->close();
?>
</div>
</body>