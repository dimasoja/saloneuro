<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Orders extends Controller_Base {

    public $template = 'layouts/common';
    
    public function __construct($request) {
        parent::__construct($request);        
    }

    public function action_index() {

        $post = Safely::safelyGet($_POST);
        $item = ORM::factory('catalog')->where('id', '=', (int)$post['productid'])->find();
        $parent = ORM::factory('productscat')->where('id', '=', $item->category)->find();
        $url = '/catalog/'.strtolower(FrontHelper::transliterate($parent->name)).'/'.strtolower(FrontHelper::transliterate($item->name));
        $post['created'] = time();
        ORM::factory('orders')->values($post)->save();
        header('Location: '.$url);
        exit();
    }

    public function action_new() {
        die('asdf');
        $post = Safely::safelyGet($_POST);
        die(print_r($post));
        $post['created'] = time();
        ORM::factory('orders')->values($post)->save();
        header('Location: '.$post['url']);
        exit();
    }
   
}