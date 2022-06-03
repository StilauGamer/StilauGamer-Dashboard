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
        <main style="display: flex; margin: 10px;">
            <form method="post" action="/createPerm" style="margin: 10px;">
                @csrf
                <label style="font-weight: bold;" for="permission">Permission Name</label><br>
                <input type="text" name="permission" placeholder="Permission"><br><br>
                <button type="submit">Create Permission</button>
            </form>
            <form method="post" action="/removePerm" style="margin: 10px;">
                @csrf
                <label style="font-weight: bold;" for="permission">Permission Name</label><br>
                <input type="text" name="permission" placeholder="Permission"><br><br>
                <button type="submit">Delete Permission</button>
            </form>
            <form method="post" action="/addPerm" style="margin: 10px;">
                @csrf
                <label style="font-weight: bold;" for="username">Username</label><br>
                <input type="text" name="username" placeholder="username"><br><br>
                <label style="font-weight: bold;" for="permission">Permission</label><br>
                <input type="text" name="permission" placeholder="Permission"><br><br>
                <button type="submit">Add Permission to user</button>
            </form>
            <form method="post" action="/deletePerm" style="margin: 10px;">
                @csrf
                <label style="font-weight: bold;" for="username">Username</label><br>
                <input type="text" name="username" placeholder="username"><br><br>
                <label style="font-weight: bold;" for="permission">Permission</label><br>
                <input type="text" name="permission" placeholder="Permission"><br><br>
                <button type="submit">Remove Permission from user</button>
            </form>

            @can('viewLoco')
            <h1>Loco</h1>
            @else
            <h1>Stilau</h1>
            @endcan
        </main>
    </body>
</html>
