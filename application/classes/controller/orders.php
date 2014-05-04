<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Orders extends Controller_Base {

    public $template = 'layouts/common';
    
    public function __construct($request) {
        parent::__construct($request);        
    }

    public function action_index() {
        $post = Safely::safelyGet($_POST);
        $post['created'] = time();
        ORM::factory('orders')->values($post)->save();
        header('Location: '.$post['url']);
        exit();
    }

    public function action_new() {
            die('asdf');
    }
   
}