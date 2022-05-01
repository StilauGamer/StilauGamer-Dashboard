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