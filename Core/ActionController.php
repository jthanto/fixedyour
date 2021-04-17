<?php
namespace fixedyour\Core;

use fixedyour\Core\Actions\ContactMail;

/**
 * Class ActionController
 * @package fixedyour\Core
 */
class ActionController{

    public static function doAction($action){

        switch($action) {
            case 'contact_mail':
                ContactMail::sendContactMail();
            break;
        }
    }
}
