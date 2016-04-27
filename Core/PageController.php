<?php

namespace fixedyour\Core;

/**
 * Class PageController
 */
class PageController {

    /* Constants for names */
    const PAGE_HOME = 'home';
    const PAGE_CV = 'cv';
    const PAGE_PROJECT = 'projects';
    const PAGE_ABOUT = 'about';

    /* Constants for filepaths */
    const TPL_ABOUT = 'about.mustache';
    const TPL_CONTACT = 'contact.mustache';
    const TPL_PROJECTS = 'projects.mustache';
    const TPL_CV = 'cv.mustache';
    const TPL_404 = '404.mustache';

    const TEMPLATE_DIR = 'templates/';

    public static function loadPage($strPage)
    {
        $objPage = new self();
        switch ($strPage) {
            case self::PAGE_HOME:
            case self::PAGE_ABOUT:
                return $objPage->getTemplates(self::TPL_ABOUT, self::TPL_CONTACT);
            case self::PAGE_PROJECT:
                return $objPage->getTemplates(self::TPL_PROJECTS);
            case self::PAGE_CV:
                return $objPage->getTemplates(self::TPL_CV);
            default:
                return $objPage->getTemplates(self::TPL_404);
        }
    }

    /**
     *  Return an array with templates as strings
     */
    private function getTemplates(){
        $templates = [];
        if(func_num_args()){
            foreach(func_get_args() as $templateName){
                $templates[] = $this->getSingleTemplate($templateName);
            }
        }
        return $templates;
    }

    private function getSingleTemplate($templateName){
        $filePath = self::TEMPLATE_DIR.$templateName;
        if(file_exists($filePath)){
            return file_get_contents($filePath);
        }
        // @TODO add some kind of logging here, so i know when stuff dies.
        return false;
    }

}