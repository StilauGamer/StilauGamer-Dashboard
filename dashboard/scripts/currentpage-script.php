<?php
# Checking for errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getCurrentPage() {
    $currentPage = ucfirst(basename($_SERVER["PHP_SELF"], ".php"));
    return $currentPage;
}

function setCurrentPage($user_id, $page) {
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    $stmt = $conn->prepare("UPDATE users SET last_page=:last_page WHERE user_id=:user_id");
    $stmt->bindParam(":last_page", $page);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}




function checkPerm($user_id, $perm_id) {
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $stmt2 = $conn->prepare("SELECT * FROM permissions WHERE perm_id=:perm_id");
    $stmt2->bindParam(":perm_id", $perm_id);
    $stmt2->execute();
    if ($stmt->rowCount() == 1 AND $stmt2->rowCount() == 1) {
        $stmt3 = $conn->prepare("Select * FROM roles WHERE user_id=:user_id AND perm_id=:perm_id");
        $stmt3->bindParam(":user_id", $user_id);
        $stmt3->bindParam(":perm_id", $perm_id);
        $stmt3->execute();
        if ($stmt3->rowCount() == 1) {
            var_dump("You got permission for it.");
            exit();
        }
        var_dump("Both the user and the permission is register, but you're not linked to it.");
        exit();
    }
    var_dump("The user and/or the permission is not registered.");
    exit();
}
?>