<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Orders extends Controller_Base {

    public $template = 'layouts/common';
    
    public function __construct($request) {
        parent::__construct($request);        
    }

    public function action_index() {
        $post = Safely::safelyGet($_POST);
        if(isset($post['type'])) {
            $url = '/gradebath#!/success';
        } else {
            $item = ORM::factory('catalog')->where('id', '=', (int)$post['productid'])->find();
            $parent = ORM::factory('productscat')->where('id', '=', $item->category)->find();
            $url = '/catalog/'.strtolower(FrontHelper::transliterate($parent->name)).'/'.strtolower(FrontHelper::transliterate($item->name));
        }
        $post['created'] = time();
        $saved = ORM::factory('orders')->values($post)->save();
        $system_email = ORM::factory('settings')->getSetting('admin_email');
        Mails::sendTemplateWithParamsToEmail($system_email, 'order', $saved->id, $post['order']);
        Mails::sendTemplateWithParamsToEmail($post['email'], 'order', $saved->id, $post['order']);
        header('Location: '.$url);
        exit();
    }
}