<?php

class PageController{

    const PAGE_HOME = 'home';
    const PAGE_CV = 'cv';
    const PAGE_PROJECT = 'project';

    private function __construct($strPage){

        switch($strPage){
            case self::PAGE_HOME:
                break;
            case self::PAGE_PROJECT:
                break;
            case self::PAGE_CV:
                break;
            default:
        }
    }

    public static function loadPage($strPage){
        return new self($strPage);
    }

    private function getTemplateArray(){
        if()
    }

}