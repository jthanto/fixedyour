<?php

namespace fixedyour\Core\View;

class View{

    public static function parse($tpl, $data=[]){
        ob_start();
        extract($data);
        include($tpl);
        $parsed =  ob_get_contents();
        ob_end_clean();
        return $parsed;
    }

    public static function recursive($tpl, $views, $data=[]){
        foreach($views as  $v_data){
            $data[$v_data['name']] = self::parse($v_data['tpl'], $v_data['data']);
        }
        return self::parse($tpl, $data);
    }

}
