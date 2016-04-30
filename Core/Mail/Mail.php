<?php

namespace fixedyour\Core\Mail;

/**
 * Class Mail
 */
/**
 * Class Mail
 * @package fixedyour\Core\Mail
 */
/**
 * Class Mail
 * @package fixedyour\Core\Mail
 */
class Mail {

    /**
     * @var
     */
    private $recipientMails = [];
    /**
     * @var
     */
    private $fromMail;
    /**
     * @var
     */
    private $content;
    /**
     * @var
     */
    private $additionalHeaders;
    /**
     * @var
     */
    private $fromName;

    /**
     * @var
     */
    private $errors;


    /**
     * Mail constructor.
     * @param $recipientsMail
     * @param fromMail
     * @param string $subject
     * @param string $content
     */
    public function __construct($recipientsMail , $fromMail, $subject = '', $content = ''){
        if(is_array($recipientsMail)){
            $this->addRecipients($recipientsMail);
        } else if(is_string($recipientsMail)){
            $this->addRecipient($recipientsMail);
        }
        $this->fromMail = filter_var($fromMail, FILTER_SANITIZE_STRING);
        $this->content = filter_var($content, FILTER_SANITIZE_STRING);
        $this->subject = filter_var($subject, FILTER_SANITIZE_STRING);
    }

    /**
     * @param $fromName
     */
    public function setFromName($fromName){
        $this->fromName = $fromName;
    }

    /**
     *
     */
    public function sendMail(){
        $mail = new \PHPMailer();

        $this->setupSMTP($mail);

        $mail->From = $this->fromMail;
        $mail->FromName = $this->fromName;
        foreach($this->recipientMails as $mailAddress){
            $mail->addAddress($mailAddress);
        }
        $mail->addReplyTo($this->fromMail);
        $mail->isHTML(false);
        $mail->Subject = $this->subject;
        $mail->Body = $this->content;

        $response = [];
        if(!$mail->send()){
            $response['status']= 'error';
            $response['message']= $mail->ErrorInfo;
        } else {
            $response['status'] = 'success';
            $response['message'] = 'Mail sent!';
        }

        echo json_encode($response);
    }

    /**
     * @param $mail \PHPMailer
     */
    private function setupSMTP($mail){
        $mail->SMTPDebug = SMTP_DEBUG_LEVEL;
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = "tls";
        $mail->Port = SMTP_PORT;
    }

    /**
     * @param $moreRecipients
     */
    public function addRecipients($moreRecipients){
        array_merge($this->recipientMails, $moreRecipients);
    }

    /**
     * @param $oneMoreRecipient
     */
    public function addRecipient($oneMoreRecipient){
        $this->recipientMails[] = $oneMoreRecipient;
    }

    /**
     * @return bool
     */
    private function validateMail(){
//        foreach($this->recipientMails)
//        {
//
//        }
//        if(!filter_var($this->recipient, FILTER_VALIDATE_EMAIL))
//        {
//            $this->errors[] = 'Recipient, is not valid email';
//        }
//        if(!filter_var($this->from, FILTER_VALIDATE_EMAIL))
//        {
//            $this->errors[] = 'Sender, is not valid email';
//        }
//        if(empty($this->subject))
//        {
//            $this->errors[] = 'Subject is empty';
//        }
//        if(empty($this->content))
//        {
//            $this->errors[] = 'Content is empty';
//        }
        return empty($this->errors);
    }

    /**
     * @return bool
     */
    public function hasErrors(){
        return !empty($this->errors);
    }

    /**
     * @return mixed
     */
    public function getErrors(){
        return $this->errors;
    }




}