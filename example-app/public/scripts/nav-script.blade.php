<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "permission-script.php";
include_once "currentpage-script.php";

function navItems($stmt, $user_id) {
    $navItems = navbar::create();
    $table_title = $row['title'];
    $table_location = $row['location'];
    $table_permission = $row['permission'];
    $active = ($table_location ==
    $_SERVER['REQUEST_URI']) ? "active" : null;
    if ($table_permission == null) {
        $navItems .= "<a href={$table_location} class={$active}>{$table_title}</a>";
    }
    if (checkPerm($user_id, getPermId($table_permission))) {
        $navItems .= "<a href={$table_location} class={$active}>{$table_title}</a>";
    }
    return $navItems;
}

$navItems = navItems($stmt, $userInfo["user_id"]);

return $navItems;
?>
