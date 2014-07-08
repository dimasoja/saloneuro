<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Complex extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);     
        ViewHead::addStyle('admin-tables.css');
        $this->cname = "complex";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/complex');
      //  $callback = ORM::factory('complex');
        //$view->callbacks = $callback->find_all()->as_array();
        //$callback->makeAllOld();
        $this->display($view);
    }
    
    public function action_save() {       
        $complex_old = ORM::factory('complex')->find_all()->as_array();
        $complextypes_old = ORM::factory('complextypes')->find_all()->as_array();
        foreach($complex_old as $co) {
            $co->delete();
        }
        foreach($complextypes_old as $cto) {
            $cto->delete();
        }
        $tests = $_POST['test'];        
        foreach($tests as $test) {
            $complex = ORM::factory('complex');
            $complex->name = $test['0'];
            $complex->price = $test['1'];
            $complex->descr = $test['2'];
            $complex->save();            
            $count = count($test);            
            for($i=3;$i<$count;$i++) {
                $complextypes = ORM::factory('complextypes');                                
                $complextypes->title = $test[$i];
                $complextypes->related = $complex->id;
                $complextypes->save();
            }
        }
        exit();    
    }
    
  

}