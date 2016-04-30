<?php

namespace fixedyour\Core\Mail;

/**
 * Class Mail
 */
/**
 * Class Mail
 * @package fixedyour\Core\Mail
 */
class Mail {

    /**
     * @var
     */
    private $recipient;
    /**
     * @var
     */
    private $from;
    /**
     * @var
     */
    private $content;
    /**
     * @var
     */
    private $additionalHeaders;

    /**
     * Mail constructor.
     * @param $recipient
     * @param $from
     * @param string $subject
     * @param string $content
     * @param string $other
     */
    public function __construct($recipient , $from, $subject = '', $content = ''){
        $this->recipient = filter_var($recipient);
        $this->from = filter_var($from, FILTER_SANITIZE_STRING);
        $this->content = filter_var($content, FILTER_SANITIZE_STRING);
        $this->subject = filter_var($subject, FILTER_SANITIZE_STRING);
        $this->additionalHeaders = $this->setupAdditionalHeader();
    }

    /**
     *
     */
    public function sendMail(){
        mail(
            $this->recipient,
            $this->subject,
            $this->content,
            $this->additionalHeaders
        );
    }

    private function setupAdditionalHeader(){
        return 'From: '.$this->from.'\r\n';
    }




}