<?php

namespace fixedyour\Core\Mail;

use SendGrid\Mail\Mail as SgMail;

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
    private $from;
    private $checkReplyTo;


    /**
     * Mail constructor.
     * @param $recipientsMail
     * @param $fromMail
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

//        var_dump(getenv('SENDGRID_API_KEY'));
//        die();

//        $mail = new PHPMailer();
        $mail = new SgMail();
        $mail->setFrom('postkontoret@fixedyour.net', 'Postkontoret hos Fixedyour.net');
        $mail->setSubject($this->subject);

        foreach($this->recipientMails as $mailAddress){
            $mail->addTo($mailAddress);
        }

        $mail->addContent('text/html',$this->content);
        $sg = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            // While debug: $sg->send($mail);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $moreRecipients
     */
    public function addRecipients($moreRecipients){
        $this->recipientMails = array_merge($this->recipientMails, $moreRecipients);
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
