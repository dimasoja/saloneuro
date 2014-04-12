<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Information extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Полезная информация';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "info";
    }

    public function action_categories() {
        $view = new View('scripts/admin/information/categories');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->information = ORM::factory('information')->getCategories();
        $this->display($view);
    }

    public function action_pages() {
        $view = new View('scripts/admin/information/pages');
        $information = ORM::factory('information');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->categories = $information->getCategories();
        $view->pages = $information->getPages();
        $this->display($view);
    }

    public function action_newcategory() {
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $post['time'] = time();
            $save = ORM::factory('information')->addCategory($post);
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'information', 'categories');
        }
    }

    public function action_newpage() {
        if($_POST) {
            $information = ORM::factory('information');
            $post = Safely::safelyGet($_POST);
            $id = $information->savePage($post);
            if($_FILES) {
                $image = ImageWork::saveInfoImage($_FILES, $id);
                $information->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'information', 'pages');
        }
    }


    public function action_index() {
        $view = new View('scripts/admin/information/index');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->information = ORM::factory('information')->find_all()->as_array();
        $this->display($view);
    }


    public function action_deletecat() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $cat = ORM::factory('information', $id);
        $cat->delete();
        AdminHelper::setParamRedirect('success', 'Удалено!', 'information', 'categories');
    }

    public function action_delete() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $cat = ORM::factory('information', $id);
        $cat->delete();
        AdminHelper::setParamRedirect('success', 'Удалено!', 'information', 'pages');
    }

    public function action_editcat() {
        $view = new View('scripts/admin/information/editcat');
        $id = trim(htmlspecialchars($this->request->param('id')));
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $cat = ORM::factory('information', $id);
            $cat->values($post)->save();
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'information', 'categories');
        }
        $view->cat = ORM::factory('information', $id);
        $this->display($view);
    }

    public function action_editpage() {
        $view = new View('scripts/admin/information/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        $information = ORM::factory('information');
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $page = ORM::factory('information', $id);
            $information->editPage($post, $id);
            if($_FILES['image']['name']!='') {
                $image = ImageWork::saveInfoImage($_FILES, $id);
                $information->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'information', 'pages');
        }
        $view->categories = ORM::factory('information')->getCategories();
        $view->page = ORM::factory('information', $id);
        $this->display($view);
    }



}