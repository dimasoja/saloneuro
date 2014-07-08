<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Catalog extends Controller_AdminBase
{

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
        $this->cname = "catalog";
    }

    public function action_pages() {
        $view = new View('scripts/admin/catalog/pages');
        $view->catalog = ORM::factory('catalog');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        //$view->categories = $information->getCategories();
        //$view->pages = $massages->getPages();
        $this->display($view);
    }

    public function action_index() {
        $view = new View('scripts/admin/catalog/pages');
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();
        if (isset($_GET['type'])) {
            $type = (int)$_GET['type'];
            $category = ORM::factory('productscat', $type);
            if (isset($category->id)) {
                $view->massage_on = $category->massage_on;
                $view->grade_on = $category->grade_on;
                $view->add_product = true;
                $view->category = ORM::factory('productscat', $category->id);
            }
        } else {
            $type = false;
        }
        $view->techn = ORM::factory('information')->where('lvl','!=','1')->where('technologies','=','on')->find_all()->as_array();
        $view->categories = ORM::factory('productscat')->find_all()->as_array();
        $view->products = ORM::factory('catalog')->find_all()->as_array();
        $view->catalog = ORM::factory('catalog')->find_all()->as_array();
        $view->directory = ORM::factory('directory')->getAll($type);
        $view->grades = ORM::factory('grade')->find_all()->as_array();
        $view->massages = ORM::factory('massage')->find_all()->as_array();
        $this->display($view);
    }

    public function action_delete() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $cat = ORM::factory('catalog')->where('id','=',$id)->find();
        $cat->delete();
        ORM::factory('options')->deleteAll($id);
        AdminHelper::setParamRedirect('success', 'Удалено!', 'catalog', 'index');
    }


    public function action_editpage() {
        $view = new View('scripts/admin/catalog/edit');
        $id = trim(htmlspecialchars($this->request->param('id')));
        $view->success = FrontHelper::successNotif();
        $view->error = FrontHelper::errorNotif();

        if ($_POST) {
            ORM::factory('options')->deleteAll($id);
            $post = Safely::safelyGet($_POST);
            $id_product = ORM::factory('catalog')->editProduct($post, $id);
            //ORM::factory('settings')->reindexProduct($id_product);
            $options = ORM::factory('options');
            $directorysave = $options->saveOptions($post, 'directory', $id_product);
            $gradesave = $options->saveGrade($post, $id_product);
            $massagesave = $options->saveMassage($post, $id_product);
            $technologiessave = $options->saveTechnologies($post, $id_product);
            $productssave = $options->saveProducts($post, $id_product);
            $imagesave = $options->saveImages($post, $id_product);
            $customsave = $options->saveCustom($post, $id_product);
            if ($_FILES) {
                $instruction = ImageWork::saveNewInstructionImage($_FILES, $id_product);
                $scheme = ImageWork::saveNewSchemeImage($_FILES, $id_product);
            }
            AdminHelper::setParamRedirect('success', 'Товар отредактирован!', 'catalog', 'index');
        }
        $view->product = ORM::factory('catalog', $id);        
        $category = ORM::factory('productscat', $view->product->category);
        if (isset($category->id)) {
            $view->massage_on = $category->massage_on;
            $view->grade_on = $category->grade_on;
            $view->category = ORM::factory('productscat', $category->id);
        }
        $view->catalog = ORM::factory('catalog')->find_all()->as_array();
        $view->products = ORM::factory('catalog')->find_all()->as_array();
        $view->directory = ORM::factory('directory')->getAll($view->product->category);
        $view->grades = ORM::factory('grade')->find_all()->as_array();
        $view->massages = ORM::factory('massage')->find_all()->as_array();
        $this->display($view);
    }

    public function action_uploadimage() {
        $image = ImageWork::saveNewCatalogImage($_FILES);
        echo $image;
        exit();
    }

    public function action_uploadmassage() {
        $image = ImageWork::saveNewMassageImage($_FILES);
        echo $image;
        exit();
    }


    public function action_uploadinstruction() {
        $document = ImageWork::saveNewInstructionImage($_FILES);
        echo $document;
        exit();
    }

    public function action_uploadscheme() {
        $document = ImageWork::saveNewSchemeImage($_FILES);
        echo $document;
        exit();
    }

    public function action_newproduct() {
        $post = Safely::safelyGet($_POST);
        $id_product = ORM::factory('catalog')->saveProduct($post);
        $options = ORM::factory('options');
        $directorysave = $options->saveOptions($post, 'directory', $id_product);
        $gradesave = $options->saveGrade($post, $id_product);
        $massagesave = $options->saveMassage($post, $id_product);
        $technologiessave = $options->saveTechnologies($post, $id_product);
        $productssave = $options->saveProducts($post, $id_product);
        $imagesave = $options->saveImages($post, $id_product);
        $customsave = $options->saveCustom($post, $id_product);
        $instruction = ImageWork::saveNewInstructionImage($_FILES, $id_product);
        $scheme = ImageWork::saveNewSchemeImage($_FILES, $id_product);
        AdminHelper::setParamRedirect('success', 'Товар создан!', 'catalog', 'index');
    }

    public function action_copy() {
        $id = trim(htmlspecialchars($this->request->param('id')));
        $product = ORM::factory('catalog')->where('id', '=', $id)->find();
        $product_arr = $product->as_array();
        if (isset($product_arr['id'])) {
            unset($product_arr['id']);
        }
        $new_product = ORM::factory('catalog');
        $new_product->values($product_arr)->save();
        $new_id = $new_product->id;
        $option_copy = ORM::factory('options')->copyOptions($id, $new_id);
        AdminHelper::setParamRedirect('success', 'Скопировано!', 'catalog', 'index');
    }


}