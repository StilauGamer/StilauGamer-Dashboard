<?php
include_once "../scripts/nav-script.php";
include_once "../scripts/theme-script.php";
include_once "../scripts/currentpage-script.php";

# Checks if the user is logged in.
if (!loggedIn()) {
    header("location: ../../login");
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
    <title>StilauGamer | <?php echo getCurrentPage(); ?></title>
    <link rel="stylesheet" type="text/css" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../../css/dashboard/dashboard-nav.css">
    <link rel="stylesheet" type="text/css" href="../../css/dashboard/dashboard-phone.css">
    <link rel="stylesheet" type="text/css" href="../../css/dashboard/users-table.css">
    <script src="../../assets/js/dropdown.js"></script>

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
                    <a href="../../logout" class="dropdown-footer">Log Out</a>
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
                    <div class="grid-item"><button>Edit</button></div>
                <?php } ?>
            </section>
        </section>
    </main>
</body>
<style>
<?php
if ($userInfo["settings_layout"] == 2) {
    include_once("../../css/dashboard/layouts/layout2.css");
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
    border: 5px solid <?php echo $boxColor ?>;
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
.grid-item:not(:nth-last-child(-n+4)) {
    border-bottom: 1px solid <?php echo $mainColor ?>;
}
.grid-item:nth-child(-n+4) {
    border-bottom: 1px solid <?php echo $lineColor ?>;
}
.grid-item:nth-child(n+5) {
    background: <?php echo $backgroundColor ?>;
}
.grid-item>button {
    color: <?php echo $textColor ?>;
}
.grid-item>button:hover {
    background: <?php echo $mainColor ?>;
}
</style>
</html>