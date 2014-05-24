<?php defined('SYSPATH') or die('No direct script access.');

class Controller_VitalPoints extends Controller_Base
{

    public $template = 'layouts/common';
    private $keywords;
    private $description;


    public function __construct($request)
    {
        parent::__construct($request);
        
        $this->page_title = __("Vital Points");
        $this->keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $this->description = __("My vital points");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
    }

    public function action_index($message = "")
    {
        $view = new View('scripts/vitalpoints');
        
        if (isset($_POST['email'])) {
            
            $post = new Validate($_POST);
            $vital_values = $post->as_array();
            $vital_errors = array();
            $post->filter('username', 'trim')
                 ->filter('surname', 'trim')
                 ->filter('email', 'trim')
                 ->rule('username', 'not_empty')
                 ->rule('username', 'min_length', array(2))
                 ->rule('username', 'max_length', array(255))
                 ->rule('surname', 'not_empty')
                 ->rule('surname', 'min_length', array(2))
                 ->rule('surname', 'max_length', array(50))
                 ->rule('email', 'not_empty')
                 ->rule('email', 'min_length', array(7))
                 ->rule('email', 'max_length', array(150))
                 ->rule('email', 'email');
            
            if ($post->check()) {
                /* Test! */
                if ($_POST['email'] == "test@test.com") {
                    Session::instance()->set('id_vpoints', 1);
                    Request::instance()->redirect( Route::get('vitalpoints')->uri(array('controller' => 'vitalpoints', 'action' => 'confirm')) );
                }
                
                $vp = ORM::factory('vpoints')->where('email', '=', $_POST['email'])->find();
                if (isset($vp->email)) {
                    ViewMessage::adminMessage('This e-mail is already registered!', 'error');
                } else {
                    $letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $pass = "";
                    for ($i = 0; $i <= 7; $i++) {
                        $pass .= $letters[rand(1, strlen($letters) - 1)];
                    }
                    $vp->email = $_POST['email'];
                    $vp->name = $_POST['username'];
                    $vp->surname = $_POST['surname'];
                    $vp->pass = md5($pass);
                    
                    if ($vp->save()) {
                        $subject = "Verify password to site FloorSandUK";
                        $body = new View('emails/vitalpoints');
                        $body->pass = $pass;
						$settings_array = ORM::factory('settings')->getSettings('other', 'object'); // получение конфигов из бд через костыль, ибо возвращается группа, а не значение опции
                        Email::send($_POST['email'], $settings_array['fs_admin_email'], $subject, $body, true);
                        Request::instance()->redirect( Route::get('vitalpoints')->uri(array('controller' => 'vitalpoints', 'action' => 'verify')) );
                    } else {
                        ViewMessage::adminMessage('Saving data is not complete.', 'error');
                    }
                }
            } else {
                ViewMessage::adminMessage('Entered data is not valid', 'error');
            }
        }
 $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
		
		$keywords=$meta['value'];
		$meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
		$description=$meta['value'];
        $this->display($view, $keywords, $description);

       // $this->display($view, $this->keywords, $this->description);
    }
    
    public function action_verify() {
        $view = new View('scripts/vitalpoints/verify');
        
        if (isset($_POST['pass'])) {
            $usr = ORM::factory('vpoints')->where('pass', '=', md5($_POST['pass']))->find();
            $usr_arr = $usr->as_array();
            if (isset($usr_arr['id'])) {
                $usr->pass = "";
                $usr->save();
                Session::instance()->set('id_vpoints', $usr_arr['id']);
                Request::instance()->redirect( Route::get('vitalpoints')->uri(array('controller' => 'vitalpoints', 'action' => 'confirm')) );
            } else {
                ViewMessage::adminMessage('Password is incorrect', 'error');
            }
        }
 $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
		
		$keywords=$meta['value'];
		$meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
		$description=$meta['value'];
        $this->display($view, $keywords, $description);

      //  $this->display($view, $this->keywords, $this->description);
    }
    
    public function action_confirm() {
        $id = Session::instance()->get('id_vpoints', '');
        if ('' == $id) {
            Request::instance()->redirect( Route::get('vitalpoints')->uri() );
        }
        
        ViewFormError::addFields(array('name', 'surname', 'address', 'phone', 'mphone', 'town', 'postcode'));
        
        $view = new View('scripts/vitalpoints/confirm');
        
        
        $view->cont = ORM::factory('pages')->where('cname', '=', 'vital_points')->find()->as_array();
        $view->user_info = ORM::factory('vpoints')->where('id', '=', $id)->find()->as_array();
        
        if (isset($_POST['name'])) {
            $post = new Validate($_POST);
            $post->filter('name', 'trim')
                    ->rule('name', 'not_empty')
                    ->rule('name', 'min_length', array(2))
                    ->rule('name', 'max_length', array(100))
                    
                    ->filter('surname', 'trim')
                    ->rule('surname', 'not_empty')
                    ->rule('surname', 'min_length', array(2))
                    ->rule('surname', 'max_length', array(50))
                    
                    ->filter('town', 'trim')
                    ->rule('town', 'not_empty')
                    ->rule('town', 'min_length', array(3))
                    ->rule('town', 'max_length', array(30))
                    
                    ->filter('address', 'trim')
                    ->rule('address', 'not_empty')
                    ->rule('address', 'min_length', array(5))
                    ->rule('address', 'max_length', array(255))
                    
                    ->filter('postcode', 'trim')
                    ->rule('postcode', 'not_empty')
                    ->rule('postcode', 'min_length', array(2))
                    ->rule('postcode', 'max_length', array(20))
                    
                    ->filter('mphone', 'trim')
                    ->rule('mphone', 'not_empty')
                    ->rule('mphone', 'min_length', array(2))
                    ->rule('mphone', 'max_length', array(20))
                    ->rule('mphone', 'regex', array('~^[\+\-\(\)0-9\s]+$~'))
                    
                    ->filter('phone', 'trim')
                    ->rule('phone', 'max_length', array(20))
                    ->rule('phone', 'regex', array('~^[\+\-\(\)0-9\s]+$~'));
            
            if ($post->check()) {
                $usr = ORM::factory('vpoints')->where('id', '=', $id)->find();
                $usr->name = $_POST['name'];
                $usr->surname = $_POST['surname'];
                $usr->address = $_POST['address'];
                $usr->phone = $_POST['phone'];
                $usr->mphone = $_POST['mphone'];
                $usr->town = $_POST['town'];
                $usr->postcode = $_POST['postcode'];
                if ($usr->save()) {
                    Request::instance()->redirect( Route::get('vitalpoints')->uri(array('controller' => 'vitalpoints', 'action' => 'successfull')) );
                } else {
                    ViewMessage::adminMessage('Saving error.', 'error');
                }
            } else {
                ViewFormError::build($view, $post);
            }
        }
         $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
		
		$keywords=$meta['value'];
		$meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
		$description=$meta['value'];
        $this->display($view, $keywords, $description);

       // $this->display($view, $this->keywords, $this->description);
    }
    
    public function action_successfull() {
        Session::instance()->delete('id_vpoints');
        $view = new View('scripts/vitalpoints/successfull');
         $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
		
		$keywords=$meta['value'];
		$meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
		$description=$meta['value'];
        $this->display($view, $keywords, $description);

        //$this->display($view, $this->keywords, $this->description);
    }

}