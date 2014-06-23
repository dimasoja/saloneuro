<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Base {

    public $template = 'layouts/common';
    private $_upload_img_dir = '../uploads/users/';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_find() {
        $view = new View('scripts/search');
        $this->page_title = __("");          
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Поиск',substr($_SERVER['REQUEST_URI'],1));
        $get = Safely::safelyGet($_GET);
        $word = $get['word'];
        $data = null;
        $request = null;
        $errors = null;
        if (!empty($get['word'])) { // Получаем поисковый запрос
            $searchlog = ORM::factory('searchlog');
            $searchlog->work = $get['word'];
            $searchlog->time = time();
            $searchlog->save();
            $search = mb_strtoupper(str_ireplace("ё", "е", strip_tags($_GET['word'])), "UTF-8"); 
            $request = $search;
        }
        if (!empty($search)) {
            // Обрабатываем данные как и в прошлом контроллере
            if (mb_strlen($search, "UTF-8") > 2) {
                preg_match_all('/([a-zа-яё]+)/ui', mb_strtoupper($search, "UTF-8"), $search_words);
                $dir = $_SERVER['DOCUMENT_ROOT'] . 'application/classes/helpers/Morphy/dicts/';

                $lang = 'ru_RU';
                $opts = array(
                    'storage' => PHPMORPHY_STORAGE_FILE,
                );
                try {
                    $morphy = new phpMorphy($dir, $lang, $opts);
                } catch (phpMorphy_Exception $e) {
                    die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
                }
             $words = $morphy->lemmatize($search_words[1]);
                $s_words = array();
                $pre_result = array();
                $pre_result_product = array();
            foreach ($words as $k => $w) {
                if (!$w)
                    $w[0] = $k;
                if (mb_strlen($w[0], "UTF-8") > 2) {
                    $s_words[] = $w[0];
                }
            }
            if (!count($s_words)) {
                // Обрабатываем ошибку (нет ни одного слова длиннее 2 символов)
            } else {
                foreach ($s_words as $s_word) {
                    //echo $s_word;
                    $search_index = ORM::factory('searchindex')->where('word', '=', $s_word)->where('product_id','=','0')->find_all()->as_array();                                        
                    foreach ($search_index as $si) {
                        if (!empty($pre_result[$si->post_id])) {
                            $pre_result[$si->post_id] = (int) $si->weight + $pre_result[$si->post_id];
                        } else {
                            $pre_result[$si->post_id] = (int) $si->weight;
                        }
                    }
                    $search_index_product = ORM::factory('searchindex')->where('word', '=', $s_word)->where('post_id','=','0')->find_all()->as_array();                     
                    foreach ($search_index_product as $si) {
                        if (!empty($pre_result_product[$si->product_id])) {
                            $pre_result_product[$si->product_id] = (int) $si->weight + $pre_result_product[$si->product_id];
                        } else {
                            $pre_result_product[$si->product_id] = (int) $si->weight;
                        }
                    }
                }
                arsort($pre_result); // Сортируем массив по весу результатов
                arsort($pre_result_product);
                foreach ($pre_result as $id => $weight) {
                    // Тут, соответственно, получаем данные о результатах и помещаем в массив
                    $data[] = $id;
                }
                $data_products = array();
                foreach ($pre_result_product as $id => $weight) {
                    // Тут, соответственно, получаем данные о результатах и помещаем в массив
                    $data_products[] = $id;
                }
            }
            }
        }
        $view->search = $data;
        $view->search_product = $data_products;
        $view->word = $word;
        $this->template->meta_title = '';
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $city_limit = ORM::factory('settings')->getSetting('addr_num');
        $this->template->session_city = Session::instance()->get('city','');
        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('main','=','on')->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->categories = ORM::factory('information')->roots();
        $view->categories = ORM::factory('information')->roots();
        $this->template->id_page = '';
        $this->template->page_title = '';
     //   $keywords = $meta['value'];
     //   $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
     //   $description = $meta['value'];
        $this->display($view, '', '');
    }

    public function action_step3() {

        $view = new View('scripts/quotation/step3');
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
        ViewHead::addScript('fancybox/jquery.mousewheel-3.0.4.pack.js');
        ViewHead::addScript('fancybox/jquery.fancybox-1.3.4.pack.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        ViewHead::addStyle('../js/fancybox/jquery.fancybox-1.3.4.css');
        if (isset($_SESSION['id'])) {
            $quote = ORM::factory('quotation')->where("id_quotation", "=", $_SESSION['id'])->find();
        } else {
            Request::instance()->redirect(Route::get('quotation')->uri(array('action' => 'index')));
        }

        $view->rooms_settings = $quote->rooms_settings;
        $view->name = $quote->name;
        $view->surname = $quote->surname;
        $view->email = $quote->email;
        $view->address = $quote->address;
        $view->work_date = $quote->work_date;
        $view->town = $quote->town;
        $view->postcode = $quote->postcode;
        $view->mphone = $quote->mphone;
        $view->phone = $quote->phone;
        $view->option = $quote->option;
        if ($quote->staining_area == ',')
            $quote->staining_area = '';
        $view->staining_area = $quote->staining_area;
        if ($quote->lift_removal == ',')
            $quote->lift_removal = '';
        $view->lift_removal = $quote->lift_removal;
        if ($quote->gap_filling == ',')
            $quote->gap_filling = '';
        $view->gap_filling = $quote->gap_filling;
        if ($quote->gap_filling_wood == ',')
            $quote->gap_filling_wood = '';
        $view->gap_filling_wood = $quote->gap_filling_wood;
        if ($quote->bitumen == ',')
            $quote->bitumen = '';
        $view->bitumen = $quote->bitumen;
        $view->total_price_for_job = $quote->total_price_for_job;
        $view->link = $quote->link;

        $view->alternative_address = $quote->alternative_address;
        $view->alternative_town = $quote->alternative_town;
        $view->alternative_postcode = $quote->alternative_postcode;
        $view->code = $quote->code;
        $data_sale = ORM::factory('promocodes')->where('code', '=', $quote->code)->find();
        if (isset($data_sale->sale))
            $view->sale = $data_sale->sale;
        else
            $view->sale = 0;
        if ($view->sale == '')
            $view->sale = 0; else
            Session::instance()->set('total_price', ((float) $quote->total_price_for_job) * (1 - (float) $view->sale / 100));
        $settings = ORM::factory('settings')->where('id_setting', '=', '28')->find();
        $view->admin_email = $settings->value;
        $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();

        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];
        $this->display($view, $keywords, $description);

        //$this->display($view);
    }

    public function action_step5() {
        $view = new View('scripts/quotation/step5');
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
        ViewHead::addScript('fancybox/jquery.mousewheel-3.0.4.pack.js');
        ViewHead::addScript('fancybox/jquery.fancybox-1.3.4.pack.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        ViewHead::addStyle('../js/fancybox/jquery.fancybox-1.3.4.css');

        if (isset($_SESSION['id'])) {
            $quote = ORM::factory('quotation')->where("id_quotation", "=", $_SESSION['id'])->find();
        } else {
            Request::instance()->redirect(Route::get('quotation')->uri(array('action' => 'index')));
        }

        $view->rooms_settings = $quote->rooms_settings;
        $view->name = $quote->name;
        $view->code = $quote->code;
        $data_sale = ORM::factory('promocodes')->where('code', '=', $quote->code)->find();
        if (isset($quote->sale))
            $view->sale = $data_sale->sale;
        else
            $view->sale = 0;
        $view->surname = $quote->surname;
        $view->email = $quote->email;
        $view->address = $quote->address;
        $view->work_date = $quote->work_date;
        $view->town = $quote->town;
        $view->postcode = $quote->postcode;
        $view->mphone = $quote->mphone;
        $view->phone = $quote->phone;
        if ($quote->staining_area == ',')
            $quote->staining_area = '';
        $view->staining_area = $quote->staining_area;
        if ($quote->lift_removal == ',')
            $quote->lift_removal = '';
        $view->lift_removal = $quote->lift_removal;
        if ($quote->gap_filling == ',')
            $quote->gap_filling = '';
        $view->gap_filling = $quote->gap_filling;
        if ($quote->gap_filling_wood == ',')
            $quote->gap_filling_wood = '';
        $view->gap_filling_wood = $quote->gap_filling_wood;
        if ($quote->bitumen == ',')
            $quote->bitumen = '';
        $view->bitumen = $quote->bitumen;
        $view->link = $quote->link;
        $view->option = $quote->option;
        $settings = ORM::factory('settings')->where('id_setting', '=', '28')->find();
        $view->admin_email = $settings->value;
        $view->transaction_id = $quote->payment_id;
        $view->total_price_for_job = $quote->total_price_for_job;
        $view->alternative_address = $quote->alternative_address;
        $view->alternative_town = $quote->alternative_town;
        $view->alternative_postcode = $quote->alternative_postcode;


        $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();

        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];
        $this->display($view, $keywords, $description);

        // $this->display($view);
    }

    public function action_step2() {
        $session = Session::instance();
        $view = new View('scripts/quotation/step2');
        $this->page_title = __("Get a FREE online quotation(step2)");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");
        ViewHead::addScript('jquery.js');
        ViewHead::addScript('ajaxupload.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addScript('quotation_step2.js');
        ViewHead::addScript('fancybox/jquery.mousewheel-3.0.4.pack.js');
        ViewHead::addScript('fancybox/jquery.fancybox-1.3.4.pack.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        ViewHead::addStyle('../js/fancybox/jquery.fancybox-1.3.4.css');

        $dates = ORM::factory('sheduledates')->where('temp', '=', 'no')->find_all()->as_array();
        $view->dates = array();
        $view->date_ids = array();
        $i = 0;
        if (count($dates) > 0) {
            foreach ($dates as $date) {
                $view->dates[] = $date->datetime;
                $view->date_ids[] = $date->id_quotation;
            }
        }
        if (isset($_SESSION['id'])) {
            $q = ORM::factory('quotation')->where('id_quotation', '=', $_SESSION['id'])->find();
        } else {
            Request::instance()->redirect(Route::get('quotation')->uri(array('action' => 'index')));
        }

        $view->total_price_for_job = $q->total_price_for_job;
        $view->rooms_settings = $q->rooms_settings;
        $view->room_dimensions = $q->room_dimentions;
        //перевыбираем дату для quotation каждый раз
        //ORM::factory('sheduledates')->where('id_quotation', '=', $q->id_quotation)->delete_all();
        //http://www.floorsanduk.com/online-quotation/index/aa60151230c6afb4f84d32114f6a051b
        $view->back_link = $q->link;

        //
        $view->eel = "";

        $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];
        $view->code = $q->code;
        $data_sale = ORM::factory('promocodes')->where('code', '=', $q->code)->find();

        if (isset($data_sale->sale))
            $view->sale = $data_sale->sale;
        else
            $view->sale = 0;
        $this->display($view, $keywords, $description);

        //$this->display($view);

        if (!empty($_POST)) {
            $data_for_meters = ORM::factory('quotation')->where('id_quotation', '=', $_SESSION['id'])->find();
            $rooms_settings = unserialize($data_for_meters->rooms_settings);
            $total_m = 0;
            foreach ($rooms_settings['total_sq'] as $k) {
                $total_m+=$k;
            }

            // количество дней на работу
            $datepick = "";
            if ($total_m <= 25) {
                $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_25')->find();
                $datepick = $settings->value;
            } elseif ($total_m <= 50) {
                $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_50')->find();
                $datepick = $settings->value;
            } elseif ($total_m <= 75) {
                $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_75')->find();
                $datepick = $settings->value;
            } elseif ($total_m <= 100) {
                $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_100')->find();
                $datepick = $settings->value;
            } elseif ($total_m <= 200) {
                $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_200')->find();
                $datepick = $settings->value;
            } else {
                $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_other')->find();
                $datepick = $settings->value;
            }

            // 148 задача - возможность сабмита без даты
            // $flag - если на шаге step2 юзер не выбрал дату и перешел пустым
            $flag = true;
            if (trim(htmlspecialchars($_POST['eel'])) == "")
                $flag = false;

            if ($flag) {
                if (isset($_POST['day']))
                    $day = trim(htmlspecialchars($_POST['day'])); else
                    $day = '0';
                if (isset($_POST['month']))
                    $month = trim(htmlspecialchars($_POST['month'])); else
                    $month = '0';
                if (isset($_POST['year']))
                    $year = trim(htmlspecialchars($_POST['year'])); else
                    $year = '0';
                $days = mktime(0, 0, 0, $month, 1, $year);
            }

            $shedule_dates1 = ORM::factory('quotation')->where('id_quotation', '=', $_SESSION['id'])->find();

            if ($flag)
                $shedule_dates1->work_date = mktime(0, 0, 0, $month, $day, $year);
            else
                $shedule_dates1->work_date = 0;

            $shedule_dates1->option = $_POST['quotation_option'];

            if ($_POST['quotation_option'] == "1") {
                $shedule_dates1->payment = $shedule_dates1->total_price_for_job;
            }
            if ($_POST['quotation_option'] == "2") {
                $shedule_dates1->payment = $shedule_dates1->total_price_for_job;
                $shedule_dates1->total_price_for_job = $shedule_dates1->payment;
            }
            if ($_POST['weekend_work'] == "1") {
                // issue #169 send email notification about weekend work 
                $quotation_to_admin = new View('emails/quotation_work_weekend');
                $settings_array = ORM::factory('settings')->getSettings('other', 'object');
                $admin_email = $settings_array['fs_admin_email'];
                Email::send($admin_email, $admin_email, "FloorsandUk: New quotation", "Someone has got new quote at: http://floorsanduk.com/admin/quotation/details/" . $_SESSION['id'] . "<br/><b>This customer wants work doing on the weekend</b>", true);
            }
            $shedule_dates1->save();

            if ($flag) {
                ORM::factory('sheduledates')->where('id_quotation', '=', $_SESSION['id'])->delete_all();
                for ($d = 0; $d < $datepick; $d++) {
                    $shedule_dates = ORM::factory('sheduledates');
                    $day_ = $day + $d;
                    $month_ = $month;
                    $year_ = $year;
                    if ($day_ > $days) {
                        $day_ = $day_ - $days;
                        $month_++;
                        if ($month_ > 12) {
                            $month_ = 1;
                            $year_++;
                        }
                    }

                    $shedule_dates->datetime = mktime(0, 0, 0, $month_, $day_, $year_);
                    $shedule_dates->id_quotation = $_SESSION['id'];
                    $shedule_dates->temp = 'yes';

                    if (isset($_POST['further_option_1_form'])) {
                        $shedule_dates->further_option_1 = $_POST['further_option_1_form'];
                    } else {
                        $shedule_dates->further_option_1 = "no";
                    }
                    if (isset($_POST['further_option_2_form'])) {
                        $shedule_dates->further_option_2 = $_POST['further_option_2_form'];
                    } else {
                        $shedule_dates->further_option_2 = "no";
                    }

                    $shedule_dates->save();
                }
            }
            Request::instance()->redirect(Route::get('quotation')->uri(array('action' => 'step3')));
        }
    }

    public function action_index($link = false) {

        //$_SESSION['id']='';

        $view = new View('scripts/quotation/index');
        //delete data of shedule_dates if user click "go back to make changes"
        if (isset($_SESSION['id'])) {
            if ($link != "") {
                $view->link = $link;
                $view->id_quotation = $_SESSION['id'];
            } else {
                $view->link = '';
                $view->id_quotation = '';
            }
            $check = ORM::factory('quotation')->where('id_quotation', '=', $_SESSION['id'])->find_all()->as_array();
            if (isset($check['0'])) {
                $id = $_SESSION['id'];
                $schedule_dates = ORM::factory('sheduledates')->where('id_quotation', '=', $id)->delete_all();
            }
        } else {
            $view->link = '';
            $view->id_quotation = '0';
        }


        $this->page_title = __("Get a FREE online quotation");
        $meta = ORM::factory('meta')->where('request', '=', 'online-quotation')->find_all()->as_array();
        $keywords = $meta['0']->keywords;
        $description = $meta['0']->description;

        ViewHead::addScript('fancybox2/lib/jquery-1.7.2.min.js');
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
        //ViewHead::addStyle('../js/fancybox/jquery.fancybox-1.3.4.css');

        if ('' != Session_Native::instance()->get('is_date', '')) {
            $view->is_date = 1;
            $view->dd = date('d', Session_Native::instance()->get('is_date', ''));
            $view->mm = date('m', Session_Native::instance()->get('is_date', ''));
            $view->yy = date('Y', Session_Native::instance()->get('is_date', ''));
        }
        ('' != Session_Native::instance()->get('further_option_1', '')) ? $view->further_option_1 = "yes" : $view->further_option_1 = "no";
        ('' != Session_Native::instance()->get('further_option_2', '')) ? $view->further_option_2 = "yes" : $view->further_option_2 = "no";

        $view->settings = ORM::factory('settings')->getSettings('quotation');

        ViewFormError::addFields(array('name', 'sale', 'code', 'surname', 'email', 'address', 'alternative_address', 'town', 'alternative_town', 'postcode', 'alternative_postcode', 'phone', 'mphone', 'discribe_work', 'area_type', 'staining_area', 'lift_removal', 'gap_filling', 'gap_filling_w', 'find_about_us', 'room_dimentions', 'rooms_count', 'total_price_for_job', 'deposit_required', 'total_price_for_job2', 'which_finish', 'bitumen'));

        if (!empty($_POST) || $link != "") {

            if ($link != "") {

                // КОСТЫЛИИИИИИИ, но блять, кто же как массив данных берет $_POST
                $vas_data = ORM::factory('quotation')->where('link', '=', $link)->find();

                $_POST['name'] = $vas_data->name;
                $_POST['surname'] = $vas_data->surname;
                $_POST['email'] = $vas_data->email;
                $_POST['address'] = $vas_data->address;
                $_POST['alternative_address'] = $vas_data->alternative_address;
                $_POST['town'] = $vas_data->town;
                $_POST['alternative_town'] = $vas_data->alternative_town;
                $_POST['postcode'] = $vas_data->postcode;
                $_POST['sale'] = $vas_data->sale;
                $_POST['code'] = $vas_data->code;
                $_POST['alternative_postcode'] = $vas_data->alternative_postcode;
                $_POST['phone'] = $vas_data->phone;
                $_POST['mphone'] = $vas_data->mphone;
                $_POST['room_dimentions'] = $vas_data->room_dimentions;
                $_POST['rooms_count'] = $vas_data->rooms_count;
                $_POST['discribe_work'] = $vas_data->discribe_work;
                $_POST['area_type'] = $vas_data->area_type;
                $_POST['staining_area'] = $vas_data->staining_area;
                $_POST['lift_removal'] = $vas_data->lift_removal;
                $_POST['gap_filling'] = $vas_data->gap_filling;
                $_POST['gap_filling_w'] = $vas_data->gap_filling_wood;
                $_POST['which_finish'] = $vas_data->which_finish;
                $_POST['bitumen'] = $vas_data->bitumen;
                $_POST['find_about_us'] = $vas_data->find_about_us;

                $vas_rooms = unserialize($vas_data->rooms_settings);
                $_POST['total_sq'] = $vas_rooms['total_sq'];
                $_POST['price'] = $vas_rooms['price'];
                $_POST['room_w'] = $vas_rooms['room_w'];
                $_POST['room_l'] = $vas_rooms['room_l'];
                //$_POST['room_w_i'] = $vas_rooms['room_w_i'];
                //$_POST['room_l_i'] = $vas_rooms['room_l_i'];
                $_POST['photos'] = unserialize($vas_data->photos);
                // КОСТЫЛИИИИИИИ
            }

            if ($_POST['name'] == "First Name") {
                $_POST['name'] = "";
            }
            if ($_POST['sale'] == "Promocode") {
                $_POST['sale'] = "";
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
                    ->filter('sale', 'trim')
                    ->filter('code', 'trim')
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
                    ->filter('alternative_address', 'trim')
                    ->rule('alternative_address', 'max_length', array(255))
                    ->filter('town', 'trim')
                    ->rule('town', 'not_empty')
                    ->rule('town', 'min_length', array(2))
                    ->rule('town', 'max_length', array(50))
                    ->filter('alternative_town', 'trim')
                    ->rule('alternative_town', 'max_length', array(50))
                    ->filter('postcode', 'trim')
                    ->rule('postcode', 'not_empty')
                    ->rule('postcode', 'min_length', array(3))
                    ->rule('postcode', 'max_length', array(20))
                    ->filter('alternative_postcode', 'trim')
                    ->rule('alternative_postcode', 'max_length', array(20))
                    ->filter('phone', 'trim')
                    ->rule('phone', 'max_length', array(20))

                    //->rule('phone', 'regex', array('~^[\+\-\(\)0-9\s]+$~'))
                    ->rule('phone', 'regex', array('/^[0-9\+\(\)\-x\s]+$/i'))
                    ->filter('mphone', 'trim')
                    ->rule('mphone', 'not_empty')
                    ->rule('mphone', 'min_length', array(5))
                    ->rule('mphone', 'max_length', array(20))

                    //->rule('mphone', 'regex', array('~^[\+\-\(\)0-9\s]+$~'))
                    ->rule('mphone', 'regex', array('/^[0-9\+\(\)\-x\s]+$/i'))
                    ->rule('area_type', 'not_empty')
                    ->rule('room_dimentions', 'not_empty')
                    ->filter('lift_removal', 'trim')
                    ->filter('gap_filling', 'trim')
                    ->filter('gap_filling_w', 'trim')
                    ->filter('discribe_work', 'trim')
                    ->filter('total_price_for_job', 'trim')
                    ->filter('find_about_us', 'trim')
                    ->filter('deposit_required', 'trim')
                    ->filter('total_price_for_job2', 'trim')
                    ->filter('which_finish', 'trim')
                    ->filter('bitumen', 'trim')
                    ->rule('primary', 'not_empty')
                    //->rule('day', 'not_empty')
                    //->rule('month', 'not_empty')
                    //->rule('year', 'not_empty')
                    ->rule('staining_area', 'max_length', array(3));

            $post->filter('rooms_count', 'trim')
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
                if ($_POST['id_quotation'] == 0) {
                    $quotation = ORM::factory('quotation');
                } else {
                    $quotation = ORM::factory('quotation')->where('id_quotation', '=', $_POST['id_quotation'])->find();
                }

                $quotation->name = $_POST['name'];
                $quotation->sale = $_POST['sale'];
                $quotation->code = $_POST['code'];
                $quotation->surname = $_POST['surname'];
                $quotation->email = $_POST['email'];
                $quotation->address = $_POST['address'];
                $quotation->alternative_address = $_POST['alternative_address'];
                $quotation->town = $_POST['town'];
                $quotation->alternative_town = $_POST['alternative_town'];
                $quotation->postcode = $_POST['postcode'];
                $quotation->alternative_postcode = $_POST['alternative_postcode'];
                if (isset($_POST['phone'])) {
                    $quotation->phone = $_POST['phone'];
                }
                $quotation->mphone = $_POST['mphone'];
                $quotation->area_type = $_POST['area_type'];
                if (isset($_POST['staining_area'])) {
                    $st_area = "";
                    $st_count = 1;
                    while (isset($_POST['stainig' . $st_count])) {
                        $st_area.=$_POST['stainig' . $st_count] . ",";
                        $st_count++;
                    }
                    $quotation->staining_area = $st_area;
                }
                if (isset($_POST['lift_removal'])) {
                    $ca_area = "";
                    $ca_count = 1;
                    while (isset($_POST['carpet' . $ca_count])) {
                        $ca_area.=$_POST['carpet' . $ca_count] . ",";
                        $ca_count++;
                    }
                    $quotation->lift_removal = $ca_area;
                }

                if (isset($_POST['gap_filling'])) {
                    $re_area = "";
                    $re_count = 1;
                    while (isset($_POST['resin' . $re_count])) {
                        $re_area.=$_POST['resin' . $re_count] . ",";
                        $re_count++;
                    }
                    $quotation->gap_filling = $re_area;
                }
                if (isset($_POST['gap_filling_w'])) {
                    $wo_area = "";
                    $wo_count = 1;
                    while (isset($_POST['wood' . $wo_count])) {
                        $wo_area.=$_POST['wood' . $wo_count] . ",";
                        $wo_count++;
                    }
                    $quotation->gap_filling_wood = $wo_area;
                }
                if (isset($_POST['which_finish'])) {
                    $quotation->which_finish = $_POST['which_finish'];
                }

                if (isset($_POST['bitumen'])) {

                    $bi_area = "";
                    $bi_count = 1;
                    while (isset($_POST['bitumen' . $bi_count])) {
                        $bi_area.=$_POST['bitumen' . $bi_count] . ",";
                        $bi_count++;
                    }
                    $quotation->bitumen = $bi_area;
                }

                $quotation->find_about_us = $_POST['find_about_us'];
                $quotation->room_dimentions = $_POST['room_dimentions'];
                $quotation->rooms_count = $_POST['rooms_count'];


                $quotation->rooms_settings = serialize($rooms);
                $quotation->total_price_for_job = $_POST['total_price_for_job'];

                /* if ($_POST['goto_checkout'] == 0) {
                  $quotation->payment = $_POST['deposit_required'];
                  } elseif ($_POST['goto_checkout'] == 1) {
                  $quotation->payment = $_POST['total_price_for_job2'];
                  } */

                if (isset($_POST['day'])) {
                    $quotation->work_date = mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']);
                }

                if (!empty($_POST['photos'])) {
                    $photos = array();
                    foreach ($_POST['photos'] as $photo) {
                        array_push($photos, $photo);
                    }
                    $quotation->photos = serialize($photos);
                }

                $quotation->discribe_work = HTML::chars($_POST['discribe_work']);
                $quotation->payment_status = 0;
                $quotation->registration_date = time();

                $quotation->is_complete = 1;
                $quotation->link = md5(microtime());
                if ($_POST['link'] == '') {

                    $quotation->save();
                } else {
                    $quotation = ORM::factory('quotation')->where('link', '=', $_POST['link'])->find();
                    $quotation->name = $_POST['name'];
                    $quotation->surname = $_POST['surname'];
                    $quotation->email = $_POST['email'];
                    $quotation->address = $_POST['address'];
                    $quotation->alternative_address = $_POST['alternative_address'];
                    $quotation->town = $_POST['town'];
                    $quotation->alternative_town = $_POST['alternative_town'];
                    $quotation->postcode = $_POST['postcode'];
                    $quotation->alternative_postcode = $_POST['alternative_postcode'];

                    if (isset($_POST['phone'])) {
                        $quotation->phone = $_POST['phone'];
                    }
                    $quotation->mphone = $_POST['mphone'];
                    $quotation->area_type = $_POST['area_type'];
                    if (isset($_POST['staining_area'])) {
                        $st_area = "";
                        $st_count = 1;
                        while (isset($_POST['stainig' . $st_count])) {
                            $st_area.=$_POST['stainig' . $st_count] . ",";
                            $st_count++;
                        }
                        $quotation->staining_area = $st_area;
                    }
                    if (isset($_POST['lift_removal'])) {
                        $ca_area = "";
                        $ca_count = 1;
                        while (isset($_POST['carpet' . $ca_count])) {
                            $ca_area.=$_POST['carpet' . $ca_count] . ",";
                            $ca_count++;
                        }
                        $quotation->lift_removal = $ca_area;
                    }

                    if (isset($_POST['gap_filling'])) {
                        $re_area = "";
                        $re_count = 1;
                        while (isset($_POST['resin' . $re_count])) {
                            $re_area.=$_POST['resin' . $re_count] . ",";
                            $re_count++;
                        }
                        $quotation->gap_filling = $re_area;
                    }
                    if (isset($_POST['gap_filling_w'])) {
                        $wo_area = "";
                        $wo_count = 1;
                        while (isset($_POST['wood' . $wo_count])) {
                            $wo_area.=$_POST['wood' . $wo_count] . ",";
                            $wo_count++;
                        }
                        $quotation->gap_filling_wood = $wo_area;
                    }
                    if (isset($_POST['which_finish'])) {
                        $quotation->which_finish = $_POST['which_finish'];
                    }

                    if (isset($_POST['bitumen'])) {

                        $bi_area = "";
                        $bi_count = 1;
                        while (isset($_POST['bitumen' . $bi_count])) {
                            $bi_area.=$_POST['bitumen' . $bi_count] . ",";
                            $bi_count++;
                        }
                        $quotation->bitumen = $bi_area;
                    }

                    $quotation->find_about_us = $_POST['find_about_us'];
                    $quotation->room_dimentions = $_POST['room_dimentions'];
                    $quotation->rooms_count = $_POST['rooms_count'];


                    $quotation->rooms_settings = serialize($rooms);
                    $quotation->total_price_for_job = $_POST['total_price_for_job'];

                    /* if ($_POST['goto_checkout'] == 0) {
                      $quotation->payment = $_POST['deposit_required'];
                      } elseif ($_POST['goto_checkout'] == 1) {
                      $quotation->payment = $_POST['total_price_for_job2'];
                      } */

                    if (isset($_POST['day'])) {
                        $quotation->work_date = mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']);
                    }

                    if (!empty($_POST['photos'])) {
                        $photos = array();
                        foreach ($_POST['photos'] as $photo) {
                            array_push($photos, $photo);
                        }
                        $quotation->photos = serialize($photos);
                    }
                    $quotation->sale = $_POST['sale'];
                    $quotation->code = $_POST['code'];
                    $quotation->discribe_work = HTML::chars($_POST['discribe_work']);
                    $quotation->payment_status = 0;
                    $quotation->registration_date = time();

                    $quotation->is_complete = 1;
                    $quotation->link = md5(microtime());
                    $quotation->save();
                }


                // ---------------
                # здесь записываем в таблицу с общими юзерами которые когда либо пользовались услугами
                # проверка на уникальность по е-мейлу
                $duplicateFlag = false;
                $selCheck = ORM::factory('userscustomers')->where('email', '=', $quotation->email)->where('type', '=', 'quotation')->find()->as_array();
                if ($selCheck['id_user'] != null)
                    $duplicateFlag = true;

                if ($duplicateFlag == false) {
                    $pass = md5(microtime());
                    $user = ORM::factory('userscustomers');
                    $user->type = 'quotation';
                    $user->password = $pass;
                    $user->name = $quotation->name;
                    $user->surname = $quotation->surname;
                    $user->email = $quotation->email;
                    $user->phone = (isset($quotation->phone)) ? $quotation->phone : "";
                    $user->mphone = $quotation->mphone;
                    $user->address = $quotation->address;
                    $user->town = $quotation->town;
                    $user->postcode = $quotation->postcode;
                    $user->save();
                }
                // ---------------

                $email_body = new View('emails/quotation');

                // check the next available date $quotation->available_date
                $available_flag = true;
                $tomorrow_constant = 86400;
                // today
                $dd = date('d', time());
                $mm = date('m', time());
                $yy = date('Y', time());

                while ($available_flag) {
                    $tomorrow = mktime(0, 0, 0, $mm, $dd, $yy) + $tomorrow_constant;

                    $shedule_dates = ORM::factory('sheduledates')->where('datetime', '=', $tomorrow)->find()->as_array();

                    if (empty($shedule_dates['id_date']) == true) {
                        if ((date("l", $tomorrow) == 'Sunday') or (date("l", $tomorrow) == 'Saturday')) {
                            $tomorrow_constant += 86400;
                        } else {
                            $available_flag = false;
                            $email_body->available_date = $tomorrow;
                        }
                    } else {

                        $tomorrow_constant += 86400;
                    }
                }
                //

                $email_body->quotation = $quotation;
                // ---------------

                $quotation_to_admin = new View('emails/quotation_to_admin');
                $quotation_to_admin->quotation = $quotation;

                // ---------------

                $pdfhtml = new View('emails/quotation_pdf');
                $pdfhtml->quotation = $quotation;

                require_once("./mpdf51/mpdf.php");
                $mpdf = new mPDF('utf-8', 'A4', 9, '', 10, 10, 7, 7, 10, 10); //* задаем формат, отступы и.т.д. */
                $mpdf->charset_in = 'utf-8';  /* не забываем про русский */
                $mpdf->list_indent_first_level = 0;
                $mpdf->WriteHTML($pdfhtml->render(), 0);  /* формируем pdf */
                $file_hash = sha1(md5(time()));
                $mpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $file_hash . '.pdf', 'F');
                $settings_array = ORM::factory('settings')->getSettings('other', 'object');
                $admin_email = $settings_array['fs_admin_email'];
                Email::send(trim(htmlspecialchars($_POST['email'])), $admin_email, "FloorSandUK: Online quotation complete!", $email_body, true);
                // шлем письмо и админу тоже (issue #46)
                Email::send($admin_email, $admin_email, "FloorSandUK: Online Quotation Notification", $quotation_to_admin, true);

                $email = ATEmail::compose('default')
                        ->to(trim(htmlspecialchars($_POST['email'])))
                        ->from(Kohana::config('general')->admin_email)
                        ->subject("FloorSandUK: Online quotation complete!")
                        ->attachment('uploads/' . $file_hash . '.pdf')
                        ->body($email_body, 'text/html');
                // $email->send();

                unlink($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $file_hash . '.pdf');

                //---------

                $tsq = 0;
                foreach ($_POST['total_sq'] as $val) {
                    $tsq += $val;
                }

                if ($tsq <= 25) {
                    $datepick = $view->settings['fs_date_booking_25'];
                } elseif ($tsq <= 50) {
                    $datepick = $view->settings['fs_date_booking_50'];
                } elseif ($tsq <= 75) {
                    $datepick = $view->settings['fs_date_booking_75'];
                } elseif ($tsq <= 100) {
                    $datepick = $view->settings['fs_date_booking_100'];
                } elseif ($tsq <= 200) {
                    $datepick = $view->settings['fs_date_booking_200'];
                } else {
                    $datepick = $view->settings['fs_date_booking_other'];
                }

                $day = (int) trim(htmlspecialchars($_POST['day']));
                $month = (int) trim(htmlspecialchars($_POST['month']));
                $year = (int) trim(htmlspecialchars($_POST['year']));
                $days = mktime(0, 0, 0, $month, 1, $year);
                for ($d = 0; $d < $datepick; $d++) {
                    $shedule_dates = ORM::factory('sheduledates');
                    $day_ = $day + $d;
                    $month_ = $month;
                    $year_ = $year;
                    if ($day_ > $days) {
                        $day_ = $day_ - $days;
                        $month_++;
                        if ($month_ > 12) {
                            $month_ = 1;
                            $year++;
                        }
                    }
                    $shedule_dates->datetime = mktime(0, 0, 0, $month_, $day_, $year_);
                    $shedule_dates->id_quotation = $quotation->id_quotation;
                    $_SESSION['id'] = $quotation->id_quotation;
                    $shedule_dates->further_option_1 = $_POST['further_option_1'];
                    $shedule_dates->further_option_2 = $_POST['further_option_2'];
                    // $shedule_dates->save();
                }

                Session_Native::instance()->set('id_pay', $quotation->id_quotation);

                Session_Native::instance()->set('checkout_type', 'quotation');

                Request::instance()->redirect(Route::get('quotation')->uri(array('action' => 'step2')));
            } else {
                ViewFormError::build($view, $post);
            }
        }

        $this->display($view, $keywords, $description);

        //$this->display($view, $keywords, $description);
    }

    public function action_failure() {
        $view = new View('scripts/quotation/failure');
        $this->page_title = __("Get a FREE online quotation - Failure");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        Session_Native::instance()->delete('is_date');
        Session_Native::instance()->delete('further_option_1');
        Session_Native::instance()->delete('further_option_2');
        $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();

        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];
        $this->display($view, $keywords, $description);

        //$this->display($view);
    }

    public function action_successfull() {
        $view = new View('scripts/quotation/checkoutsuccessfull');
        $this->page_title = __("Get a FREE online quotation - Successfull");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        Session_Native::instance()->delete('is_date');
        Session_Native::instance()->delete('further_option_1');
        Session_Native::instance()->delete('further_option_2');
        $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();

        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];
        $this->display($view, $keywords, $description);

        // $this->display($view);
    }

    public function action_saveuser() {

        $this->auto_render = false;
        $session = Session::instance();
        if (!empty($_POST)) {
            if ($_POST['id_quotation'] == 0) {
                $quotation = ORM::factory('quotation');
            } else {
                $quotation = ORM::factory('quotation')->where('id_quotation', '=', $_POST['id_quotation'])->find();
                if ($_POST['link'] != '')
                    $quotation = ORM::factory('quotation')->where('link', '=', $_POST['link'])->find();
                $quotation = ORM::factory('quotation')->where('id_quotation', '=', $_POST['id_quotation'])->find();
            }


            Session_Native::instance()->set('transaction_id', "");
            $quotation->name = trim(htmlspecialchars($_POST['name']));
            $quotation->surname = trim(htmlspecialchars($_POST['surname']));
            $quotation->sale = trim(htmlspecialchars($_POST['sale']));
            $quotation->code = trim(htmlspecialchars($_POST['code']));
            $quotation->email = trim(htmlspecialchars($_POST['email']));
            $quotation->address = trim(htmlspecialchars($_POST['address']));
            $quotation->alternative_address = trim(htmlspecialchars($_POST['alternative_address']));
            $quotation->town = trim(htmlspecialchars($_POST['town']));
            $quotation->alternative_town = trim(htmlspecialchars($_POST['alternative_town']));
            $quotation->postcode = trim(htmlspecialchars($_POST['postcode']));
            $quotation->alternative_postcode = trim(htmlspecialchars($_POST['alternative_postcode']));
            $quotation->phone = trim(htmlspecialchars($_POST['phone']));
            $quotation->mphone = trim(htmlspecialchars($_POST['mphone']));
            $quotation->registration_date = time();
            $quotation->discribe_work = trim(htmlspecialchars($_POST['discribe_work']));
            $quotation->area_type = trim(htmlspecialchars($_POST['area_type']));
            $quotation->is_complete = trim(htmlspecialchars($_POST['is_complete']));

            $quotation->which_finish = trim(htmlspecialchars($_POST['which_finish']));
            $quotation->staining_area = trim(htmlspecialchars($_POST['staining_area']));
            $quotation->lift_removal = trim(htmlspecialchars($_POST['lift_removal']));
            $quotation->gap_filling = trim(htmlspecialchars($_POST['gap_filling']));
            $quotation->gap_filling_wood = trim(htmlspecialchars($_POST['gap_filling_w']));
            $quotation->bitumen = trim(htmlspecialchars($_POST['bitumen']));


            $quotation->find_about_us = trim(htmlspecialchars($_POST['find_about_us']));
            $quotation->room_dimentions = trim(htmlspecialchars($_POST['room_dimentions']));
            $quotation->rooms_count = trim(htmlspecialchars($_POST['rooms_count']));
            $quotation->total_price_for_job = trim(htmlspecialchars($_POST['tpfj']));
            //parse rooms dimentions
            if (!empty($_POST['room_w'])) {
                $rooms = array();
                unset($_POST['room_w'][0]);
                unset($_POST['room_l'][0]);
                $rooms['room_w'] = $_POST['room_w'];
                $rooms['room_l'] = $_POST['room_l'];
                if ($_POST['room_dimentions'] == "feet") {
                    unset($_POST['room_w_i'][0]);
                    unset($_POST['room_l_i'][0]);
                    $rooms['room_w_i'] = $_POST['room_w_i'];
                    $rooms['room_l_i'] = $_POST['room_l_i'];
                }
                unset($_POST['total_sq'][0]);
                unset($_POST['price'][0]);
                $rooms['total_sq'] = $_POST['total_sq'];
                $rooms['price'] = $_POST['price'];
                $quotation->rooms_settings = serialize($rooms);
            }

            // занесение в таблицу с пользователями потенциального юзера
            // проверка уникальности по email
            $duplicateFlag = false;
            $selCheck = ORM::factory('userscustomers')->where('email', '=', $quotation->email)->where('type', '=', 'quotation')->find()->as_array();
            if ($selCheck['id_user'] != null)
                $duplicateFlag = true;

            if ($duplicateFlag == false) {
                $pass = md5(microtime());
                $user = ORM::factory('userscustomers');
                $user->type = 'quotation';
                $user->password = $pass;
                $user->name = $quotation->name;
                $user->surname = $quotation->surname;
                $user->email = $quotation->email;
                $user->phone = (isset($quotation->phone)) ? $quotation->phone : "";
                $user->mphone = $quotation->mphone;
                $user->address = $quotation->address;
                $user->town = $quotation->town;
                $user->postcode = $quotation->postcode;
                $user->save();
            }
            // ---------------
            // issue #149 шлем письмо админу
            $quotation_to_admin = new View('emails/quotation_to_admin');
            $quotation_to_admin->quotation = $quotation;
            $settings_array = ORM::factory('settings')->getSettings('other', 'object');
            $admin_email = $settings_array['fs_admin_email'];

            Email::send($admin_email, $admin_email, "FloorSandUK: Online Quotation Notification", $quotation_to_admin, true);


            $quotation->save();
            Email::send($admin_email, $admin_email, "FloorsandUk: New quotation", "Someone has got new quote at: http://floorsanduk.com/admin/quotation/details/" . $quotation->id_quotation);

            //шлем новое письмо с pdf'ом
            $email_body = new View('emails/quotation');
            // check the next available date $quotation->available_date
            $available_flag = true;
            $tomorrow_constant = 86400;
            // today
            $dd = date('d', time());
            $mm = date('m', time());
            $yy = date('Y', time());

            while ($available_flag) {
                $tomorrow = mktime(0, 0, 0, $mm, $dd, $yy) + $tomorrow_constant;
                $shedule_dates = ORM::factory('sheduledates')->where('datetime', '=', $tomorrow)->find()->as_array();
                if (empty($shedule_dates['id_date']) == true) {
                    if ((date("l", $tomorrow) == 'Sunday') or (date("l", $tomorrow) == 'Saturday')) {
                        $tomorrow_constant += 86400;
                    } else {
                        $available_flag = false;
                        $email_body->available_date = $tomorrow;
                    }
                } else {
                    $tomorrow_constant += 86400;
                }
            }
            $email_body->quotation = $quotation;
            $quotation_to_admin = new View('emails/quotation_to_admin');
            $quotation_to_admin->quotation = $quotation;
            //формируем pdf
            $pdfhtml = new View('emails/quotation_pdf');
            $pdfhtml->quotation = $quotation;

            require_once("./mpdf51/mpdf.php");
            $mpdf = new mPDF('utf-8', 'A4', 9, '', 10, 10, 7, 7, 10, 10); //* задаем формат, отступы и.т.д. */
            $mpdf->charset_in = 'utf-8';  /* не забываем про русский */
            $mpdf->list_indent_first_level = 0;
            $mpdf->WriteHTML($pdfhtml->render(), 0);  /* формируем pdf */
            $file_hash = sha1(md5(time()));
            $mpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $file_hash . '.pdf', 'F');
            $settings_array = ORM::factory('settings')->getSettings('other', 'object');
            $admin_email = $settings_array['fs_admin_email'];
            $email = ATEmail::compose('default')
                    ->to(trim(htmlspecialchars($_POST['email'])))
                    ->from(Kohana::config('general')->admin_email)
                    ->subject("FloorSandUK: Online quotation complete!")
                    ->attachment('uploads/' . $file_hash . '.pdf')
                    ->body($email_body, 'html');
            $email->send();
            echo $quotation->id_quotation;
        } else {
            echo "0";
        }
    }

    public function action_delimg() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            if (unlink(SYSPATH . $_POST['imgpath'])) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function action_upload() {
        $this->auto_render = false;

        $post = new Validate($_FILES);
        $post->rules('imagefile', array(
            'Upload::valid' => array(),
            'Upload::type' => array('Upload::type' => array('jpg', 'png', 'gif', 'JPG')),
            'Upload::size' => array('5M')
        ));

        if ($post->check()) {
            $ext = pathinfo($_FILES['imagefile']['name'], PATHINFO_EXTENSION);
            if ('' == trim($ext)) {
                $ext = 'jpg';
            }
            $filename = md5(microtime()) . '.' . $ext;
            Upload::save($_FILES['imagefile'], $filename, SYSPATH . $this->_upload_img_dir, 0777);
            echo $filename;
        } else {
            echo "0";
        }
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

    public function action_checkpromo() {
        $data = ORM::factory('promocodes')->where('code', '=', htmlspecialchars($_GET['code']))->find();
        if (isset($data->id)) {
            echo $data->id . "~" . $data->sale . "~" . $data->code;
        } else {
            echo "no";
        }
        exit();
    }

}