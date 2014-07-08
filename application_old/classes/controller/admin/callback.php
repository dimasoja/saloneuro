<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Callback extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "callback";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/callback/index');
        $callback = ORM::factory('callback');
        $view->callbacks = $callback->find_all()->as_array();
        $callback->makeAllOld();
        $this->display($view);
    }

                public function action_delete() {
        $id = $_GET['id'];
        ORM::factory('callback')->where('id','=',$id)->delete_all();
        //ORM::factory('settings')->deleteItem('response','$id');
         $this->action_index();
    }
    
  

}