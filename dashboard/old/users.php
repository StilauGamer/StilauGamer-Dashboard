<?php

session_start();
include "../../mysql.php";

$stmt = $conn->prepare("SELECT username, password, id FROM users");
$stmt->execute();

if(isset($_SESSION["loggedin"])) {
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | Users</title>
    <link rel="stylesheet" type="text/css" href="../../css/dashboard/old/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../../css/dashboard/old/users.css">
    <link rel="stylesheet" type="text/css" href="../../css/theme.css">
</head>
<body>
    <main>
        
        <section id="nav">
            <h2 class="title"><?php echo $_SESSION["username"]; ?></h2>
            <hr class="title-underline">
            <div class="nav-content">
            <a href="/dashboard/users" class="underline">Users</a>
                <a href="/dashboard/permissions" class="underline">Permissions</a>
            </div>
            <div class="nav-footer">
                <hr class="footer-underline">
                <a href="/logout">
                    <h2 class="footer underline">Log Out</h2>
                </a>
            </div>
        </section>
        <section id="main">
            <h2 class="main-title txt-bg7">Users</h2>
            <section id="table-bg">
                <div id="table-th">
                    <h3 class="id">ID</h3>
                    <h3>Username</h3>
                    <h3>Password</h3>
                    <h3>Actions</h3>
                </div>
                <div id="table-tb">
                    <div class="row">
                        <h3 class="id">1</h3>
                        <h3>StilauGamer</h3>
                        <h3>Stilau123</h3>
                        <h3>Edit</h3>
                    </div>
                </div>
            </section>
        </section>

    </main>
</body>
</html>

<?php
} else {
    header("location: ../../login");
}
?>