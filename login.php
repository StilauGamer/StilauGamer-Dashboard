<?php 
if(isset($_COOKIE["login_token"])) {
    header("location: ./dashboard/home");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="https://kit.fontawesome.com/42811d1e0a.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <section class="login-header">
            <img src="/assets/img/cloudlockadmin.png" class="lock">
        </section>
        <section class="login">
            <form action="./login-script-V2.php" method="post" class="login-form">
                <label>USERNAME</label><br>
                <input type="text" name="username" placeholder="Name" class="textbox"><br><br><br>
                <label>PASSWORD</label><br>
                <input type="password" name="password" placeholder="Password" class="textbox"><br><br><br>
                <button type="submit" class="button">Login</button>
            </form>
            <section class="login-footer">
                <?php if(isset($_GET["error"])) { ?>
                    <p class="error"><?php echo $_GET["error"]; ?></p>
                <?php } ?>
            </section>
        </section>
    </main>
</body>
</html>