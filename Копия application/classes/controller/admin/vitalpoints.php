<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_VitalPoints extends Controller_AdminBase
{
    private $_column_arr = array(
            'name' => "Name",
            'email' => "E-mail", 
            'town' => 'Town',
            'address' => "Address", 
            'postcode' => "Postcode",
			'mphone' => "Mobile tel. number",
			'phone' => "Landline tel. numberx"
    );
    public $template = 'layouts/admin';
    
    private $_pages;
    private $_count_per_page = 30;
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "vpoints";
        
        $count_users = count(ORM::factory('vpoints')->find_all()->as_array());
        $this->_pages = ceil($count_users / $this->_count_per_page);
        
        ViewHead::addScript('ckeditor/ckeditor.js');
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
    }

    public function action_index()
    {
        $view = new View('scripts/admin/vitalpoints');
        $this->page_title = __("Vital Points");
        
        $view->users = ORM::factory('vpoints')->limit($this->_count_per_page)->offset(0)->find_all()->as_array();
        $view->pages =  $this->_pages;
        $view->page = 1;
        $view->columns = $this->_column_arr;
        $this->display($view);
    }
	
	public function action_excelexport() 
    {
        $this->auto_render = false;
        if (!empty($_POST['columns'])) {
		
            $vpoints = ORM::factory('vpoints')->find_all()->as_array();
            $values = array();
			$COUNT=0;
			//users changed columns
            foreach ($_POST['columns'] as $key => $column) {
				$COUNT++;	
			   $values[$key] = $column;
            }
			
			//put into excel file $_column_arr values
			$count_column = 1;
			$res_arr['0']['0'] = "";
			foreach ($values as $column_name) {
				$res_arr['0'][$count_column] = $this->_column_arr[$column_name];
				$count_column++;
			}
			
			//get data into excel file
			$count_string=1;
			foreach($vpoints as $val) {
				$count_row = 1;
				$res_arr[$count_string]['0'] = $count_string;
				foreach($values as $val_post) {
					$res_arr[$count_string][$count_row] = $val->$val_post;
					$count_row++;
				}
				$count_string++;
			}

			//build excel file
			$xls = new XLSExporter('FloorSandUK_export_all_vpoints_' . date("d_m_Y_h_i_s"));
            $xls->build($res_arr);
			
        } else {
            Request::instance()->redirect( Route::get('admin')->uri() );
        }
    }
    
    public function action_page() {
        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $view = new View('scripts/admin/vitalpoints');
            $this->page_title = __("Vital Points");
            $offset = $this->_count_per_page * ($page - 1);
            $view->users = ORM::factory('vpoints')->limit($this->_count_per_page)->offset($offset)->find_all()->as_array();
            $view->pages =  $this->_pages;
            $view->page = $page;
            $view->columns = $this->_column_arr;
            $this->display($view);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'vitalpoints')) );
        }
    }
    
    public function action_send() {
        if (isset($_POST['email_subject']) && isset($_POST['email_body'])) {
            $subject = trim($_POST['email_subject']);
            $body = "<html><body>";
            $body .= $_POST['email_body'];
            $body .= "</body></html>";
            
            $users = ORM::factory('vpoints')->where('pass', '=', '')->find_all()->as_array();
			$settings_array = ORM::factory('settings')->getSettings('other', 'object'); // ��������� �������� �� �� ����� �������, ��� ������������ ������, � �� �������� �����
            if (count($users) > 0) {
                foreach ($users as $user) {
                    if (!Email::send($user->email, $settings_array['fs_admin_email'], $subject, $body, true)) {
                        ViewMessage::adminMessage("Error occured at sending to " . $user->email, 'error', true);
                    }
                }
            } else {
                ViewMessage::adminMessage('There is no users in database.', 'error', true);
            }
        }
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'vitalpoints')) );
    }
    
    public function action_delete() {
        $this->auto_render = false;
        $id_user = Request::instance()->param('id', '');
        $this->delete_user($id_user);
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'vitalpoints')) );
    }
    
    public function action_deleteall() {
        $this->auto_render = false;
        $ids = Request::instance()->param('id', '');
        if ('' != $ids) {
            $ids = substr($ids, 0, -1);
            
            $ids = explode('|', $ids);
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    $this->delete_user($id);
                }
            }
        }
        ViewMessage::adminMessage('Users was successfully deleted!', 'info', true);
        
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'vitalpoints')) );
    }
    
    private function delete_user($id_user) {
        if (is_numeric($id_user)) {
            $del_usr = ORM::factory('vpoints')->where('id', '=', $id_user)->find();
            if (!$del_usr->delete()) {
                ViewMessage::adminMessage('User was not deleted!', 'error', true);
            }
        }
    }

}