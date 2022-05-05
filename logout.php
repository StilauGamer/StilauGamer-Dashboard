<?php
session_start();
include "dashboard/scripts/currentpage-script.php";
setCurrentPage($_SESSION["user_id"], null);
session_destroy();
header("location: /");
?>