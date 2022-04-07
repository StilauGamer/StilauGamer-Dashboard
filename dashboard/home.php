<?php

session_start();
include "scripts/nav-script.php";

if(!isset($_SESSION["loggedin"])) {
    header("location: ../login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | Home</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/dashboard/dashboard-nav.css">
</head>
<body>
    <nav>
        <section id="nav-title">
            <h1 class="title">Nav Title</h1>
            <hr class="underline">
        </section>
        <section id="nav-content">

            <?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $table_title = $row['title'];
                $table_location = $row['location'];
                $table_permission = $row['permission'];
                if ($table_permission = $_SESSION[$table_permission]) {
            ?>
            <a href="<?php echo $table_location; ?>"><h1><?php echo $table_title; ?></h1></a>
            <?php } } ?>
        </section>
        <section id="nav-footer">
            <hr class="underline">
            <h1 class="title">nav footer</h1>
        </section>
    </nav>
    <main>
        main
    </main>
</body>
</html>