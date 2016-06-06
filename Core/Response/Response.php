<?php

namespace fixedyour\Core\Response;

/**
 * Class PageController
 */
/**
 * Class Response
 * @package fixedyour\Core
 */
class Response {

    public static function respond($responseData='', $responseCode='200'){
        http_response_code($responseCode);
        if(is_array($responseData))
        {
            $responseData = json_encode($responseData);
        }
        echo $responseData;
        die();
    }

}