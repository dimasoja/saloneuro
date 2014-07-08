<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Productscat extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Категории товаров';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "productscat";
    }

    public function action_index() {
        $view = new View('scripts/admin/productscat/index');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->productscat = ORM::factory('productscat')->find_all()->as_array();
        $this->display($view);
    }

    public function action_new() {
        if($_POST) {
            $productscat = ORM::factory('productscat');
            $post = Safely::safelyGet($_POST);
            $id = $productscat->saveProductscat($post);
            if($_FILES) {
                $image = ImageWork::saveProductscatImage($_FILES, $id);
                //$productscat->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'productscat', 'index');
        }
    }

    public function action_delete() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $cat = ORM::factory('productscat', $id);
        $cat->delete();
        AdminHelper::setParamRedirect('success', 'Удалено!', 'productscat', 'index');
    }

    public function action_edit() {
        $view = new View('scripts/admin/productscat/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        $productscat = ORM::factory('productscat');
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $page = ORM::factory('productscat', $id);
            $productscat->editProductscat($post, $id);
            if($_FILES['image']['name']!='') {
                $image = ImageWork::saveProductscatImage($_FILES, $id);
                //$productscat->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'productscat', 'index');
        }
        $view->productscat = ORM::factory('productscat', $id);
        $this->display($view);
    }



}