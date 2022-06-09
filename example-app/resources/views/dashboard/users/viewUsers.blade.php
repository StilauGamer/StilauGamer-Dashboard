<?php
use App\Models\User;
use App\Models\Navbar;
use App\Models\Themes;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\currentpageController;

$themeColors = Themes::get(userSettings::getThemeId(Auth::user()));

# Getting the theme colors
$backgroundColor = $themeColors['background-color'];
$mainColor = $themeColors['main-color'];
$boxColor = $themeColors['box-color'];
$textColor = $themeColors['text-color'];
$lineColor = $themeColors['line-color'];

$pageName = currentpageController::getCurrentPage();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | <?= $pageName ?></title>
    <link rel="stylesheet" type="text/css" href="/css/dashboard/dashboard.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/dashboard-nav.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/dashboard-phone.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/users-table.css">
    <script src="/assets/js/dropdown.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    <!-- Discord -->
    <meta content="StilauGamer | <?= $pageName ?>" property="og:title" />
    <meta content="StilauGamers Dashboard" property="og:description" />
    <meta content="xampp.stilaugamer.com/dashboard/home" property="og:url" />
    <meta content="#FFFFFF" data-react-helmet="true" name="theme-color" />
</head>
<body>
    <nav>
        <section id="nav-title">
            <h1 class="title"><a href="youtube.com"><?= Auth::user()->username; ?></a></h1>
        </section>
        <section id="nav-content">
            <?= Navbar::get(Auth::user()); ?>
        </section>
        <section id="nav-footer">
            <a href="/logout">Log Out</a>
        </section>
    </nav>
    <main>
        <section id="main-title">
            <h1 class="main-title"><?= $pageName ?></h1>
            <div class="dropdown">
                <button class="dropdown-button" onclick="dropdownFunc()"><?= $pageName ?></button>
                <div class="dropdown-content">
                    <?= Navbar::get(Auth::user()); ?>
                    <a href="/logout" class="dropdown-footer">Log Out</a>
                </div>
            </div>
        </section>
        <section id="main-content">
            <section id="grid-container">
                <!-- Header -->
                <div class="grid-item">ID</div>
                <div class="grid-item">Username</div>
                <div class="grid-item phone-view">Full Name</div>
                <div class="grid-item phone-view">Email</div>
                <div class="grid-item">Options</div>
                <!-- Users -->
                <?php $users = User::query()->get('*');
                foreach($users as $user) { ?>
                    <div class="grid-item"><?= $user->id; ?></div>
                    <div class="grid-item"><?= $user->username; ?></div>
                    <div class="grid-item phone-view"><?= $user->name; ?></div>
                    <div class="grid-item phone-view"><?= $user->email; ?></div>
                    <div class="grid-item" style="display: flex; align-items: center;">
                        <button><a href="/test3/{{$user->id}}">Edit</a></button>
                        <button>Del</button>
                    </div>
                <?php } ?>
            </section>
        </section>
    </main>
</body>
<style>
<?php (userSettings::getLayoutId(Auth::user()) == 2) ? include_once("/css/dashboard/layouts/layout2.css") : null; ?>
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
.grid-item:not(:nth-last-child(-n+5)) {
    border-bottom: 1px solid <?= $mainColor ?>;
}
.grid-item:nth-child(-n+5) {
    background: <?= $boxColor ?>;
    border-bottom: 1px solid <?= $lineColor ?>;
}
.grid-item>button {
    color: <?= $textColor ?>;
}
.grid-item>button>a {
    color: <?= $textColor ?>;
}
.grid-item>button:hover {
    background: <?= $mainColor ?>;
}
</style>
</html>
