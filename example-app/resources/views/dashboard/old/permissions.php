<?php
session_start();
if (isset($_SESSION["loggedin"])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | Users</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/theme.css">
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
            <h2 class="main-title txt-bg7">Permissions</h2>
        </section>
    </main>
</body>
</html>

<?php
} else {
    header("location: ../login");
}
?>