<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Blocks extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);

        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');

    }

    public function action_callus() {
        $view = new View('scripts/admin/blocks/callus');
        $view->success = FrontHelper::successNotif();
        $view->content = ORM::factory('settings')->getSetting('callus');
        $view->error = FrontHelper::errorNotif();
        $view->addresses = ORM::factory('addresses')->find_all()->as_array();
        $this->page_title = 'Настройки блока "Позвоните нам"';
        $this->cname = "callus";
        $this->display($view);
    }

    public function action_grade() {
        $view = new View('scripts/admin/blocks/grade');
        $view->success = FrontHelper::successNotif();
        $view->content = ORM::factory('settings')->getSetting('grade');
        $view->error = FrontHelper::errorNotif();
        $view->addresses = ORM::factory('addresses')->find_all()->as_array();
        $this->page_title = 'Настройки блока "Скомплектовать ванну"';
        $this->cname = "gradeblock";
        $this->display($view);
    }

    public function action_benefits() {
        $view = new View('scripts/admin/blocks/benefits');
        $view->success = FrontHelper::successNotif();
        $view->content = ORM::factory('settings')->getSetting('benefits');
        $view->error = FrontHelper::errorNotif();
        $view->addresses = ORM::factory('addresses')->find_all()->as_array();
        $this->page_title = 'Настройки блока "Преимущества"';
        $this->cname = "benefits";
        $this->display($view);
    }

    public function action_trouble() {
        $view = new View('scripts/admin/blocks/trouble');
        $view->success = FrontHelper::successNotif();
        $view->content = ORM::factory('settings')->getSetting('trouble');
        $view->error = FrontHelper::errorNotif();
        $view->addresses = ORM::factory('addresses')->find_all()->as_array();
        $this->page_title = 'Как не ошибиться выборе ванны';
        $this->cname = "trouble";
        $this->display($view);
    }

    public function action_production() {
        $view = new View('scripts/admin/blocks/production');
        $view->success = FrontHelper::successNotif();
        $view->content = ORM::factory('settings')->getSetting('production');
        $view->error = FrontHelper::errorNotif();
        $view->addresses = ORM::factory('addresses')->find_all()->as_array();
        $this->page_title = 'Настройки блока "Продукция Thermolux"';
        $this->cname = "production";
        $this->display($view);
    }

    public function action_footer() {
        $view = new View('scripts/admin/blocks/footer');
        $view->success = FrontHelper::successNotif();
        $view->content = ORM::factory('settings')->getSetting('footer');
        $view->error = FrontHelper::errorNotif();
        $view->addresses = ORM::factory('addresses')->find_all()->as_array();
        $this->page_title = 'Футер';
        $this->cname = "footer";
        $this->display($view);
    }

    public function action_acctypes() {
        $view = new View('scripts/admin/blocks/acctypes');
        $view->success = FrontHelper::successNotif();
        $view->blinds = ORM::factory('settings')->getSetting('blinds');
        $view->mixer = ORM::factory('settings')->getSetting('mixer');
        $view->sink = ORM::factory('settings')->getSetting('sink');
        $view->accessory = ORM::factory('settings')->getSetting('accessory');
        $view->rod = ORM::factory('settings')->getSetting('rod');
        $view->bede = ORM::factory('settings')->getSetting('bede');
        $view->error = FrontHelper::errorNotif();
        $view->addresses = ORM::factory('addresses')->find_all()->as_array();
        $this->page_title = 'Редактировать типы аксессуаров';
        $this->cname = "acctypes";
        $this->display($view);
    }


}