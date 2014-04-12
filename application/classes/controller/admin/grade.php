<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Grade extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Комплектация';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "grade";
    }

    public function action_categories() {
        $view = new View('scripts/admin/grade/categories');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->information = ORM::factory('information')->getCategories();
        $this->display($view);
    }

    public function action_pages() {
        $view = new View('scripts/admin/grade/pages');
        $view->grade = ORM::factory('grade');
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

    public function action_newgrade() {
        if($_POST) {
            $grade = ORM::factory('grade');
            $post = Safely::safelyGet($_POST);
            $id = $grade->saveGrade($post);
            if($_FILES) {
                $image = ImageWork::saveGradeImage($_FILES, $id);
                $grade->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'grade', 'index');
        }
    }


    public function action_index() {
        $view = new View('scripts/admin/grade/pages');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->grades = ORM::factory('grade')->find_all()->as_array();
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
        $cat = ORM::factory('grade', $id);
        $cat->delete();
        AdminHelper::setParamRedirect('success', 'Удалено!', 'grade', 'index');
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
        $view = new View('scripts/admin/grade/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        $grade = ORM::factory('grade');
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $grade = ORM::factory('grade', $id);
            $grade->editGrade($post, $id);
            if($_FILES['image']['name']!='') {
                $image = ImageWork::saveGradeImage($_FILES, $id);
                $grade->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'grade', 'index');
        }
        $view->grade = ORM::factory('grade', $id);
        $this->display($view);
    }



}