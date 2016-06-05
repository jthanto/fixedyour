<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/../_config/config.php';

use fixedyour\Core\PageController;
use fixedyour\Core\ActionController;


/* This will be my router for now ;) */

if(isset($_POST) && isset($_POST['action'])){
    $action = filter_var($_POST['action'], FILTER_SANITIZE_STRING);
    ActionController::doAction($action);
}

if(isset($_GET) && isset($_GET['page']))
{
    $strPage = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
    echo json_encode(PageController::loadPage($strPage)); //@TODO get some response thing. That would be nice
}

if(!empty($_SERVER['REQUEST_URI']))
{
//    echo 'Server request uri: '.$_SERVER['REQUEST_URI'];
    echo PageController::displayPage($_SERVER['REQUEST_URI']);
} else {
    echo 'Do 404';
}


/* YAAAY SCRIPTING */


