<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "mysql.php";

$username = $_POST["username"];
$password = $_POST["password"];

# Login
$stmt = $conn->prepare("SELECT * FROM users WHERE username=:uname");
$stmt->bindParam(":uname", $username);
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

# Permissions
$stmt2 = $conn->prepare("SELECT * FROM permissions WHERE id=:id");
$stmt2->bindParam(":id", $db_id);
$stmt2->execute();

# User Settings
$stmt3 = $conn->prepare("SELECT * FROM user_settings WHERE id=:id");
$stmt3->bindParam(":id", $db_id);
$stmt3->execute();
$result = $stmt3->fetch();
$db_layout = $result["layout"];
if ($result == false) {
    $stmt4 = $conn->prepare("INSERT INTO user_settings(id, username, layout) VALUES(:id, :username, 1)");
    $stmt4->bindParam(":id", $db_id);
    $stmt4->bindParam(":username", $db_username);
    $stmt4->execute();
    $db_layout = 1;
}

if(strtolower($username) == strtolower($db_username) && $password == $db_password) {
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $db_id;
    $_SESSION["username"] = $db_username;
    $_SESSION["settings_layout"] = $db_layout;
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