<?php

var_dump(getcwd());
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