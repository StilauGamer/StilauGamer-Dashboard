<?php

if (!isset($_COOKIE["login_token"])) {
    return false;
    exit();
}

include_once $_SERVER['DOCUMENT_ROOT']."/mysql.php";
$stmt = $conn->prepare("SELECT user_id FROM sessions WHERE hashed_token=:hashed_token");
$stmt->bindParam(":hashed_token", $_COOKIE["login_token"]);
$stmt->execute();
$result = $stmt->fetch();

if ($result["user_id"] > 0 ) {
    $stmt2 = $conn->prepare("SELECT * FROM users WHERE user_id=:user_id");
    $stmt2->bindParam(":user_id", $result["user_id"]);
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


?>