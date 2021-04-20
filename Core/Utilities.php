<?php

namespace fixedyour\Core;


class Utilities{

    static function debug($value){
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }

}