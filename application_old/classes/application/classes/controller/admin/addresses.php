<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Addresses extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Адреса филиалов';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "addresses";
    }

    public function action_index() {
        $view = new View('scripts/admin/addresses/index');
        $view->success = FrontHelper::successNotif();
        $view->addr_num = ORM::factory('settings')->getSetting('addr_num');
        $view->error = FrontHelper::errorNotif();
        $view->addresses = ORM::factory('addresses')->find_all()->as_array();
        $this->display($view);
    }

    public function action_new() {
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $post['time'] = time();
            $save = ORM::factory('addresses')->values($post)->save();
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'addresses', 'index');
        }
    }

    public function action_delete() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $cat = ORM::factory('addresses', $id);
        $cat->delete();
        AdminHelper::setParamRedirect('success', 'Удалено!', 'addresses', 'index');
    }

    public function action_edit() {
        $view = new View('scripts/admin/addresses/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $addresses = ORM::factory('addresses', $id);
            $addresses->values($post)->save();
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'addresses', 'index');
        }
        $view->addresses = ORM::factory('addresses', $id);
        $this->display($view);
    }

    public function action_editcity() {
        $view = new View('scripts/admin/addresses/editcity');
        $id = trim(htmlspecialchars($this->request->param('id')));
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $addresses = ORM::factory('addresses', $id);
            $addresses->values($post)->save();
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'addresses', 'index');
        }
        $view->addresses = ORM::factory('addresses', $id);
        $this->display($view);
    }

    public function action_newcity() {
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $post['time'] = time();
            $save = ORM::factory('addresses')->values($post)->save();
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'addresses', 'index');
        }
    }



}