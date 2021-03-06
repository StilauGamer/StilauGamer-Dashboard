<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "mysql.php";

$username = trim($_POST["username"]);
$password = trim($_POST["password"]);

# Login
$stmt = $conn->prepare("SELECT * FROM users WHERE username=:uname");
$stmt->bindParam(":uname", $username);
$stmt->execute();
$result = $stmt->fetch();
$db_id = $result["id"];
$db_username = $result["username"];
$db_password = $result["password"];
$db_layout = $result["layout"];
$db_theme = $result["theme"];

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

# Permissions
$stmt2 = $conn->prepare("SELECT * FROM permissions WHERE id=:id");
$stmt2->bindParam(":id", $db_id);
$stmt2->execute();

if(strtolower($username) == strtolower($db_username) && $password == $db_password) {
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["user_id"] = $db_id;
    $_SESSION["username"] = $db_username;
    $_SESSION["settings_layout"] = $db_layout;
    $_SESSION["settings_theme"] = $db_theme;
    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $columns = array_keys($row, "1");
        foreach ($columns as $key => $value) {
            if ($row[$value] == "1") {
                $_SESSION[$value] = $value;
            }
        }
    }
    header("location: ./dashboard/home");
} else {
    header("location: ./login?error=Wrong username or password.");
    exit();
}

?>