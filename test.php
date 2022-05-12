<?php

# Checking for errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "dashboard/scripts/permission-script.php";
include "./mysql.php";
include "./dashboard/scripts/checkUser-script.php";

if(!checkPerm($userInfo["user_id"], getPermId("viewTestPage"))) {
    header("location: ./dashboard/home");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h1>Simen</h1>
    <div id="nav-title">Nav-Title</div>
    <div id="nav-content">
        <a>Home</a>
        <a>Users</a>
        <a>Permissions</a>
        <a>Notepads</a>
        <a>VS-Code</a>
    </div>

    <form action="test-script.php" method="post">
        <label>ID</label>
        <input type="text" name="id">
        <label>Username</label>
        <input type="text" name="username">
        <label>Password</label>
        <input type="text" name="pass">
        <button type="submit">Create Account</button>
    </form>
    <form action="test-script-2.php" method="post">
        <label>ID</label>
        <input type="text" name="id">
        <label>Theme</label>
        <input type="text" name="theme">
        <label>Layout</label>
        <input type="text" name="layout">
        <button type="submit">Update user</button>
    </form>

    <!-- CSS GRID -->
    <section class="grid-container">
        <!-- Header -->
        <div class="grid-item">ID</div>
        <div class="grid-item">Username</div>
        <div class="grid-item">Theme</div>
        <div class="grid-item">Layout</div>
        <div class="grid-item">Options</div>
        <!-- Users -->
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="grid-item"><?php echo $row["user_id"] ?></div>
        <div class="grid-item"><?php echo $row["username"] ?></div>
        <div class="grid-item"><?php echo $row["theme"] ?></div>
        <div class="grid-item"><?php echo $row["layout"] ?></div>
        <div class="grid-item">
            <form action="test-script-3.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row["user_id"] ?>" />
                <input type="submit" name="options" value="Options" />
            </form>
        </div>
        <?php } ?>
    </section>
    <?php
        if(isset($_GET["id"])) {
            $stmt2 = $conn->prepare("SELECT * FROM users WHERE user_id=:id");
            $stmt2->bindParam(":id", $_GET["id"]);
            $stmt2->execute();
            $result = $stmt2->fetch();
            $id = $result["user_id"];
            $username = $result["username"];
            $theme = $result["theme"];
            $layout = $result["layout"];
    ?>
        <form action="test-script-4.php" method="post">
            <input type="text" name="id" value="<?php echo $id ?>"   readonly="true" />
            <input type="text" name="username" value="<?php echo $username ?>" />
            <input type="text" name="theme" value="<?php echo $theme ?>" />
            <input type="text" name="layout" value="<?php echo $layout ?>" />
            <input type="submit" name="submit" value="Submit" />
        </form>
    <?php } ?>
</body>


<script>
$(document).ready(function() {
    $("#nav-title").click(function() {
        $("#nav-content").slideToggle("slow");
    });
});
</script>
<style>

    * {
        box-sizing: border-box;
    }

    /* CSS GRID */
    .grid-container {
        width: max-content;
        display: grid;
        grid-template-columns: 50px 200px 100px 100px 150px;
        background: red;
        border-radius: 25px;
        overflow: hidden;
        border: 3px solid black;
    }
    .grid-item {
        display: grid;
        justify-content: center;
        align-content: center;
        height: 50px;
    }
    .grid-item:nth-child(-n+5) {
        background: blue;
        border-bottom: 3px solid black;
    }

    /* Dropdown */
    #nav-content, #nav-title {
        color: white;
        padding: 5px;
        font-size: 50px;
        text-align: center;
        background-color: black;
    }
    #nav-content {
        padding: 50px;
        display: flex;
        flex-direction: column;
    }
</style>

</html>