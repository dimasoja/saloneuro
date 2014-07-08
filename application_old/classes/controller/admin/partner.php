<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Partner extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "partner";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/partner/index');
        $partner = ORM::factory('partners');
        $view->partners = $partner->find_all()->as_array();
        $partner->makeAllOld();
        $this->display($view);
    }

                public function action_delete() {
        $id = $_GET['id'];
        ORM::factory('partners')->where('id','=',$id)->delete_all();
        //ORM::factory('settings')->deleteItem('response','$id');
         $this->action_index();
    }
    
  

}