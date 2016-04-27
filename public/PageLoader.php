<?php

use fixedyour\Core\PageController;

require_once __DIR__.'/../vendor/autoload.php'; //@TODO make use of the load.php

class PageLoader{

    public function __construct(){
        $strPage = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
        echo json_encode(PageController::loadPage($strPage)); //@TODO get some response thing. That would be nice
    }
}

new PageLoader();

