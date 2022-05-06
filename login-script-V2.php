<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "mysql.php";

$username = trim($_POST["username"]);
$password = trim($_POST["password"]);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($username) && empty($password)) {
        header("location: ./login?error=Please enter a username and a password.");
        exit();
    }
    if (empty($username)) {
        header("location: ./login?error=Please enter a username.");
        exit();
    }
    if (empty($password)) {
        header("location: ./login?error=Please enter a password.");
        exit();
    }

    if ($stmt = $conn->prepare("SELECT * FROM users WHERE username=:uname")) {
        $stmt->bindParam(":uname", $username);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount == 1) {
            $result = $stmt->fetch();
            $hashed_password = trim($result["hashed_password"]);
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["user_id"] = $result["user_id"];
                $_SESSION["settings_theme"] = $result["theme"];
                $_SESSION["settings_layout"] = $result["layout"];
                header("location: ./dashboard/home");
            } else {
                header("location: ./login?error=Wrong username or password.");
                exit();

            }
        } else {
            header("location: ./login?error=Wrong username or password.");
            exit();
        }
    } else {
        header("location: ./login?error=A problem has occured, try again later.");
        exit();
    }
}

?>