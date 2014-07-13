<?php

$to = 'jthanto@fixedyour.net';
$subject = 'Mail fra fixedyour.net';
$message = 'Melding!';
    
    //[, string $additional_headers [, string $additional_parameters ]] 

if(mail($to, $subject, $message)){
    return "true";
} else {
    return "false";
}

?>