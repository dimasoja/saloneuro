<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Massage extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Массажные опции';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "massage";
    }

    public function action_categories() {
        $view = new View('scripts/admin/massage/categories');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->information = ORM::factory('information')->getCategories();
        $this->display($view);
    }

    public function action_pages() {
        $view = new View('scripts/admin/massage/pages');
        $view->massages = ORM::factory('massage');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        //$view->categories = $information->getCategories();
        //$view->pages = $massages->getPages();
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

    public function action_newmassage() {
        if($_POST) {
            $massage = ORM::factory('massage');
            $post = Safely::safelyGet($_POST);
            $id = $massage->saveMassage($post);
            if($_FILES) {
                $image = ImageWork::saveMassageImage($_FILES, $id);
                $massage->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'massage', 'index');
        }
    }


    public function action_index() {
        $view = new View('scripts/admin/massage/pages');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->massages = ORM::factory('massage')->find_all()->as_array();
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
        $cat = ORM::factory('massage', $id);
        $cat->delete();
        AdminHelper::setParamRedirect('success', 'Удалено!', 'massage', 'index');
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
        $view = new View('scripts/admin/massage/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        $massage = ORM::factory('massage');
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $massage = ORM::factory('massage', $id);
            $massage->editMassage($post, $id);
            if($_FILES['image']['name']!='') {
                $image = ImageWork::saveMassageImage($_FILES, $id);
                $massage->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'massage', 'index');
        }
        $view->massage = ORM::factory('massage', $id);
        $this->display($view);
    }



}