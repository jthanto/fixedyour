<?php

namespace fixedyour\Core;

use fixedyour\Blog\Controllers\BlogController;

/**
 * Class PageController
 */
class PageController {

    /* Constants for names */
    const PAGE_HOME = 'home';
    const PAGE_CV = 'cv';
    const PAGE_PROJECT = 'projects';
    const PAGE_ABOUT = 'about';
    const PAGE_BLOG = 'blog';
    const PAGE_ADMIN = 'admin';

    /* Constants for filepaths */
    const TPL_FRAME = 'frame.mustache';
    const TPL_ABOUT = 'about.mustache';
    const TPL_CONTACT = 'contact.mustache';
    const TPL_PROJECTS = 'projects.mustache';
    const TPL_CV = 'cv.mustache';
    const TPL_BLOG = 'Blog.mustache';
    const TPL_404 = '404.mustache';
    const TPL_ADMIN = 'admin.mustache';

    const TEMPLATE_OLD_DIR = 'templates/';
    const TEMPLATE_DIR = '../Core/Templates/';

    public function __construct(){
        $this->mustache = new \Mustache_Engine();
    }

    public static function loadPage($strPage)
    {
        $strPage = strtolower($strPage);
        $page = new self();
        switch ($strPage) {
            case self::PAGE_HOME:
            case self::PAGE_ABOUT:
                return $page->getTemplates(self::TPL_ABOUT, self::TPL_CONTACT);
            case self::PAGE_PROJECT:
                return $page->getTemplates(self::TPL_PROJECTS);
            case self::PAGE_CV:
                return $page->getTemplates(self::TPL_CV);
            case self::PAGE_BLOG:
                return $page->getTemplates(self::TPL_BLOG);
            default:
                return $page->getTemplates(self::TPL_404);
        }
    }

    public static function displayPage($strRequest){
        $page = new self();
        $request = $page->parseRequest($strRequest);
        $renderedTemplates = [];

        if(empty($request)){
            $templates = $page->getTemplates(self::TPL_ABOUT, self::TPL_CONTACT);
            $renderedTemplates = array('left'=> $templates[0], 'right' => $templates[1], self::PAGE_ABOUT.'_active' => true);
        } else {
            switch($request[0]){
                case self::PAGE_HOME:
                case self::PAGE_ABOUT:
                    $templates = $page->getTemplates(self::TPL_ABOUT, self::TPL_CONTACT);
                    $renderedTemplates = array('left'=> $templates[0], 'right' => $templates[1], self::PAGE_ABOUT.'_active' => true);
                    break;
                case self::PAGE_ADMIN:
                    $templates = $page->getTemplates(self::TPL_ADMIN);
                    $renderedTemplates = array('center'=> $templates[0], self::PAGE_ADMIN.'_active' => true);
                    break;
                case self::PAGE_PROJECT:
                    $templates = $page->getTemplates(self::TPL_PROJECTS);
                    $renderedTemplates = array('center'=> $templates[0], self::PAGE_PROJECT.'_active' => true);
                    break;
                case self::PAGE_CV:
                    $templates = $page->getTemplates(self::TPL_CV);
                    $renderedTemplates = array('center'=> $templates[0], self::PAGE_CV.'_active' => true);
                    break;
                case self::PAGE_BLOG:
                    $blog = new BlogController();
                    $templates = $blog->getFrontPage();
                    $renderedTemplates = array('center'=> $templates, self::PAGE_BLOG.'_active' => true);
                    break;
            }
        }

        if(empty($renderedTemplates)) {
            return $page->mustache->render($page->getSingleTemplate(self::TPL_FRAME), array('center' => $page->getSingleTemplate(self::TPL_404)));
        } else {
            return $page->mustache->render($page->getSingleTemplate(self::TPL_FRAME), $renderedTemplates);
        }
    }

    private function parseRequest($strPage){
        return array_merge(array_filter(explode('/', $strPage)), []);
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