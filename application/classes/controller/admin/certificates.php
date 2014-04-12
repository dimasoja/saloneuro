<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Certificates extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Сертификаты';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "certificates";
    }

    public function action_index() {
        $view = new View('scripts/admin/certificates/index');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        $view->certificates = ORM::factory('certificates')->find_all()->as_array();
        $this->display($view);
    }

    public function action_new() {
        if($_POST) {
            $certificates = ORM::factory('certificates');
            $post = Safely::safelyGet($_POST);
            $id = $certificates->saveCertificate($post);
            if($_FILES) {
                $image = ImageWork::saveCertificateImage($_FILES, $id);
                $certificates->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Добавлено!', 'certificates', 'index');
        }
    }

    public function action_delete() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $cat = ORM::factory('certificates', $id);
        $cat->delete();
        AdminHelper::setParamRedirect('success', 'Удалено!', 'certificates', 'index');
    }

    public function action_edit() {
        $view = new View('scripts/admin/certificates/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        $certificates = ORM::factory('certificates');
        if($_POST) {
            $post = Safely::safelyGet($_POST);
            $page = ORM::factory('certificates', $id);
            $certificates->editCertificate($post, $id);
            if($_FILES['image']['name']!='') {
                $image = ImageWork::saveCertificateImage($_FILES, $id);
                $certificates->saveImage($image, $id);
            }
            AdminHelper::setParamRedirect('success', 'Отредактировано успешно!', 'certificates', 'index');
        }
        $view->certificate = ORM::factory('certificates', $id);
        $this->display($view);
    }



}