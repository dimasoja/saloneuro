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
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $city_limit = ORM::factory('settings')->getSetting('addr_num');
        $this->template->front_name = "/catalog/akrilovye_vanny";
        $this->template->session_city = Session::instance()->get('city', '');

        $view->session_city = Session::instance()->get('city', '');

        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();

        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();

        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Новости', 'news');
        $this->template->id_page = '';

        $view = new View('scripts/catalog');
        $this->template->widths = ORM::factory('catalog')->group_by('width')->find_all()->as_array();
        $this->template->categories = ORM::factory('productscat')->order_by('order', 'asc')->find_all()->as_array();
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
        $semicircular = '';
        $pentagon = '';
        $rectangular = '';
        $increased = '';
        $width = '';
        $height = '';
        $high = '';

        if (isset($get['order_by'])) {
            $order_by = $get['order_by'];
        } else {
            $order_by = 'default';
        }
        if (isset($get['angular'])) {
            $angular = $get['angular'];
        }
        if (isset($get['semicircular'])) {
            $semicircular = $get['semicircular'];
        }
        if (isset($get['pentagon'])) {
            $pentagon = $get['pentagon'];
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
        if (isset($get['high'])) {
            $high = $get['high'];
        }

        $view->order_by = $order_by;
        $this->template->order_by = 'order_by=' . $order_by . '&';
        $this->template->angular = $angular;
        $this->template->semicircular = $semicircular;
        $this->template->pentagon = $pentagon;
        $this->template->rectangular = $rectangular;
        $this->template->increased = $increased;
        $this->template->width = $width;
        $this->template->height = $height;
        $this->template->high = $high;

        $this->template->heights = ORM::factory('catalog')->where('width', '=', $this->template->width)->group_by('length')->find_all()->as_array();
        $this->template->highs = ORM::factory('catalog')->where('width', '=', $this->template->width)->where('length', '=', $this->template->height)->group_by('width')->group_by('length')->find_all()->as_array();
        $item_founded = false;
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
                    $item_founded = true;
                    $currents = $check;
                    $id_found = $cat->id;
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbCatalog('category', $cat->name, 'information/' . $check);
                }
            }
            $view->this_category = ORM::factory('productscat')->where('id', '=', $id_found)->find();
            $this->template->this_category = ORM::factory('productscat')->where('id', '=', $id_found)->find();
            $this_category = ORM::factory('productscat')->where('id', '=', $id_found)->find();
            if ($this_category->type_filter == 'bath') {
                $this->template->meta_title = $view->this_category->title;
                $keywords = $view->this_category->keywords;
                $description = $view->this_category->description;
                $view->id_cat = $id_found;
                $view->images = $images;

                $order_item = 'price';
                $order_type = 'asc';
                if ($order_by != '') {
                    if ($order_by == 'default') {
                        $order_item = 'order';
                        $order_type = 'desc';
                    } else {
                        $order = explode('-', $order_by);
                        if ((isset($order[0])) && (isset($order[1]))) {
                            $order_item = $order[0];
                            $order_type = $order[1];
                        }
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
                                if ($rectangular == 'on') {
                                    if (($item->additional_type != 'rectangular') && ($item->additional_type2 != 'rectangular')) {
                                        unset($items[$key]);
                                    }
                                } elseif ($increased == 'on') {
                                    if (($item->additional_type != 'increased') && ($item->additional_type2 != 'increased')) {
                                        unset($items[$key]);
                                    }
                                } else {
                                    unset($items[$key]);
                                }
                            }
                        }
                        if ($rectangular != 'on') {
                            if ($item->type == 'rectangular') {
                                if ($angular == 'on') {
                                    if (($item->additional_type != 'angular') && ($item->additional_type2 != 'angular')) {
                                        unset($items[$key]);
                                    }
                                } elseif ($increased == 'on') {
                                    if (($item->additional_type != 'increased') && ($item->additional_type2 != 'increased')) {
                                        unset($items[$key]);
                                    }
                                } else {
                                    unset($items[$key]);
                                }
                            }
                        }
                        if ($increased != 'on') {
                            if ($item->type == 'increased') {
                                if ($angular == 'on') {
                                    if (($item->additional_type != 'angular') && ($item->additional_type2 != 'angular')) {
                                        unset($items[$key]);
                                    }
                                } elseif ($rectangular == 'on') {
                                    if (($item->additional_type != 'rectangular') && ($item->additional_type2 != 'rectangular')) {
                                        unset($items[$key]);
                                    }
                                } else {
                                    unset($items[$key]);
                                }
                            }
                        }
                    }
                }
                $newitems = array();
                $count_items = 0;
                foreach ($items as $key => $item) {
                    $massage = ORM::factory('options')->where('id_product', '=', $item->id)->where('type', '=', 'massage')->find_all()->as_array();
                    $gidromassage = array();
                    $underoptions = array();
                    $othersoptions = array();
                    foreach ($massage as $mas) {
                        $massage_image = json_decode($mas->value, true);
                        if (isset($massage_image[1])) {
                            $key = $massage_image[1];
                            $id_image = $massage_image[0];
                            $forsun = $massage_image[2];
                            if (isset($massage_image[4])) {
                                $default_for_massage = $massage_image[4];
                                // если гидромассаж
                                if ($default_for_massage == '1') {
                                    if (isset($massage_image[3])) {
                                        $gidromassage['price'] = $massage_image[3];
                                    }
                                    if (isset($massage_image[5])) {
                                        $gidromassage['required'] = $massage_image[5];
                                    }
                                    $gidromassage['image'] = $id_image;
                                    $gidromassage['forsun'] = $forsun;
                                    $gidromassage['option_id'] = $key;
                                }
                                //если массаж спины или ног
                                if ($default_for_massage == '0') {
                                    if (isset($massage_image[6])) {
                                        if ($massage_image[6] == '1') {
                                            $underoption = array();
                                            if (isset($massage_image[3])) {
                                                $underoption['price'] = $massage_image[3];
                                            }
                                            $underoption['image'] = $id_image;
                                            $underoption['forsun'] = $forsun;
                                            $underoption['option_id'] = $key;
                                            $underoptions[] = $underoption;
                                        } else {
                                            $others = array();
                                            if (isset($massage_image[3])) {
                                                $others['price'] = $massage_image[3];
                                            }
                                            $others['image'] = $id_image;
                                            $others['forsun'] = $forsun;
                                            $others['option_id'] = $key;
                                            $othersoptions[] = $others;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $grades = ORM::factory('options')->where('id_product', '=', $item->id)->where('type', '=', 'grade')->find_all()->as_array();
                    foreach ($grades as $grade) {
                        $grade_array = json_decode($grade->value);
                        if (isset($grade_array[1])) {
                            if ($grade_array[1] == '1') {
                                $bath = ORM::factory('grade')->where('id', '=', $grade_array[0])->find();
                            }
                        }
                    }
                    $massage_price = 0;
                    if ($view->this_category->massage_on == 'on') {
                        if (count($gidromassage) > 0) {
                            if ($gidromassage['required'] == '1') {
                                $massage_price = $gidromassage['price'];
                            }
                        }
                    }
                    if ($view->this_category->grade_on == 'on') {
                        $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $item->id)->find_all()->as_array();
                        $grade_price = 0;
                        foreach ($options as $option) {
                            $grade_opt = json_decode($option->value);
                            $grades = ORM::factory('grade')->where('id', '=', $grade_opt[0])->find();
                            if (isset($grade_opt[2])) {
                                if (($grade_opt[2] == 1) || ($grade_opt[1] == 1)) {
                                    $grade_price += $grades->price;
                                }
                            }
                        }
                    }
                    if (isset($grade_price)) {
                        if (count($options) > 0) {
                            $priceglobal = $massage_price + $grade_price;
                        } else {
                            $priceglobal = $item->price;
                        }
                    } else {
                        $priceglobal = $item->price;
                    }
                    //$items[$key]['priceglobal'] = $priceglobal;
                    //$item = (array)$item;
                    $item = $item->as_array();
                    $item['priceglobal'] = $priceglobal;
                    $newitems[] = $item;
                }
                $order_item = 'price';
                $order_type = 'asc';
                if ($order_by != '') {
                    $order = explode('-', $order_by);
                    if ((isset($order[0])) && (isset($order[1]))) {
                        $order_item = $order[0];
                        if ($order_item == 'price') {
                            $order_type = $order[1];
                            if ($order_type == 'asc') {
                                usort($newitems, array("Controller_Catalog", "sortitemsup"));
                            } else {
                                usort($newitems, array("Controller_Catalog", "sortitemsdown"));
                            }
                        }
                    }
                } else {
                    usort($newitems, array("Controller_Catalog", "sortitemsup"));
                }

                $view->items = $newitems;
                //$view->items = ORM::factory('catalog')->where('category', '=', $id_found)->where($where_width, '=', $width_value)->where($where_height, '=', $height_value)->order_by($order_item, $order_type)->find_all()->as_array();

                $this->template->current = $currents;
                if (!$item_founded) {
                    header('Location: /error/404');
                    exit();
                }
            }
            //die(var_dump($this_category->type_filter));
            if (($this_category->type_filter == 'shower')||($this_category->type_filter == 'accessory')) {

                $this->template->widths = ORM::factory('catalog')->where('category', '=', $this_category->id)->group_by('width')->find_all()->as_array();
                $this->template->meta_title = $view->this_category->title;
                $keywords = $view->this_category->keywords;
                $description = $view->this_category->description;
                $view->id_cat = $id_found;
                $view->images = $images;

                $order_item = 'price';
                $order_type = 'asc';
                if ($order_by != '') {
                    if ($order_by == 'default') {
                        $order_item = 'order';
                        $order_type = 'desc';
                    } else {
                        $order = explode('-', $order_by);
                        if ((isset($order[0])) && (isset($order[1]))) {
                            $order_item = $order[0];
                            $order_type = $order[1];
                        }
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
                                if ($rectangular == 'on') {
                                    if ($item->additional_type != 'rectangular') {
                                        unset($items[$key]);
                                    }
                                } elseif ($increased == 'on') {
                                    if ($item->additional_type != 'increased') {
                                        unset($items[$key]);
                                    }
                                } else {
                                    unset($items[$key]);
                                }
                            }
                        }
                        if ($rectangular != 'on') {
                            if ($item->type == 'rectangular') {
                                if ($angular == 'on') {
                                    if ($item->additional_type != 'angular') {
                                        unset($items[$key]);
                                    }
                                } elseif ($increased == 'on') {
                                    if ($item->additional_type != 'increased') {
                                        unset($items[$key]);
                                    }
                                } else {
                                    unset($items[$key]);
                                }
                            }
                        }
                        if ($increased != 'on') {
                            if ($item->type == 'increased') {
                                if ($angular == 'on') {
                                    if ($item->additional_type != 'angular') {
                                        unset($items[$key]);
                                    }
                                } elseif ($rectangular == 'on') {
                                    if ($item->additional_type != 'rectangular') {
                                        unset($items[$key]);
                                    }
                                } else {
                                    unset($items[$key]);
                                }
                            }
                        }
                    }
                }
                $newitems = array();
                $count_items = 0;
                foreach ($items as $key => $item) {
                    $massage = ORM::factory('options')->where('id_product', '=', $item->id)->where('type', '=', 'massage')->find_all()->as_array();
                    $gidromassage = array();
                    $underoptions = array();
                    $othersoptions = array();
                    foreach ($massage as $mas) {
                        $massage_image = json_decode($mas->value, true);
                        if (isset($massage_image[1])) {
                            $key = $massage_image[1];
                            $id_image = $massage_image[0];
                            $forsun = $massage_image[2];
                            if (isset($massage_image[4])) {
                                $default_for_massage = $massage_image[4];
                                // если гидромассаж
                                if ($default_for_massage == '1') {
                                    if (isset($massage_image[3])) {
                                        $gidromassage['price'] = $massage_image[3];
                                    }
                                    if (isset($massage_image[5])) {
                                        $gidromassage['required'] = $massage_image[5];
                                    }
                                    $gidromassage['image'] = $id_image;
                                    $gidromassage['forsun'] = $forsun;
                                    $gidromassage['option_id'] = $key;
                                }
                                //если массаж спины или ног
                                if ($default_for_massage == '0') {
                                    if (isset($massage_image[6])) {
                                        if ($massage_image[6] == '1') {
                                            $underoption = array();
                                            if (isset($massage_image[3])) {
                                                $underoption['price'] = $massage_image[3];
                                            }
                                            $underoption['image'] = $id_image;
                                            $underoption['forsun'] = $forsun;
                                            $underoption['option_id'] = $key;
                                            $underoptions[] = $underoption;
                                        } else {
                                            $others = array();
                                            if (isset($massage_image[3])) {
                                                $others['price'] = $massage_image[3];
                                            }
                                            $others['image'] = $id_image;
                                            $others['forsun'] = $forsun;
                                            $others['option_id'] = $key;
                                            $othersoptions[] = $others;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $grades = ORM::factory('options')->where('id_product', '=', $item->id)->where('type', '=', 'grade')->find_all()->as_array();
                    foreach ($grades as $grade) {
                        $grade_array = json_decode($grade->value);
                        if (isset($grade_array[1])) {
                            if ($grade_array[1] == '1') {
                                $bath = ORM::factory('grade')->where('id', '=', $grade_array[0])->find();
                            }
                        }
                    }
                    $massage_price = 0;
                    if ($view->this_category->massage_on == 'on') {
                        if (count($gidromassage) > 0) {
                            if ($gidromassage['required'] == '1') {
                                $massage_price = $gidromassage['price'];
                            }
                        }
                    }
                    if ($view->this_category->grade_on == 'on') {
                        $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $item->id)->find_all()->as_array();
                        $grade_price = 0;
                        foreach ($options as $option) {
                            $grade_opt = json_decode($option->value);
                            $grades = ORM::factory('grade')->where('id', '=', $grade_opt[0])->find();
                            if (isset($grade_opt[2])) {
                                if (($grade_opt[2] == 1) || ($grade_opt[1] == 1)) {
                                    $grade_price += $grades->price;
                                }
                            }
                        }
                    }
                    if (isset($grade_price)) {
                        if (count($options) > 0) {
                            $priceglobal = $massage_price + $grade_price;
                        } else {
                            $priceglobal = $item->price;
                        }
                    } else {
                        $priceglobal = $item->price;
                    }
                    //$items[$key]['priceglobal'] = $priceglobal;
                    //$item = (array)$item;
                    $item = $item->as_array();
                    $item['priceglobal'] = $priceglobal;
                    $newitems[] = $item;
                }
                $order_item = 'price';
                $order_type = 'asc';
                if ($order_by != '') {
                    $order = explode('-', $order_by);
                    if ((isset($order[0])) && (isset($order[1]))) {
                        $order_item = $order[0];
                        if ($order_item == 'price') {
                            $order_type = $order[1];
                            if ($order_type == 'asc') {
                                usort($newitems, array("Controller_Catalog", "sortitemsup"));
                            } else {
                                usort($newitems, array("Controller_Catalog", "sortitemsdown"));
                            }
                        }
                    }
                } else {
                    usort($newitems, array("Controller_Catalog", "sortitemsup"));
                }

                $view->items = $newitems;
                //$view->items = ORM::factory('catalog')->where('category', '=', $id_found)->where($where_width, '=', $width_value)->where($where_height, '=', $height_value)->order_by($order_item, $order_type)->find_all()->as_array();

                $this->template->current = $currents;
                if (!$item_founded) {
                    header('Location: /error/404');
                    exit();
                }
            }
        }

        if ($this->id != '') {
            $view = new View('scripts/catalog/content');
            $item_founded = false;
            $currents = '';
            $id_found = '';
            $all_cate = ORM::factory('productscat')->order_by('order', 'asc')->find_all()->as_array();
            foreach ($all_cate as $cat) {
                $check = strtolower(FrontHelper::transliterate($cat->name));
                if ($this->category == $check) {
                    $currents = $check;
                    $id_found = $cat->id;
                    $category_name = ORM::factory('productscat')->where('id', '=', $id_found)->find();
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbCatalog('category', $cat->name, 'information/' . $check);
                }
            }


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
                    $item_founded = true;
                    $view->page = $item;
                    $view->category_product = ORM::factory('productscat')->where('id', '=', $item->category)->find();
                    $view->product = ORM::factory('catalog')->where('id', '=', $item->id)->find();
                    $this->template->link_manufacturer = $view->product->manufacturer;
                    $this->template->meta_title = $view->product->title_meta;
                    $keywords = $view->product->keywords_meta;
                    $description = $view->product->description_meta;
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbCatalog('inner', $category_name->name, 'catalog/' . $found_url, $item->name, 'catalog/' . $check . '/' . $checks);
                    $view->technologies = ORM::factory('options')->where('id_product', '=', $item->id)->where('type', '=', 'technologies')->find_all()->as_array();
                    $related_images = array();
                    if ($view->page->featured != '') {
                        $related_images[] = ORM::factory('images')->where('id_image', '=', $view->page->featured)->find();
                        $options_images = ORM::factory('options')->where('type', '=', 'image')->where('value', '!=', $view->page->featured)->where('id_product', '=', $view->page->id)->find_all()->as_array();
                    } else {

                        $options_images = ORM::factory('options')->where('type', '=', 'image')->where('id_product', '=', $view->page->id)->find_all()->as_array();
                    }
                    foreach ($options_images as $option_image) {
                        $related_images[] = ORM::factory('images')->where('id_image', '=', $option_image->value)->find();
                    }

                    $view->related_images = $related_images;
                    $view->images = $images;
                    $massage = ORM::factory('options')->where('id_product', '=', $item->id)->where('type', '=', 'massage')->find_all()->as_array();
                    $view->gidromassage = array();
                    $view->feetmassage = array();
                    $view->backmassage = array();
                    $view->underoptions = array();
                    $view->othersoptions = array();
                    $massages_images = array();
                    foreach ($massage as $mas) {
                        $massage_image = json_decode($mas->value, true);
                        if (isset($massage_image[1])) {
                            $key = $massage_image[1];
                            $id_image = $massage_image[0];
                            $forsun = $massage_image[2];
                            if (isset($massage_image[4])) {
                                if ($massage_image[5] == '1') {
                                    $massage_im = ORM::factory('images')->where('id_image', '=', $id_image)->find();
                                    if (isset($massage_im)) {
                                        $massages_images[$key] = '.' . $massage_im->path;
                                    }
                                }
                                $default_for_massage = $massage_image[4];
                                // если гидромассаж
                                if ($default_for_massage == '1') {
                                    if (isset($massage_image[3])) {
                                        $view->gidromassage['price'] = $massage_image[3];
                                    }
                                    if (isset($massage_image[5])) {
                                        $view->gidromassage['required'] = $massage_image[5];
                                    }
                                    $view->gidromassage['image'] = $id_image;
                                    $view->gidromassage['forsun'] = $forsun;
                                    $view->gidromassage['option_id'] = $key;
                                }
                                //если массаж спины или ног
                                if ($default_for_massage == '0') {
                                    if (isset($massage_image[6])) {
                                        if ($massage_image[6] == '1') {
                                            $underoption = array();
                                            if (isset($massage_image[3])) {
                                                $underoption['price'] = $massage_image[3];
                                            }
                                            $underoption['image'] = $id_image;
                                            $underoption['forsun'] = $forsun;
                                            $underoption['option_id'] = $key;
                                            $view->underoptions[] = $underoption;
                                        } else {
                                            $others = array();
                                            if (isset($massage_image[3])) {
                                                $others['price'] = $massage_image[3];
                                            }
                                            if (isset($massage_image[5])) {
                                                $others['required'] = $massage_image[5];
                                            }
                                            $others['image'] = $id_image;
                                            $others['forsun'] = $forsun;
                                            $others['option_id'] = $key;
                                            $view->othersoptions[] = $others;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $view->baseimageid = '';
                    $view->baseemptyimage = '';
                    if (isset($related_images[0])) {
                        $baseimage = ORM::factory('catalog')->where('id', '=', $item->id)->find();
                        if ($baseimage->base != '') {
                            $view->baseimageid = $baseimage->base;
                            $baseim = ORM::factory('images')->where('id_image', '=', $baseimage->base)->find();
                            if (isset($baseim->path)) {
                                $view->baseemptyimage = $baseim->path;
                            }
                        }
                        $image = '';
                        if (isset($baseim->path)) {
                            $image = '.' . $baseim->path;
                        }
                        $dest = ImageWork::createImage($image);
                        if ($dest) {
                            imageAlphaBlending($dest, false);
                            imageSaveAlpha($dest, true);
                            $x1 = imagesx($dest);
                            $y1 = imagesy($dest);
                            $slate = imagecreatetruecolor($x1, $y1);
                            $transparent = imagecolorallocatealpha($slate, 0, 255, 0, 127);
                            imagefill($slate, 0, 0, $transparent);
                            imagecopy($slate, $dest, 0, 0, 0, 0, imagesx($dest) - 1, imagesy($dest) - 1);
                            foreach ($massages_images as $mi) {
                                $src = ImageWork::createImage($mi);
                                imageAlphaBlending($src, false);
                                imageSaveAlpha($src, true);
                                $x2 = imagesx($src);
                                $y2 = imagesy($src);
                                imagecopy($slate, $src, 0, 0, 0, 0, imagesx($src) - 1, imagesy($src) - 1);
                            }
                            imageAlphaBlending($slate, false);
                            imageSaveAlpha($slate, true);
                            $mainimagename = '/uploads/mainimage' . time() . '.png';
                            $view->baseimage = $mainimagename;
                            imagepng($slate, '.' . $mainimagename);
                        } else {
                            $view->baseimage = '';
                        }
                    } else {
                        $view->baseimage = '';
                    }


                    $mainimage = ORM::factory('catalog')->where('id', '=', $item->id)->find();
                    $mainim = ORM::factory('images')->where('id_image', '=', $mainimage->featured)->find();
                    if (isset($mainim->path)) {
                        $view->mainimage = $mainim->path;
                    }
                    //                    $baseimage = ORM::factory('catalog')->where('id', '=', $item->id)->find();
                    //                    $view->baseimage = '';
                    //                    if ($baseimage->base != '') {
                    //                        $baseim = ORM::factory('images')->where('id_image', '=', $baseimage->base)->find();
                    //                        if (isset($baseim->path)) {
                    //                            $view->baseimage = $baseim->path;
                    //                        }
                    //                    }


                    $grades = ORM::factory('options')->where('id_product', '=', $item->id)->where('type', '=', 'grade')->find_all()->as_array();
                    foreach ($grades as $grade) {
                        $grade_array = json_decode($grade->value);
                        if (isset($grade_array[1])) {
                            if ($grade_array[1] == '1') {
                                //var_dump($grade_array[0]);
                                $view->bath = ORM::factory('grade')->where('id', '=', $grade_array[0])->where('name', 'LIKE', '%Ванна%')->find();
                            }
                        }
                    }
                } else {
                    // $view = new View('scripts/catalog/content');
                }
            }

            if (!$item_founded) {
                header('Location: /error/404');
                exit();
            }

            $view->responses = ORM::factory('response')->where('to', '=', $view->page->id)->where('published', '=', 'on')->find_all()->as_array();
            $this->template->current = $currents;
        }


        $this->template->css = ORM::factory('settings')->getSetting('css');
        $this->display($view, $keywords, $description);
    }

    function sortitemsup($a, $b) {
        $al = strtolower($a['priceglobal']);
        $bl = strtolower($b['priceglobal']);
        if ($al == $bl) {
            return 0;
        }
        return ($al > $bl) ? +1 : -1;
    }

    function sortitemsdown($a, $b) {
        $al = strtolower($a['priceglobal']);
        $bl = strtolower($b['priceglobal']);
        if ($al == $bl) {
            return 0;
        }
        return ($al < $bl) ? +1 : -1;
    }
}