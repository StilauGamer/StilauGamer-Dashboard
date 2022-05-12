<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = trim($_POST["username"]);
$password = trim($_POST["password"]);

# Cookie
if (isset($_COOKIE["login_token"])) {
    header("location: ./dashboard/home");
}

# No Cookie
if (!isset($_COOKIE["login_token"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include_once "mysql.php";

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
                    $hashed_token = md5(sha1($result["user_id"] . $hashed_password));
                    setcookie("login_token", $hashed_token, time() + 86400);
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
    $stmt = $conn->prepare("INSERT INTO sessions VALUES(:user_id, :hashed_token)");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":hashed_token", $hashed_token);
    $stmt->execute();
}

?>