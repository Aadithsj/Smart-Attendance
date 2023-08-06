<!DOCTYPE html>
<html>
<head>
    <title>Login Status</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/b8c6c27289.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Merienda+One&family=Permanent+Marker&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <!-- fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Yesteryear&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/2312f8d79b.js"></script><script src="https://use.fontawesome.com/2312f8d79b.js"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link href="../css/main.css" rel="stylesheet" media="all">;
<style>
    #video-container {
  position: fixed;
  top: 1000px;
  left: 0;
  min-width: 100%;
  min-height: 100%;
  z-index: -1;
}
h1{
    font-family: Tahoma, Verdana, sans-serif;
    font-style: italic;
    font-weight: 900;
    margin-top:60px;

</style>

</head>

<body style="background: #86c1cc;">
<div id="video-container">
    <video autoplay muted loop id="myVideo">
      <source src="./ink-67358.mp4" type="video/mp4">
    </video>
  </div>
<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item" style="align-items: right;">
                        <a class="nav-link" href="../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:asvanth@gmail.com">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Login</a>
                    </li>

                </ul>
</div>
    <center>
        <?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "sap");
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }   
          
        $user_id = $_POST['user_id'];  
        $password = $_POST  ['password'];  
        $_SESSION['user_id'] = $user_id;  
        $user_id = stripcslashes($user_id);  
        $user_id = stripcslashes($user_id);  
        $user_id = mysqli_real_escape_string($conn, $user_id);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $sql = "select email,password from users where email = '$user_id' and password = '$password'";
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
$sql1="select * from users where email = '$user_id'";
$query = mysqli_query($conn, $sql1);

while ($row = mysqli_fetch_array($query)) {
    $user_type = $row['role_id'];
    $name=$row['email'];
}
        if($count == 1){ 
            if($user_type==2)
                header( "refresh:5;url=../student/student_menu.html" );
            elseif ($user_type==3) {
                header( "refresh:5;url=../teacher/teacher_menu.html?myVariable=" . $_SESSION['user_id'] );
            }
            elseif ($user_type==1) {
                header( "refresh:5;url=../admin/admin menu.html" );
            }
            elseif ($user_type==4) {
                header( "refresh:5;url=../parent/parent_menu.html" );
            }
            echo "<h1><center> Login Successful </center></h1>";  
            echo "<h1><center>Logged in with " .$name. " </center></h1>";
        }  
        else{ 
            header( "refresh:5;url=./login.html" );
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
?>  

<div id="app" style="margin-top:100px;"></div>
    </center>
</body>
<style>
                .base-timer {
            position: relative;
            width: 300px;
            height: 300px;
            }

            .base-timer__svg {
            transform: scaleX(-1);
            }

            .base-timer__circle {
            fill: none;
            stroke: none;
            }

            .base-timer__path-elapsed {
            stroke-width: 7px;
            stroke: grey;
            }

            .base-timer__path-remaining {
            stroke-width: 7px;
            stroke-linecap: round;
            transform: rotate(90deg);
            transform-origin: center;
            transition: 1s linear all;
            fill-rule: nonzero;
            stroke: currentColor;
            }

            .base-timer__path-remaining.green {
            color: rgb(65, 184, 131);
            }

            .base-timer__path-remaining.orange {
            color: orange;
            }

            .base-timer__path-remaining.red {
            color: red;
            }

            .base-timer__label {
            position: absolute;
            width: 300px;
            height: 300px;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 68px;
            font-weight:100;
    }
</style>
<script>
            const FULL_DASH_ARRAY = 283;
        const WARNING_THRESHOLD = 10;
        const ALERT_THRESHOLD = 5;

        const COLOR_CODES = {
        info: {
            color: "green"
        },
        warning: {
            color: "orange",
            threshold: WARNING_THRESHOLD
        },
        alert: {
            color: "red",
            threshold: ALERT_THRESHOLD
        }
        };

        const TIME_LIMIT = 5;
        let timePassed = 0;
        let timeLeft = TIME_LIMIT;
        let timerInterval = null;
        let remainingPathColor = COLOR_CODES.info.color;

        document.getElementById("app").innerHTML = `
        <div class="base-timer">
        <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <g class="base-timer__circle">
            <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
            <path
                id="base-timer-path-remaining"
                stroke-dasharray="283"
                class="base-timer__path-remaining ${remainingPathColor}"
                d="
                M 50, 50
                m -45, 0
                a 45,45 0 1,0 90,0
                a 45,45 0 1,0 -90,0
                "
            ></path>
            </g>
        </svg>
        <span id="base-timer-label" class="base-timer__label">${formatTime(
            timeLeft
        )}</span>
        </div>
        `;

        startTimer();

        function onTimesUp() {
        clearInterval(timerInterval);
        }

        function startTimer() {
        timerInterval = setInterval(() => {
            timePassed = timePassed += 1;
            timeLeft = TIME_LIMIT - timePassed;
            document.getElementById("base-timer-label").innerHTML = formatTime(
            timeLeft
            );
            setCircleDasharray();
            setRemainingPathColor(timeLeft);

            if (timeLeft === 0) {
            onTimesUp();
            }
        }, 1000);
        }

        function formatTime(time) {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;

        if (seconds < 10) {
            seconds = `0${seconds}`;
        }

        return `${minutes}:${seconds}`;
        }

        function setRemainingPathColor(timeLeft) {
        const { alert, warning, info } = COLOR_CODES;
        if (timeLeft <= alert.threshold) {
            document
            .getElementById("base-timer-path-remaining")
            .classList.remove(warning.color);
            document
            .getElementById("base-timer-path-remaining")
            .classList.add(alert.color);
        } else if (timeLeft <= warning.threshold) {
            document
            .getElementById("base-timer-path-remaining")
            .classList.remove(info.color);
            document
            .getElementById("base-timer-path-remaining")
            .classList.add(warning.color);
        }
        }

        function calculateTimeFraction() {
        const rawTimeFraction = timeLeft / TIME_LIMIT;
        return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
        }

        function setCircleDasharray() {
        const circleDasharray = `${(
            calculateTimeFraction() * FULL_DASH_ARRAY
        ).toFixed(0)} 283`;
        document
            .getElementById("base-timer-path-remaining")
            .setAttribute("stroke-dasharray", circleDasharray);
        }
</script>
</html>