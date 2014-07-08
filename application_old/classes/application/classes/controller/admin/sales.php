<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Sales extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "sales";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/sales/index');
        $sales = ORM::factory('sales');
        $view->contacts = $sales->find_all()->as_array();
        $sales->makeAllOld();
        $this->display($view);
    }

                    public function action_delete() {
        $id = $_GET['id'];
        ORM::factory('sales')->where('id','=',$id)->delete_all();
        //ORM::factory('settings')->deleteItem('response','$id');
         $this->action_index();
    }
    
  

}