<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_PostCodes extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "services";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/postcodes/index');
        $this->page_title = __("Edit offices");
        
        $view->offices = ORM::factory('offices')->find_all()->as_array();
        
        $this->display($view);
    }
    
    public function action_add() {
        $view = new View('scripts/admin/postcodes/add');
        $this->page_title = __("Add new office");
        
        $view->postcodes = ORM::factory('postcodes')->find_all()->as_array();
        
        if (isset($_POST['name'])) {
            $office = ORM::factory('offices');
            $office->name = $_POST['name'];
            $office->address = $_POST['address'];
            $office->phone = $_POST['phone'];
            $office->mphone = $_POST['mphone'];
            $office->town = $_POST['town'];
            $office->postcode = $_POST['postcode'];
            $office->email = $_POST['email'];
            $office->save();
            if (isset($_POST['postcodes']) && count($_POST['postcodes']) > 0) {
                foreach ($_POST['postcodes'] as $pcode) {
                    $po = ORM::factory('postcodesoffices');
                    $po->id_postcode = $pcode;
                    $po->id_office = $office->id_office;
                    $po->postsubcodes = $_POST['postsubcode_' . $pcode];
                    $po->save();
                }
            }
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'postcodes')) );
        }
        
        $this->display($view);
    }
    
    public function action_edit() {
        $id_office = Request::instance()->param('id', '');
        if (!is_numeric($id_office)) {
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'postcodes')) );
        }
        
        $view = new View('scripts/admin/postcodes/edit');
        $this->page_title = __("Edit office");
        $office = ORM::factory('offices')->where('id_office', '=', $id_office)->find();
        $view->office = $office->as_array();

        $used_postcodes = ORM::factory('postcodesoffices')->where('id_office', '=', $id_office)->find_all()->as_array();
         
        if (count($used_postcodes) > 0) {
            $used_p = array();
            foreach ($used_postcodes as $postcode) {
                $used_p[$postcode->id_postcode] = $postcode->postsubcodes;
            }
            $view->used_postcodes = $used_p;
        }
        
        $view->postcodes = ORM::factory('postcodes')->find_all()->as_array();
        
        if (isset($_POST['name'])) {
            $office->name = $_POST['name'];
            $office->address = $_POST['address'];
            $office->phone = $_POST['phone'];
            $office->mphone = $_POST['mphone'];
            $office->town = $_POST['town'];
            $office->postcode = $_POST['postcode'];
            $office->email = $_POST['email'];
            $office->save();
            
            ORM::factory('postcodesoffices')->where('id_office', '=', $id_office)->delete_all();
            
            if (isset($_POST['postcodes']) && count($_POST['postcodes']) > 0) {
                foreach ($_POST['postcodes'] as $pcode) {
                    $po = ORM::factory('postcodesoffices');
                    $po->id_postcode = $pcode;
                    $po->id_office = $office->id_office;
                    $po->postsubcodes = $_POST['postsubcode_' . $pcode];
                    $po->save();
                }
            }
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'postcodes')) );
        }
        
        $this->display($view);
    }

}