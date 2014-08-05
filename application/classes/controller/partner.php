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
        $this->template->session_city = Session::instance()->get('city','');
        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('main','=','on')->where('city', '=', $this->template->session_city)->find_all()->as_array();
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
        $fields = array(
            1 => 'Продажа сантехники',
            2 => 'Дизайнер',
            3 => 'Строительная компания',
            4 => 'Другое'
        );
        $fields_html = '';
        foreach($post['sphere'] as $sphere_value) {
            $fields_html .= $fields[$sphere_value].'; ';
        }
        $subject = 'Заявка на сотрудничество';
        $body_params = array(
            'Имя'                   =>$post['contact'],
            'Телефон'               =>$post['phone'],
            'e-mail'                =>$post['email'],
            'Компания'              =>$post['company'],
            'Город'                 =>$post['city'],
            'Сфера деятельности'    =>$fields_html,
            'Другое'                =>$post['another'],
            'Комментарий'           =>$post['comment'],
            'Открыта'               =>date('Y-m-d H:i:s', $post['time'])
        );

        $settings = ORM::factory('settings');
        $is_spam = FrontHelper::isSpam(
            array(
                $post['contact'],
                $post['phone'],
                $post['company'],
                $post['city'],
                $post['another'],
                $post['comment']
            )
        );
        if(!$is_spam) {
            $post['sphere'] = json_encode($post['sphere']);
            ORM::factory('partners')->values($post)->save();
            $sendLetter = $settings->sendLetter($admin_email = $settings->getSetting('admin_email'), $subject, $settings->paramsToHtml($body_params));
        }
        FrontHelper::setHardRedirect('/partner/success');
    }

    public function action_success() {
        $view = new View('scripts/partner/success');
        $this->page_title = __("");
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Поиск',substr($_SERVER['REQUEST_URI'],1));
        $this->template->meta_title = '';
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $city_limit = ORM::factory('settings')->getSetting('addr_num');
        $this->template->session_city = Session::instance()->get('city','');
        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('main','=','on')->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->categories = ORM::factory('information')->roots();
        $view->categories = ORM::factory('information')->roots();
        $this->template->id_page = '';
        $this->template->page_title = '';
        $this->display($view, '', '');
    }
}