<?php

$sname="web.stilaugamer.com";
$uname="stil_stilauweb";
$password="Stilau123";
$db_name="stil_stilauweb";

$conn = new PDO("mysql:host=$sname;dbname=$db_name", $uname, $password);

if (!$conn) {
    echo "Connection failed!";
}

?>