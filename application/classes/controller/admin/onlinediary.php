<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_OnlineDiary extends Controller_AdminBase
{
    public $template = 'layouts/admin';
    protected $user_id;   

    public function __construct($request) {

        parent::__construct($request);
        $this->cname = "services";
        ViewHead::addStyle('jquery-ui.css');
        ViewHead::addStyle('timepicker.css');
        ViewHead::addScript('jquery.ui.js');
        ViewHead::addScript('timepicker.js');
        ViewHead::addScript('slider.ui.js');
        ViewHead::addScript('fancybox2/lib/jquery.mousewheel-3.0.6.pack.js');
        ViewHead::addScript('fancybox2/source/jquery.fancybox.js?v=2.0.6');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-media.js?v=1.0.0');
        ViewHead::addScript('onlinediary_admin.js');
        ViewHead::addScript('calendar/fullcalendar.min.js');
        ViewHead::addStyle('black-fancybox.css?v=1.0.2');
        ViewHead::addStyle('calendar/fullcalendar.css');
        ViewHead::addStyle('calendar/fullcalendar.print.css');
        ViewHead::addStyle('admin-tables.css');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
        $this->user_id = Auth::instance()->get_user()->id;
        $this->page_title = __("Online Diary");
    }

    //add quotation, maintenance-contract, todo-list, enquiries-list and shedule dates to index onlinediary page
    public function action_index() {
        $view = new View('scripts/admin/onlinediary/index');
        $_model_enquiries = ORM::factory('onlinediary');
        $view->enquiries = $_model_enquiries->where('id_user','=', $this->user_id)->order_by('id', 'desc')->limit(7,0)->find_all()->as_array();
        $view->count_enquiries = $_model_enquiries->where('id_user','=', $this->user_id)->count_all();
        $_model_todo = ORM::factory('todo');
        $view->todolist = $_model_todo->where('id_user','=', $this->user_id)->order_by('id', 'desc')->limit(7,0)->find_all()->as_array();
        $view->count_todo = $_model_todo->where('id_user','=', $this->user_id)->count_all();
        $view->quotations = ORM::factory('quotation')->find_all()->as_array();
        $view->model_shedule = ORM::factory('sheduledates');
        $view->maintenances = ORM::factory('maintenancecontract')->find_all()->as_array();
        $this->display($view);
    }
    
    //add todo and enquiries in this function by $_GET['save']
    public function action_addonlinediary() {
        $model = ORM::factory($_GET['save']);
        $model->values($_POST);
        $model->save();
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'onlinediary', 'action' => 'index')));
    }
    
    //ajax changestatus for enquiries-list
    public function action_changestatusforenquiries() {
        ORM::factory('onlinediary')->changeStatus($_GET['id'], $_GET['val']);
        exit();
    }
    
    //ajax changestatus for todo-list
    public function action_changestatusfortodo() {
        ORM::factory('todo')->changeStatus($_GET['id'], $_GET['val']);
        exit();
    }
    
    //delete entrys ajax
    public function action_deleteentrys() {
        $model=ORM::factory($_GET['type']);
        $ids = explode(',', $_GET['response']); 
        foreach($ids as $id) {$model->delete($id);}
        exit();     
    }
    
    //for ajax pagination todo and enquiries
    public function action_getPartOfTable() {
       $od_part = ORM::factory($_GET['type'])->where('id_user','=', $this->user_id)->order_by('id', 'desc')->limit(7)->offset((int)$_GET['start_from']*7)->find_all()->as_array();
       echo ORM::factory($_GET['type'])->getPartOfTable($od_part);
       exit();
    }
    
}