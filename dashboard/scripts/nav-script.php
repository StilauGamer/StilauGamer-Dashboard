<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
include "permission-script.php";

$stmt = $conn->prepare("SELECT title, location, permission FROM navlist");
$stmt->execute();

function navItems($stmt) {
    $navItems = "";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $table_title = $row['title'];
        $table_location = $row['location'];
        $table_permission = $row['permission'];
        if (checkPerm($_SESSION["user_id"], getPermId($table_permission))) {
            $navItems .= "<a href={$table_location}><h1>{$table_title}</h1></a>";
        } 
    }
    return $navItems;
}

$navItems = navItems($stmt);

return $navItems;
?>