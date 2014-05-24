<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Quotation extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    private $_pages;
    private $_count_per_page = 30;
    private $_upload_img_dir = '../uploads/users/';
    
    private $_column_arr = array(
            'name' => "First Name", 
            'surname' => "Last Name",
            'email' => "Email", 
            'address' => "Address", 
            'town' => 'Town',
            'code' => 'Promocode',
            'company' => 'Company',
            'postcode' => "Postcode",
            'alternative_address' => "Alternative Address",
            'alternative_town' => "Alternative Town",
            'alternative_postcode' => "Alternative Postcode",
            'phone' => "Telephone number",
            'mphone' => "Mobile number",
            'special_notes' => "Special Notes",
            'area_type' => "Type of Flooring",
            'staining_area' => "Staining Area",
            'lift_removal' => "Carpet Lift and Removal",
            'gap_filling' => "Gap Filling",
            'which_finish' => "Which finish would you like?",
            'find_about_us' => "Find About Us",
            'room_dimentions' => "Room Measurements",
            'rooms_count' => "Rooms Count",
            'rooms_settings' => "Rooms Details",
            'total_price_for_job' => "Total Price For Job",
            'payment' => "Deposited",
            'registration_date' => "Enquiry Date",
            'work_date' => "Booking Date",
            'payment_status' => "Payment Status",
            'payment_id' => "Transaction ID"
        );
    
    public function __construct($request) 
    {
        parent::__construct($request);
        $this->cname = "services";
        
        $count_users = count(ORM::factory('quotation')->find_all()->as_array());
        $this->_pages = ceil($count_users / $this->_count_per_page);
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
    }

    public function action_index()
    {
        $view = new View('scripts/admin/quotation/index');
        $view->sales = array();
        $this->page_title = __("Online quotation");
        $view->quotations = ORM::factory('quotation')->limit($this->_count_per_page)->offset(0)->order_by('id_quotation', 'desc')->find_all()->as_array();
        $view->pages = $this->_pages;
        $view->page = 1;
        $view->columns = $this->_column_arr;
        $sales = ORM::factory('promocodes')->find_all()->as_array();
        foreach($sales as $sale) {
            $view->sales[$sale->code] = $sale->sale;
        }        
        $this->display($view);
    }
    
    public function action_page()
    {
        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $view = new View('scripts/admin/quotation/index');
            $this->page_title = __("Online quotation");
            $offset = $this->_count_per_page * ($page - 1);
            $view->quotations = ORM::factory('quotation')->limit($this->_count_per_page)->offset($offset)->order_by('id_quotation', 'desc')->find_all()->as_array();
            $view->pages =  $this->_pages;
            $view->page = $page;
            
            $view->columns = $this->_column_arr;
            
            $this->display($view);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'quotation')) );
        }
    }
    
    public function action_details()
    {
        ViewHead::addScript('adm_quotation.js');
        $id = Request::instance()->param('id', '');
        if ('' == $id || !is_numeric($id)) {
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'quotation')) );
        }
        if ($id == 0) {
            $view = new View('scripts/admin/quotation/new');
        } else {
            $result = array();
            $view = new View('scripts/admin/quotation/details');
            $view->user = ORM::factory('quotation')->where('id_quotation', '=', $id)->find()->as_array();
            $sales = ORM::factory('promocodes')->find_all()->as_array();
            foreach ($sales as $sale) {
                $result[$sale->code] = $sale->sale;
            }
            $view->sales = $result;
            $view->booking = ORM::factory('sheduledates')->where('id_quotation', '=', $id)->find_all()->as_array();
        }
        $view->settings = ORM::factory('settings')->getSettings('quotation');
        ViewHead::addScript('jquery.lightbox.js');
        ViewHead::addStyle('lightbox.css');
        $view->columns = $this->_column_arr;
        
        $this->display($view);        
    }
    
    public function action_changedetails()
    {
        if (!empty($_POST)) {
            if ($_POST['id_quotation'] == -1) {
                $quotation = ORM::factory('quotation')->order_by('id_quotation', 'desc')->limit(1)->find();
                $id = $quotation->id_quotation;
                $quotation->is_complete = 1;
                $quotation->registration_date = time();
            } else {
                $id = $_POST['id_quotation'];
                $quotation = ORM::factory('quotation')->where('id_quotation', '=', $_POST['id_quotation'])->find();
            }
            $quotation->name = $_POST['name'];
            $quotation->surname = $_POST['surname'];
            $quotation->email = $_POST['email'];
            $quotation->address = $_POST['address'];
            $quotation->town = $_POST['town'];
            $quotation->postcode = $_POST['postcode'];
            $quotation->alternative_address = $_POST['alternative_address'];
            $quotation->alternative_town = $_POST['alternative_town'];
            $quotation->alternative_postcode  = $_POST['alternative_postcode'];
            $quotation->phone = $_POST['phone'];
            $quotation->mphone = $_POST['mphone'];
            $quotation->rooms_count = $_POST['rooms_count'];
			$quotation->total_price_with_discount=$_POST['total_price_for_job_discount'];
			$quotation->discount=$_POST['discount'];
            if (isset($_POST['area_type'])) {
                $quotation->area_type = $_POST['area_type'];
                if (isset($_POST['staining_area'])) {
                    $quotation->staining_area = $_POST['staining_area'];
                }
                if (isset($_POST['lift_removal'])) {
                    $quotation->lift_removal = $_POST['lift_removal'];
                }
                if (isset($_POST['gap_filling'])) {
                    $quotation->gap_filling = $_POST['gap_filling'];
                }
                if (isset($_POST['which_finish'])) {
                    $quotation->which_finish = $_POST['which_finish'];
                }
                if (isset($_POST['bitumen'])) {
                    $quotation->bitumen = $_POST['bitumen'];
                }
                $quotation->room_dimentions = $_POST['room_dimentions'];
                if (!empty($_POST['room_w'])) {
                    $rooms = array();
                    $rooms['room_w'] = $_POST['room_w'];
                    $rooms['room_l'] = $_POST['room_l'];
                    if ($_POST['room_dimentions'] == "feet" && isset($_POST['room_w_i'])) {
                        $rooms['room_w_i'] = $_POST['room_w_i'];
                        $rooms['room_l_i'] = $_POST['room_l_i'];
                    }
                    $rooms['total_sq'] = $_POST['total_sq'];
                    $rooms['price'] = $_POST['price'];
                    $quotation->rooms_settings = serialize($rooms);
                }
                $quotation->total_price_for_job = $_POST['total_price_for_job'];
                $quotation->payment = $_POST['total_price_for_job_discount'];
			   // $quotation->payment = "";
                $quotation->discribe_work = $_POST['discribe_work'];
            }
            
            if ($quotation->save()) {
                
                $bookings = ORM::factory('sheduledates')->where('id_quotation', '=', '-1')->find_all()->as_array();
                $_POST['id_quotation'] = $quotation->id_quotation;
                foreach ($bookings as $booking) {
                    $booking->id_quotation = $quotation->id_quotation;
                    $booking->save();
                }
                
                ViewMessage::adminMessage('Details were changed successfully!', 'info', true);
                $email_body = new View('emails/quotation');
                $email_body->quotation = $quotation;
                $email_body->is_admin = 1;
                
				$settings_array = ORM::factory('settings')->getSettings('other', 'object'); // ��������� �������� �� �� ����� �������, ��� ������������ ������, � �� �������� �����
			 
              //  Email::send($_POST['email'], $settings_array['fs_admin_email'], "FloorSandUK: Administrator has changed your quotation", $email_body, true);
           
                
            } else {
                ViewMessage::adminMessage('Details were not changed!', 'error', true);
            }
            
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'quotation', 'action' => 'details', 'id' => $_POST['id_quotation'])) );
            
        } else {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }
    }
    
    public function action_excelexport() 
    {
        $this->auto_render = false;
        if (!empty($_POST['columns'])) {
            $quotations = ORM::factory('quotation')->find_all()->as_array();
            $values = array();
            foreach ($_POST['columns'] as $key => $column) {
                $values[0][$key] = $this->_column_arr[$column];
            }
            
            $key = 1;
            foreach ($quotations as $quotation) {
                $is_continue = false;
                for($i = 0; $i < count($_POST['columns']); $i++) {
                    if ("" != $quotation->$_POST['columns'][$i]) {
                        $is_continue = true;
                    }
                    if ($_POST['columns'][$i] == "registration_date" || $_POST['columns'][$i] == "work_date") {
                        $values[$key][$i] = date("d/m/Y", $quotation->$_POST['columns'][$i]);
                    } elseif ($quotation->$_POST['columns'][$i] == "none") {
                        $values[$key][$i] = "";
                    } elseif ($_POST['columns'][$i] == "payment" && $quotation->payment_status == 0) {
                        $values[$key][$i] = 0;
                    } elseif ($_POST['columns'][$i] == "rooms_settings") {
                        $rooms_settings = unserialize($quotation->rooms_settings);
                        if ($rooms_settings) {
                            $rsstr = "";
                            foreach ($rooms_settings['room_w'] as $k => $rs) {
                                if ($quotation->room_dimentions == "feet") {
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
                        $values[$key][$i] = $quotation->$_POST['columns'][$i];
                    }
                }
                if ($is_continue) {
                    $key++;
                }
            }
            $xls = new XLSExporter('FloorSandUK_export_online_quotation_' . date("d_m_Y_h_i_s"));
            $xls->build($values);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }
    }
    
    public function action_detailsexport()
    {
        $this->auto_render = false;
        if (!empty($_POST['columns'])) {
            $quotation = ORM::factory('quotation')->where('id_quotation', '=', $_POST['id_quotation'])->find()->as_array();
            $values = array();
            foreach ($_POST['columns'] as $key => $column) {
                $values[$key][0] = $this->_column_arr[$column];
                if ($column == "registration_date" || $column == "work_date") {
                    $values[$key][1] = date("d/m/Y", $quotation[$column]);
                } elseif ($quotation[$column] == "none") {
                    $values[$key][1] = "";
                } elseif ($column == "payment" && $quotation['payment_status'] == 0) {
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
            $xls = new XLSExporter('FloorSandUK_export_online_quotation_details_' . date("d_m_Y_h_i_s"));
            $xls->build($values);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }
    }
    
    public function action_delete() 
    {
        $id = Request::instance()->param('id', '');
        if ('' != $id) {
            $quotation = ORM::factory('quotation')->where('id_quotation', '=', $id)->find();
            ORM::factory('sheduledates')->where('id_quotation', '=', $id)->delete_all();
            if ('' != $quotation->photos) {
                $photos = unserialize($quotation->photos);
                foreach ($photos as $photo) {
                    @unlink(SYSPATH . $this->_upload_img_dir . $photo);
                }
            }
            $quotation->delete();
        }
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => "quotation")) );
    }
    
    public function action_editinfo()
    {
        $view = new View('scripts/admin/quotation/editinfo');
        
        ViewHead::addScript('ckeditor/ckeditor.js');
        
        $this->page_title = __("Online quotation :: Edit info");
        $view->minfo = ORM::factory('minfo')->where('area', '=', 'quotation')->find_all()->as_array();
        
        if (!empty($_POST)) {
            foreach ($_POST['nm'] as $nm) {
                $data = ORM::factory('minfo')->where('name', '=', $nm)->find();
                $data->info = $_POST[$nm];
                $data->save();
            }
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'quotation', 'action' => 'editinfo')) );
        }
        
        $this->display($view);
    }

}
//<td class="days">1 (Mon)
//    <span>
//        <a href="javascript:void(0);" onclick="chooseDate(1, 7, 2013, &quot;image150,image151,image152,image153,&quot;)">
//            <img id="image150" src="/images/green-mark.gif" width="27" height="24" alt="">
//        </a>
//    </span>
//</td>