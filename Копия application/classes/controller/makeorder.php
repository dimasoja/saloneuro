<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Makeorder extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        
        $this->cname = "floorsand_services";
    }

    public function action_index() {
    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Заказать услуги','makeorder');
        $view = new View('scripts/makeorder');
        $view->products_home = ORM::factory('products')->where('published', '=', 'on')->where('type', '=', 'for_home')->find_all();
        $view->products_business = ORM::factory('products')->where('published', '=', 'on')->where('type', '=', 'for_business')->find_all();
        $this->display($view);
    }

    public function action_new() {    
        $orders = ORM::factory('orders');
        $products = ORM::factory('products');
        $post = $_POST;               
        $orders->name = trim(htmlspecialchars($post['name']));
        unset($post['name']);
        $orders->phone = trim(htmlspecialchars($post['phone']));
        unset($post['phone']);
        $orders->order = '';
        $orders->types = '';
        foreach ($post as $key => $product) {
            $expl = explode('-', $key);
            $orders->order .= $expl[1] . "~";
            foreach($product as $key=>$prod) {
		$orders->types .= $key . "~";
            }            
        }     

        $orders->created = strtotime('now');
        $orders->save();
        $subject = 'Заказали услугу';
        $body_params = array(
            'Имя' => $orders->name,
            'Телефон' => $orders->phone             
        );
        $html_order = '';

        $array_ids = explode('~', $orders->order);
                        foreach ($array_ids as $id) {
                            if ($id != '') {
                                $product = ORM::factory('products')->where('id_product', '=', $id)->find();
                                if ($product->type == 'for_home')
                                    $type = "для дома"; else
                                    $type = "для бизнеса";
                                $html_order .= ''.$product->title . " (" . $type . ")<br/>";
                                $check = ORM::factory('productsitems')->where('to','=',$id)->find_all()->as_array();                               
                                $types = explode('~', $orders->types);                                
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
        $html_products = '';    
        foreach ($post as $key => $product) {
            $expl = explode('-', $key);            
            $html_products .= $products->where('id_product','=',$expl[1])->find()->title.';&nbsp;&nbsp;</br>';
        }
        $body_params['Заказанные услуги'] = $html_order;
        $body_params['Отправили'] = date('Y-m-d H:i:s',$orders->created);
        $settings = ORM::factory('settings');        
        $sendLetter = $settings->sendLetter($settings->getSetting('admin_email'), $subject, $settings->paramsToHtml($body_params));        
        Request::instance()->redirect(Route::get('makeorder')->uri(array('controller' => 'makeorder', 'action' => 'success')));
    }

    public function action_success() {
        $view = new View('scripts/makeorder/success');
        $this->display($view);
    }

}