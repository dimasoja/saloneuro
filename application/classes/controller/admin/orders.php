<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Orders extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "orders";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/orders/index');
        $orders = ORM::factory('orders');
        $view->contacts = $orders->find_all()->as_array();
        $view->for_business = ORM::factory('products')->where('type','=','for_business')->find_all()->as_array();
        $view->for_home = ORM::factory('products')->where('type','=','for_home')->find_all()->as_array();
        $orders->makeAllOld();
        $this->display($view);
    }
    
    public function action_delete() {
        $id = $_GET['id'];
        ORM::factory('orders')->where('id','=',$id)->delete_all();
        //ORM::factory('settings')->deleteItem('orders','$id');
         $this->action_index();
    }

    public function action_changepublished() {
        $model = ORM::factory('orders')->where('id','=',$_GET['id'])->find();
        $model->published = $_GET['change'];
        $model->save();
        echo "ok";
        exit();
    }
    
    public function action_saveto() {
        $id = $_GET['id'];
        $to = $_GET['to'];
        $products = ORM::factory('orders')->where('id','=',$id)->find();
        $products->to = $to; 
        $products->save();
        exit();
    }
  

}