<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Searchlog extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "searchlog";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/searchlog/index');
        $searchlog = ORM::factory('searchlog');
        $view->searchlog = $searchlog->find_all()->as_array();       
        $this->display($view);
    }      
}