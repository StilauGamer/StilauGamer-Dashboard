<?php
include_once "scripts/nav-script.php";
include_once "scripts/theme-script.php";
include_once "scripts/currentpage-script.php";

# Checks if the user is logged in.
if (!loggedIn()) {
    header("location: ../login");
    exit();
}
$userInfo = getUserInfo(getUserId());

# Updates the DB and tells what page the user is on.
# setCurrentPage($userInfo["user_id"], getCurrentPage());

# Getting the theme colors
$backgroundColor = getThemeColor($userInfo["settings_theme"], "background-color");
$mainColor = getThemeColor($userInfo["settings_theme"], "main-color");
$boxColor = getThemeColor($userInfo["settings_theme"], "box-color");
$textColor = getThemeColor($userInfo["settings_theme"], "text-color");
$lineColor = getThemeColor($userInfo["settings_theme"], "line-color");

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

    <!-- Discord -->
    <meta content="StilauGamer | <?php echo getCurrentPage() ?>" property="og:title" />
    <meta content="StilauGamers Dashboard" property="og:description" />
    <meta content="xampp.stilaugamer.com/dashboard/home" property="og:url" />
    <meta content="#FFFFFF" data-react-helmet="true" name="theme-color" />
</head>
<body>
    <nav>
        <section id="nav-title">
            <h1 class="title"><a href="youtube.com"><?php echo $userInfo["username"] ?></a></h1>
        </section>
        <section id="nav-content">
            <?php echo $navItems; ?>
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
if ($userInfo["settings_layout"] == 2) {
    include_once("../css/dashboard/layouts/layout2.css");
}
?>
.active {
    background: <?php echo $backgroundColor ?>;
}
body {
    background: <?php echo $backgroundColor ?>;
    color: <?php echo $textColor ?>;
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
#nav-title a {
    color: <?php echo $textColor ?>;
}
#nav-title a:hover {
    color: <?php echo $backgroundColor ?>;
}
#nav-footer {
    background: <?php echo $boxColor ?>;
    border-top: 1px solid <?php echo $lineColor ?>;
}
#nav-footer a {
    color: <?php echo $textColor ?>;
}
#nav-footer a:hover {
    color: <?php echo $backgroundColor ?>;
}
#nav-content a {
    color: <?php echo $textColor ?>;
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
    color: <?php echo $textColor ?>;
}
.dropdown-content {
    background: <?php echo $backgroundColor ?>;
}
.dropdown-content a {
    color: <?php echo $textColor ?>;
}
.dropdown-content a:hover:not(:last-child) {
    background: <?php echo $backgroundColor ?>;
}
.dropdown-footer {
    background: <?php echo $boxColor ?>;
    border-top: 1px solid <?php echo $lineColor ?>;
}
.dropdown-footer:hover {
    color: <?php echo $backgroundColor ?>;
}
</style>
</html>