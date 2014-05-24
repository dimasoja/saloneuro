<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Meta extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "meta";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/meta/index');
        $this->page_title = __("Meta Tags");
        $view->meta_pages = ORM::factory('meta')->find_all()->as_array();
        $this->display($view);
    }
    
    public function action_save() {
		$meta_id = $_POST['meta_id'];
		$content = ORM::factory('meta')->where('id', '=', $meta_id)->find();
		$content->keywords = $_POST['keywords'];
		$content->description = $_POST['description'];
        $content->save();
		$this->request->redirect('admin/meta/?success='.$content->value);
    }
	function action_getkeydesc() {
		$value = $_REQUEST['val'];
		$meta = ORM::factory('meta')->where('id', '=', $value)->find_all()->as_array();
        echo($meta['0']->keywords.'~~'.$meta['0']->description);
		exit();	
	}

}