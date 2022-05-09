<?php

session_start();
include_once "scripts/nav-script.php";
include_once "scripts/theme-script.php";
include_once "scripts/currentpage-script.php";

# Checks if the user is logged in.
if(!isset($_SESSION["loggedin"])) {
    header("location: ../login");
    exit();
}

# Updates the DB and tells what page the user is on.
setCurrentPage($_SESSION["user_id"], getCurrentPage());
$backgroundColor = getThemeColor($_SESSION["settings_theme"], "background-color", null);
$mainColor = getThemeColor($_SESSION["settings_theme"], "main-color", null);
$boxColor = getThemeColor($_SESSION["settings_theme"], "box-color", null);
$lineColor = getThemeColor($_SESSION["settings_theme"], "line-color", null);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | <?php echo getCurrentPage(); ?></title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/dashboard/dashboard-nav.css">
    <link rel="stylesheet" type="text/css" href="../css/dashboard/dashboard-phone.css">
    <script src="../assets/js/dropdown.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <section id="nav-title">
            <h1 class="title"><?php echo $_SESSION["username"] ?></h1>
        </section>
        <section id="nav-content">
            <?php echo $navItems; ?>
        </section>
        <section id="error">
            <?php if(isset($_GET["error"])) { ?>
                <p class="error"><?php echo $_GET["error"]; ?></p>
            <?php } ?>
        </section>
        <section id="nav-footer">
            <a href="../logout">Log Out</a>
        </section>
    </nav>
    <main>
        <section id="main-title">
            <h1 class="main-title"><?php echo getCurrentPage(); ?></h1>
            <div class="dropdown">
                <button class="dropdown-button" onclick="dropdownFunc()"><?php echo getCurrentPage(); ?></button>
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

body {
    background: <?php echo $backgroundColor ?>;
}
nav {
    background: <?php echo $mainColor ?>;
}
main {
    background: <?php echo $mainColor ?>;
}
#nav-title {
    background: <?php echo $boxColor ?>;
    border-bottom: 1px solid <?php echo $lineColor ?>;
}
#nav-footer {
    background: <?php echo $boxColor ?>;
    border-top: 1px solid <?php echo $lineColor ?>;
}
#nav-footer a:hover {
    color: <?php echo $backgroundColor ?>;
}
#nav-content a:hover {
    background: <?php echo $backgroundColor ?>;
}
#main-title {
    background: <?php echo $boxColor ?>;
}
#main-content {
    background: <?php echo $boxColor ?>;
}
.dropdown-button {
    border-bottom: 1px solid <?php echo $lineColor ?>;
}
.dropdown-content {
    background: <?php echo $backgroundColor ?>;
}
.dropdown-content a:hover {
    background: <?php echo $backgroundColor ?>;
}
</style>
</html>