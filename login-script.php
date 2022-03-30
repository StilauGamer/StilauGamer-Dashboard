<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "mysql.php";

$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM users WHERE username=:uname");
$stmt->bindparam(":uname", $username);
$stmt->execute();
$result = $stmt->fetch();
$db_id = $result["id"];
$db_username = $result["username"];
$db_password = $result["password"];

if(empty($username) && empty($password)) {
    header("location: ./login?error=Please enter a username and a password.");
    exit();
}
if(empty($username)) {
    header("location: ./login?error=Please enter a username.");
    exit();
}
if(empty($password)) {
    header("location: ./login?error=Please enter a password.");
    exit();
}

if(strtolower($username) == strtolower($db_username) && $password == $db_password) {
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $db_id;
    $_SESSION["username"] = $db_username;
    header("location: ./dashboard/home");
} else {
    header("location: ./login?error=Wrong username or password.");
    exit();
}

?>