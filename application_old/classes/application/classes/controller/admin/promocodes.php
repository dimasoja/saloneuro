<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Promocodes extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';

    public function __construct($request) {

        parent::__construct($request);
        $this->cname = "promocodes";
        ViewHead::addStyle('jquery-ui.css');
        ViewHead::addScript('fancybox2/lib/jquery.mousewheel-3.0.6.pack.js');
        ViewHead::addScript('fancybox2/source/jquery.fancybox.js?v=2.0.6');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-media.js?v=1.0.0');
        ViewHead::addScript('promocodes_admin.js');
        ViewHead::addStyle('black-fancybox.css?v=1.0.2');
        ViewHead::addStyle('admin-tables.css');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
        $this->page_title = __("Promocodes");
    }

    public function action_index() {
        $view = new View('scripts/admin/promocodes/index');
        $view->promocodes = ORM::factory('promocodes')->find_all()->as_array();
        $this->display($view);
    }

    public function action_addpromo() {
        if ($_GET) {
            $user = ORM::factory('promocodes');
            $user->code = htmlspecialchars($_GET['code']);
            $user->sale = htmlspecialchars($_GET['sale']);
            $user->save();
        }
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'promocodes', 'action' => 'index')));
    }
    
    public function action_deletegroup() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $ids = substr($_POST['hash'], 0, -1);
            $ids = explode(",", $ids);
            foreach ($ids as $key => $val) {
                $dt = ORM::factory('promocodes')->where('id', '=', $val)->find_all();
                foreach ($dt as $dl) {
                    $dl->delete();
                }
            }
        }
        echo "ok";
        exit();
    }
}
