<?php
include "mysql.php";
$stmt = $conn->prepare("DELETE FROM sessions WHERE hashed_token=:hashed_token");
$stmt->bindParam(":hashed_token", $_COOKIE["login_token"]);
$stmt->execute();
setcookie("login_token", "", time() - 3600);
header("location: /");
?>