<?php

session_start();
include "scripts/nav-script.php";

$_SESSION["pageName"] = basename($_SERVER["PHP_SELF"], ".php");
$pageName = $_SESSION["pageName"];

if(!isset($_SESSION["loggedin"])) {
    header("location: ../login");
    exit();
}

function navItems($stmt) {
    $navItems = "";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $table_title = $row['title'];
        $table_location = $row['location'];
        $table_permission = $row['permission'];
        if ($table_permission == isset($_SESSION[$table_permission])) {
            $navItems .= "<a href={$table_location}><h1>{$table_title}</h1></a>";
        } 
    }
    return $navItems;
}
$navItems = navItems($stmt);
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
    <link rel="stylesheet" type="text/css" href="../css/dashboard/dashboard-phone.css">
    <script src="../assets/js/dropdown.js"></script>
</head>
<body>
    <nav>
        <section id="nav-title">
            <h1 class="title">Nav Title</h1>
            <hr class="underline">
        </section>
        <section id="nav-content">
            <?php echo $navItems; ?>
        </section>
        <section id="nav-footer">
            <hr class="underline">
            <h1 class="title">nav footer</h1>
        </section>
    </nav>
    <main>
        <section id="main-title" onClick="dropdownFunc()">
            <h1 class="main-title"><?php echo $pageName?></h1>
            <div class="dropdown">
                <button class="dropdown-button"><?php echo $pageName ?></button>
                <div class="dropdown-content">
                    <hr class="underline">
                    <?php echo $navItems; ?>
                    <hr class="underline">
                    <h1 href="../logout" class="dropdown-footer">Log Out</a>
                </div>
            </div>
        </section>
        <section id="main-content">
            <h1>main-content</h1>
        </section>
    </main>
</body>
<style>
<?php
if ($_SESSION["settings_layout"] == 2) {
    include("../css/dashboard/layouts/layout2.css");
}
?>
</style>
</html>