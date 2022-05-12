<?php
include_once "dashboard/scripts/checkUser-script.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | Home</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <script type="text/javascript" src="/assets/js/scroll.js"></script>
</head>
<body>
    <header>
        <div id="navbar" class="nav-scroll">
            <h2><a href="/">STILAUGAMER</a></h2>
            <ul>
                <li>
                    <a href="/" class="nav-active">HOME</a>
                </li>
                <li>
                    <a href="/">TEST</a>
                </li>
                <li>
                    <?php if(loggedIn()) {?>
                    <div class="dropdown" style="float: right;">
                        <button class="dropdown-button">ACCOUNT</button>
                        <div class="dropdown-content">
                            <a href="/dashboard/home">Home</a>
                            <a href="/logout">Log Out</a>
                        </div>
                    </div>
                    <?php } else { ?>
                    <a href="login">LOG IN</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
        <section class="header-title">
            <h1>StilauGamer</h1>
            <h5>Programmer & Gamer</h5>
        </section>
    </header>

    
    <main>
        <iframe src="https://discord.com/widget?id=770971963111768075&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
    </main>
</body>
</html>