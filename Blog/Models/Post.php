<?php

namespace fixedyour\Blog\Models;

use fixedyour\Core\Database\Database;
use fixedyour\Core\Database\Row;
use fixedyour\Core\Utilities;

class Post extends Row{


    /**
     * Blog constructor.
     */
    public function __construct() {
        parent::__construct(new Database('fixedyour'));
        $this->setTable('article');
    }

    /**
     *
     * @param $id
     * @return Post
     */
    public static function getById($id){
        return new self();
    }

    public static function getByUrl($url){
        $article = new self();
        return $article
            ->select([
                'ar.*',
                'au.firstname',
                'au.lastname',
                'au.img',
                'au.url as author_url'
            ])
            ->from($article->getTable(). ' ar')
            ->join('author au', 'ar.author = au.id')
            ->where('ar.url', $url)
            ->get(ROW::FETCH_ONE);
    }

    public static function getLastX($limit=5){
        $article = new self();
            $posts = $article
                ->select([
                    'ar.*',
                    'au.firstname',
                    'au.lastname',
                    'au.url as author_url',
                ])
                ->from($article->getTable(). ' ar')
                ->join('author au', 'ar.author = au.id')
                ->order_by('created')
                ->limit(5)
                ->get(ROW::FETCH_ALL);
//            Utilities::debug($posts);
        return $posts;
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