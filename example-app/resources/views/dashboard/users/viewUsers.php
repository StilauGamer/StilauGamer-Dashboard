<?php
$host = $_SERVER['DOCUMENT_ROOT'];
include_once $host."/dashboard/scripts/nav-script.php";
include_once $host."/dashboard/scripts/theme-script.php";
include_once $host."/dashboard/scripts/currentpage-script.php";

# Checks if the user is logged in.
if (!loggedIn()) {
    header("location: /login");
    exit();
}
$userInfo = getUserInfo(getUserId());

# Updates the DB and tells what page the user is on.
# setCurrentPage($userInfo["user_id"], getCurrentPage());

# Getting the users
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();

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
    <title>StilauGamer | <?= getCurrentPage(); ?></title>
    <link rel="stylesheet" type="text/css" href="/css/dashboard/dashboard.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/dashboard-nav.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/dashboard-phone.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/users-table.css">
    <script src="/assets/js/dropdown.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    <!-- Discord -->
    <meta content="StilauGamer | <?= getCurrentPage() ?>" property="og:title" />
    <meta content="StilauGamers Dashboard" property="og:description" />
    <meta content="xampp.stilaugamer.com/dashboard/home" property="og:url" />
    <meta content="#FFFFFF" data-react-helmet="true" name="theme-color" />
</head>
<body>
    <nav>
        <section id="nav-title">
            <h1 class="title"><a href="youtube.com"><?= $userInfo["username"] ?></a></h1>
        </section>
        <section id="nav-content">
            <?= $navItems; ?>
        </section>
        <section id="nav-footer">
            <a href="/logout">Log Out</a>
        </section>
    </nav>
    <main>
        <section id="main-title">
            <h1 class="main-title"><?= getCurrentPage(); ?></h1>
            <div class="dropdown">
                <button class="dropdown-button" onclick="dropdownFunc()"><?= getCurrentPage(); ?></button>
                <div class="dropdown-content">
                    <?= $navItems; ?>
                    <a href="/logout" class="dropdown-footer">Log Out</a>
                </div>
            </div>
        </section>
        <section id="main-content">
            <section id="grid-container">
                <!-- Header -->
                <div class="grid-item">ID</div>
                <div class="grid-item">Username</div>
                <div class="grid-item">Email</div>
                <div class="grid-item">Options</div>
                <!-- Users -->
                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="grid-item"><?= $row["user_id"] ?></div>
                    <div class="grid-item"><?= $row["username"] ?></div>
                    <div class="grid-item"><?= $row["email"] ?></div>
                    <div class="grid-item" style="display: flex; align-items: center;">
                        <button>Edit</button>
                        <button>Del</button>
                    </div>
                <?php } ?>
            </section>
        </section>
    </main>
</body>
<style>
<?php
if ($userInfo["settings_layout"] == 2) {
    include_once("$host/css/dashboard/layouts/layout2.css");
}
?>
.active {
    background: <?= $backgroundColor ?>;
}
body {
    background: <?= $backgroundColor ?>;
    color: <?= $textColor ?>;
}
nav {
    background: <?= $mainColor ?>;
}
main {
    background: <?= $mainColor ?>;
}
#nav-title {
    background: <?= $boxColor ?>;
    border-bottom: 1px solid <?= $lineColor ?>;
}
#nav-title a {
    color: <?= $textColor ?>;
}
#nav-title a:hover {
    color: <?= $backgroundColor ?>;
}
#nav-footer {
    background: <?= $boxColor ?>;
    border-top: 1px solid <?= $lineColor ?>;
}
#nav-footer a {
    color: <?= $textColor ?>;
}
#nav-footer a:hover {
    color: <?= $backgroundColor ?>;
}
#nav-content a {
    color: <?= $textColor ?>;
}
#nav-content a:hover {
    background: <?= $backgroundColor ?>;
}
#main-title {
    background: <?= $boxColor ?>;
}
#main-content {
    background: <?= $backgroundColor ?>;
    border: 5px solid <?= $boxColor ?>;
}
.dropdown-button {
    border-bottom: 1px solid <?= $lineColor ?>;
    color: <?= $textColor ?>;
}
.dropdown-content {
    background: <?= $backgroundColor ?>;
}
.dropdown-content a {
    color: <?= $textColor ?>;
}
.dropdown-content a:hover:not(:last-child) {
    background: <?= $backgroundColor ?>;
}
.dropdown-footer {
    background: <?= $boxColor ?>;
    border-top: 1px solid <?= $lineColor ?>;
}
.dropdown-footer:hover {
    color: <?= $backgroundColor ?>;
}
.grid-item:not(:nth-last-child(-n+4)) {
    border-bottom: 1px solid <?= $mainColor ?>;
}
.grid-item:nth-child(-n+4) {
    background: <?= $boxColor ?>;
    border-bottom: 1px solid <?= $lineColor ?>;
}
.grid-item>button {
    color: <?= $textColor ?>;
}
.grid-item>button:hover {
    background: <?= $mainColor ?>;
}
</style>
</html>