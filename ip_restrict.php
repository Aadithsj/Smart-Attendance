<?php
$allowedIPs = array('192.168.0.1', '10.0.0.1'); // List of allowed IP addresses

$remoteIP = $_SERVER['REMOTE_ADDR']; // Get the IP address of the visitor

if (!in_array($remoteIP, $allowedIPs)) {
    // IP not allowed, redirect or display an error message
    header('HTTP/1.1 403 Forbidden');
    echo 'Access Denied';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Restricted Page</title>
</head>
<body>
    <h1>Welcome to the restricted page!</h1>
    <!-- Rest of your HTML content -->
</body>
</html>