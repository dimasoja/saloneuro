<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Checkout extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_column_arr = array(
        'key' => "Code",
        'name' => "Name",
        'email' => "E-mail",
        'address' => "Address",
        'town' => 'Amount',
        'postcode' => "Area"
    );

    public function action_index() {
        
            
            
            

  

        $view = new View('scripts/admin/checkout/index');
        ViewHead::addScript('admcheckout.js');
        $view->type = '';
        if (isset($_POST['type'])) {
            $type = $_POST['type'];
        }
        if (!empty($_POST['code'])) {
            $view->code = $_POST['code'];
            $view->type = $type;
            $view->checkouts = ORM::factory('checkout')->where($type, 'like', '%' . $view->code . '%')->find_all()->as_array();
        } else {
            $view->checkouts = ORM::factory('checkout')->find_all()->as_array();
        }
        $this->page_title = __("All Sales");
        $view->columns = $this->_column_arr;
        $this->display($view);
    }

    public function action_excelexport() {
        $this->auto_render = false;
        if (!empty($_POST['columns'])) {
            $vpoints = ORM::factory('checkout')->find_all()->as_array();
            $values = array();
            $COUNT = 0;
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
            $count_string = 1;
            foreach ($vpoints as $val) {
                $count_row = 1;
                $res_arr[$count_string]['0'] = $count_string;
                foreach ($values as $val_post) {
                    $res_arr[$count_string][$count_row] = $val->$val_post;
                    $count_row++;
                }
                $count_string++;
            }

            //build excel file
            $xls = new XLSExporter('FloorSandUK_export_all_checkout_' . date("d_m_Y_h_i_s"));
            $xls->build($res_arr);
        } else {
            Request::instance()->redirect(Route::get('admin')->uri());
        }
    }

}