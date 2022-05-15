<?php

setcookie("login_token", "3455b6f81dfe60fb45926357ffec85223714ab46aa78ee95a0cc2c1e6f8c9f38a367b55ccc248f3ad32e3c85cd9bc100cc04f93a8651f317bb43ed20c82b2119");
exit();

# Checking for errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$to = "stianlauvdal@hotmail.com";
$subject = "Subject lol";
$message = "Message 1";
$message .= "Message 2";
$message .= "Message 3";
$message .= "Message 4";

$header = "From stilaugamer@stilaugamer.com";
$header .= "Reply To: replyto@stilaugamer.com";

$retval = mail($to, $subject, $message, $header);
if ($retval == true) {
    echo "Message sent.";
} else {
    echo "Message not sent.";
}

?>