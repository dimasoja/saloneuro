<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Css extends Controller_AdminBase {

    public $template = 'layouts/admin';

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Полезная информация';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "css";
    }

    public function action_index() {
        $view = new View('scripts/admin/css');
        $view->value = ORM::factory('settings')->getSetting('css');
        $this->display($view);

    }

    public function action_savevalue() {
        $post = Safely::safelyGet($_POST);

        if(isset($post['value'])) {
            ORM::factory('settings')->saveSetting('css', $post['value']);
        }
        echo "ok";
        die();
    }
}
