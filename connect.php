<?php
$dbhost="localhost";
$dbuser="root";
$dbpassword="";
$dbname="utrudnienia";
$conn = new mysqli ($dbhost, $dbuser, $dbpassword, $dbname)
or die (mysqli_error($conn));
mysqli_set_charset($conn, "utf8");
?>