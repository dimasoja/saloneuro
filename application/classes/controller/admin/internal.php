<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Internal extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';

    public function __construct($request) {

        parent::__construct($request);
        $this->cname = "internal";
        ViewHead::addStyle('jquery-ui.css');
        ViewHead::addScript('fancybox2/lib/jquery.mousewheel-3.0.6.pack.js');
        ViewHead::addScript('fancybox2/source/jquery.fancybox.js?v=2.0.6');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-media.js?v=1.0.0');
        ViewHead::addScript('internal_admin.js');
        ViewHead::addStyle('black-fancybox.css?v=1.0.2');
        ViewHead::addStyle('admin-tables.css');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
        $this->page_title = __("Роли пользователей");
    }

    public function action_index() {
        $view = new View('scripts/admin/internal/index');
        $view->users = ORM::factory('internal')->getUserTable();
        $view->roles_superadmin = json_decode($this->action_getrole());
        $view->all_roles = ORM::factory('roles')->find_all()->as_array();
        $this->display($view);
    }

    public function action_adduser() {
        if ($_POST) {
            $user = ORM::factory('user');
            $user->email = $_POST['email'];
            $user->password = md5($_POST['password']);
            $user->username = $_POST['username'];
            $user->save();
            $user->add('roles', ORM::factory('role')->where('name', '=', $_POST['role'])->find());
        }
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'internal', 'action' => 'index')));
    }

    public function action_changepassword() {
        if ($_GET) {
            $user = ORM::factory('user')->where('id','=',$_GET['id'])->find();
            //$user->email = $_POST['email'];
            $user->password = md5($_GET['password']);
            //$user->username = $_POST['username'];
            $user->save();
            //$user->add('roles', ORM::factory('role')->where('name', '=', $_POST['role'])->find());
        }
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'internal', 'action' => 'index')));
    }    
    
    public function action_deletegroup() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $ids = substr($_POST['hash'], 0, -1);
            $ids = explode(",", $ids);
            foreach ($ids as $key => $val) {
                $dt = ORM::factory('user')->where('id', '=', $val)->find_all();
                foreach ($dt as $dl) {
                    $dl->delete();
                }
            }
        }
        echo "ok";
        exit();
    }
    
    public function action_addrole() {
        $post = $_POST;
        $uri = Auth::uri();
        foreach($post as $value) {
           if(in_array($value, $uri)) $uri_for_role[] = $value;
        }
        $description = json_encode($uri_for_role);
        $role = ORM::factory('role')->where('name', '=', $post['role'])->find();
        $role->description = $description;
        $role->save();
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'internal', 'action' => 'index')));
    }
    
    public function action_getrole($name='superadministrator') {
        return json_encode(ORM::factory('internal')->getRoles($name));
    }

    public function action_getroleajax() {
        if(isset($_REQUEST['name'])) $name = $_REQUEST['name'];
        echo json_encode(ORM::factory('internal')->getRoles($name));
        exit();
    }
    
    public function action_addnewrole() {
        $new_role = ORM::factory('roles');
        $new_role->name = $_POST['role'];
        $new_role->save();
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'internal', 'action' => 'index')));
    }
}
