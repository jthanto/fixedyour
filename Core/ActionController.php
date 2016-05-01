<?php
namespace fixedyour\Core;

use fixedyour\Core\Mail\Mail;

/**
 * Class ActionController
 * @package fixedyour\Core
 */
class ActionController{

    public static function doAction($action){
        
        $objThis = new self();
        switch($action) {
            case 'contact_mail':
                $objThis->sendContactMail();
            break;
        }
    }

    private function sendContactMail(){
        if($_POST['other']){
            $content = $_POST['content'].' <br> Annet:'.$_POST['other'];
        } else {
            $content = $_POST['content'];
        }
        if($_POST['name']){
            $strSubject = 'Ny melding fra '.$_POST['name'];
        } else {
            $strSubject = 'Ny melding fra Ukjent Person';
        }
        $mail = new Mail(
            DEFAULT_FROM_MAIL,
            DEFAULT_FROM_MAIL,
            $strSubject,
            $content
        );
        $mail->setReplyTo($_POST['from']);
        $mail->sendMail();
    }

}