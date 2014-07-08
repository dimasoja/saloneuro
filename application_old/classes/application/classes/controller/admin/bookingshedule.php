<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_BookingShedule extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "services";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/bookingshedule/index');
        $this->page_title = __("Booking shedule");
        
        //$dates = ORM::factory('sheduledates')->where('enabled', '=', '1')->find_all()->as_array();
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
        
        $this->display($view);
    }
    
    public function action_edit() {
        $this->auto_render = false;
        if (!isset($_POST['d']) || !isset($_POST['m']) || !isset($_POST['y'])) {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }     
        $datetime = mktime(0, 0, 0, $_POST['m'], $_POST['d'], $_POST['y']);
        if ($_POST['sl'] == 1) {
            $d = ORM::factory('sheduledates');
            $d->datetime = $datetime;
            $d->enabled = 1;
            $d->save();
        } else {
            ORM::factory('sheduledates')->where('datetime', '=', $datetime)->delete_all();
        }
    }
    public function action_checkdate()
    {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $datetime = mktime(0, 0, 0, $_POST['m'], $_POST['d'], $_POST['y']);
            if ($_POST['s1'] == 1) {
                $d = ORM::factory('sheduledates');
                $d->partial = $_POST['checked'];
                $d->datetime = $datetime;
                if ($d->save()) {
                    echo "1";
                } else {
                    echo "0";
                }
            } else {
                ORM::factory('sheduledates')->where('datetime', '=', $datetime)->delete_all();
                echo "1";
            }
        }
    }
    
    public function action_updatepartial()
    {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $datetime = mktime(0, 0, 0, $_POST['m'], $_POST['d'], $_POST['y']);
            $d = ORM::factory('sheduledates')->where('datetime','=',$datetime)->find();
            $d->partial = $_POST['checked'];
            if ($d->save()) {
                echo "1";
             } else {
                echo "0";
             }
         } 
           
      }
}