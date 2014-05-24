<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Categorys extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        $this->cname = "emails";
    }

    public function action_index()
    {
        $view = new View('scripts/admin/emails/index');
        $id = Request::instance()->param('id', '');
        
        if ('' != $id && is_numeric($id)) {
            $email_template = ORM::factory('templates')->where('id_template', '=', $id)->find();
            $view->uid = $id;
        } else {
            $email_template = ORM::factory('templates');
        }
        
        if (!empty($_POST)) {
            $email_template->template_name = $_POST['template_name'];
            $email_template->subject = $_POST['subject'];
            $email_template->message = $_POST['message'];
            if ($email_template->save()) {
                ViewMessage::adminMessage('Template was successfully saved!', 'info', true);
            } else {
                ViewMessage::adminMessage('Template was not saved!', 'error', true);
            }
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'emails')) );
        }
        
        $view->et = $email_template;
        
        $this->page_title = __("Email Templates");
        
        $view->email_templates = ORM::factory('templates')->find_all()->as_array();
        
        ViewHead::addScript('ckeditor/ckeditor.js');        
        $this->display($view);
    }
    
    public function action_delete()
    {
        $id = Request::instance()->param('id', '');
        
        if ('' != $id && is_numeric($id)) {
            ORM::factory('templates')->where('id_template', '=', $id)->delete_all();
            ViewMessage::adminMessage('Template was successfully deleted!', 'info', true);
        }
        
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'emails')) );
    }

}