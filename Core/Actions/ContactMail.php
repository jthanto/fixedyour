<?php

namespace fixedyour\Core\Actions;

use fixedyour\Core\Mail\Mail;
use fixedyour\Core\Response\Response;
use fixedyour\Core\View\View;


class ContactMail {

    private $validationErrors;

    public static function sendContactMail(){
        $contactMail = new ContactMail();
        $contactMail->send();
    }

    private function send(){
        $mailDetails = $this->getContactMailDetails();

        if($this->validateMailDetails($mailDetails)){
            $response = [];
            $mail = new Mail();

            $content = View::parse(ROOT_DIR.'/Core/Templates/Actions/contact.php', $mailDetails);
            $mail->addRecipient(DEFAULT_CONTACT_RECIPIENT_MAIL, DEFAULT_CONTACT_RECIPIENT_NAME)
                ->setFrom(DEFAULT_FROM_MAIL, DEFAULT_CONTACT_FROM_NAME)
                ->setReplyTo($mailDetails['replyto'], $mailDetails['name'])
                ->setSubject($mailDetails['subject'])
                ->setContent($content);
            if($mail->sendMail())
            {
                $response['status'] = 'success';
                $response['message'] = 'Mail sent!';
            } else {
                $response['status']= 'error';
                $response['message']= 'Feil med meilsending';
            }
        } else {
            $response = $this->validationErrors;
            $response['status'] = 'error';
        }
        Response::respond($response);

    }

    private function getContactMailDetails(){
        $mailDetails = [];
        if($_POST['other']){
            $mailDetails['body']= $_POST['content'].' <br> Annet:'.$_POST['other'];
        } else {
            $mailDetails['body'] = $_POST['content'];
        }
        if($_POST['name']){
            $mailDetails['subject'] = 'Ny melding fra '.$_POST['name'];
        } else {
            $mailDetails['subject'] = 'Ny melding fra Ukjent Person';
        }
        $mailDetails['replyto'] = $_POST['from'];
        $mailDetails['name'] = $_POST['name'];
        return $mailDetails;
    }

    private function validateMailDetails($mailDetails){

        if(!Mail::isValidEmail($mailDetails['replyto'])){
            $this->validationErrors['message']['replyto'] = '\''.$mailDetails['replyto'].'\''.' er ikke en gyldig e-post adresse';
        }

        if(empty($mailDetails['body'])){
            $this->validationErrors['message']['body'] = 'Du glemte å skrive en melding :(';
        }

        if(empty($mailDetails['name'])){
            $this->validationErrors['message']['name'] = 'Det hadde vært fryktelig hyggelig om du kunne skrevet navnet ditt';
        }

        return empty($this->validationErrors);

}

}
