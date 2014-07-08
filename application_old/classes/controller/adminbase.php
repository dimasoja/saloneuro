<?php defined('SYSPATH') or die('No direct script access.');

class Controller_AdminBase extends Controller_Template
{
    
    public $allowed_pages = array();
    public function __construct($request) {
        
       if(isset(Auth::instance()->get_user()->id)) $id_user = Auth::instance()->get_user()->id; else $id_user = '';
        if($id_user==0) {Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'login')));}
        $users = ORM::factory('internal')->getUserInfo($id_user);        
        $this->allowed_pages = json_decode($users['description']);
        $this->allowed_pages[] = 'admin/accessdenied';
        $this->allowed_pages[] = 'admin/information/newpage';
        $this->allowed_pages[] = 'admin/information/edit';
        $this->allowed_pages[] = 'admin/information/pages';
        $this->allowed_pages[] = 'admin/information/newcategory';
        $this->allowed_pages[] = 'admin/information/newpage';
        $this->allowed_pages[] = 'admin/information/deletecat';
        $this->allowed_pages[] = 'admin/information/editcat';
        $this->allowed_pages[] = 'admin/information/delete';
        $this->allowed_pages[] = 'admin/information/editpage';
        $access_denied=true;

        foreach ($this->allowed_pages as $page) {
            if(strpos($request->uri, $page)===false) {

            } else {
                $access_denied = false;
            }
        }

        //if supplier and index page is disabled
        if(($request->uri=='admin/index') and ($this->allowed_pages['0']!="admin/index")) {
            Request::instance()->redirect(URL::base().$this->allowed_pages['0']);
        }
        //if access for this user is denied
        if($access_denied) {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'accessdenied')));
        }
        //if user not logged in
        if (Auth::instance()->logged_in() == false) {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'login')));
        }
        
        parent::__construct($request);
        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('main_functions.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        ViewHead::addStyle('luba-admin.css');
        ViewHead::addStyle('admin.css');
    }

    public function display(& $view, $keywords = "", $description = "") {
        $this->template->site_name = Kohana::config('general')->site_name;
        $this->template->allowed = $this->allowed_pages;
        $this->template->request = $this->request->uri;
        $this->template->page_title = '';
        $this->template->page_title_split = '';
        if (isset($this->page_title)) {
            $this->template->page_title = $this->page_title;
            $this->template->page_title_split = ' :: ';
        }
        $this->template->content = $view;
        $this->template->keywords = $keywords;
        $this->template->description = $description;
        if (isset($this->cname)) {
            $this->template->cname = $this->cname;
        } else {
            $this->template->cname = "";
        }

    }

    public function display_ajax($view)
    {
        $this->auto_render = false;
        echo $view;
    }

}
