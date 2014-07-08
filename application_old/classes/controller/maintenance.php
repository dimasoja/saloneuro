<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Maintenance extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index() {
        $view = new View('scripts/maintenance/index');
        Session_Native::instance()->delete('company');
        Session_Native::instance()->delete('special_notes');
        Session_Native::instance()->delete('id_pay');
        
        $this->page_title = __("Maintenance Contract");
        $meta = ORM::factory('meta')->where('request', '=', 'online-maintenance')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('ajaxupload.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addScript('maintenance.js');
        //ViewHead::addScript('fancybox/jquery.mousewheel-3.0.4.pack.js');
        //ViewHead::addScript('fancybox/jquery.fancybox-1.3.4.pack.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        //ViewHead::addStyle('../js/fancybox/jquery.fancybox-1.3.4.css');

        $view->settings = ORM::factory('settings')->getSettings('maintenance');
        $view->settings2 = ORM::factory('settings')->getSettings('quotation');

        ViewFormError::addFields(array('name', 'surname', 'email', 'address', 'town', 'postcode', 'phone', 'mphone', 'daily_clean', 'deep_clean', 'buff_n_coat', 'type_of_floor', 'type_of_floor_other', 'rooms_count', 'total_price_for_job', 'option_1', 'option_1_saving', 'terms_and_conditions', 'option_3', 'room_dimentions', 'option_2', 'day_of_week', 'alternative_address', 'alternative_town', 'alternative_postcode'));

        if (!empty($_POST)) {
            if ($_POST['name'] == "First Name") {
                $_POST['name'] = "";
            }
            if ($_POST['surname'] == "Last Name") {
                $_POST['surname'] = "";
            }
            if ($_POST['email'] == "Email") {
                $_POST['email'] = "";
            }
            if ($_POST['address'] == "Address") {
                $_POST['address'] = "";
            }
            if ($_POST['alternative_address'] == "Alternative Address") {
                $_POST['alternative_address'] = "";
            }
            if ($_POST['town'] == "Town") {
                $_POST['town'] = "";
            }
            if ($_POST['alternative_town'] == "Alternative Town") {
                $_POST['alternative_town'] = "";
            }
            if ($_POST['postcode'] == "Postcode") {
                $_POST['postcode'] = "";
            }
            if ($_POST['alternative_postcode'] == "Alternative Postcode") {
                $_POST['alternative_postcode'] = "";
            }
            if ($_POST['phone'] == "Telephone number") {
                $_POST['phone'] = "";
            }
            if ($_POST['mphone'] == "Mobile number") {
                $_POST['mphone'] = "";
            }

            $post = new Validate($_POST);

            $post->filter('name', 'trim')
                    ->rule('name', 'not_empty')
                    ->rule('name', 'min_length', array(2))
                    ->rule('name', 'max_length', array(150))
                    ->filter('surname', 'trim')
                    ->rule('surname', 'not_empty')
                    ->rule('surname', 'min_length', array(2))
                    ->rule('surname', 'max_length', array(50))
                    ->filter('email', 'trim')
                    ->rule('email', 'not_empty')
                    ->rule('email', 'min_length', array(5))
                    ->rule('email', 'max_length', array(150))
                    ->rule('email', 'email')
                    ->filter('address', 'trim')
                    ->rule('address', 'not_empty')
                    ->rule('address', 'min_length', array(5))
                    ->rule('address', 'max_length', array(255))
                    ->filter('town', 'trim')
                    ->rule('town', 'not_empty')
                    ->rule('town', 'min_length', array(2))
                    ->rule('town', 'max_length', array(50))
                    ->filter('postcode', 'trim')
                    ->rule('postcode', 'not_empty')
                    ->rule('postcode', 'min_length', array(3))
                    ->rule('postcode', 'max_length', array(20))
                    ->filter('phone', 'trim')
                    ->rule('phone', 'max_length', array(20))
                    ->rule('phone', 'regex', array('/^[0-9\+\(\)\-x\s]+$/i'))
                    ->filter('mphone', 'trim')
                    ->rule('mphone', 'not_empty')
                    ->rule('mphone', 'min_length', array(5))
                    ->rule('mphone', 'max_length', array(20))
                    ->rule('mphone', 'regex', array('/^[0-9\+\(\)\-x\s]+$/i'))
                    ->filter('daily_clean', 'trim')
                    ->filter('deep_clean', 'trim')
                    ->filter('buff_n_coat', 'trim')
                    ->filter('type_of_floor', 'trim')
                    ->rule('type_of_floor', 'not_empty')
                    ->filter('type_of_floor_other', 'trim')
                    ->filter('terms_and_conditions', 'trim')
                    ->filter('room_dimentions', 'trim')
                    ->filter('day_of_week', 'trim')
                    ->filter('alternative_address', 'trim')
                    ->filter('alternative_town', 'trim')
                    ->filter('alternative_postcode', 'trim')
                    ->rule('total_price_for_job', 'not_empty')
                    ->rule('option_1', 'not_empty')
                    ->filter('option_1_saving', 'trim')
                    ->rule('option_3', 'not_empty')
                    ->rule('option_2', 'not_empty')
                    ->filter('rooms_count', 'trim')
                    ->rule('rooms_count', 'not_empty');

            if (!empty($_POST['room_w'])) {
                $rooms = array();
                $rooms['room_w'] = $_POST['room_w'];
                $rooms['room_l'] = $_POST['room_l'];
                if ($_POST['room_dimentions'] == "feet") {
                    $rooms['room_w_i'] = $_POST['room_w_i'];
                    $rooms['room_l_i'] = $_POST['room_l_i'];
                }
                $rooms['total_sq'] = $_POST['total_sq'];
                $rooms['price'] = $_POST['price'];
                $view->rooms_settings = $rooms;
            }

            if ($post->check()) {

                if ($_POST['id_maintenance'] == 0) {
                    $maintenance = ORM::factory('maintenancecontract');
                } else {
                    $maintenance = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $_POST['id_maintenance'])->find();
                }
                $maintenance->name = $_POST['name'];
                $maintenance->surname = $_POST['surname'];
                $maintenance->email = $_POST['email'];
                $maintenance->address = $_POST['address'];
                $maintenance->alternative_address = $_POST['alternative_address'];
                $maintenance->town = $_POST['town'];
                $maintenance->alternative_town = $_POST['alternative_town'];
                $maintenance->postcode = $_POST['postcode'];
                $maintenance->alternative_postcode = $_POST['alternative_postcode'];
                $maintenance->phone = $_POST['phone'];
                $maintenance->mphone = $_POST['mphone'];
                $maintenance->registration_date = time();
                $maintenance->find_about_us = $_POST['find_about_us'];
                $maintenance->room_dimentions = $_POST['room_dimentions'];
                if (!empty($_POST['photos'])) {
                    $photos = array();
                    foreach ($_POST['photos'] as $photo) {
                        array_push($photos, $photo);
                    }
                    $maintenance->photos = serialize($photos);
                }
                if (isset($_POST['day_of_week'])) {
                    $maintenance->day_of_week = $_POST['day_of_week'];
                }
                if (isset($_POST['daily_clean'])) {
                    $maintenance->daily_clean = $_POST['daily_clean'];
                }
                if (isset($_POST['deep_clean'])) {
                    $maintenance->deep_clean = $_POST['deep_clean'];
                }
                if (isset($_POST['buff_n_coat'])) {
                    $maintenance->buff_n_coat = $_POST['buff_n_coat'];
                }
                if (isset($_POST['type_of_floor']) && $_POST['type_of_floor'] == "other") {
                    $maintenance->type_of_floor = $_POST['type_of_floor_other'];
                } else {
                    $maintenance->type_of_floor = $_POST['type_of_floor'];
                }
                $maintenance->rooms_count = $_POST['rooms_count'];
                $maintenance->rooms_settings = serialize($rooms);
                $maintenance->total_price_for_job = $_POST['total_price_for_job'];
                switch ($_POST['goto_checkout']) {
                    case 0:
                        $maintenance->option_type = 'option 3';
                        $maintenance->option_price = $_POST['option_3'];
                        break;

                    case 1:
                        $maintenance->option_type = 'option 1';
                        $maintenance->option_price = $_POST['option_1'];
                        break;

                    case 2:
                        $maintenance->option_type = 'option 2';
                        $maintenance->option_price = $_POST['option_2'];
                        break;
                }


                $maintenance->is_complete = 1;

                if ($maintenance->save()) {

                    // ---------------
                    # здесь записываем в таблицу с общими юзерами которые когда либо пользовались услугами
                    # проверка на уникальность по е-мейлу
                    $duplicateFlag = false;
                    $selCheck = ORM::factory('userscustomers')->where('email', '=', $maintenance->email)->where('type', '=', 'maintenance')->find()->as_array();
                    if ($selCheck['id_user'] != null)
                        $duplicateFlag = true;

                    if ($duplicateFlag == false) {
                        $pass = md5(microtime());
                        $user = ORM::factory('userscustomers');
                        $user->type = 'maintenance';
                        $user->password = $pass;
                        $user->name = $maintenance->name;
                        $user->surname = $maintenance->surname;
                        $user->email = $maintenance->email;
                        $user->phone = (isset($maintenance->phone)) ? $maintenance->phone : "";
                        $user->mphone = $maintenance->mphone;
                        $user->address = $maintenance->address;
                        $user->town = $maintenance->town;
                        $user->postcode = $maintenance->postcode;
                        $user->save();
                    }
                    // ---------------
                    
                    // отправка email админу
                    $email_body = new View('emails/maintenance_to_admin');
                    $email_body->id_maintenance = $maintenance->id_maintenance;
                    $settings_array = ORM::factory('settings')->getSettings('other', 'object');
                    $settings_array['fs_admin_email'] = trim($settings_array['fs_admin_email']);
                    Email::send($settings_array['fs_admin_email'], $settings_array['fs_admin_email'], "FloorSandUK: Maintenance Contract Notification", $email_body, true);

                    if ($_POST['goto_checkout'] != 0) {
                        Session_Native::instance()->set('id_pay', $maintenance->id_maintenance);
                        Session_Native::instance()->set('checkout_type', 'maintenance');

                        Request::instance()->redirect(Route::get('checkout')->uri());
                    } else {
                        Request::instance()->redirect(Route::get('maintenance')->uri(array('controller' => 'maintenance', 'action' => 'successfull')));
                    }
                } else {
                    ViewMessage::adminMessage('Something wrong.', 'error');
                }
            } else {
                ViewFormError::build($view, $post);
            }
        }
        /*$meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();

        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
        $this->display($view, $keywords, $description);

        //$this->display($view, $keywords, $description);
    }

    public function action_successfull() {

        $view = new View('scripts/maintenance/step5');
        $this->page_title = __("Maintenance Contract - Successfull");
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
        $meta = ORM::factory('meta')->where('request', '=', 'online-maintenance')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
        
        $data = ORM::factory('maintenancecontract')->order_by('id_maintenance', 'desc')->limit(1)->find();
        $view->id = $data->id_maintenance;
        $view->type_of = 'maintenance';
        $view->transaction_id = $data->payment_id;
        $view->rooms_settings = $data->rooms_settings;
        $view->option = $data->option_type;
        $view->name = $data->name;
        $view->surname = $data->surname;
        $view->address = $data->address;
        $view->town = $data->town;
        $view->option_price = $data->option_price;
        $view->postcode = $data->postcode;
        $view->alternative_address = $data->alternative_address;
        $view->alternative_town = $data->alternative_town;
        $view->alternative_postcode = $data->alternative_postcode;
        $view->day_of_week = $data->day_of_week;
        $view->email = $data->email;
        $view->phone = $data->phone;
        $view->mphone = $data->mphone;
        $view->admin_email = Kohana::config('general')->admin_email;
        $view->deep_clean = $data->deep_clean;
        $view->daily_clean = $data->daily_clean;
        $view->buff_n_coat = $data->buff_n_coat;
        $view->type_of_floor = $data->type_of_floor;

        
        
        
        
        $this->display($view, $keywords, $description);

        //$this->display($view);
    }

    public function action_info() {
        $this->auto_render = false;
        $id = Request::instance()->param('id', '');
        echo "<div style='width: 480px; height: 380px; background: #000; color: #fff; font-size: 18px; padding: 10px;'>";
        if ('' != $id) {
            $data = ORM::factory('minfo')->where('name', '=', $id)->find()->as_array();
            if (isset($data['info'])) {
                echo $data['info'];
            } else {
                echo "No information";
            }
        } else {
            echo "No information";
        }
        echo "</div>";
    }

    public function action_saveuser() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            if ($_POST['id_maintenance'] == 0) {
                $maintenance = ORM::factory('maintenancecontract');
            } else {
                $maintenance = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $_POST['id_maintenance'])->find();
            }
            $maintenance->name = $_POST['name'];
            $maintenance->surname = $_POST['surname'];
            $maintenance->email = $_POST['email'];
            $maintenance->address = $_POST['address'];
            $maintenance->alternative_address = $_POST['alternative_address'];
            $maintenance->town = $_POST['town'];
            $maintenance->alternative_town = $_POST['alternative_town'];
            $maintenance->postcode = $_POST['postcode'];
            $maintenance->alternative_postcode = $_POST['alternative_postcode'];
            $maintenance->phone = $_POST['phone'];
            $maintenance->mphone = $_POST['mphone'];
            $maintenance->registration_date = time();
            $maintenance->save();
            Session_Native::instance()->set('id_pay', $maintenance->id_maintenance );


            echo $maintenance->id_maintenance;
        } else {
            echo "0";
        }
    }

}