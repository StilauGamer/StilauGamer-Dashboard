<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include $_SERVER['DOCUMENT_ROOT']."/mysql.php";

$stmt = $conn->prepare("SELECT title, location, permission FROM navlist");
$stmt->execute();

return $stmt;

?>