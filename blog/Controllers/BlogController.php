<?php

namespace fixedyour\Blog\Controllers;

use fixedyour\Blog\Models\Post;
use fixedyour\Core\Database\Database;

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
        $this->DB = new Database('fixedyour_blog');
    }

    /**
     * @param $id
     * @return string
     */
    public function getArticle($id){
        $post = Post::getById($id);
        return 'post with template';
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
        return 'Forside for bloggeeeeeen, bloggen den er bare miiiiiin!!!!';
    }
}