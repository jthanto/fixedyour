<?php

$to = 'jthanto@fixedyour.net';
$subject = 'Mail fra fixedyour.net';
$message = 'Melding!';

if(!isset($_POST['data'])){
    echo 'Illegal move';
    http_response_code(403);
}

if(mail($to, $subject, $message)){
    http_response_code(200);
} else {
    http_response_code(503);
}

?>