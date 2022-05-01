<?php


if (!isset($_SESSION["loggedin"])) {
    header("../../login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StilauGamer | Test</title>
</head>
<body>
    <form>
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" placeholder="<?php echo $_GET["error"]; ?>" disabled>
        <input type="submit" value="submit">
    </form>
</body>
</html>