<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Information extends Controller_Base
{

    public $template = 'layouts/common-information';
    public $category;
    public $id;

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "information";
        $this->category = $request->param('category', '');
        $this->id = $request->param('id', '');
        if ($this->id != '') {
            $this->template = 'layouts/common-information-inner';
        }
    }

    public function action_index() {
        $this->template->front_name = '/information';
        $item_founded = false;
        $view = new View('scripts/information');
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $city_limit = ORM::factory('settings')->getSetting('addr_num');
        $this->template->session_city = Session::instance()->get('city');
        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('main','=','on')->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->categories = ORM::factory('information')->roots();
        $view->categories = ORM::factory('information')->roots();
        $this->template->id_page = '';
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Портфолио', 'portfolio');
        $images = array();
        $view->categories = ORM::factory('information')->roots();
        $this->template->current = '';
        foreach ($view->categories as $category) {
            $founded = ORM::factory('information')->where('parent_id', '=', $category->id)->find();
            if (isset($founded->id)) {
                $item_founded = true;
                $images[$founded->id] = $founded->image;
            } else {
                $images[$founded->id] = '';
            }
        }
        $view->images = $images;
        $view->items = ORM::factory('information')->where('lvl', '!=', '1')->find_all()->as_array();
        $this->template->right_block = 'no';
        $view->portfolio = $images;
        if ($this->category == '') {
            $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbInformation('index');
            $this->template->meta_title = 'Полезная информация';
            $keywords = '';
            $description = '';
        }
        if ($this->category != '') {
            $item_founded = false;
            $this->template->breadcrumbs = '';
            $currents = '';
            $id_found = '';
            foreach ($view->categories as $cat) {
                $check = strtolower(FrontHelper::transliterate($cat->name));
                if ($this->category == $check) {
                    $item_founded = true;
                    $currents = $check;
                    $id_found = $cat->id;
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbInformation('category',$cat->name, 'information/'.$check);
                    $info_item = ORM::factory('information')->where('id','=', $id_found)->find();
                    $view->page_name = $info_item->name;
                    $this->template->meta_title = $info_item->title;
                    $keywords = $info_item->keywords;
                    $description = $info_item->description;
                }
            }
            $view->images = $images;
            $view->items = ORM::factory('information')->where('lvl', '!=', '1')->where('parent_id','=',$id_found)->find_all()->as_array();
            $this->template->current = $currents;
        }

        if(!$item_founded) {
            header('Location: /error/404');
            exit();
        }

        if ($this->id != '') {
            $item_founded = false;
            $view = new View('scripts/information/content');
            $this->template->categories = ORM::factory('information')->roots();
            $view->categories = ORM::factory('information')->roots();
            $this->template->id_page = '';
            $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Портфолио', 'portfolio');
            $images = array();
            $view->categories = ORM::factory('information')->roots();
            $this->template->current = '';
            foreach ($view->categories as $category) {
                $founded = ORM::factory('information')->where('parent_id', '=', $category->id)->find();
                if (isset($founded->id)) {
                    $images[$founded->id] = $founded->image;
                } else {
                    $images[$founded->id] = '';
                }
            }
            $view->images = $images;
            $view->items = ORM::factory('information')->where('lvl', '!=', '1')->find_all()->as_array();
            $this->template->right_block = 'no';
            $view->portfolio = $images;
            $this->template->breadcrumbs = '';
            $currents = '';
            $id_found = '';
            $found_url = '';
            foreach ($view->categories as $cat) {
                $check = strtolower(FrontHelper::transliterate($cat->name));
                if ($this->category == $check) {

                    $found_url = $check;
                    $currents = $check;
                    $id_found = $cat->id;
                }
            }
            $id_page = '';
            $category = ORM::factory('information')->where('id','=',$id_found)->find();
            $view->items = ORM::factory('information')->where('lvl', '!=', '1')->find_all()->as_array();
            foreach ($view->items as $item) {
                $checks = strtolower(FrontHelper::transliterate($item->name));
                if ($this->id == $checks) {
                    $item_founded = true;
                    $id_page = $item->id;
                    $view->page = ORM::factory('information')->where('id','=',$id_page)->find()->as_array();
                    $this->template->meta_title = $view->page['title'];
                    $keywords = $view->page['keywords'];
                    $description = $view->page['description'];
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbInformation('inner',$category->name, 'information/'.$found_url, $view->page['name'], 'information/'.$check.'/'.$checks );
                }
            }
            if(!$item_founded) {
                header('Location: /error/404');
                exit();
            }
            $view->images = $images;
            $this->template->current = $currents;
        }

        $this->display($view, $keywords, $description);
    }


}