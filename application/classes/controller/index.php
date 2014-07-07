<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Base
{

//    $php_url = $_GLOBAL['REQUEST_URI'];

    public $template = 'layouts/common';

    public function __construct($request) {

        $id_page = Request::instance()->param('id', '');
        if ($id_page == '') {
            $this->template = 'layouts/index';

        }
        if ($id_page == 'about') {
            $this->template = 'layouts/common-about';
        }
        if ($id_page == 'individuals') {
            $this->template = 'layouts/common-ind';
        }
        if ($id_page == 'contacts') {
            $this->template = 'layouts/common-contacts';
        }
        parent::__construct($request);
    }

    public function action_index() {
        $id_page = Request::instance()->param('id', '');
        if ($id_page == 'about') {
            $this->template->front_name = '/about';
        }
        if ($id_page == 'individuals') {
            $this->template->front_name = '/individuals';
        }

        if (($id_page == '')) {
            $this->template->front_name = '/';
            $meta = ORM::factory('meta')->where('request', '=', '/')->find_all()->as_array();
            $content = ORM::factory('pages')->where('browser_name', '=', '/')->find();
            $this->template->meta_title = $content->meta_title;
            if (isset($content->value)) {
                $this->template->index_content = $content->value;
            }
        } else {
            $meta = ORM::factory('meta')->where('request', '=', $this->request->param('id'))->find_all()->as_array();
        }
        if (!isset($this->template->front_name)) {
            $this->template->front_name = '/' . $id_page;
        }

        if (isset($meta['0'])) {
            if (($meta['0']->keywords != '') or ($meta['0']->description != '')) {
                $keywords = $meta['0']->keywords;
                $description = $meta['0']->description;
            } else {
                $meta_val = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
                $keywords = $meta_val['value'];
                $meta_val = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
                $description = $meta_val['value'];
            }
        }
        $view = new View('scripts/pages');
        $id_page = Request::instance()->param('id', '');
        if (!isset($meta['0'])) {
            header('Location: /error/404');
            exit();
        }
        if ($meta['0']->id_product) {
            if ($meta['0']->id_product != '0') {
                $page_content = ORM::factory('products')->where('browser_name', '=', $id_page)->find()->as_array();
                $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbProducts($meta['0']->id_product);
                $view->content = $page_content['content'];
                $view->title = $page_content['title'];
                $view->checked = $page_content['title'];
                $view->this_product = $page_content['id_product'];
                $view->image = ORM::factory('images')->where('part', '=', 'products')->where('id_page', '=', $page_content['id_product'])->find();
                $view->portfolio = ORM::factory('images')->where('id_page', '=', $page_content['id_product'])->where('part', '=', 'other')->find_all()->as_array();
                $view->responses = ORM::factory('response')->where('to', '=', $page_content['id_product'])->where('published', '=', 'on')->find_all()->as_array();
            }
        } else {
            $page_content = ORM::factory('pages')->where('browser_name', '=', $id_page)->find()->as_array();
            if ($id_page != '') {
                $this->template->meta_title = $page_content['meta_title'];
            }
            $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage($page_content['title'], $page_content['browser_name']);
            $this->template->portfolio = ORM::factory('images')->where('id_page', '=', $page_content['id_page'])->where('part', '=', 'other')->find_all()->as_array();
            if ($page_content['id_page'] == '58') {
                $this->template->portfolio = ORM::factory('images')->where('id_page', '=', $page_content['id_page'])->find_all()->as_array();
                $this->template->about = '';
            }
            $view->content = $page_content['value'];
            $view->checked = '';
        }
        $this->template->id_page = $page_content['id_page'];
        $view->browser_name = $page_content['browser_name'];
        $this->page_title = $page_content['title'];
        $this->template->page_title = $page_content['title'];


        //$this->cname = $page_content['cname'];
        // $description = $page_content['description'];
        //            $view = new View('scripts/index');
        //            $this->page_title = __("Manchester Floor Sanding Services, Cheshire Floor Sanding, Refinishing Wood Floors, Restoration Company Wilmslow UK");
        //            //$description = __("Floor Sanding Manchester M4 - Expert Floor Sanding - Guaranteed Best Prices - over 15 years experience - DUST FREE FLOOR SANDING MACHINES - Home &amp; Commercial, School floor sanding, Church floor sanding, Hotel floor sanding specialists, Nationwide service!");
        //
        //            Request::instance()->redirect(Route::get('default')->uri());

        $this->gallery_images = ORM::factory('images')->where('part', '=', 'work_samples')->limit(50)->order_by('sort', 'asc')->offset(0)->find_all()->as_array();

        //  ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        //slider
        $this->template->productscat = ORM::factory('productscat')->order_by('order')->find_all()->as_array();
        $this->template->menu = ORM::factory('menu')->where('published', '=', 'on')->where('parent', '=', 'on')->where('type', '=', 'topmenu')->order_by('position', 'asc')->find_all()->as_array();
        $this->template->certificates = ORM::factory('certificates')->where('featured', '=', 'on')->find_all()->as_array();
        $city_limit = ORM::factory('settings')->getSetting('addr_num');

        $geo_data = Geoipthermo::getData();
        $geo_data = simplexml_load_string($geo_data);
        $geo_data = $geo_data->ip;
        $city = Session::instance()->get('city', '');
        if ($city == '') {
            $session_city = (array)$geo_data->city;
            Session::instance()->set('city', $session_city[0]);
        } else {

        }

        if (isset($geo_data->city)) {
            //            $this->template->city = $geo_data->city;
            $this->template->session_city = Session::instance()->get('city','');
        } else {
            $this->template->session_city = 'Ростов-на-Дону';
        }

        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('main', '=', 'on')->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->order_cities = ORM::factory('addresses')->group_by('city')->find_all()->as_array();
        $this->template->all_cities = ORM::factory('addresses')->find_all()->as_array();
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $this->display($view, $keywords, $description);

    }

    public function action_footerlogin() {
        $this->auto_render = false;
        if (isset($_POST['login_pass'])) {
            $login_pass = trim(htmlspecialchars($_POST['login_pass']));
            $query = ORM::factory('settings')->where('short_name', '=', 'footer_password')->find();
            if ($login_pass == $query->value) {
                //okaaaay
                Cookie::set('footerLogin', true);
                // redirect
                $rel = trim(htmlspecialchars($_POST['rel']));
                if ($rel != "") {
                    echo "true";
                }
            } else {
                echo "Wrong password";
            }
        } else {
            echo "false";
            echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=http://" . $_SERVER['HTTP_HOST'] . "\">";
        }
        // если сессия уже создана
        //Session_Native::instance()->set('id_pay', $quotation->id_quotation);
    }

    function action_savetosession() {
        Session::instance()->get('type');
        Session::instance()->set('type', $_GET['to']);
        die();
    }

    function action_makeorder() {
        $get = $_GET;
        $sales = ORM::factory('sales');
        $sales->created = strtotime('now');
        $sales->values($get)->save();
        $subject = 'Новый заказ на сайте';
        $html_order = '';

        $array_ids = array('0' => $get['id_product']);
        foreach ($array_ids as $id) {
            if ($id != '') {
                $product = ORM::factory('products')->where('id_product', '=', $id)->find();
                if ($product->type == 'for_home') {
                    $type = "для дома";
                } else {
                    $type = "для бизнеса";
                }
                $html_order .= '' . $product->title . " (" . $type . ")<br/>";
                $check = ORM::factory('productsitems')->where('to', '=', $id)->find_all()->as_array();
                $types = explode('~', $get['types']);
                foreach ($types as $type) {
                    foreach ($check as $ch) {
                        if (isset($ch->id)) {
                            if (isset($type)) {
                                if ($ch->id == $type) {
                                    $html_order .= '<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $ch->value;
                                    $html_order .= "</i><br/>";
                                }
                            }
                        }
                    }
                }
            }
        }
        $body_params = array('Имя' => $get['name'], 'Телефон' => $get['phone'], //'Заказали'=>ORM::factory('products')->where('id_product','=',$get['id_product'])->find()->title,
            'Заказали' => $html_order,);
        $settings = ORM::factory('settings');
        $sendLetter = $settings->sendLetter($admin_email = $settings->getSetting('admin_email'), $subject, $settings->paramsToHtml($body_params));
        die('ok');
    }

    public function action_getsizes() {

        $post = Safely::safelyGet($_POST);
        $width = (int)$post['value'];
        $angular = '';
        $rectangular = '';
        $increased = '';
        $where_angular = 'check';
        $where_rectangular = 'check';
        $where_increased = 'check';
        $angular_value = '';
        $rectangular_value = '';
        $increased_value = '';
        if (isset($post['angular'])) {
            $angular = $post['angular'];
        }
        if (isset($post['rectangular'])) {
            $rectangular = $post['rectangular'];
        }
        if (isset($post['increased'])) {
            $increased = $post['increased'];
        }
        if ($angular == 'true') {
            $where_angular = 'type';
            $angular_value = 'angular';
        }
        if ($rectangular == 'true') {
            $where_rectangular = 'type';
            $rectangular_value = 'rectangular';
        }
        if ($increased == 'true') {
            $where_increased = 'type';
            $increased_value = 'increased';
        }


        $items = ORM::factory('catalog')->where('published', '=', 'on')->where('width', '=', $width)->group_by('length')->find_all()->as_array();

        if (($angular == 'true') || ($rectangular == 'true') || ($increased == 'true')) {
            foreach ($items as $key => $item) {
                if ($angular != 'true') {
                    if ($item->type == 'angular') {
                        if ($rectangular == 'true') {
                            if (($item->additional_type != 'rectangular') && ($item->additional_type2 != 'rectangular')) {
                                unset($items[$key]);
                            }
                        } elseif ($increased == 'true') {
                            if (($item->additional_type != 'increased') && ($item->additional_type2 != 'increased')) {
                                unset($items[$key]);
                            }
                        } else {
                            unset($items[$key]);
                        }
                    }
                }
                if ($rectangular != 'true') {
                    if ($item->type == 'rectangular') {
                        if ($angular == 'true') {
                            if (($item->additional_type != 'angular') && ($item->additional_type2 != 'angular')) {
                                unset($items[$key]);
                            }
                        } elseif ($increased == 'true') {
                            if (($item->additional_type != 'increased') && ($item->additional_type2 != 'increased')) {
                                unset($items[$key]);
                            }
                        } else {
                            unset($items[$key]);
                        }
                    }
                }
                if ($increased != 'true') {
                    if ($item->type == 'increased') {
                        if ($angular == 'true') {
                            if (($item->additional_type != 'angular') && ($item->additional_type2 != 'angular')) {
                                unset($items[$key]);
                            }
                        } elseif ($rectangular == 'true') {
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
        $h_array = array();
        $i = 0;
        foreach ($items as $height) {
            $h_array[$i] = $height->length;
            $i++;
        }
        echo json_encode($h_array);
        die();
    }


    public function action_getsizesshowerlength() {

        $post = Safely::safelyGet($_POST);
        $width = (int)$post['value'];
        $angular = '';
        $semicircular = '';
        $pentagon = '';
        $rectangular = '';

        $where_angular = 'check';
        $where_semicircular = 'check';
        $where_rectangular = 'check';
        $where_pentagon = 'check';

        $angular_value = '';
        $semicircular_value = '';
        $rectangular_value = '';
        $pentagon_value = '';

        if (isset($post['angular'])) {
            $angular = $post['angular'];
        }
        if (isset($post['semicircular'])) {
            $semicircular = $post['semicircular'];
        }
        if (isset($post['rectangular'])) {
            $rectangular = $post['rectangular'];
        }
        if (isset($post['pentagon'])) {
            $pentagon = $post['pentagon'];
        }
        if ($angular == 'true') {
            $where_angular = 'type';
            $angular_value = 'angular';
        }
        if ($semicircular == 'true') {
            $where_semicircular = 'type';
            $semicircular_value = 'semicircular';
        }
        if ($rectangular == 'true') {
            $where_rectangular = 'type';
            $rectangular_value = 'rectangular';
        }
        if ($pentagon == 'true') {
            $where_pentagon = 'type';
            $pentagon_value = 'pentagon';
        }
        $categories = ORM::factory('productscat')->where('type_filter', '=', 'shower')->group_by('id')->find_all()->as_array();

        $ids = array();
        foreach ($categories as $category) {
            $ids[] .= $category->id . ',';
        }

        $items = ORM::factory('catalog')->where('published', '=', 'on')->where('width', '=', $width)->where('category', 'in', $ids)->find_all()->as_array();

        if (($angular == 'true') || ($semicircular == 'true') || ($rectangular == 'true') || ($pentagon == 'true')) {
            foreach ($items as $key => $item) {
                if ($angular != 'true') {
                    if ($item->form == 'angular') {
                        unset($items[$key]);
                    }
                }
                if ($semicircular != 'true') {
                    if ($item->form == 'semicircular') {
                        unset($items[$key]);
                    }
                }
                if ($rectangular != 'true') {
                    if ($item->type == 'rectangular') {
                        unset($items[$key]);
                    }
                }
                if ($pentagon != 'true') {
                    if ($item->type == 'pentagon') {
                        unset($items[$key]);
                    }
                }
            }
        }
        $h_array = array();
        $i = 0;
        foreach ($items as $height) {
            $h_array[$i] = $height->length;
            $i++;
        }
        echo json_encode($h_array);
        die();
    }

    public function action_getsizesshowerheight() {

        $post = Safely::safelyGet($_POST);
        $width = (int)$post['width'];
        $length = (int)$post['value'];
        $angular = '';
        $semicircular = '';
        $pentagon = '';
        $rectangular = '';

        $where_angular = 'check';
        $where_semicircular = 'check';
        $where_rectangular = 'check';
        $where_pentagon = 'check';

        $angular_value = '';
        $semicircular_value = '';
        $rectangular_value = '';
        $pentagon_value = '';

        if (isset($post['angular'])) {
            $angular = $post['angular'];
        }
        if (isset($post['semicircular'])) {
            $semicircular = $post['semicircular'];
        }
        if (isset($post['rectangular'])) {
            $rectangular = $post['rectangular'];
        }
        if (isset($post['pentagon'])) {
            $pentagon = $post['pentagon'];
        }
        if ($angular == 'true') {
            $where_angular = 'type';
            $angular_value = 'angular';
        }
        if ($semicircular == 'true') {
            $where_semicircular = 'type';
            $semicircular_value = 'semicircular';
        }
        if ($rectangular == 'true') {
            $where_rectangular = 'type';
            $rectangular_value = 'rectangular';
        }
        if ($pentagon == 'true') {
            $where_pentagon = 'type';
            $pentagon_value = 'pentagon';
        }

        $categories = ORM::factory('productscat')->where('type_filter', '=', 'shower')->group_by('id')->find_all()->as_array();

        $ids = array();
        foreach ($categories as $category) {
            $ids[] .= $category->id . ',';
        }

        $items = ORM::factory('catalog')->where('published', '=', 'on')->where('width', '=', $width)->where('length', '=', $length)->where('category', 'in', $ids)->group_by('height')->find_all()->as_array();


        if (($angular == 'true') || ($semicircular == 'true') || ($rectangular == 'true') || ($pentagon == 'true')) {
            foreach ($items as $key => $item) {
                if ($angular != 'true') {
                    if ($item->form == 'angular') {
                        unset($items[$key]);
                    }
                }
                if ($semicircular != 'true') {
                    if ($item->form == 'semicircular') {
                        unset($items[$key]);
                    }
                }
                if ($rectangular != 'true') {
                    if ($item->form == 'rectangular') {
                        unset($items[$key]);
                    }
                }
                if ($pentagon != 'true') {
                    if ($item->form == 'pentagon') {
                        unset($items[$key]);
                    }
                }
            }
        }
        $h_array = array();
        $i = 0;
        foreach ($items as $height) {
            $h_array[$i] = $height->height;
            $i++;
        }
        echo json_encode($h_array);
        die();
    }


    public function action_getwidths() {
        $post = Safely::safelyGet($_POST);
        if ($post['angular'] == 'true') {
            $angular = 'angular';
        } else {
            $angular = 'none';
        }
        if ($post['increased'] == 'true') {
            $increased = 'increased';
        } else {
            $increased = 'none';
        }
        if ($post['rectangular'] == 'true') {
            $rectangular = 'rectangular';
        } else {
            $rectangular = 'none';
        }
        //$width = (int)$post['value'];
        $h11 = ORM::factory('catalog')->where('published', '=', 'on')->where('type', '=', $angular)->group_by('width')->find_all()->as_array();
        $h21 = ORM::factory('catalog')->where('published', '=', 'on')->where('type', '=', $rectangular)->group_by('width')->find_all()->as_array();
        $h31 = ORM::factory('catalog')->where('published', '=', 'on')->where('type', '=', $increased)->group_by('width')->find_all()->as_array();
        $h12 = ORM::factory('catalog')->where('published', '=', 'on')->where('additional_type', '=', $angular)->group_by('width')->find_all()->as_array();
        $h22 = ORM::factory('catalog')->where('published', '=', 'on')->where('additional_type', '=', $rectangular)->group_by('width')->find_all()->as_array();
        $h32 = ORM::factory('catalog')->where('published', '=', 'on')->where('additional_type', '=', $increased)->group_by('width')->find_all()->as_array();
        $h13 = ORM::factory('catalog')->where('published', '=', 'on')->where('additional_type2', '=', $angular)->group_by('width')->find_all()->as_array();
        $h23 = ORM::factory('catalog')->where('published', '=', 'on')->where('additional_type2', '=', $rectangular)->group_by('width')->find_all()->as_array();
        $h33 = ORM::factory('catalog')->where('published', '=', 'on')->where('additional_type2', '=', $increased)->group_by('width')->find_all()->as_array();
        $heights = array_merge($h11, $h21, $h31, $h12, $h22, $h32, $h13, $h23, $h33);
        $h_array = array();
        $i = 0;
        foreach ($heights as $height) {
            $h_array[$i] = $height->width;
            $i++;
        }
        $h_array = array_unique($h_array);
        $h_array = array_filter($h_array);
        echo json_encode($h_array);
        die();
    }

    public function action_getwidthsshower() {
        $post = Safely::safelyGet($_POST);
        if (isset($post['angular'])) {
            if ($post['angular'] == 'true') {
                $angular = 'angular';
            } else {
                $angular = 'none';
            }
        } else {
            $angular = 'none';
        }
        if (isset($post['semicircular'])) {
            if ($post['semicircular'] == 'true') {
                $semicircular = 'semicircular';
            } else {
                $semicircular = 'none';
            }
        } else {
            $semicircular = 'none';
        }
        if (isset($post['rectangular'])) {
            if ($post['rectangular'] == 'true') {
                $rectangular = 'rectangular';
            } else {
                $rectangular = 'none';
            }
        } else {
            $rectangular = 'none';
        }
        if (isset($post['pentagon'])) {
            if ($post['pentagon'] == 'true') {
                $pentagon = 'pentagon';
            } else {
                $pentagon = 'none';
            }
        } else {
            $pentagon = 'none';
        }
        $categories = ORM::factory('productscat')->where('type_filter', '=', 'shower')->group_by('id')->find_all()->as_array();

        $ids = array();
        foreach ($categories as $category) {
            $ids[] .= $category->id . ',';
        }
        $h11 = ORM::factory('catalog')->where('published', '=', 'on')->where('form', '=', $angular)->where('category', 'IN', $ids)->group_by('width')->find_all()->as_array();
        $h21 = ORM::factory('catalog')->where('published', '=', 'on')->where('form', '=', $semicircular)->where('category', 'IN', $ids)->group_by('width')->find_all()->as_array();
        $h31 = ORM::factory('catalog')->where('published', '=', 'on')->where('form', '=', $rectangular)->where('category', 'IN', $ids)->group_by('width')->find_all()->as_array();
        $h41 = ORM::factory('catalog')->where('published', '=', 'on')->where('form', '=', $pentagon)->where('category', 'IN', $ids)->group_by('width')->find_all()->as_array();
        $heights = array_merge($h11, $h21, $h31, $h41);
        if (($angular == 'none') && ($semicircular == 'none') && ($rectangular == 'none') && ($pentagon == 'none')) {
            $heights = ORM::factory('catalog')->where('published', '=', 'on')->where('category', 'IN', $ids)->group_by('width')->find_all()->as_array();
        }
        $h_array = array();
        $i = 0;
        foreach ($heights as $height) {
            $h_array[$i] = $height->width;
            $i++;
        }
        $h_array = array_unique($h_array);
        $h_array = array_filter($h_array);
        echo json_encode($h_array);
        die();
    }


    public function action_reviewsave() {
        $post = Safely::safelyGet($_POST);
        $post['created'] = time();
        $saved = ORM::factory('response')->saveReview($post);
        if ($saved) {
            echo 'saved';
        }
        exit();
    }

    public function action_writeorder() {
        echo "<pre>";
        print_r($_POST['order']);
        print_r(json_decode($_POST['order']));
        exit();
    }

    function action_generateimagesli() {
        $post = Safely::safelyGet($_POST);
        $image = $post['image'];
        $response = array();
        $response['big'] = '<li data-jcarouselcontrol="true" class="changed-image-big">' . FrontHelper::output($image, 420, 400, 420, 400) . '</li>';
        $response['small'] = '<li data-jcarouselcontrol="true" class="changed-image-small">' . FrontHelper::outputRender($image, 60, 60, 60, 60) . '</li>';
        echo json_encode($response);
        die();
    }

    function action_generateimages() {
        $post = Safely::safelyGet($_POST);
        $image = $post['image'];
        $response = array();
        $response['big'] = FrontHelper::output($image, 420, 400, 420, 400);
        $response['small'] = FrontHelper::outputRender($image, 60, 60, 60, 60);
        echo json_encode($response);
        die();
    }

    function action_changecity() {
        $post = Safely::safelyGet($_POST);
        if (isset($post['city'])) {
            Session::instance()->set('city', $post['city']);
        }
        exit();
    }

    function action_getmap() {
        $post = Safely::safelyGet($_POST);
        $id = (int)$post['id'];
        $address = ORM::factory('addresses')->where('id', '=', $id)->find();
        echo $address->map;
        exit();
    }

    public function action_getproduct() {
        if (Request::$is_ajax OR $this->request !== Request::instance()) {
            $this->auto_render = FALSE;
            header('content-type: application/json');
        }
        $id_product = (int)Request::instance()->param('id', '');
        $post = Safely::safelyGet($_POST);
        $value = array();

        foreach($post as $key=>$value) {
            $value = (array)json_decode(str_replace('\\','',$key));
        }

        $post = $value;
        if ($id_product == 0) {
            $id_product = FrontHelper::getFirstProduct();
        }

        $result = FrontHelper::getProductForBackbone($id_product, $post);
        $result = FrontHelper::getFirstAndLastProductForBackbone($id_product, $result);
        echo json_encode($result);
    }

    public function action_getsteps() {
        if (Request::$is_ajax OR $this->request !== Request::instance()) {
            $this->auto_render = FALSE;
            header('content-type: application/json');
        }
        $current_step = (int)Request::instance()->param('id', '');
        $av_steps = FrontHelper::getAvailableSteps();

        if (in_array($current_step, $av_steps)) {
            FrontHelper::setStep($current_step);
            $av_steps = FrontHelper::getStepsForBackbone($av_steps);
            echo json_encode(array('result' => 'success', 'steps' => $av_steps));
        } else {
            echo json_encode(array('result' => 'error'));
        }
    }

    public function action_generateimage() {
        $post = Safely::safelyGet($_POST);
        FrontHelper::getProductImageForBackbone($post['id']);
        die();
    }

    function action_generatesimages() {
        $post = Safely::safelyGet($_POST);
        $order_pre = json_decode($post['order']);
        $order_pre = (array)$order_pre;
        $order_pre = (array)$order_pre['massages'];
        $order_pre = (array)$order_pre;
        $order = array();
        foreach ($order_pre as $key => $item) {
            $order[$key] = $item;
        }
        $is_electronic = false;
        foreach ($order as $key => $item) {
            $massage_check = ORM::factory('massage')->where('id', '=', $key)->find();
            if (isset($massage_check->electronic)) {
                if ($massage_check->electronic == 'on') {
                    $is_electronic = true;
                }
            }
        }

        $massages_images = array();
        $massage = ORM::factory('options')->where('id_product', '=', $post['id'])->where('type', '=', 'massage')->find_all()->as_array();
        foreach ($massage as $mas) {
            $massage_image = json_decode($mas->value, true);

            if ($is_electronic) {
                if (isset($massage_image[7])) {
                    $id_image = $massage_image[7];
                    $key = $massage_image[1];
                    $massage_im = ORM::factory('images')->where('id_image', '=', $id_image)->find();
                    if (isset($massage_im)) {
                        if (isset($order[$key])) {
                            $massages_images[$key] = '.' . $massage_im->path;
                        }
                    }
                }
            } else {
                if (isset($massage_image[1])) {
                    $id_image = $massage_image[0];
                    $key = $massage_image[1];
                    $massage_im = ORM::factory('images')->where('id_image', '=', $id_image)->find();
                    if (isset($massage_im)) {
                        if (isset($order[$key])) {
                            $massages_images[$key] = '.' . $massage_im->path;
                        }
                    }
                }
            }
        }

        $image = '.' . $post['image'];
        //$desting = ImageWork::createImage($image);
        //imagepng($desting, './uploads/1235.png');
        $dest = ImageWork::createImage($image);
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
        $fn = '/uploads/withopt' . time() . '.png';
        imagepng($slate, '.' . $fn);
        $response = array();
        $response['0'] = $fn;
        //
        $response['1'] = FrontHelper::outputRender($fn, 60, 60, 60, 60);
        $response['2'] = FrontHelper::outputRender($fn, 420, 400, 420, 400);
        echo json_encode($response);
        die();
        //$this->auto_render = false;
        //$this->is_ajax = TRUE;
        //        header('content-type: application/json');
        //        $this->response->headers('Content-Type','application/json');
        //        $this->response->body(json_encode($response));
        //$this->request->headers['Content-Type'] = 'application/json';
        //$this->request->response = json_encode($response);
        //
        //
        //        //header('Content-Type: image/png');
        //
        //        $image = './uploads/123.png';
        //        imagepng($dest, './uploads/123.png');
        //        echo 'asdf';
        //        die();
    }

}
