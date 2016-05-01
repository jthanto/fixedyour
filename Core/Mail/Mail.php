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

    private $replyTo;
    private $checkReplyTo;


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
        if(!empty($this->fromMail)){
            $mail->addReplyTo($this->fromMail);
        }
        $mail->Subject = $this->subject;
        $mail->Body = $this->content;
        return $mail->send();
    }

    /**
     * @param $mail \PHPMailer
     */
    private function setupSMTP($mail){
        $mail->addReplyTo($this->replyTo);
        $mail->SMTPDebug = SMTP_DEBUG_LEVEL;
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = "tls";
        $mail->Port = SMTP_PORT;
        $mail->isHTML(true);
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

    public function setReplyTo($replyTo){
        $this->replyTo = $replyTo;
        $this->checkReplyTo;
    }

    public static function isValidEmail($mail){
        return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }

    public static function isValidEmails($mails){
        $return=[];
        foreach($mails as $mail){
            $return[$mail] = self::isValidEmail($mail);
        }
        return $return;
    }




}