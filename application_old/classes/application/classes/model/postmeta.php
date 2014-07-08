<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Postmeta extends ORM {

    protected $_table_name = 'postmeta';
    protected $_primary_key = 'meta_id';

    function getValue($post_id = '', $meta_key = '', $type = '') {
        return $this->where('post_id', '=', $post_id)->where('meta_key', '=', $meta_key)->where('type', '=', $type)->find()->meta_value;
    }

    //сохранить значение постмета
    function saveValue($post_id = '', $meta_key = '', $meta_value = '', $type = '') {
        $check = $this->where('post_id', '=', $post_id)->where('meta_key', '=', $meta_key)->where('type', '=', $type);
        if (is_null($check->find()->meta_id)) {
            $this->post_id = $post_id;
            $this->meta_key = $meta_key;
            $this->meta_value = $meta_value;
            $this->type = $type;
            $this->save();
        } else {
            $model = $this->where('post_id', '=', $post_id)->where('meta_key', '=', $meta_key)->where('type', '=', $type)->find();
            $model->meta_value = $meta_value;
            $model->save();
        }
    }

    function getDataById($post_id) {
        $datameta = ORM::factory('postmeta')->where('post_id', '=', $post_id)->find_all();
        $row = array();
        foreach ($datameta as $k => $d) {
            $row[$k] = $d->as_array();
        }
        return $row;
    }

    function get_postmeta($array, $key) {
        foreach ($array as $arr) {
            if ($arr['meta_key'] == $key) {
                return $arr['meta_value'];
            }
        }
    }
    
    function get_for_home($array) {
        $keys = array();
        foreach($array as $key=>$arr) {
            $found = 'no';
            foreach ($arr as $a) {                
                if($a['meta_key']=='for_home') {$found='yes';}
                if(($a['meta_key']=='for_home') and ($a['meta_value']=='false')) {
                   $keys[] = $key;
                } 
            }
            if($found=='no') {$keys[] = $key;}
            
        }
        foreach($keys as $key) {
            
            unset($array[$key]);
        }        
        return $array;
    }
    
    function get_for_business($array) {
        $keys = array();
        foreach($array as $key=>$arr) {
            $found = 'no';
            foreach ($arr as $a) {                
                if($a['meta_key']=='for_business') {$found='yes';}
                if(($a['meta_key']=='for_business') and ($a['meta_value']=='false')) {
                   $keys[] = $key;
                } 
            }
            if($found=='no') {$keys[] = $key;}
            
        }
        foreach($keys as $key) {
            
            unset($array[$key]);
        }        
        return $array;
    }
    
}