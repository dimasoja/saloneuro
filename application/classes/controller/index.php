<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {   
        $id_page = Request::instance()->param('id', '');        
        if ($id_page == '') {
            $this->template = 'layouts/index';
        }        
        parent::__construct($request);
    }

    public function action_index() {    
        $id_page = Request::instance()->param('id', '');        
        if (($id_page == '')) {
            $meta = ORM::factory('meta')->where('request', '=', 'home')->find_all()->as_array();
        } else {
            $meta = ORM::factory('meta')->where('request', '=', $this->request->param('id'))->find_all()->as_array();
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
        if ($meta['0']->id_product) { 
            if ($meta['0']->id_product != '0') {
                $page_content = ORM::factory('products')->where('browser_name', '=', $id_page)->find()->as_array();   
                $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbProducts($meta['0']->id_product);                
                $view->content = $page_content['content'];
                $view->title = $page_content['title'];
                $view->checked = $page_content['title'];
                $view->this_product = $page_content['id_product'];
                $view->image = ORM::factory('images')->where('part','=','products')->where('id_page','=',$page_content['id_product'])->find();                              
                $view->portfolio = ORM::factory('images')->where('id_page','=',$page_content['id_product'])->where('part','=','other')->find_all()->as_array();
                $view->responses = ORM::factory('response')->where('to','=',$page_content['id_product'])->where('published','=','on')->find_all()->as_array();                                
            }
        } else { 
            $page_content = ORM::factory('pages')->where('browser_name', '=', $id_page)->find()->as_array();            
            $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage($page_content['title'], $page_content['browser_name']);              
            $this->template->portfolio = ORM::factory('images')->where('id_page','=', $page_content['id_page'])->where('part','=','other')->find_all()->as_array();   
            if($page_content['id_page']=='58') {
                $this->template->portfolio = ORM::factory('images')->where('id_page','=', $page_content['id_page'])->find_all()->as_array();   
                $this->template->about = '';
            }
            $view->content = $page_content['value'];     
            $view->checked = '';
        }  

        $view->browser_name = $page_content['browser_name'];       
        $this->page_title = $page_content['title'];
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
        $this->template->menu = ORM::factory('menu')->where('published','=','on')->where('parent','=','on')->where('type','=','topmenu')->order_by('position', 'asc')->find_all()->as_array();
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
                if ($rel != "")
                    echo "true";
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

        $array_ids = array('0'=>$get['id_product']);
                        foreach ($array_ids as $id) {
                            if ($id != '') {
                                $product = ORM::factory('products')->where('id_product', '=', $id)->find();
                                if ($product->type == 'for_home')
                                    $type = "для дома"; else
                                    $type = "для бизнеса";
                                $html_order .= ''.$product->title . " (" . $type . ")<br/>";
                                $check = ORM::factory('productsitems')->where('to','=',$id)->find_all()->as_array();                               
                                $types = explode('~', $get['types']);                                
                                foreach($types as $type) {                                
                                    foreach($check as $ch) {
                                         if(isset($ch->id)) {
                                             if(isset($type)) {
                                                 if($ch->id==$type) { $html_order .= '<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ch->value; $html_order .= "</i><br/>"; }
                                             }
                                          }
                                    }
                                }
                            }
                        }          
        $body_params = array(
                             'Имя'      =>$get['name'], 
                             'Телефон'   =>$get['phone'],                              
                             //'Заказали'=>ORM::factory('products')->where('id_product','=',$get['id_product'])->find()->title,                                                          
                             'Заказали'=>$html_order,                                                          
                       );
        $settings = ORM::factory('settings');        
        $sendLetter = $settings->sendLetter($admin_email = $settings->getSetting('admin_email'), $subject, $settings->paramsToHtml($body_params));          
        die('ok');
    }
    


}
