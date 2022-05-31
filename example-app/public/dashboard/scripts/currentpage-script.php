<?php
# Checking for errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getCurrentPage() {
    $currentPage = basename($_SERVER["PHP_SELF"], ".php");
    $currentPage = preg_replace('/(?<!\ )[A-Z]/', ' $0', $currentPage);
    $currentPage = ucfirst($currentPage);
    return $currentPage;
}

function setCurrentPage($user_id, $page) {
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    $stmt = $conn->prepare("UPDATE users SET last_page=:last_page WHERE user_id=:user_id");
    $stmt->bindParam(":last_page", $page);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}
?>