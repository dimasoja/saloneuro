<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Maintenance extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    private $_upload_img_dir = '../uploads/users/';
    
    private $_column_arr = array(
            'name' => "First Name", 
            'surname' => "Last Name",
            'company' => "Company",
            'email' => "Email", 
            'address' => "Address", 
            'town' => 'Town',
            'postcode' => "Postcode",
            'alternative_address' => "Alternative Address",
            'alternative_town' => "Alternative Town",
            'alternative_postcode' => "Alternative Postcode",
            'phone' => "Telephone number",
            'mphone' => "Mobile number",
            'special_notes' => "Special Notes",
            'daily_clean' => "Daily clean",
            'deep_clean' => "Deep clean",
            'buff_n_coat' => "Buff'n'Coat",
            'type_of_floor' => "Type of flooring",
            'day_of_week' => "Day of week",
            'find_about_us' => "Find About Us",
            'room_dimentions' => "Room Measurements",
            'rooms_count' => "Rooms Count",
            'rooms_settings' => "Rooms Details",
            'total_price_for_job' => "Total Price For Job",
            'registration_date' => "Enquiry Date",
            'payment_status' => "Payment Status",
            'payment_id' => "Transaction ID"
        );
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "services";
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
    }

    public function action_index()
    {
        $view = new View('scripts/admin/maintenance/index');
        $this->page_title = __("Maintenance contract");
        $view->contracts = ORM::factory('maintenancecontract')->order_by('id_maintenance', 'desc')->find_all()->as_array();
        $view->columns = $this->_column_arr;
        $this->display($view);
    }
    
    public function action_details()
    {
        $id = Request::instance()->param('id', '');
        if ('' == $id || !is_numeric($id)) {
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'maintenance')) );
        }
        
        ViewHead::addScript('ajaxupload.js');
        ViewHead::addScript('adm_maintenance.js');
        ViewHead::addScript('jquery.lightbox.js');
        ViewHead::addStyle('lightbox.css');
        if (0 == $id) {
            $view = new View('scripts/admin/maintenance/new');
        } else {
            $view = new View('scripts/admin/maintenance/details');
        }
        
        $view->settings = ORM::factory('settings')->getSettings('maintenance');
        $view->settings2 = ORM::factory('settings')->getSettings('quotation');
        $view->new = 'no';
        $user = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $id)->find()->as_array();
        if(isset($user['id_maintenance'])) {
            $view->new = 'yes';
        } else {           
            $last_id = ORM::factory('maintenancecontract')->order_by('id_maintenance', 'desc')->limit(1)->find(); 
            $last_id = (int)$last_id->id_maintenance+1;
            $view->new = $last_id;
        }
        $view->user = $user;
        $view->columns = $this->_column_arr;
        $view->work_dates = ORM::factory('sheduledates')->where('id_maintenance', '=', $id)->find_all()->as_array();
        $view->partials = array();
        $view->types = array();
        $partials = ORM::factory('sheduledates')->where('partial', '=', 'yes')->where('id_maintenance', '=', $id)->find_all()->as_array();
        foreach ($partials as $partial) {
            $view->partials[] = (int) $partial->datetime;
        }
        if (count($view->work_dates)) {
            foreach ($view->work_dates as $date) {
                $view->types[$date->datetime] = $date->type;
            }
        }        
        $this->display($view);        
    }
    
    public function action_editinfo()
    {
        $view = new View('scripts/admin/maintenance/editinfo');
        
        ViewHead::addScript('ckeditor/ckeditor.js');
        
        $this->page_title = __("Maintenance contract :: Edit info");
        $view->minfo = ORM::factory('minfo')->where('area', '=', 'maintenance')->find_all()->as_array();
        
        if (!empty($_POST)) {
            foreach ($_POST['nm'] as $nm) {
                $data = ORM::factory('minfo')->where('name', '=', $nm)->find();
                $data->info = $_POST[$nm];
                $data->save();
            }
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'maintenance', 'action' => 'editinfo')) );
        }
        
        $this->display($view);
    }
    
    public function action_delete() 
    {
        $id = Request::instance()->param('id', '');
        if ('' != $id) {
            $maintenance = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $id)->find();
            ORM::factory('sheduledates')->where('id_maintenance', '=', $id)->delete_all();
            if ('' != $maintenance->photos) {
                $photos = unserialize($maintenance->photos);
                foreach ($photos as $photo) {
                    @unlink(SYSPATH . $this->_upload_img_dir . $photo);
                }
            }
            $maintenance->delete();
        }
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => "maintenance")) );
    }
    
    
    
    public function action_excelexport() 
    {
        $this->auto_render = false;
        if (!empty($_POST['columns'])) {
            $maintenances = ORM::factory('maintenancecontract')->find_all()->as_array();
            $values = array();
            foreach ($_POST['columns'] as $key => $column) {
                $values[0][$key] = $this->_column_arr[$column];
            }
            
            $key = 1;
            foreach ($maintenances as $maintenance) {
                $is_continue = false;
                for($i = 0; $i < count($_POST['columns']); $i++) {
                    if ("" != $maintenance->$_POST['columns'][$i]) {
                        $is_continue = true;
                    }
                    if ($_POST['columns'][$i] == "registration_date") {
                        $values[$key][$i] = date("d/m/Y", $maintenance->$_POST['columns'][$i]);
                    } elseif ($maintenance->$_POST['columns'][$i] == "none") {
                        $values[$key][$i] = "";
                    } elseif ($_POST['columns'][$i] == "payment_status" && $maintenance->payment_status == 0) {
                        $values[$key][$i] = 0;
                    } elseif ($_POST['columns'][$i] == "rooms_settings") {
                        $rooms_settings = unserialize($maintenance->rooms_settings);
                        if ($rooms_settings) {
                            $rsstr = "";
                            foreach ($rooms_settings['room_w'] as $k => $rs) {
                                if ($maintenance->room_dimentions == "feet") {
                                    $rsstr .= "Room " . $k . ": Width " . $rooms_settings['room_w'][$k] . " Feet " . $rooms_settings['room_w_i'][$k] . " Inches x Length " . $rooms_settings['room_l'][$k] . " Feet " . $rooms_settings['room_l_i'][$k] . " Inches = " . $rooms_settings['total_sq'][$k] . " Total Sq Feet  Price " . $rooms_settings['price'][$k]  . "\n";
                                } else {
                                    $rsstr .= "Room " . $k . ": Width " . $rooms_settings['room_w'][$k] . " Metres x Length " . $rooms_settings['room_l'][$k] . " Metres = " . $rooms_settings['total_sq'][$k] . " Total Sq Metres Price " . $rooms_settings['price'][$k]  . "\n";
                                }
                            }
                            $values[$key][$i] = $rsstr;
                        } else {
                            $values[$key][$i] = "";
                        }
                    } else {
                        $values[$key][$i] = $maintenance->$_POST['columns'][$i];
                    }
                }
                if ($is_continue) {
                    $key++;
                }
            }
            $xls = new XLSExporter('FloorSandUK_export_online_maintenance_' . date("d_m_Y_h_i_s"));
            $xls->build($values);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }
    }
    
    public function action_detailsexport()
    {
        $this->auto_render = false;
        if (!empty($_POST['columns'])) {
            $quotation = ORM::factory('maintenancecontract')->where('id_maintenance', '=', $_POST['id_maintenance'])->find()->as_array();
            $values = array();
            foreach ($_POST['columns'] as $key => $column) {
                $values[$key][0] = $this->_column_arr[$column];
                if ($column == "registration_date") {
                    $values[$key][1] = date("d/m/Y", $quotation[$column]);
                } elseif ($quotation[$column] == "none") {
                    $values[$key][1] = "";
                } elseif ($column == "payment_status" && $quotation['payment_status'] == 0) {
                    $values[$key][1] = 0;
                } elseif ($column == "rooms_settings") {
                    $rooms_settings = unserialize($quotation['rooms_settings']);
                    if ($rooms_settings) {
                        $rsstr = "";
                        foreach ($rooms_settings['room_w'] as $k => $rs) {
                            if ($quotation['room_dimentions'] == "feet") {
                                $rsstr .= "Room " . $k . ": Width " . $rooms_settings['room_w'][$k] . " Feet " . $rooms_settings['room_w_i'][$k] . " Inches x Length " . $rooms_settings['room_l'][$k] . " Feet " . $rooms_settings['room_l_i'][$k] . " Inches = " . $rooms_settings['total_sq'][$k] . " Total Sq Feet  Price " . $rooms_settings['price'][$k]  . "\n";
                            } else {
                                $rsstr .= "Room " . $k . ": Width " . $rooms_settings['room_w'][$k] . " Metres x Length " . $rooms_settings['room_l'][$k] . " Metres = " . $rooms_settings['total_sq'][$k] . " Total Sq Metres Price " . $rooms_settings['price'][$k]  . "\n";
                            }
                        }
                        $values[$key][1] = $rsstr;
                    } else {
                        $values[$key][1] = "";
                    }
                } else {
                    $values[$key][1] = $quotation[$column];
                }
            }
            $xls = new XLSExporter('FloorSandUK_export_online_maintenance_details_' . date("d_m_Y_h_i_s"));
            $xls->build($values);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }
    }
    
    public function action_changedetails()
    {
        if (!empty($_POST)) {
            if ($_POST['id_maintenance'] == -1) {
                $maintenance = ORM::factory('maintenancecontract');
                $maintenance->is_complete = 1;
                $maintenance->registration_date = time();
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
            $payment_status = $_POST['payment_status'];
            switch($payment_status){
                case '1' : 
                    $maintenance->is_complete ='0';
                    $maintenance->payment_status='0';
                    break;
                case '2' :
                    $maintenance->is_complete ='1';
                    $maintenance->payment_status='0';                    
                    break;
                case '3' :
                    $maintenance->is_complete ='1';
                    $maintenance->payment_status='1';                    
                    break;
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
            if (isset($_POST['day_of_week'])) {
                $maintenance->day_of_week = $_POST['day_of_week'];
            }
            $maintenance->room_dimentions = $_POST['room_dimentions'];
            $maintenance->rooms_count = $_POST['rooms_count'];
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
                $maintenance->rooms_settings = serialize($rooms);
                
            }
            $maintenance->total_price_for_job = $_POST['total_price_for_job'];
            $maintenance->option_price = $_POST['option_price'];
            if ($_POST['id_maintenance'] == -1) {
                $maintenance->option_type = 'option 3';
                $maintenance->option_price = $_POST['total_price_for_job'];
                $maintenance->payment_status = $_POST['payment_status'];
            }
            if ($maintenance->save()) {
                ViewMessage::adminMessage('Details were changed successfully!', 'info', true);
            } else {
                ViewMessage::adminMessage('Details were not changed!', 'error', true);
            }
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'maintenance', 'action' => 'details', 'id' => $_POST['id_maintenance'])) );
        } else {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }
    }
    
    public function action_checkdate()
    {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $datetime = mktime(0, 0, 0, $_POST['m'], $_POST['d'], $_POST['y']);
            ORM::factory('sheduledates')->where('datetime', '=', $datetime)->delete_all();
            if ($_POST['s1'] == 1) {
                $d = ORM::factory('sheduledates');
                $d->partial = $_POST['checked'];
                $d->id_maintenance = $_POST['idm'];
                $d->datetime = $datetime;
                $d->type=$_POST['type'];
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
            $d->id_maintenance = $_POST['idm'];
            if ($d->save()) {
                echo "1";
             } else {
                echo "0";
             }
         } 
           
      }
}