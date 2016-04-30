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
        $content = $_POST['content'].' <br> Annet:'.$_POST['other'];
        $mail = new Mail(
            'post@fixedyour.net',
            $_POST['from'],
            'Ny melding fra '.$_POST['name'],
            $content
        );
        $mail->sendMail();
    }

}