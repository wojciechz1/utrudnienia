<?php
session_start();
unset($_SESSION['uzytkownik']);
unset($_SESSION['administrator']);
$poprzednia = $_SERVER['HTTP_REFERER'];
header("Location: $poprzednia");
?>