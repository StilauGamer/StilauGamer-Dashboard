<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Oslo');
include_once "mysql.blade.php";

$username = trim($_POST["username"]);
$password = trim($_POST["password"]);

# Cookie
if (isset($_COOKIE["login_token"])) {
    header("location: ./dashboard/home");
}

# No Cookie
if (!isset($_COOKIE["login_token"])) {
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

        if ($stmt = $conn->prepare("SELECT * FROM users WHERE username=:uname OR email=:uname")) {
            $stmt->bindParam(":uname", $username);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            if ($rowCount == 1) {
                $result = $stmt->fetch();
                $hashed_password = trim($result["hashed_password"]);
                if (password_verify($password, $hashed_password)) {
                    $hashed_token = hash("sha512", $result["username"] . time() . "RANDOMSALT");
                    setcookie("login_token", $hashed_token, time() + 900);
                    saveCookieDb($result["user_id"], $hashed_token);
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
}

function saveCookieDb($user_id, $hashed_token) {
    include "mysql.php";
    $stmt = $conn->prepare("INSERT INTO sessions(user_id, hashed_token, sessionEnd) VALUES(:user_id, :hashed_token, :sessionEnd)");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":hashed_token", $hashed_token);
    $stmt->bindParam(":sessionEnd", date('Y-m-d H:i:s', time() + 900));
    $stmt->execute();
}

?>