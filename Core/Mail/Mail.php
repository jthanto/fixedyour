<?php

namespace fixedyour\Core\Mail;

class Mail {

    private $recipients = [];
    private $from_name;
    private $from_email;
    private $content_text;
    private $content_html;
    private $subject;
    private $replyto_email;
    private $replyto_name;


    public function __construct(){
    }

    public function setSubject($subject){
        $this->subject = $subject;
        return $this;
    }

    public function setContent($content){
        if($content != $text = strip_tags($content)){
            $this->content_html = $content;
            $this->content_text = $text;
        } else {
            $this->content_html = $this->content_text = $content;
        }
        return $this;
    }

    public function setFrom($email, $name){
        $this->from_email = $email;
        $this->from_name = $name;
        return $this;
    }

    public function setReplyTo($email, $name){
        $this->replyto_email = $email;
        $this->replyto_name = $name;
        return $this;
    }

    public function addRecipient($email, $name){
        if($this->isValidEmail($email)){
            $this->recipients[]=[
                'email' => $email,
                'name' => $name
            ];
        }
        return $this;
    }


    public function addRecipients($recipients){
        foreach($recipients as $recipient){
            $this->addRecipient($recipient['email'], $recipient['name']);
        }
        return $this;
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

    private function send_mail($mail_body){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer '.MAILSENDER_API_KEY,
        ]);
        curl_setopt($ch, CURLOPT_URL, 'https://api.mailersend.com/v1/email');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($mail_body));
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function sendMail(){

        $body = [];
        foreach($this->recipients as $val){
            $body['to'][] = ['email' => $val['email'], 'name' => $val['name']];
        }
        $body['from'] = [
            'email' => $this->from_email,
            'name' => $this->from_name
        ];

        if($this->replyto_email && $this->replyto_name){
            $body['reply_to'] = ['email' => $this->replyto_email, 'name' => $this->replyto_name];
        }
        $body['subject'] = $this->subject;
        $body['text'] = $this->content_text;
        $body['html'] = $this->content_html;

        try {
            $response = $this->send_mail($body);
            file_put_contents(ROOT_DIR.'/debug/mailstatus.txt', $response."\n", FILE_APPEND); //This is for debug..
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }



}
