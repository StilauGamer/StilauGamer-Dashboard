<?php

include "../../mysql.php";

$stmt = $conn->prepare("SELECT title, location FROM nav-list");
$stmt->execute();

?>