<?php

$to = 'jthanto@fixedyour.net';
$subject = 'Mail fra fixedyour.net';
$message = 'Melding!';

if(!isset($_POST['data'])){
    echo 'Illegal move';
    print_r($_POST['data']);
    http_response_code(403);
}

if(mail($to, $subject, $message)){
    http_response_code(200);
} else {
    echo '<script>console.log('+$_POST['data']+');</script>';
    http_response_code(500);
    
}

?>