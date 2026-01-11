<?php
$host = "localhost";
$user = "root";
$pass = "GOKUL20";
$db   = "job_portal";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("DB connection failed: " . mysqli_connect_error());
}
?>
