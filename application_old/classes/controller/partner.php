<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Partner extends Controller_Base {

    public $template = 'layouts/common';
    private $_upload_img_dir = '../uploads/users/';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index() {
        $view = new View('scripts/partner');
        $this->page_title = __("");
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Поиск',substr($_SERVER['REQUEST_URI'],1));
        $this->template->meta_title = '';
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $city_limit = ORM::factory('settings')->getSetting('addr_num');
        $this->template->session_city = Session::instance()->get('city');
        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->categories = ORM::factory('information')->roots();
        $view->categories = ORM::factory('information')->roots();
        $this->template->id_page = '';
        $this->template->page_title = '';
        $this->display($view, '', '');
    }

    public function action_new() {
        $post = Safely::safelyGet($_POST);
        $post['time'] = time();
        $post['sphere'] = json_encode($post['sphere']);
        ORM::factory('partners')->values($post)->save();
        FrontHelper::setHardRedirect('/partner/success');
    }

    public function action_success() {
        $view = new View('scripts/partner/success');
        $this->page_title = __("");
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Поиск',substr($_SERVER['REQUEST_URI'],1));
        $this->template->meta_title = '';
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $city_limit = ORM::factory('settings')->getSetting('addr_num');
        $this->template->session_city = Session::instance()->get('city');
        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->categories = ORM::factory('information')->roots();
        $view->categories = ORM::factory('information')->roots();
        $this->template->id_page = '';
        $this->template->page_title = '';
        $this->display($view, '', '');
    }
}