<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Complexorders extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "complexorders";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/complexorders/index');
        $callback = ORM::factory('complexorders');
        $view->callbacks = $callback->find_all()->as_array();
        $callback->makeAllOld();
        $this->display($view);
    }
                      public function action_delete() {
        $id = $_GET['id'];
        ORM::factory('complexorders')->where('id','=',$id)->delete_all();
        //ORM::factory('settings')->deleteItem('response','$id');
         $this->action_index();
    }
  

}
