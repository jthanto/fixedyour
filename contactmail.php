<?php
error_reporting(E_ALL);
?>

<?php
require 'lib/PHPMailer-master/PHPMailerAutoload.php';

if(!isset($_POST['name'])){
    http_response_code(403);
}
else{
    $mail = new PHPMailer();
    $mail->isSMTP();

    $mail->SMTPDebug = 0;   //Enable SMTP debugging     // 0 = off (for production use)     // 1 = client messages      // 2 = client and server messages

    $mail->Debugoutput = 'html';        //Ask for HTML-friendly debug output

    $mail->Host = "smtp.domeneshop.no";
    $mail->Port = 587;
    
    $mail->SMTPAuth = true;
    require 'classified/smtp.details.php';
    
    $mail->setFrom($_POST['email'], $_POST['name'] );               //AVSENDER HER
    //$mail->addReplyTo('jthanto@fixedyour.net', 'First Last');     //ALTERNATIV SVAR TIL ADRESSE
    $mail->addAddress('post@fixedyour.net', 'Post Fixedyour');
    $mail->Subject = 'Mail fra fixedyour.net - Eget emne her';
    $mail->msgHTML($_POST['message']);

    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';

    //send the message, check for errors
    if (!$mail->send()) {
        http_response_code(500);
        echo 'Tjenesten er midlertidig utilgjengelig, prøv igjen senere.';
        //echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Melding sendt! Takk for at du tok kontakt.";
    }
}
    
//send the message, check for errors
/*if (!$mail->send()) {
    echo $mail->ErrorInfo;
    //echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //http_response_code(200);
    echo 'alt gikk best';
}*/
?>

</body>
</html>
