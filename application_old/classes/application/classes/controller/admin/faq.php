<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Faq extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Часто задаваемые вопросы';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "uslug";
    }

    public function action_index() {
        $view = new View('scripts/admin/faq/index');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->faq = ORM::factory('faq')->find_all()->as_array();
        $this->display($view);
    }

    public function action_new() {
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $post['time'] = time();
            $save = ORM::factory('faq')->values($post)->save();
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'faq', 'index');
        }
    }

    public function action_delete() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $cat = ORM::factory('faq', $id);
        $cat->delete();
        AdminHelper::setParamRedirect('success', 'Удалено!', 'faq', 'index');
    }

    public function action_edit() {
        $view = new View('scripts/admin/faq/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $faq = ORM::factory('faq', $id);
            $faq->values($post)->save();
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'faq', 'index');
        }
        $view->faq = ORM::factory('faq', $id);
        $this->display($view);
    }



}