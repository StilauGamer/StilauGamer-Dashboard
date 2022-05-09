<?php

# Checking for errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "dashboard/scripts/permission-script.php";

# Starts a session.
session_start();

# Checks if the user is logged in.
if(!isset($_SESSION["loggedin"])) {
    header("location: ./login");
    exit();
}

if(!checkPerm($_SESSION["user_id"], getPermId("viewTestPage"))) {
    header("location: ./dashboard/home");
    exit();
}

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
</body>


<script>
$(document).ready(function() {
    $("#nav-title").click(function() {
        $("#nav-content").slideToggle("slow");
    });
});
</script>
<style>
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