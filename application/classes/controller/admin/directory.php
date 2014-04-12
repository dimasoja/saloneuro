<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Directory extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->page_title = __("Справочник");
        $this->cname = "directory";
    }

    public function action_index() {
        $view = new View('scripts/admin/directory/index');
        $view->directories = ORM::factory('directory')->where('parent_id', '=', '0')->find_all()->as_array();
        $view->categories = ORM::factory('productscat')->find_all()->as_array();
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $get = Safely::safelyGet($_GET);
        if (isset($get['type'])) {
            $type = $get['type'];
            $view->add_type = $get['type'];
        }
        $this->display($view);
    }

    public function action_edit() {
        $view = new View('scripts/admin/directory/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        $view->directory = ORM::factory('directory')->where('id', '=', $id)->find();
        if($view->directory->categories!='') {
            $view->json_cat = json_decode($view->directory->categories);
        } else {
            $view->json_cat = array();
        }
        $view->categories = ORM::factory('productscat')->find_all()->as_array();
        $view->items = ORM::factory('directory')->where('parent_id', '=', $id)->find_all()->as_array();
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
    }

    public function action_add() {
        $view = new View('scripts/admin/directory/add');
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
    }

    public function action_delete() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $root = ORM::factory('directory')->where('id', '=', $id)->find();
        $root->delete();
        $childrens = ORM::factory('directory')->where('parent_id', '=', $id)->find_all()->as_array();
        foreach ($childrens as $children) {
            $children->delete();
        }
        AdminHelper::setParamRedirect('success', 'Удалено!', 'directory', 'index');

    }

    public function action_save() {
        $post = Safely::safelyGet($_POST['test']['1']);
        $cat = Safely::safelyGet($_POST);
        $id = (int)$_POST['id'];
        $categories = $cat['categories'];
        unset($post['categories']);
        $directory = ORM::factory('directory');
        $success = $directory->saveAll($post, $id, $categories);
        if ($success) {
            echo 'ok';
        }
        Session::instance()->set('success', 'Отредактировано!');
        exit();
    }

    public function action_savenew() {
        $post = Safely::safelyGet($_POST['test']['1']);
        $cat = Safely::safelyGet($_POST);
        foreach ($post as $key => $value) {
            if ($value == '') {
                unset($post[$key]);
            }
        }

        $categories = $cat['categories'];
        unset($post['categories']);
        $directory = ORM::factory('directory');
        $success = $directory->saveNew($post, $categories);
        if ($success) {
            echo 'ok';
        }
        Session::instance()->set('success', 'Добавлено!');
        exit();
    }

    public function action_newtext() {
        $post = Safely::safelyGet($_POST);
        if(isset($post['categories'])) {
            $categories = json_encode($post['categories']);
        } else {
            $categories = '';
        }
        $name = $post['name'];
        $model = ORM::factory('directory');
        $model->name = $name;
        $model->type='text';
        $model->categories = $categories;
        $model->save();
        AdminHelper::setParamRedirect('success', 'Добавлено!', 'directory', 'index');
    }

    public function action_edittext() {
        $post = Safely::safelyGet($_POST);
        $id = trim(htmlspecialchars($this->request->param('id')));
        $directory = ORM::factory('directory')->where('id','=',$id)->find();
        $directory->name = $post['name'];
        if(isset($post['categories'])) {
            $categories = json_encode($post['categories']);
        } else {
            $categories = '';
        }
        $directory->categories = $categories;
        $directory->save();
        AdminHelper::setParamRedirect('success', 'Отредактировано!', 'directory', 'index');
    }

}