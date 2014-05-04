<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_AdminBase
{

    public $template = 'layouts/admin';

    public function action_index()
    { 

        $this->cname = "home";
        $view = new View('scripts/admin/index');
        $this->page_title = __("Главные настройки");
        if (!empty($_POST)) {
            foreach ($_POST['setting'] as $key => $val) {
                $obj = ORM::factory('settings')->where('short_name', '=', $key)->find();
                $obj->value = $val;
                $obj->save();
            }
        }
        
        $view->fs_bottom_adsense = ORM::factory('adsense')->where('short_name', '=', 'fs_bottom_adsense')->find()->text;       
        $view->settings = ORM::factory('settings')->where('id_setting', '!=', '22')->where('id_setting', '!=', '45')->where('id_setting', '!=', '48')->where('id_setting', '!=', '49')->where('id_setting', '!=', '50')->order_by('type', 'asc')->order_by('id_setting', 'asc')->find_all()->as_array();
        $view->logo = ORM::factory('settings')->getSetting('logo');
        $view->noise = ORM::factory('settings')->getSetting('noise');
        $view->strength = ORM::factory('settings')->getSetting('strength');
        $view->call_us = ORM::factory('settings')->getSetting('call_us');
        $view->heat = ORM::factory('settings')->getSetting('heat');
        $this->display($view);
    }
    
    public function action_saveadsense()
    {
        if (!empty($_POST)) {
            $adsense = ORM::factory('adsense')->where('short_name', '=', 'fs_bottom_adsense')->find();
            $adsense->text = $_POST['fs_bottom_adsense'];
            $adsense->save();
        }
        Request::instance()->redirect( Route::get('admin')->uri() );
    }

    public function action_savelogo() {
        if($_FILES['logo']['name']!='') {
            $upload = ORM::factory('settings')->uploadLogo($_FILES);
        } else {
            header("Location: /admin/index");
            exit();
        }
    }

    function action_saveconf() {
	foreach($_POST as $key=>$value) {
	    ORM::factory('settings')->saveSetting($key, $value);
	}
	exit();
    }
    function action_savestatic() {            
        ORM::factory('settings')->saveSetting('complex_content', $_POST['complex_content']);    
    exit();
    }

    function action_savemakeorder() {
        ORM::factory('settings')->saveSetting('makeorder_content', $_POST['makeorder_content']);    
    exit();
    }
    function action_savecallus() {
        ORM::factory('settings')->saveSetting('callus', $_POST['callus']);
        exit();
    }

    function action_savenoise() {
        ORM::factory('settings')->saveSetting('noise', $_POST['noise']);
        exit();
    }

    function action_savestrength() {
        ORM::factory('settings')->saveSetting('strength', $_POST['strength']);
        exit();
    }

    function action_saveheat() {
        ORM::factory('settings')->saveSetting('heat', $_POST['heat']);
        exit();
    }

    function action_savebenefits() {
        ORM::factory('settings')->saveSetting('benefits', $_POST['benefits']);
        exit();
    }
    function action_savegrade() {
        ORM::factory('settings')->saveSetting('grade', $_POST['grade']);
        exit();
    }
    function action_callus() {

        ORM::factory('settings')->saveSetting('call_us', $_POST['call_us']);
        ORM::factory('settings')->saveSetting('logotext', $_POST['logotext']);
        exit();
    }
    function action_saveproduction() {
        ORM::factory('settings')->saveSetting('production', $_POST['production']);
        exit();
    }

    function action_saveserttags() {
        $post = Safely::safelyGet($_POST);
        ORM::factory('settings')->saveSetting('cert_title', $post['cert_title']);
        ORM::factory('settings')->saveSetting('cert_description', $post['cert_description']);
        ORM::factory('settings')->saveSetting('cert_keywords', $post['cert_keywords']);
        exit();
    }

}