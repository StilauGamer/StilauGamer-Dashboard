<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | Register</title>
</head>
<body>
    <main style="display: flex; justify-content: center;">
        <form method="POST" action="/register">
            @csrf
            <label style="font-weight: bold;" for="username">USERNAME</label><br>
            <input type="text" name="username" placeholder="username"><br><br>
            <label style="font-weight: bold;" for="name">NAME</label><br>
            <input type="text" name="name" placeholder="name"><br><br>
            <label style="font-weight: bold;" for="email">email</label><br>
            <input type="email" name="email" placeholder="email"><br><br>
            <label style="font-weight: bold;" for="password">PASSWORD</label><br>
            <input type="password" name="password" placeholder="password"><br><br>
            <button type="submit" class="button">Login</button>
        </form>
    </main>
</body>
<style>
* {
    font-family: Arial;
}
</style>
</html>