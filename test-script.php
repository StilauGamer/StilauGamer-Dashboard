<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_POST["id"];
$username = $_POST["username"];
$pass = $_POST["pass"];
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

include "mysql.php";

$stmt = $conn->prepare("INSERT INTO users(username, hashed_password) VALUES(:username, :pass)");
$stmt->bindParam(":username", $username);
$stmt->bindParam(":pass", $hashed_pass);
$stmt->execute();

?>