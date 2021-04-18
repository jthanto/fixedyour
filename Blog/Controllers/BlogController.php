<?php

namespace fixedyour\Blog\Controllers;

use fixedyour\Blog\Models\Post;
use fixedyour\Core\Database\Database;
use fixedyour\Core\PageController;

/**
 * Class BlogController
 * @package fixedyour\Blog\Controllers
 */
class BlogController {


    private $DB;
    /**
     * Blog constructor.
     */
    public function __construct() {
        $this->mustache = new \Mustache_Engine();
        $this->DB = new Database('fixedyour');
    }

    public function route($request){
        switch($request[0] ?? ''){
            case 'article':
                return $this->get_parsed_view(realpath(__DIR__.'/../View/article.php'), Post::getByUrl($request[1]));
            case 'category':
                return  'category';
            case '':
            case 'front':
            default:
                return $this->get_parsed_view(realpath(__DIR__.'/../View/blog.php'), ['posts' => Post::getLastX(5)]);
        }

    }

    /**
     * @param $id
     * @return string
     */
    public function getArticle($id){
        $post = Post::getById($id);
        return 'post with template';
    }

    public function get_parsed_view($tpl, $data=[]){
        ob_start();
        extract($data);
        include($tpl);
        $parsed =  ob_get_contents();
        ob_end_clean();
        return $parsed;
    }

    /**
     *
     */
    public function getFrontPageArticles($limit=5, $sort='asc'){
        return 'string';
    }

    /**
     *
     */
    public function getCategory(){

    }



    /**
     *
     */
    public function getFrontPage(){
        $articles = $this->getFrontPageArticles();
        return 'Heiaaa bloggen';
    }
}
