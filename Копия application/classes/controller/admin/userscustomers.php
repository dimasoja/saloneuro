<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_userscustomers extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_pages;
    private $_count_per_page = 50;

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "users";
        
        $count_users = count(ORM::factory('userscustomers')->find_all()->as_array());
        $this->_pages = ceil($count_users / $this->_count_per_page);

        $count_users_quotation = count(ORM::factory('userscustomers')->where('type', '=', 'quotation')->find_all()->as_array());
        $this->_pages_quotation = ceil($count_users_quotation / $this->_count_per_page);
        
        $count_users_maintenance = count(ORM::factory('userscustomers')->where('type', '=', 'maintenance')->find_all()->as_array());
        $this->_pages_maintenance = ceil($count_users_maintenance / $this->_count_per_page);
        
        $count_users_supplies = count(ORM::factory('userscustomers')->where('type', '=', 'supplies')->find_all()->as_array());
        $this->_pages_supplies = ceil($count_users_supplies / $this->_count_per_page);
    }

    public function action_index() {
        $view = new View('scripts/admin/userscustomers/index');
        $this->page_title = __("Users - Customers");

        $view->users = ORM::factory('userscustomers')->where('name', '!=', '')->limit($this->_count_per_page)->offset(0)->find_all()->as_array();
        $view->pages = $this->_pages;
        $view->page = 1;

        $this->display($view);
    }

    public function action_onlinequotation() {
        $view = new View('scripts/admin/userscustomers/index');
        $this->page_title = __("Online Quotation Area Users");

        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $offset = $this->_count_per_page * ($page - 1);

            $sort = Request::instance()->param('sort', '');
            if (trim($sort) != "")
                $view->users = ORM::factory('userscustomers')->where('type', '=', 'quotation')->limit($this->_count_per_page)->order_by('surname', $sort)->offset($offset)->find_all()->as_array();
            else
                $view->users = ORM::factory('userscustomers')->where('type', '=', 'quotation')->limit($this->_count_per_page)->order_by('id_user', 'desc')->offset($offset)->find_all()->as_array();
            $view->pages = $this->_pages_quotation;
            $view->page = $page;
        } else {
            $view->users = ORM::factory('userscustomers')->where('type', '=', 'quotation')->limit($this->_count_per_page)->order_by('id_user', 'desc')->offset(0)->find_all()->as_array();
            $view->pages = $this->_pages_quotation;
            $view->page = 1;
        }

        $view->controller = "onlinequotation";

        $this->display($view);
    }

    public function action_maintenancecontract() {
        $view = new View('scripts/admin/userscustomers/index');
        $this->page_title = __("Maintenance Contract Area Users");

        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $offset = $this->_count_per_page * ($page - 1);

            $sort = Request::instance()->param('sort', '');
            if (trim($sort) != "")
                $view->users = ORM::factory('userscustomers')->where('type', '=', 'maintenance')->limit($this->_count_per_page)->order_by('surname', $sort)->offset($offset)->find_all()->as_array();
            else
                $view->users = ORM::factory('userscustomers')->where('type', '=', 'maintenance')->limit($this->_count_per_page)->order_by('id_user', 'desc')->offset($offset)->find_all()->as_array();
            $view->pages = $this->_pages_maintenance;
            $view->page = $page;
        } else {
            $view->users = ORM::factory('userscustomers')->where('type', '=', 'maintenance')->limit($this->_count_per_page)->order_by('id_user', 'desc')->offset(0)->find_all()->as_array();
            $view->pages = $this->_pages_maintenance;
            $view->page = 1;
        }

        $view->controller = "maintenancecontract";

        $this->display($view);
    }

    public function action_buysupplies() {
        $view = new View('scripts/admin/userscustomers/index');
        $this->page_title = __("Buy Supplies Area Users");

        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $offset = $this->_count_per_page * ($page - 1);

            $sort = Request::instance()->param('sort', '');
            if (trim($sort) != "")
                $view->users = ORM::factory('userscustomers')->where('type', '=', 'supplies')->limit($this->_count_per_page)->order_by('surname', $sort)->offset($offset)->find_all()->as_array();
            else
                $view->users = ORM::factory('userscustomers')->where('type', '=', 'supplies')->limit($this->_count_per_page)->order_by('id_user', 'desc')->offset($offset)->find_all()->as_array();
            $view->pages = $this->_pages_supplies;
            $view->page = $page;
        } else {
            $view->users = ORM::factory('userscustomers')->where('type', '=', 'supplies')->limit($this->_count_per_page)->order_by('id_user', 'desc')->offset(0)->find_all()->as_array();
            $view->pages = $this->_pages_supplies;
            $view->page = 1;
        }

        $view->controller = "buysupplies";

        $this->display($view);
    }

    public function action_page() {
        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $view = new View('scripts/admin/userscustomers/index');
            $this->page_title = __("Users - Customers");
            $offset = $this->_count_per_page * ($page - 1);
            $view->users = ORM::factory('userscustomers')->limit($this->_count_per_page)->offset($offset)->find_all()->as_array();
            $view->pages = $this->_pages;
            $view->page = $page;

            $this->display($view);
        } else {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'userscustomers')));
        }
    }

    public function action_edit() {
        $id_user = Request::instance()->param('id', '');
        if (is_numeric($id_user)) {
            $view = new View('scripts/admin/userscustomers/edit');
            $usr = ORM::factory('userscustomers')->where('id_user', '=', $id_user)->find();
            if (isset($_POST['name'])) {
                $usr->name = $_POST['name'];
                $usr->email = $_POST['email'];
                $usr->address = $_POST['address'];
                $usr->town = $_POST['town'];
                $usr->postcode = $_POST['postcode'];
                $usr->phone = $_POST['phone'];
                $usr->mphone = $_POST['mphone'];
                $usr->save();
                Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'userscustomers')));
            }

            $view->user = $usr->as_array();

            if (isset($view->user['id_user'])) {
                $this->page_title = __("Edit user " . $view->user['name']);
                $this->display($view);
            } else {
                Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'userscustomers')));
            }
        } else {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'userscustomers')));
        }
    }

    public function action_delete() {
        $id_user = Request::instance()->param('id', '');
        $this->delete_user($id_user);
        $act = "onlinequotation";
        
        if(strpos($_SERVER['HTTP_REFERER'], 'onlinequotation')!=false)
                $act = "onlinequotation";
        if(strpos($_SERVER['HTTP_REFERER'], 'maintenancecontract')!=false)
                $act = "maintenancecontract";
        if(strpos($_SERVER['HTTP_REFERER'], 'buysupplies')!=false)
                $act = "buysupplies";
        
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'userscustomers', 'action' => $act)));
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
        
        $act = "onlinequotation";
        if(strpos($_SERVER['HTTP_REFERER'], 'onlinequotation')!=false)
                $act = "onlinequotation";
        if(strpos($_SERVER['HTTP_REFERER'], 'maintenancecontract')!=false)
                $act = "maintenancecontract";
        if(strpos($_SERVER['HTTP_REFERER'], 'buysupplies')!=false)
                $act = "buysupplies";
        
        ViewMessage::adminMessage('Users was successfully deleted!', 'info', true);

        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'userscustomers', 'action' => $act)));
    }

    private function delete_user($id_user) {
        if (is_numeric($id_user)) {
            $del_usr = ORM::factory('userscustomers')->where('id_user', '=', $id_user)->find();
            if (!$del_usr->delete()) {
                ViewMessage::adminMessage('User was not deleted!', 'error', true);
            }
        }
    }

    public function action_port() {
        $this->auto_render = false;

        $quotationUsers = ORM::factory('maintenancecontract')->find_all();
        foreach ($quotationUsers as $quotation) {
            $duplicateFlag = false;
            $selCheck = ORM::factory('userscustomers')->where('email', '=', $quotation->email)->where('type', '=', 'maintenance')->find()->as_array();
            if ($selCheck['id_user'] != null || $quotation->name == "")
                $duplicateFlag = true;

            if ($duplicateFlag == false) {
                $pass = md5(microtime());
                $user = ORM::factory('userscustomers');
                $user->type = 'maintenance';
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
        }
    }

}