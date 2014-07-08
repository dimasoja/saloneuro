<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Consult extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "consult";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/consult/index');
        $consult = ORM::factory('consult');
        $view->contacts = $consult->find_all()->as_array();
        $consult->makeAllOld();
        $this->display($view);
    }
    
    public function action_changepublished() {
        $model = ORM::factory('consult')->where('id','=',$_GET['id'])->find();
        $model->published = $_GET['change'];
        $model->save();
        echo "ok";
        exit();
    }

        public function action_delete() {
        $id = $_GET['id'];
        ORM::factory('consult')->where('id','=',$id)->delete_all();
        //ORM::factory('settings')->deleteItem('response','$id');
         $this->action_index();
    }
  

}
