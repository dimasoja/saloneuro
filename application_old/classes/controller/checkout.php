<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Checkout extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        ViewHead::addStyle('checkout.css');
        }

    public function action_paysucsecc() {
        $view = new View('scripts/paysucsecc');

        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('main_functions.js');
        //ViewHead::addScript('fancybox/jquery.mousewheel-3.0.4.pack.js');
        //ViewHead::addScript('fancybox/jquery.fancybox-1.3.4.pack.js');
        ViewHead::addScript('checkout.js');
        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        //ViewHead::addStyle('../js/fancybox/jquery.fancybox-1.3.4.css');
        $type_checkout = Session_Native::instance()->get('checkout_type', '');
        $id_pay = Session_Native::instance()->get('id_pay', '');
        $view->mas = "No cookie";
        $view->qqq = "";
        if (strcmp($type_checkout, "supplies") == 0) {
            $type_checkout = Request::instance()->redirect(Route::get('supplies')->uri(array('action' => 'step4')));
        }
        if (strcmp($type_checkout, "maintenance") == 0) {
            $type_checkout = Request::instance()->redirect(Route::get('default')->uri());
        }
        if (strcmp($type_checkout, "quotation") == 0) {
            $type_checkout = Request::instance()->redirect(Route::get('quotation')->uri(array('action' => 'step5')));
        }

        $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];
        $this->display($view, $keywords, $description);
    }

    public function action_index() {

        $view = new View('scripts/checkout');
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");

        
        ViewHead::addScript('dw_scrollObj.js');
        
        // ---- FANCYBOX V2 ----
        ViewHead::addScript('fancybox2/lib/jquery-1.7.2.min.js');
        ViewHead::addScript('fancybox2/lib/jquery.mousewheel-3.0.6.pack.js');
        
        ViewHead::addScript('fancybox2/source/jquery.fancybox.js?v=2.0.6');
        ViewHead::addStyle('fancybox2/source/jquery.fancybox.css?v=2.0.6');
        
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
        
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
        
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-media.js?v=1.0.0');
        // ---- FANCYBOX V2 ----
        
        ViewHead::addScript('main_functions.js');
        ViewHead::addScript('checkout.js');
        ViewHead::addScript('footerLogin.js');
        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        
        
        //check checkout type and pay_id
        $type_checkout = Session_Native::instance()->get('checkout_type', '');
        $id_pay = Session_Native::instance()->get('id_pay', '');
        


        //check payment error for all type of checkout
        $payment_error = "";
        //look payment status with order id. if payment status then order confirmed
        $pay_id = Session_Native::instance()->get('id_pay');
        if ($type_checkout == "quotation") {
            $data_pay = ORM::factory('quotation')->where('id_quotation', '=', $pay_id)->find();
        }

        if ($type_checkout == "supplies") {
           //set to session total price and delivery option
            if((isset($_POST['kto_ti_uasya'])) and ($_POST['kto_ti_uasya']=="from_suplice") ) {
                Session_Native::instance()->set('total_price', $_POST['total_val']);
                Session_Native::instance()->set('delivery_options', $_POST['delivery_options']);
                $update_total->total = $_POST['total_val'];
            }
            $data_pay = ORM::factory('suppliessales')->where('id_ss', '=', $pay_id)->find();
            $update_total= ORM::factory('suppliessales', $pay_id);
            $update_total->save();
        }
        if ($type_checkout=='maintenance'){
            $data_pay = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $pay_id)->find();
        }
        if(isset($data_pay)) {
           $pay_stat = $data_pay->payment_status; //check payment status for not double order payment           
        } else {
            Request::instance()->redirect(URL::base());
        }

        $payment_error = Session_Native::instance()->get('payment_error', '');
        if($pay_stat=='1') $payment_error = '501';
        if($payment_error!='') {
            $view->payment_error = (string)$payment_error;
            $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
            $keywords = $meta['value'];
            $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
            $description = $meta['value'];
            Session_Native::instance()->delete('payment_error');
            $this->display($view, $keywords, $description);
        }
        
        // set location for this type of checkout
        if (strcmp($type_checkout, "supplies") == 0) {
            $view->proceedOnClick = "parent.location='/supplies/step4'";
        }
        if (strcmp($type_checkout, "maintenance") == 0) {
            $view->proceedOnClick = "parent.location='/'";
        }
        if (strcmp($type_checkout, "quotation") == 0) {
            //$type_checkout = Request::instance()->redirect(Route::get('quotation')->uri(array('action' => 'step5')));
            $view->proceedOnClick = "parent.location='/online-quotation/step5'";
        }

        if ($type_checkout == "supplies" && isset($_POST['kto_ti_uasya'])) {

            // во избежание многократной записи заказа в БД проверяем по хэшу
            $hash_check = Session_Native::instance()->get('hash', '');
            $duplicateFlag = false;
            if (isset($hash_check) && !empty($hash_check)) {
                $selCheck = ORM::factory('suppliessales')->where('hash', '=', $hash_check)->find()->as_array();
                if ($selCheck['id_ss'] != null)
                    $duplicateFlag = true;
            }
            if ($duplicateFlag == false) {
                // создаем сразу пользователя записываем без деталей.
                $pass = md5(microtime());
                $user = ORM::factory('userscustomers');
                $user->type = 'supplies';
                $user->password = $pass;
                $user->save();

                $user = ORM::factory('userscustomers')->where('password', '=', $pass)->find();
                $id_pay = $user->id_user;
                Session_Native::instance()->set('id_pay', $id_pay);
                $hash = md5(microtime());
                if (isset($_POST['supplies'])) {

                    // записывает данные о заказе из buy supplies в таблицу supplies_sales
                    $sup = ORM::factory('suppliessales');

                    $sup->id_user = $id_pay;
                    $sup->supplies = serialize($_POST['supplies']);
                    $sup->auto_send = $_POST['auto_send'];
                    $sup->hash = $hash;
                    $sup->delivery_options = $_POST['delivery_options'];
                    
                    $sup->total = $_POST['total_val'];
                    $sup->date = time();
                    $sup->save();       

                    Session_Native::instance()->set('total_price', $_POST['total_val']);
                    Session_Native::instance()->set('hash', $hash);
                }
            }
        }

        switch ($type_checkout) {
            case "quotation":
                $data = ORM::factory('quotation')->where('id_quotation', '=', $id_pay)->find();
                $payment = $data->payment;
                $data_sale = ORM::factory('promocodes')->where('code','=',$data->code)->find();
                if(isset($data_sale->sale))
                    $sale = (float)$data_sale->sale;
                else
                    $sale = 0;
                if($data->option=='2') $payment = $data->payment * (0.9 -$sale/100);
                if($data->option=='1') $payment = $data->payment * 0.05 * (1-$sale/100);
                break;

            case "maintenance":
                $data = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $id_pay)->find();
                $payment = $data->option_price;
                break;

            case "supplies":
                //$data = ORM::factory('suppliessales')->where('id_user', '=', $id_pay)->find();
                $data->name = Session_Native::instance()->get('name');
                $data->surname = Session_Native::instance()->get('surname');
                $data->address = Session_Native::instance()->get('address');
                $data->email = Session_Native::instance()->get('email');
                $data->town = Session_Native::instance()->get('town');
                $data->postcode = Session_Native::instance()->get('postcode');
                $view->company = Session_Native::instance()->get('company');
                $view->landtel = Session_Native::instance()->get('landtel');
                $view->mobtel = Session_Native::instance()->get('mobtel');
                $data->alternative_address = Session_Native::instance()->get('alternative_address');
                $data->alternative_postcode = Session_Native::instance()->get('alternative_postcode');
                $data->alternative_town = Session_Native::instance()->get('alternative_town');
                
                $view->special_notes = Session_Native::instance()->get('special_notes');
                if((isset($_POST['kto_ti_uasya'])) and ($_POST['kto_ti_uasya']=="from_suplice") ) {
                    $payment = $_POST['total_val'];
                    $view->payment = $_POST['total_val'];
                } else {
                    $view->payment = Session_Native::instance()->get('total_price');
                }
                break;

            default:
                Request::instance()->redirect(Route::get('default')->uri());
                break;
        }
        $view->company = Session_Native::instance()->get('company');
                $view->special_notes = Session_Native::instance()->get('special_notes');        
        $view->cardholder_name = $data->name;
        $view->cardholder_surname = $data->surname;
        $view->address = $data->address;
        $view->email = $data->email;
        $view->town = $data->town;
        $view->postcode = $data->postcode;
        $view->alternative_address = $data->alternative_address;
        $view->alternative_town = $data->alternative_town;
        $view->alternative_postcode = $data->alternative_postcode;
        if ($type_checkout != "supplies") {
            $view->payment = $payment;
            $view->total_price_for_job = $data->total_price_for_job;
        } else {
            
            $view->total_price_for_job = Session_Native::instance()->get('total_price', '');
        }

        $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];
        $this->display($view, $keywords, $description);
        //}
    }
    
    public function action_makepay() {

        $view = new View('scripts/checkout');
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        
        $type_checkout = Session_Native::instance()->get('checkout_type', '');
        $id_pay = Session_Native::instance()->get('id_pay', '');
        
        //look payment status with order id. if payment status then order confirmed
        if ($type_checkout == "quotation") {
            $data_pay = ORM::factory('quotation')->where('id_quotation', '=', $id_pay)->find();
        }
        if ($type_checkout == "supplies") {
            $data_pay = ORM::factory('suppliessales')->where('id_ss', '=', $id_pay)->find();
        }
        if ($type_checkout == "maintenance") {
            $data_pay = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $id_pay)->find();
        }

        $pay_stat = $data_pay->payment_status;
        if ($pay_stat == '1') {
            $payment_error = '501';
            Session_Native::instance()->set('payment_error', $payment_error);
            Request::instance()->redirect('checkout');
        }

        //set session var and payment 
        switch ($type_checkout) {
            case "quotation":
                $data = ORM::factory('quotation')->where('id_quotation', '=', $id_pay)->find();       
                $payment = $data->payment;
                $sale = (float)$data->sale;
                if($data->option=='2') $payment = $data->payment * (0.9 - $sale/100);
                if($data->option=='1') $payment = $data->payment * 0.05 * (1-$sale/100);
                break;

            case "maintenance":
                $data = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $id_pay)->find();
                $payment = $data->option_price;
                break;

            case "supplies":
                //$data = ORM::factory('suppliessales')->where('id_user', '=', $id_pay)->find();
                $data->name = Session_Native::instance()->set('name', $_POST['cardholder_name']);
                $data->surname = "";
                $data->address = Session_Native::instance()->set('address', $_POST['address']);
                $data->email = Session_Native::instance()->set('email', $_POST['email']);
                $data->town = Session_Native::instance()->set('town', $_POST['town']);
                $data->postcode = Session_Native::instance()->set('postcode', $_POST['postcode']);
                $data->alternative_address = Session_Native::instance()->set('alternative_address', $_POST['alternative_address']);
                $data->alternative_town = Session_Native::instance()->set('alternative_town', $_POST['alternative_town']);
                $data->alternative_postcode = Session_Native::instance()->set('alternative_postcode', $_POST['alternative_postcode']);
                Session_Native::instance()->set('landtel', $_POST['landtel']);
                Session_Native::instance()->set('mobtel', $_POST['mobtel']);
                
                $payment =  Session_Native::instance()->get('total_price');

                //Session_Native::instance()->set('total_price', '');
                break;

            default:
                Request::instance()->redirect(Route::get('default')->uri());
                break;
        }
        Session_Native::instance()->set('company', $_POST['cardholder_company']);
        $view->company = $_POST['cardholder_company'];
        Session_Native::instance()->set('special_notes', $_POST['special_notes']);
        $view->special_notes = $_POST['special_notes'];
        $view->cardholder_name = $data->name;
        $view->cardholder_surname = $data->surname;
        $view->address = $data->address;
        $view->email = $data->email;
        $view->town = $data->town;
        $view->postcode = $data->postcode;
        $view->alternative_postcode = $data->alternative_postcode;
        $view->alternative_town = $data->alternative_town;
        $view->alternative_address = $data->alternative_address;

        if ($type_checkout != "supplies") {
            $view->payment = $payment;
            $view->total_price_for_job = $data->total_price_for_job;
        } else {
            $view->payment = Session_Native::instance()->get('total_price', '');
            $view->total_price_for_job = Session_Native::instance()->get('total_price', '');
        }

        $make_payment = new globaliris();
        $result = $make_payment->getData($_POST['cardholder_name'],                          //card name
                                         $_POST['cardholderpan'],                            //card number
                                         str_replace("/", "", $_POST['card_expiration']),    //expire date       
                                         (string)$payment,                                      //how much
                                         $_POST['cvv2val'],           
                                         $pay_id="");                                        //unique order id for hsbc
        if(isset($result->result)) $res = (int)$result->result; else $result->result = 'unknown error';
        //if result with error then send error to checkout page
        if ($result->result != '00') {
            if($type_checkout=='supplies') {
                    $new_user = ORM::factory('userscustomers');
                         $name_arr = explode(" ", $_POST['cardholder_name']);
                    $new_user->name = $name_arr[0];
                         if (isset($name_arr[1])) {
                    $new_user->surname = $name_arr[1];} else { $new_user->surname = ""; }
                    $new_user->email = $_POST['email'];
                    $new_user->address = $_POST['address'];
                    $new_user->town = $_POST['town'];
                    $new_user->type = 'supplies';
                    $new_user->postcode = $_POST['postcode'];
                    $new_user->alternative_address = $_POST['alternative_address'];
                    $new_user->alternative_town = $_POST['alternative_town'];
                    $new_user->alternative_postcode = $_POST['alternative_postcode'];
                    $new_user->phone = $_POST['landtel'];
                    $new_user->mphone = $_POST['mobtel'];
                    $new_user->special_notes = $_POST['special_notes'];
                    $new_user->company = $_POST['cardholder_company'];
                         $hash = Session_Native::instance()->get('hash');
                    $new_user->hash = $hash;
                    $new_user->save();
                    
                    $data = ORM::factory('suppliessales');
                    $new_user = ORM::factory('userscustomers')->where('hash', '=', $hash)->find();   
                    $data->id_user = $new_user->id_user;       
                    $data->payment_status = '0';
                    $data->payment_id = '';
                         $supplies_arr = Session_Native::instance()->get('post_action');
                    $data->supplies = $supplies_arr['supplies_arr'];
                    $data->delivery_options = Session_Native::instance()->get('delivery_options');
                    $data->total = $payment;
                    $data->hash = $hash;
                    $data->date = time();
                    $data->save();
                   
            } 
            if($type_checkout=='quotation') {
                    $data = ORM::factory('quotation')->where('id_quotation', '=', $id_pay)->find();
                         $name_arr = explode(" ", $_POST['cardholder_name']);
                    $data->name = $name_arr[0];
                         if (isset($name_arr[1])) {
                    $data->surname = $name_arr[1];} else { $new_user->surname = ""; }
                    $data->email = $_POST['email'];
                    $data->special_notes = $_POST['special_notes'];
                    $data->company = $_POST['cardholder_company'];
                    $data->address = $_POST['address'];
                    $data->town = $_POST['town'];
                    $data->postcode = $_POST['postcode'];
                    $data->alternative_address = $_POST['alternative_address'];
                    $data->alternative_town = $_POST['alternative_town'];
                    $data->alternative_postcode = $_POST['alternative_postcode'];

                    $data->save();
                    
            }
            Session_Native::instance()->set('payment_error', $res);
            Session_Native::instance()->set('transaction_id', "");
            Session_Native::instance()->set('order_id', "");
            Request::instance()->redirect('checkout');
        } else {   //if result without error
            Session_Native::instance()->delete('payment_error');
            switch ($type_checkout) {    //check type_checkout for writing to database payment_status
                case "quotation":
                    $data = ORM::factory('quotation')->where('id_quotation', '=', $id_pay)->find();
                    $data->payment_status = '1';
                    $data->payment_id = $result->orderid;
                    $data->special_notes = $_POST['special_notes'];
                    $data->company = $_POST['cardholder_company'];
                    Session_Native::instance()->set('transaction_id', $result->orderid);
                    Session_Native::instance()->set('order_id', $id_pay);
                    $data->save();
                    break;

                case "maintenance":
                    $data = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $id_pay)->find();
                    $data->payment_status = '1';
                    $data->payment_id = $result->orderid;
                    $data->special_notes = $_POST['special_notes'];
                    $data->company = $_POST['cardholder_company'];
                    $data->save();
                    break;

                case "supplies":
                   //<!-------------------------save to users_customer and supplies_sales--------------------!>//
                    $new_user = ORM::factory('userscustomers');
                         $name_arr = explode(" ", $_POST['cardholder_name']);
                    $new_user->name = $name_arr[0];
                         if (isset($name_arr[1])) {
                    $new_user->surname = $name_arr[1];} else { $new_user->surname = ""; }
                    $new_user->email = $_POST['email'];
                    $new_user->address = $_POST['address'];
                    $new_user->town = $_POST['town'];
                    $new_user->type = 'supplies';
                    $new_user->phone = $_POST['landtel'];
                    $new_user->mphone = $_POST['mobtel'];
                    $new_user->postcode = $_POST['postcode'];
                    $new_user->alternative_address = $_POST['alternative_address'];
                    $new_user->alternative_town = $_POST['alternative_town'];
                    $new_user->alternative_postcode = $_POST['alternative_postcode'];
                    $new_user->special_notes = $_POST['special_notes'];
                    $new_user->company = $_POST['cardholder_company'];
                         $hash = Session_Native::instance()->get('hash');
                    $new_user->hash = $hash;
                    $new_user->save();
                    
                    $data = ORM::factory('suppliessales');
                    $new_user = ORM::factory('userscustomers')->where('hash', '=', $hash)->find();   
                    $data->id_user = $new_user->id_user;       
                    $data->payment_status = '1';
                    $data->payment_id = $result->orderid;
                         $supplies_arr = Session_Native::instance()->get('post_action');
                    $data->supplies = $supplies_arr['supplies_arr'];
                    $data->delivery_options = Session_Native::instance()->get('delivery_options');
                    $data->total = $payment;
                    $data->hash = $hash;
                    $data->date = time();
                    Session_Native::instance()->set('transaction_id', $result->orderid);
                    Session_Native::instance()->set('order_id', $id_pay);
                    $data->save();
                    Session_Native::instance()->set('id_pay', $data->id_ss);
                    break;
                default :
                    
                    break;
            }
            $check = ORM::factory('checkout');
            $name_arr = explode(" ", $_POST['cardholder_name']);
            $check->name = $name_arr[0];
            if (isset($name_arr[1])) {
                $check->surname = $name_arr[1];
            } else {
                $check->surname = "";
            }
            $check->email = $_POST['email'];
            $check->address = $_POST['address'];
            $check->town = $_POST['town'];
            $check->postcode = $_POST['postcode'];
            $check->alternative_address = $_POST['alternative_address'];
            $check->alternative_town = $_POST['alternative_town'];
            $check->alternative_postcode = $_POST['alternative_postcode'];
            $check->card_number = $_POST['cardholder_name'];
            $check->expiry_date = $_POST['card_expiration'];
            $check->cvv = $_POST['cvv2val'];
            $check->total = $payment;
            $check->date = time();
            $check->key = $this->giveRandom();
            $check->Area = $type_checkout;
            $check->save();

            //redirect to order confirmation page
            if (strcmp($type_checkout, "supplies") == 0) {
                Request::instance()->redirect(Route::get('supplies')->uri(array('action' => 'step4')));
            }
            if (strcmp($type_checkout, "maintenance") == 0) {
                Request::instance()->redirect(Route::get('maintenance')->uri(array('action' => 'successfull')));
            }
            if (strcmp($type_checkout, "quotation") == 0) {
               Request::instance()->redirect(Route::get('quotation')->uri(array('action' => 'step5')));
            }
            //<!------------------------ save to checkout page ------------------------>
        }
      }
    
      function giveRandom(){
        $random = rand(0,9999999999);
        $length = strlen($random);
        $random = str_pad($random, $length, "0", STR_PAD_LEFT);
        return $random;
    }


    
    private function action_pay() {
        $post = Session_Native::instance()->get('pay_post', '');
        $type_checkout = Session_Native::instance()->get('checkout_type', '');
        $id_pay = Session_Native::instance()->get('id_pay', '');
        $hash = Session_Native::instance()->get('hash', '');

        if ('' == $post || empty($_POST)) {
            Request::instance()->redirect(Route::get('default')->uri());
        }

        switch ($type_checkout) {
            case "quotation":
                $data = ORM::factory('quotation')->where('id_quotation', '=', $id_pay)->find();
                break;

            case "maintenance":
                $data = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $id_pay)->find();
                break;

            case "supplies":
                $data = ORM::factory('userscustomers')->where('id_user', '=', $id_pay)->find();
                break;

            default:
                Request::instance()->redirect(Route::get('default')->uri());
                break;
        }

        $hsbc = new hsbc();

        $hsbc->payment_mode = 'Y';
        $hsbc->debug = false;
        $hsbc->ccparesultscode = $_POST['CcpaResultsCode'];

//        $hsbc->cavv = $_POST['CAVV'];
        $hsbc->xid = $_POST['XID'];

        $hsbc->xmldata = array(
            'name' => Kohana::config('general')->hsbc_client_username,
            'password' => Kohana::config('general')->hsbc_client_password,
            'clientid' => Kohana::config('general')->hsbc_id,
            'cardholderpan' => Kohana::config('general')->hsbc_client_id,
            'number' => $post['cardholderpan'],
            'cvv2val' => $post['cvv2val'],
            'expires' => $post['card_expiration'],
            'issuenum' => "",
            'startdate' => "",
            'total' => "1",
            'email' => $data->email,
            'street1' => $post['address'],
            'street2' => "",
            'city' => $post['town'],
            'stateprov' => "UK",
            'postalcode' => $post['postcode'],
            'country' => "UK"
        );

        $result = $hsbc->execute_api();
        $result = "A";
        if ("A" == $result) {
            Session_Native::instance()->delete('pay_post');
            Session_Native::instance()->delete('checkout_type');
            Session_Native::instance()->delete('id_pay');
            Session_Native::instance()->delete('hash');

            /*
              $subject = "New checkout from FloorsandUK";
              $body = "Hello,<br>";
              $body .= "Somebody was paid for the order on the site. Please, go to the admin-side and check this.";
              Email::send(Kohana::config('general')->admin_email, Kohana::config('general')->admin_email, $subject, $body, true);
             */

            if ('' == $hash) {
                $data->payment_status = 1;
                $data->save();
                switch ($type_checkout) {
                    case "quotation":
                        $dates = ORM::factory('sheduledates')->where('id_quotation', '=', $id_pay)->find_all();
                        foreach ($dates as $da) {
                            $da->enabled = 1;
                            $da->save();
                        }
                        break;

                    case "maintenance":
                        $dates = ORM::factory('sheduledates')->where('id_maintenance', '=', $id_pay)->find_all();
                        foreach ($dates as $da) {
                            $da->enabled = 1;
                            $da->save();
                        }
                        break;

                    default:
                        Request::instance()->redirect(Route::get('default')->uri());
                        break;
                }
            } else {
                $supplies = ORM::factory('suppliesuser')->where('hash', '=', $hash)->find_all();
                foreach ($supplies as $supply) {
                    $supply->id_user = $id_pay;
                    $supply->payment_status = 1;
                    $supply->save();
                }
            }

            switch ($type_checkout) {
                case "quotation":
                    Request::instance()->redirect(Route::get('quotation')->uri(array('controller' => 'quotation', 'action' => 'successfull')));
                    break;

                case "maintenance":
                    Request::instance()->redirect(Route::get('maintenance')->uri(array('controller' => 'maintenance', 'action' => 'successfull')));
                    break;

                case "supplies":
                    Request::instance()->redirect(Route::get('supplies')->uri(array('controller' => 'supplies', 'action' => 'successfull')));

                default:
                    Request::instance()->redirect(Route::get('default')->uri());
                    break;
            }
        } else {
            Request::instance()->redirect(Route::get('quotation')->uri(array('controller' => 'quotation', 'action' => 'failure')));
        }
    }

    private function sent_data($post, $payment) {
//        if (Session_Native::instance()->get('checkout_type', '') == "supplies") {
//            $usr = ORM::factory('users');
//            $usr->name = $post['cardholder_name'];
//            $usr->surname = $post['cardholder_surname'];
//            $usr->email = $post['cardholder_email'];
//            $usr->address = $post['address'];
//            $usr->town = $post['town'];
//            $usr->postcode = $post['postcode'];
//            $usr->save();
//            
//            Session_Native::instance()->set('id_pay', $usr->id_user);
//        }
        $pieces = explode(" ", $post['cardholder_name']);
        $surname = "";
        for ($it = 1; $it < sizeof($pieces); $it++) {
            $surname.=$pieces[$it];
        }
        $checkout = ORM::factory('checkout');
        $checkout->name = $pieces[0];
        //$checkout->name = $post['cardholder_name'];
        $checkout->surname = $surname;
        //$checkout->surname="sssMMMIIITTT"
        //$checkout->surname = $post['cardholder_surname'];
        $checkout->email = $post['email'];
        $checkout->address = $post['address'];
        $checkout->town = $post['town'];
        $checkout->postcode = $post['postcode'];
        $checkout->card_number = $post['cardholderpan'];
        $checkout->expiry_date = $post['card_expiration'];
        $checkout->cvv = $post['cvv2val'];
        $checkout->total = $payment;
        $checkout->area = $type_checkout = Session_Native::instance()->get('checkout_type', '');

        do {
            $letters = "0123456789";
            $key = "";
            for ($i = 0; $i <= 9; $i++) {
                $key .= $letters[rand(1, strlen($letters) - 1)];
            }
            $tmp = ORM::factory('checkout')->where('key', '=', $key)->find()->as_array();
        } while (isset($tmp['id_checkout']));
        $checkout->key = $key;
        $checkout->save();
        Email::send($post['email'], "admin@floorsanduk.com", "FloorSandUk: Checkout details", "Hello. Tracking number for your order is " . $key);

        Session_Native::instance()->set('pay_post', $post);

        $hsbc = new hsbc();

        $hsbc->add_pass_field('CardholderPan', $post['cardholderpan']);
        $hsbc->add_pass_field('CardExpiration', $post['card_expiration']);
        $hsbc->add_pass_field('CcpaClientId', Kohana::config('general')->hsbc_client_id);
        $hsbc->add_pass_field('CurrencyExponent', '2');
//        $hsbc->add_pass_field('PurchaseAmount', $payment);
//        $hsbc->add_pass_field('PurchaseAmountRaw', $payment * 100);
        $hsbc->add_pass_field('PurchaseAmount', '1'); // $hsbc->add_pass_field('PurchaseAmount', $payment);
        $hsbc->add_pass_field('PurchaseAmountRaw', '100'); // $hsbc->add_pass_field('PurchaseAmountRaw', $payment * 100);
        $hsbc->add_pass_field('PurchaseCurrency', '826');
        $hsbc->add_pass_field('ResultUrl', Kohana::config('general')->site_url . "checkout/pay");

        $hsbc->send_pass();
    }
    

}