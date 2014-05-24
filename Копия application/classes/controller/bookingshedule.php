<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_BookingShedule extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index() {
        $view = new View('scripts/bookingshedule/index');

        $this->page_title = __("Booking Shedule");
                
        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        $view->postcode = "";

        $dates = ORM::factory('sheduledates')->find_all()->as_array();
        $view->dates = array();

        if (count($dates) > 0) {
            foreach ($dates as $date) {
                $view->dates[] = $date->datetime;
            }
        }
        
       /* $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
		$meta = ORM::factory('meta')->where('request', '=', 'booking-shedule')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
		$this->display($view, $keywords, $description);
    }

    public function action_add() {
        if (empty($_POST) || $_POST['month'] == "" || $_POST['day'] == "" || $_POST['year'] == "") {
            Request::instance()->redirect(Route::get('bookingshedule')->uri());
        }
        Session_Native::instance()->set('is_date', mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
        if (isset($_POST['further_option_1'])) {
            Session_Native::instance()->set('further_option_1', "yes");
        }
        if (isset($_POST['further_option_2'])) {
            Session_Native::instance()->set('further_option_2', "yes");
        }
        Request::instance()->redirect(Route::get('quotation')->uri());
    }

    public function action_booking($id_quotation = false) {
        $this->auto_render = false;

        $view = new View('scripts/bookingshedule/booking');
        $dates = ORM::factory('sheduledates')->find_all()->as_array();
        $view->dates = array();
        $view->partials = array();
        $view->types = array();
        $partials = ORM::factory('sheduledates')->where('partial', '=', 'yes')->find_all()->as_array();
        foreach ($partials as $partial) {
            $view->partials[] = (int) $partial->datetime;
        }  
        if (count($dates)) {
            foreach ($dates as $date) {
                $view->types[$date->datetime] = $date->type;
            }
        }
        if (count($dates) > 0) {
            foreach ($dates as $date) {
                $view->dates[] = $date->datetime;
            }
        }
        
        $view->settings = ORM::factory('settings')->getSettings('quotation');
        $view->total_m = $_POST['total_m'];
        if (isset($_POST['fu1'])) {
            $view->fu1 = $_POST['fu1'];
            $view->fu2 = $_POST['fu2'];
        }
        
        //перевыбираем дату для quotation каждый раз
//        if($id_quotation != '')
//            ORM::factory('sheduledates')->where('id_quotation', '=', $id_quotation)->delete_all();
        
        echo $view;
    }

    public function action_savenew() {
        $this->auto_render = false;

        if (!empty($_POST)) {
            ORM::factory('sheduledates')->where('id_quotation', '=', $_POST['id_q'])->delete_all();
            if($_POST['id_q']=='-1') {
                $last_id = ORM::factory('quotation')->order_by('id_quotation', 'desc')->limit(1)->find(); 
                $last_id = (int)$last_id->id_quotation+1;
                $new = ORM::factory('quotation');
                $new->id_quotation = $last_id;
                $new->save();
            } else {
                $last_id = $_POST['id_q'];
            }

            $settings = ORM::factory('settings')->getSettings('quotation');
            $tsq = $_POST['tm'];
            if ($tsq <= 25) {
                $datepick = $settings['fs_date_booking_25'];
            } elseif ($tsq <= 50) {
                $datepick = $settings['fs_date_booking_50'];
            } elseif ($tsq <= 75) {
                $datepick = $settings['fs_date_booking_75'];
            } elseif ($tsq <= 100) {
                $datepick = $settings['fs_date_booking_100'];
            } elseif ($tsq <= 200) {
                $datepick = $settings['fs_date_booking_200'];
            } else {
                $datepick = $settings['fs_date_booking_other'];
            }

            $day = $_POST['d'];
            $month = $_POST['m'];
            $year = $_POST['y'];
            $days = mktime(0, 0, 0, $month, 1, $year);
            $q = ORM::factory('quotation')->where('id_quotation', '=', $last_id)->find();
            $q->work_date = mktime(0, 0, 0, $month, $day, $year);
            $q->save();

            for ($d = 0; $d < $datepick; $d++) {
                $shedule_dates = ORM::factory('sheduledates', 0);
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
                $shedule_dates->id_quotation = $last_id;
                $shedule_dates->further_option_1 = $_POST['fu1'];
                $shedule_dates->type = 'busy';
                $shedule_dates->further_option_2 = $_POST['fu2'];
                $shedule_dates->save();
            }
            $dt = date("d/m/Y", mktime(0, 0, 0, $month, $day, $year));
            if ($datepick > 1) {
                $dt .= " - " . date("d/m/Y", $shedule_dates->datetime);
            }
            echo $dt."~".$last_id;
        }
    }

    public function action_maintenancebooking() {
        $this->auto_render = false;
        $view = new View('scripts/bookingshedule/maintenancebooking');
        $dates = ORM::factory('sheduledates')->find_all()->as_array();
        $view->dates = array();
        $view->partials = array();
        $view->types = array();
        $partials = ORM::factory('sheduledates')->where('partial', '=', 'yes')->find_all()->as_array();
        foreach ($partials as $partial) {
            $view->partials[] = (int) $partial->datetime;
        }
        if (count($dates)) {
            foreach ($dates as $date) {
                $view->dates[] = $date->datetime;
                $view->types[$date->datetime] = $date->type;
            }
        }
        echo $view;
        
    }

}