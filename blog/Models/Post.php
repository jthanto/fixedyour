<?php

namespace fixedyour\Blog\Models;

use fixedyour\Core\Database\Database;
use fixedyour\Core\Database\Row;

class Post extends Row{


    private $DB;
    /**
     * Blog constructor.
     */
    public function __construct() {
        parent::__construct(new Database('fixedyour_blog'));
    }

    /**
     *
     * @param $id
     * @return Post
     */
    public static function getById($id){
        return new self($id);
    }

    /**
     *
     */
    public function getArticle(){

    }

    /**
     *
     */
    public function getCategory(){

    }

    /**
     *
     */
    public function getArticles(){

    }

    /**
     *
     */
    public function getFrontPage(){
        return 'Forside for bloggeeeeeen, bloggen den er bare miiiiiin!!!!';
    }
}