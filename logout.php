<?php
setcookie("login_token", "", time() - 3600);
header("location: /");
?>