<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$id = $_POST["id"];
$theme = $_POST["theme"];
$layout = $_POST["layout"];

include "mysql.php";
$stmt = $conn->prepare("UPDATE users SET theme=:theme, layout=:layout WHERE user_id=:user_id");
$stmt->bindParam(":user_id", $id);
$stmt->bindParam(":theme", $theme);
$stmt->bindParam(":layout", $layout);
$stmt->execute();
$_SESSION["settings_layout"] = $layout;
$_SESSION["settings_theme"] = $theme;
header("location: ./test");

?>