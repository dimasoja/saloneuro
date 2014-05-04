<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Catalog extends Controller_Base
{

    public $template = 'layouts/common-catalog';
    public $category;
    public $id;

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "information";
        $this->category = $request->param('category', '');
        $this->id = $request->param('id', '');
    }

    public function action_index() {
        $view = new View('scripts/catalog');
        $this->template->widths = ORM::factory('catalog')->group_by('width')->find_all()->as_array();
        $this->template->categories = ORM::factory('productscat')->order_by('order', 'desc')->find_all()->as_array();
        $view->categories = ORM::factory('productscat')->order_by('order', 'desc')->find_all()->as_array();
        $this->template->id_page = '';
        //$this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('index');
        $images = array();
        $this->template->current = '';
        $view->images = array();
        $view->items = ORM::factory('catalog')->find_all()->as_array();
        $this->template->right_block = 'no';
        $view->portfolio = $images;
        $get = Safely::safelyGet($_GET);
        $order_by = '';
        $angular = '';
        $rectangular = '';
        $increased = '';
        $width = '';
        $height = '';
        if (isset($get['order_by'])) {
            $order_by = $get['order_by'];
        }
        if (isset($get['angular'])) {
            $angular = $get['angular'];
        }
        if (isset($get['rectangular'])) {
            $rectangular = $get['rectangular'];
        }
        if (isset($get['increased'])) {
            $increased = $get['increased'];
        }
        if (isset($get['width'])) {
            $width = $get['width'];
        }
        if (isset($get['height'])) {
            $height = $get['height'];
        }

        $view->order_by = $order_by;
        $this->template->order_by = 'order_by=' . $order_by . '&';
        $this->template->angular = $angular;
        $this->template->rectangular = $rectangular;
        $this->template->increased = $increased;
        $this->template->width = $width;
        $this->template->height = $height;

        $this->template->heights = ORM::factory('catalog')->where('width', '=', $this->template->width)->group_by('length')->find_all()->as_array();

        if ($this->category == '') {
            $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbCatalog('index');
        }
        if ($this->category != '') {
            $this->template->breadcrumbs = '';
            $currents = '';
            $id_found = '';
            foreach ($view->categories as $cat) {
                $check = strtolower(FrontHelper::transliterate($cat->name));
                if ($this->category == $check) {
                    $currents = $check;
                    $id_found = $cat->id;
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbCatalog('category', $cat->name, 'information/' . $check);
                }
            }
            $view->this_category = ORM::factory('productscat')->where('id', '=', $id_found)->find();
            $view->id_cat = $id_found;
            $view->images = $images;

            $order_item = 'price';
            $order_type = 'asc';
            if ($order_by != '') {
                $order = explode('-', $order_by);
                if ((isset($order[0])) && (isset($order[1]))) {
                    $order_item = $order[0];
                    $order_type = $order[1];
                }
            }
            $where_angular = 'check';
            $where_rectangular = 'check';
            $where_increased = 'check';
            $where_width = 'check';
            $where_height = 'check';
            $angular_value = '';
            $rectangular_value = '';
            $increased_value = '';
            $width_value = '';
            $height_value = '';

            if ($angular == 'on') {
                $where_angular = 'type';
                $angular_value = 'angular';
            }
            if ($rectangular == 'on') {
                $where_rectangular = 'type';
                $rectangular_value = 'rectangular';
            }
            if ($increased == 'on') {
                $where_increased = 'type';
                $increased_value = 'increased';
            }
            if ($width != '') {
                $where_width = 'width';
                $width_value = $width;
            }
            if ($height != '') {
                $where_height = 'length';
                $height_value = $height;
            }

            $items = ORM::factory('catalog')->where('category', '=', $id_found)->where($where_width, '=', $width_value)->where($where_height, '=', $height_value)->order_by($order_item, $order_type)->find_all()->as_array();
            $items_array = array();
            if (($angular == 'on') || ($rectangular == 'on') || ($increased == 'on')) {
                foreach ($items as $key => $item) {
                    if ($angular != 'on') {
                        if ($item->type == 'angular') {
                            unset($items[$key]);
                        }
                    }
                    if ($rectangular != 'on') {
                        if ($item->type == 'rectangular') {
                            unset($items[$key]);
                        }
                    }
                    if ($increased != 'on') {
                        if ($item->type == 'increased') {
                            unset($items[$key]);
                        }
                    }
                }
            }
            $view->items = $items;

            //$view->items = ORM::factory('catalog')->where('category', '=', $id_found)->where($where_width, '=', $width_value)->where($where_height, '=', $height_value)->order_by($order_item, $order_type)->find_all()->as_array();

            $this->template->current = $currents;
        }
        if ($this->id != '') {
            $currents = '';
            $id_found = '';
            foreach ($view->categories as $cat) {
                $check = strtolower(FrontHelper::transliterate($cat->name));
                if ($this->category == $check) {
                    $currents = $check;
                    $id_found = $cat->id;
                    $category_name = ORM::factory('productscat')->where('id', '=', $id_found)->find();
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbCatalog('category', $cat->name, 'information/' . $check);
                }
            }

            $view = new View('scripts/catalog/content');
            $this->template->id_page = '';
            $names = ORM::factory('catalog')->find_all()->as_array();
            $this->template->right_block = 'no';
            $view->portfolio = $images;
            $this->template->breadcrumbs = '';
            $currents = '';
            $id_found = '';
            $found_url = '';

            foreach ($names as $item) {
                $checks = strtolower(FrontHelper::transliterate($item->name));
                if ($this->id == $checks) {
                    $view->page = $item;
                    $view->category_product = ORM::factory('productscat')->where('id','=', $item->category)->find();
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbCatalog('inner', $category_name->name, 'catalog/' . $found_url, $item->name, 'catalog/' . $check . '/' . $checks);
                    $view->technologies = ORM::factory('options')->where('id_product','=', $item->id)->where('type','=','technologies')->find_all()->as_array();
                }
            }
            $view->responses = ORM::factory('response')->where('to','=', $view->page->id)->where('published','=','on')->find_all()->as_array();
            $options_images = ORM::factory('options')->where('type','=','image')->where('id_product','=', $view->page->id)->find_all()->as_array();
            $related_images = array();
            foreach($options_images as $option_image) {
                $related_images[] = ORM::factory('images')->where('id_image','=',$option_image->value)->find();
            }
            $view->related_images = $related_images;
            $view->gidromassage = ORM::factory('massage')->where('id','=','9')->find();
            $view->feetmassage = ORM::factory('massage')->where('id','=','10')->find();
            $view->backmassage = ORM::factory('massage')->where('id','=','11')->find();
            $view->images = $images;
            $this->template->current = $currents;
        }
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $this->display($view);
    }


}