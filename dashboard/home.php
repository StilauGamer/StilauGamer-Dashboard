<?php

session_start();
include_once "scripts/nav-script.php";

$_SESSION["pageName"] = basename($_SERVER["PHP_SELF"], ".php");
$pageName = ucfirst($_SESSION["pageName"]);

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
    <link rel="stylesheet" type="text/css" href="../css/dashboard/dashboard-phone.css">
    <script src="../assets/js/dropdown.js"></script>
</head>
<body>
    <nav>
        <section id="nav-title">
            <h1 class="title">Nav Title</h1>
        </section>
        <section id="nav-content">
            <?php echo $navItems; ?>
        </section>
        <section id="nav-footer">
            <h1 class="title">nav footer</h1>
        </section>
    </nav>
    <main>
        <section id="main-title">
            <h1 class="main-title"><?php echo $pageName?></h1>
            <div class="dropdown">
                <button class="dropdown-button" onclick="dropdownFunc()"><?php echo $pageName ?></button>
                <div class="dropdown-content">
                    <?php echo $navItems; ?>
                    <a href="../logout" class="dropdown-footer">Log Out</a>
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
    include_once("../css/dashboard/layouts/layout2.css");
}
?>
</style>
</html>