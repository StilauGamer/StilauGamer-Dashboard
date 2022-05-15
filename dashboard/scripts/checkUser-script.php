<?php

function loggedIn() {
    if (!isset($_COOKIE["login_token"])) {
        return false;
        exit();
    }
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    $currentTime = date('Y-m-d H:i:s', time());
    $stmt = $conn->prepare("SELECT user_id FROM sessions WHERE hashed_token=:hashed_token AND sessionEnd>:sessionEnd");
    $stmt->bindParam(":hashed_token", $_COOKIE["login_token"]);
    $stmt->bindParam(":sessionEnd", $currentTime);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if ($rowCount == 1) {
        return true;
        exit();
    }
}

function getUserId() {
    if (!isset($_COOKIE["login_token"])) {
        return false;
        exit();
    }
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    $currentTime = date('Y-m-d H:i:s', time());
    $stmt = $conn->prepare("SELECT user_id FROM sessions WHERE hashed_token=:hashed_token AND sessionEnd>:sessionEnd");
    $stmt->bindParam(":hashed_token", $_COOKIE["login_token"]);
    $stmt->bindParam(":sessionEnd", $currentTime);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result["user_id"];
}

function getUserInfo($user_id) {
    if ($user_id > 0 ) {
        include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
        $stmt2 = $conn->prepare("SELECT * FROM users WHERE user_id=:user_id");
        $stmt2->bindParam(":user_id", $user_id);
        $stmt2->execute();
        $result2 = $stmt2->fetch();
        $userInfo = [
            "user_id" => $result2["user_id"],
            "username" => $result2["username"],
            "settings_theme" => $result2["theme"],
            "settings_layout" => $result2["layout"],
        ];
        return $userInfo;
    }
}



?>