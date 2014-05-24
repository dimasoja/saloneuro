<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Contacts extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "contacts";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/contacts');
        $contacts = ORM::factory('contactus');
        $view->contacts = $contacts->find_all()->as_array();        
        $contacts->makeAllOld();
        $this->display($view);
    }

              public function action_delete() {
        $id = $_GET['id'];
        ORM::factory('contactus')->where('id_contactus','=',$id)->delete_all();
        //ORM::factory('settings')->deleteItem('response','$id');
         $this->action_index();
    }

}