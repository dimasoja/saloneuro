<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Supplies extends Controller_Base {

    public $template = 'layouts/common';
    private $_count_per_page = 12;

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "supplies";

    }

    public function action_step4() {
        
        $view = new View('scripts/supplies/step4');
        $this->page_title = __("Get a FREE online quotation");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");
        ViewHead::addScript('jquery.js');
        ViewHead::addScript('ajaxupload.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addScript('quotation.js');
        //ViewHead::addScript('fancybox/jquery.mousewheel-3.0.4.pack.js');
        //ViewHead::addScript('fancybox/jquery.fancybox-1.3.4.pack.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        ViewHead::addStyle('../js/fancybox/jquery.fancybox-1.3.4.css');

        $view->supplies = ORM::factory('suppliessales')->where("hash", "=", Session_Native::instance()->get('hash', ''))->where('id_user', '!=', '0')->find()->as_array();
        //die(print_r(ORM::factory('suppliessales')->where("hash", "=", Session_Native::instance()->get('hash', ''))->find()->as_array()));
        $quote = ORM::factory('userscustomers')->where("hash", "=", Session_Native::instance()->get('hash', ''))->find();
        $view->name = $quote->name;
        $view->surname = $quote->surname;
        $view->email = $quote->email;
        $view->address = $quote->address;
        $view->town = $quote->town;
        $view->postcode = $quote->postcode;
        $view->phone = $quote->phone;
        $view->mphone = $quote->mphone;
        $transaction_id = ORM::factory('suppliessales')->where("hash", "=", Session_Native::instance()->get('hash', ''))->where('payment_status', '=', '1')->find();
        if(!$transaction_id->loaded()) {
             Request::instance()->redirect(Route::get('supplies')->uri(array('action' => 'ordersuppliesproduct')));           
        }

        $view->transaction_id = $transaction_id->payment_id;
        $settings = ORM::factory('settings')->where('id_setting', '=', '28')->find();
        $view->admin_email = $settings->value;

       // отправка email админу
        $email_body = new View('emails/supplies_to_admin');
        $email_body->hash = Session_Native::instance()->get('hash', '');
        $settings_array = ORM::factory('settings')->getSettings('other', 'object');
        $settings_array['fs_admin_email'] = trim($settings_array['fs_admin_email']);
        Email::send($settings_array['fs_admin_email'], $settings_array['fs_admin_email'], "FloorSandUK: Buy Supplies Notification", $email_body, true);
        
        // отправка email покупателю
        $email_body = new View('emails/supplies_confirmation');
        $email_body->supplies = $view->supplies;
        $email_body->name = $view->name;
        $email_body->surname = $view->surname;
        $email_body->email = $view->email;
        $email_body->address = $view->address;
        $email_body->town = $view->town;
        $email_body->postcode = $view->postcode;
        $email_body->phone = $view->phone;
        $email_body->mphone = $view->mphone;
        $email_body->transaction_id = $view->transaction_id;
        $email_body->supplies = $view->supplies;
        $email_body->admin_email = $view->admin_email;
        $email_body->hash = Session_Native::instance()->get('hash', '');
        $settings_array = ORM::factory('settings')->getSettings('other', 'object');
        $settings_array['fs_admin_email'] = trim($settings_array['fs_admin_email']);
        //Email::send($view->email, $settings_array['fs_admin_email'], "FloorSandUK: Buy Supplies Notification", 'subject', true);
        Email::send($view->email, $settings_array['fs_admin_email'], "FloorSandUK: Buy Supplies Notification", $email_body, true);
           
        Session_Native::instance()->delete('name');
        Session_Native::instance()->delete('address');        
        Session_Native::instance()->delete('email');
        Session_Native::instance()->delete('town');
        Session_Native::instance()->delete('postcode');
        Session_Native::instance()->delete('company');       
        Session_Native::instance()->delete('special_notes');
        Session_Native::instance()->delete('landtel');
        Session_Native::instance()->delete('mobtel');
//        $hash = Session_Native::instance()->get('hash');
//        $id_pay = Session_Native::instance()->get('id_pay');
//        $total = Session_Native::instance()->get('total_price');
//        Session_Native::instance()->destroy();
//        Session_Native::instance()->set('hash', $hash);
//        Session_Native::instance()->set('id_pay', $id_pay);
//        Session_Native::instance()->set('total_price', $total);

        /*$meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
		$meta = ORM::factory('meta')->where('request', '=', 'order-supplies-product')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
        $this->display($view, $keywords, $description);

        //  $this->display($view);
    }

    public function action_index() {
        $view = new View('scripts/supplies/index');

        $this->page_title = __("Buy supplies Online");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');

      /* $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
		$meta = ORM::factory('meta')->where('request', '=', 'order-supplies-product')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
        $this->display($view, $keywords, $description);

//        $this->display($view, $keywords, $description);
    }

    public function action_ordersuppliesproduct() {

        Session_Native::instance()->delete('post_action');
        Session_Native::instance()->delete('company');
        Session_Native::instance()->delete('special_notes');
        Session_Native::instance()->set('hash', md5(microtime()));
        $view = new View('scripts/supplies/orderproduct');
        $this->page_title = __("Buy supplies Online");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addScript('jquery.json.js');
        //ViewHead::addScript('fancybox/jquery.mousewheel-3.0.4.pack.js');
        //ViewHead::addScript('fancybox/jquery.fancybox-1.3.4.pack.js');
        ViewHead::addScript('supplies.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        //ViewHead::addStyle('../js/fancybox/jquery.fancybox-1.3.4.css');
       /* $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();

        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
		$meta = ORM::factory('meta')->where('request', '=', 'order-supplies-product')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
        $this->display($view, $keywords, $description);

        // $this->display($view, $keywords, $description);
    }

    public function action_getsupplies() {

        $this->auto_render = false;
        if (!empty($_POST)) {
            $tmp = ORM::factory('supplies')->where('type_column', '=', $_POST['tab']);
            if ("" != $_POST['btn']) {
                $tmp = $tmp->join('sb_data')->on('sb_data.id_supplies', '=', 'supplies.id_supplies')->where('sb_data.id_button', '=', $_POST['btn']);
            }

            if (0 != $_POST['manufacturer']) {
                $tmp = $tmp->where('id_manufacturer', '=', $_POST['manufacturer']);
            }

            if ("" != $_POST['sch']) {
                $search_str = HTML::chars(trim($_POST['sch']));
                $tmp = $tmp->and_where_open()->where('title', 'like', '%' . $search_str . '%')->or_where_open()->where('keywords', 'like', '%' . $search_str . '%')->or_where_close()->and_where_close();
            }
            $tmp = $tmp->find_all();
            $count = count($tmp);
            $pages = ceil($count / $this->_count_per_page);
            $supplies = ORM::factory('supplies')->where('type_column', '=', $_POST['tab']);
            if ("" != $_POST['btn']) {
                $supplies = $supplies->join('sb_data')->on('sb_data.id_supplies', '=', 'supplies.id_supplies')->where('sb_data.id_button', '=', $_POST['btn']);
            }

            if (0 != $_POST['manufacturer']) {
                $supplies = $supplies->where('id_manufacturer', '=', $_POST['manufacturer']);
            }

            if ("" != $_POST['sch']) {
                $search_str = HTML::chars(trim($_POST['sch']));
                $supplies = $supplies->and_where_open()->where('title', 'like', '%' . $search_str . '%')->or_where_open()->where('keywords', 'like', '%' . $search_str . '%')->or_where_close()->and_where_close();
            }

            if ($_POST['name_order'] == "price_low") {
                $supplies = $supplies->order_by('price', 'ASC');
            } else if ($_POST['name_order'] == "price_high") {
                $supplies = $supplies->order_by('price', 'DESC');
            } else if ($_POST['name_order'] == "az") {
                $supplies = $supplies->order_by('title', 'ASC');
            } else if ($_POST['name_order'] == "za") {
                $supplies = $supplies->order_by('title', 'DESC');
            }

            if ($_POST['name_order'] == "") {
                $supplies = $supplies->order_by('position');
            }
            $supplies = $supplies->limit($this->_count_per_page)->offset(($_POST['p'] - 1) * $this->_count_per_page);
            $supplies = $supplies->find_all()->as_array();
            $manufacturers = ORM::factory('manufacturer')->where('type_column', '=', $_POST['tab'])->find_all()->as_array();
            $html = "<div style='background: #fff; padding: 5px 0;'><center>";
            $buttons = ORM::factory('sbuttons')->where('type_column', '=', $_POST['tab'])->find_all()->as_array();
            if (!empty($buttons)) {
                foreach ($buttons as $button) {
                    $html .= "<input type='button' value='" . $button->title . "' class='submit-small' onclick='getCont(\"" . $_POST['tab'] . "\", \"1\", \"" . $button->id_button . "\", \"" . $_POST['name_order'] . "\", \"" . $_POST['sch'] . "\", " . $_POST['manufacturer'] . ")' /> ";
                }
            }
            $html .= "</center>";
            $html .= "<div style='color: #000; padding-left: 10px; margin-top: 10px; margin-bottom: 10px; font-size: 18px;'>";
            $html .= "Sort by: ";
            $html .= "<select onchange=";
            $html .= "'getCont(\"" . $_POST['tab'] . "\", \"1\", \"" . $_POST['btn'] . "\", this.value, \"" . $_POST['sch'] . "\", " . $_POST['manufacturer'] . ")'>";
            $html .= "<option value=\"\">Please, select...</option>";
            $html .= "<option value=\"price_low\"";
            if ($_POST['name_order'] == "price_low") {
                $html .= " selected=\"selected\"";
            }
            $html .= ">Price Low to High</option>";
            $html .= "<option value=\"price_high\"";
            if ($_POST['name_order'] == "price_high") {
                $html .= " selected=\"selected\"";
            }
            $html .= "> Price High to Low</option>";
            $html .= "<option value=\"az\"";
            if ($_POST['name_order'] == "az") {
                $html .= " selected=\"selected\"";
            }
            $html .= ">Name A - Z</option>";
            $html .= "<option value=\"za\"";
            if ($_POST['name_order'] == "za") {
                $html .= " selected=\"selected\"";
            }
            $html .= ">Name Z - A</option>";
            $html .= "</select>";
            $html .= "&emsp; Filter by: ";
            $html .= "<select onchange=";
            $html .= "'getCont(\"" . $_POST['tab'] . "\", \"1\", \"" . $_POST['btn'] . "\", \"" . $_POST['name_order'] . "\", \"" . $_POST['sch'] . "\", this.value)'>";
            $html .= "<option value='0'>Please, select...</option>";
            if (count($manufacturers) > 0) {
                foreach ($manufacturers as $manufacturer) {
                    $html .= "<option value='" . $manufacturer->id_manufacturer . "'";
                    if ($manufacturer->id_manufacturer == $_POST['manufacturer']) {
                        $html .= " selected=\"selected\"";
                    }
                    $html .= ">" . $manufacturer->title . "</option>";
                }
            }
            $html .= "</select>";
            $html .= "<div style='float: right; margin-right: 20px;'>Search: <input type='text' id='search_input' value='" . $_POST['sch'] . "' class='searchinp' />";
            $html .= "<a href='javascript:void(0);' onclick='getCont(\"" . $_POST['tab'] . "\", \"1\", \"" . $_POST['btn'] . "\", \"" . $_POST['name_order'] . "\", \"" . $_POST['sch'] . "\", " . $_POST['manufacturer'] . ");'>";
            $html .= "<img src='" . URL::base() . "images/search.gif' alt='Search' style='float: right; margin-top: 2px; margin-left: 5px;' /></a></div>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "<div class='clear'></div>";
            $html .= "<div  class=\"order-supplies-tab-con-sub\"><ul>";
            $id_ul = 0;
            foreach ($supplies as $supply) {
                if ($id_ul > 3) {
                    $id_ul = 0;
                    $html .= "</ul><ul>";
                }
                $image = ORM::factory('images')->join('supplies_images')
                        ->on('supplies_images.id_image', '=', 'images.id_image')
                        ->where('supplies_images.id_supplies', '=', $supply->id_supplies)
                        ->find()
                        ->as_array();


                if ($id_ul > 2) {
                    $forth = " class=\"forth\"";
                } else {
                    $forth = "";
                }
                $html .= "<li" . $forth . ">\n";
                $html .= "<input type=\"hidden\" id=\"hidden_title_" . $supply->id_supplies . "\" value=\"" . $supply->title . "\" />\n";
                $html .= "<input type=\"hidden\" id=\"hidden_price_" . $supply->id_supplies . "\" value=\"" . $supply->price . "\" />\n";
                $html .= "<input type=\"hidden\" id=\"hidden_code_" . $supply->id_supplies . "\" value=\"" . $supply->code . "\" />\n";
                $html .= "<p><strong>" . $supply->title . "</strong><br /><span style=\"font-size: 1.5em;\">£" . number_format($supply->price, 2, '.', '') . "</span></p>\n";
                $html .= "<div class=\"orange-icon\"><a href=\"" . URL::base() . "supplies/info/" . $supply->id_supplies . "\" class=\"fancy\"><img src=\"" . URL::base() . "images/pro-supplies-orange-icon.gif\" width=\"27\" height=\"27\" alt=\"\" border=\"0\" /></a></div>\n";
                $html .= "<div style=\"position: relative;\">";
                if (!empty($image['path'])) {
                    $html .= "<img src=\"" . URL::base() . "uploads/images/" . $image['path'] . "\" class=\"supplies-image\">";
                }
                $html .= "<img src=\"" . URL::base() . "images/supplies/" . $supply->type_star . ".png\" width=\"91\" height=\"91\" alt=\"\" style=\"position: absolute; right: 0; top: 110px;\" /></div>\n";
                $html .= "<div class=\"adtobasket\">\n";
                //$html .= "<div class=\"orange-icon\"><a href=\"" . URL::base() . "supplies/info/" . $supply->id_supplies . "\" class=\"fancy\"><img src=\"" . URL::base() . "images/pro-supplies-orange-icon.gif\" width=\"27\" height=\"27\" alt=\"\" border=\"0\" /></a></div>\n";
                if (isset($_POST['arr'][$supply->id_supplies])) {
                    $quantity_val = $_POST['arr'][$supply->id_supplies]['cnt'];
                    $chkd = " checked=\"checked\"";
                } else {
                    $quantity_val = "0";
                    $chkd = "";
                }
                $html .= "<div class=\"checkbox-icon\"><input type=\"text\" id=\"quantity_" . $supply->id_supplies . "\" name=\"\" value=\"" . $quantity_val . "\" style=\"width: 20px;\" class=\"quantity_text\" /></div>\n";
                $html .= "<div class=\"quantity-text\">QUANTITY</div>\n";
                $html .= "<div class=\"addtobasket-text\">ADD TO BASKET</div>\n";
                $html .= "<div class=\"checkbox-icon\" ><input style='margin: 6px 0 0 0;' rel=\"" . $supply->id_supplies . "\" id=\"" . $supply->type_column . "_" . $supply->id_supplies . "\" type=\"checkbox\" name=\"\" value=\"\" class=\"add_to_basket\"" . $chkd . " /></div>\n";
                $html .= "</div>\n";
                //$html .= "<div style=\"color: #000; padding-left: 5px;position: absolute; bottom: -1px; font-size: 8px; \">MORE<br />INFO</div>\n";
                $html .= "</li>\n";

                $id_ul++;
            }
            $html .= "</ul></div>";

            $html .= "<div class=\"products-quan-hold\">\n";
            $html .= "<div class=\"products-quan-one\">\n";
            $html .= "<div class=\"products-top\">Automatically send me this Quantity</div>\n";
            $html .= "<div class=\"products-bottom\">\n";
            $html .= "<form action=\"#\" method=\"post\">\n";
            $week = "";
            $fortnight = "";
            $month = "";
            $quarter = "";
            if (isset($_POST['auto_send'])) {
                switch ($_POST['auto_send']) {
                    case "week":
                        $week = " checked=\"checked\"";
                        $fortnight = "";
                        $month = "";
                        $quarter = "";
                        break;

                    case "fortnight":
                        $week = "";
                        $fortnight = " checked=\"checked\"";
                        $month = "";
                        $quarter = "";
                        break;

                    case "month":
                        $week = "";
                        $fortnight = "";
                        $month = " checked=\"checked\"";
                        $quarter = "";
                        break;

                    case "quarter":
                        $week = "";
                        $fortnight = "";
                        $month = "";
                        $quarter = " checked=\"checked\"";
                        break;

                    default:
                        $week = "";
                        $fortnight = "";
                        $month = "";
                        $quarter = "";
                        break;
                }
            }
            $html .= "<span><label for=\"week\">Every Week</label> <input type=\"checkbox\" name=\"auto_send\" value=\"week\" class=\"chkbox\"" . $week . " /></span>\n";
            $html .= "<span><label for=\"fortnight\">Every Fortnight</label> <input type=\"checkbox\" name=\"auto_send\" value=\"fortnight\" class=\"chkbox\"" . $fortnight . "  /></span>\n";
            $html .= "<span><label for=\"month\">Every Month</label> <input type=\"checkbox\" name=\"auto_send\" value=\"month\" class=\"chkbox\"" . $month . "  /></span>\n";
            $html .= "<span><label for=\"quarter\">Every Quarter</label> <input type=\"checkbox\" name=\"auto_send\" value=\"quarter\" class=\"chkbox\"" . $quarter . "  /></span>\n";
            $html .= "</form>\n";
            $html .= "</div>\n";
            $html .= "</div>\n";
            $html .= "<div class=\"products-quan-two\">";
            if (1 != $_POST['p']) {
                $html .= "<a href=\"javascript:void(0);\" title=\"Back\" onclick=\"getCont('" . $_POST['tab'] . "', " . ($_POST['p'] - 1);
                $html .= ", '" . $_POST['btn'];
                $html .= "', '" . $_POST['name_order'] . "', '" . $_POST['sch'] . "', " . $_POST['manufacturer'] . ")\"><input type='button' class='submit-supplies' value='BACK' /></a>";
            }
            $html .= "</div>\n";
            $html .= "<div class=\"products-quan-three\">";
            if ($pages > $_POST['p']) {
                $html .= "<a href=\"javascript:void(0);\" title=\"More Abrasives\" onclick=\"getCont('" . $_POST['tab'] . "', " . ($_POST['p'] + 1);
                $html .= ", '" . $_POST['btn'];
                $html .="', '" . $_POST['name_order'] . "', '" . $_POST['sch'] . "', " . $_POST['manufacturer'] . ")\"><input type='button' class='submit-supplies' value='MORE PRODUCTS' /></a>";
            }

            $settings = ORM::factory('settings')->where('id_setting', '=', '28')->find();
            $admin_email = $settings->value;

            $html .= "</div>\n";
            $html .= "<div class=\"products-para\">You will be charged for Automatic Orders shortly before dispatch.<br />If you need to cancel/change an Automatic Order, please email us at <a href='mailto:$admin_email' alt='Email Us'><span style='color: #FF6819;'>$admin_email</span></a></div>\n</div>";

            echo $html;
        } else {
            echo "Error";
        }
    }

    public function action_ordersuppliescheckout() {

        if ('' != Session_Native::instance()->get('post_action', '')) {
            $_POST = Session_Native::instance()->get('post_action', '');
            Session_Native::instance()->delete('post_action');
        }
        if (!empty($_POST)) {
            if (!AuthAdapter::logged()) {
                Session_Native::instance()->set('post_action', $_POST);
                //  $data_supp = ORM::factorytance()->set('id_pay', $data_supp->id_ss);
                //Session_Native::inst('suppliessales')->where("hash", "=", Session_Native::instance()->get('hash', ''))->find();
               // Session_Native::insance()->set('id', $data_supp->id_ss);
                //Request::instance()->redirect( Route::get('supplies')->uri() );
            }
            $check_supplies = ORM::factory('suppliessales');
            $check_supplies->where('hash', '=', Session_Native::instance()->get('hash'))->find();

            if($check_supplies->id_ss=="") {
                $order_save = ORM::factory('suppliessales');
                $order_save->supplies = $_POST['supplies_arr'];
                $order_save->auto_send = $_POST['auto_send'];
                $order_save->hash = Session_Native::instance()->get('hash');
                Session_Native::instance()->set('total_price', $order_save->hash);
                    $supplies = json_decode($_POST['supplies_arr']);
                    $total = 0;
                    foreach($supplies as $key=>$value) {
                        $total += (float)$value->price * (int)$value->cnt;
                    }
                Session_Native::instance()->set('total_price', $total);
                Session_Native::instance()->set('total_val', $total);
                $order_save->total = $total;
                $order_save->date = time();
                $order_save->save(); 
                $order_save->where('hash', '=', $order_save->hash)->find();
                Session_Native::instance()->set('id_pay', $order_save->id_ss);
            }
            $supplies_arr = json_decode($_POST['supplies_arr']);
            $view = new View('scripts/supplies/ordersuppliescheckout');
            $view->settings = ORM::factory('settings')->getSettings('supplies');

            $this->page_title = "";

            ViewHead::addScript('jquery.js');
            ViewHead::addScript('dw_scrollObj.js');
            ViewHead::addScript('dw_hoverscroll.js');
            ViewHead::addScript('swfobject_modified.js');
            ViewHead::addScript('main_functions.js');

            ViewHead::addStyle('scrolling.css');
            ViewHead::addStyle('menu.css');

            $view->supplies_arr = $supplies_arr;
            $view->auto_send = $_POST['auto_send'];
            Session_Native::instance()->set('checkout_type', 'supplies');

            /*$meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
            $keywords = $meta['value'];
            $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
            $description = $meta['value'];*/
			$meta = ORM::factory('meta')->where('request', '=', 'order-supplies-product')->find_all()->as_array();
			$keywords =	$meta['0']->keywords; 
			$description = $meta['0']->description;
            $this->display($view, $keywords, $description);

            //$this->display($view);
        } else {
            Request::instance()->redirect(Route::get('supplies')->uri());
        }
    }

    public function action_info() {
        $this->auto_render = false;
        $id = Request::instance()->param('id', '');
        $info = "<div style=\"width: 500px; height: 300px; background: #000;\">";
        if ('' != $id && is_numeric($id)) {
            $inf = ORM::factory('supplies')->where('id_supplies', '=', $id)->find()->info;
            if ('' != $inf) {
                $info .= $inf;
            } else {
                $info .= "<div style='padding-top: 15px; margin-left: 15px; color: white; font-size: 20px; font-weight: bold;'>No information</div>";
            }
        } else {
            $info .= "Bad parameter";
        }
        $info .= "</div>";
        echo $info;
    }

    # странная ебанутая функция которую хуй отладишь и хуй поймешь что она делает и кто ее писал

    public function action_placeorder() {
        if (!empty($_POST)) {
            $hash = md5(microtime());
            die(print_r($hash));


            $sup->id_user = 0;
            $sup->supplies = $_POST['supplies'];
            $sup->auto_send = $_POST['auto_send'];
            $sup->hash = $hash;
            $sup->delivery_options = $_POST['delivery_options'];
            $sup->total = $_POST['total_val'];
            $sup->date = time();
            $sup->save();

            // тут же отправка емейла с содержимым заказа клиенту

            Session_Native::instance()->set('checkout_type', 'supplies');
            Session_Native::instance()->set('id_pay', $sup->id_ss);
            Session_Native::instance()->set('total_price', $_POST['total_val']);
            Session_Native::instance()->set('hash', $hash);

            Request::instance()->redirect(Route::get('checkout')->uri());
        } else {
            Request::instance()->redirect(Route::get('supplies')->uri());
        }
    }

    public function action_successfull() {
        $view = new View('scripts/supplies/successfull');
        $this->page_title = "";

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
       /* $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();

        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
		$meta = ORM::factory('meta')->where('request', '=', 'order-supplies-product')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
        $this->display($view, $keywords, $description);

        // $this->display($view);
    }

}