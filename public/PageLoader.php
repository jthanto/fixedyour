<?php

class PageLoader{

    public function __construct(){
        $strPage = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
        PageController::loadPage($strPage);
    }
}

new PageLoader();
