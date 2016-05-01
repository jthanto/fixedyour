<?php

namespace fixedyour\Core\Actions;

use fixedyour\Core\Mail\Mail;

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
            $mail = new Mail(
                DEFAULT_FROM_MAIL,
                DEFAULT_FROM_MAIL,
                $mailDetails['subject'],
                $mailDetails['body']
            );
            $mail->setReplyTo($mailDetails['replyto']);
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
        echo json_encode($response);

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