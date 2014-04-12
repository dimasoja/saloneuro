<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Templates extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';


    public function __construct($request) {

        parent::__construct($request);
        $this->cname = "templates";
        ViewHead::addStyle('jquery-ui.css');
        ViewHead::addScript('fancybox2/lib/jquery.mousewheel-3.0.6.pack.js');
        ViewHead::addScript('fancybox2/source/jquery.fancybox.js?v=2.0.6');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-media.js?v=1.0.0');
        ViewHead::addScript('internal_admin.js');
        ViewHead::addStyle('black-fancybox.css?v=1.0.2');
        ViewHead::addStyle('admin-tables.css');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
        $this->page_title = __("Шаблоны писем");
    }

    public function action_index() {
        $view = View::factory('scripts/admin/templates/index');
        $this->template->set('page_name', 'Шаблоны писем');
        $view->templates = ORM::factory('templates')->find_all()->as_array();
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $this->display($view);
    }

    

    public function action_edit() {
        $id = $this->request->param('id', '');
        if ($id != '') {
            $post = $_POST;
            if (!empty($post)) {
                $post = Safely::safelyGet($_POST);
                $templates = ORM::factory('templates')->where('id', '=', $id)->find();
                $templates->values($post);
                $templates->save();
                AdminHelper::setParamRedirect('success', 'Успешно изменено. ', 'templates');
            } else {
                $view = View::factory('scripts/admin/templates/edit');
                $this->template->set('page_name', 'Templates Edit');
                $view->template = ORM::factory('templates')->where('id', '=', $id)->find();
                $this->display($view);
            }
        }
    }
}

