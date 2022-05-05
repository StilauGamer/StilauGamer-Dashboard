<?php
function checkPerm($user_id, $perm_id) {
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    $stmt = $conn->prepare("Select * FROM roles WHERE user_id=:user_id AND perm_id=:perm_id");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":perm_id", $perm_id);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        return true;
    }
    return false;
}

function getPermId($perm_name) {
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    $stmt = $conn->prepare("SELECT * FROM permissions WHERE perm_name=:perm_name");
    $stmt->bindParam(":perm_name", $perm_name);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        $result = $stmt->fetch();
        return $result["perm_id"];
    }
    return null;
}
?>