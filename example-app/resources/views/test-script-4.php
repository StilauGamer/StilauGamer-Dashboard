<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_POST["id"];
$username = $_POST["username"];
$theme = $_POST["theme"];
$layout = $_POST["layout"];

include "./mysql.php";
$stmt = $conn->prepare("UPDATE users SET username=:username, layout=:layout, theme=:theme WHERE user_id=:user_id");
$stmt->bindParam(":user_id", $id);
$stmt->bindParam(":username", $username);
$stmt->bindParam(":theme", $theme);
$stmt->bindParam(":layout", $layout);
$stmt->execute();
header("location: ./test");

?>