<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Login extends Controller_Base
{

   public $template = 'layouts/admin';
   protected $auth;
   protected $user;
   private $_areas = array('username', 'password');

   public function action_index()
   {

      $this->auth = Auth::instance();	

	  $this->user = $this->auth->get_user();

      if ($this->auth->logged_in())
      {
         Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'index')) );
      }
      ViewFormError::addFields($this->_areas);
      
      $view = new View('scripts/admin/loginform');

      $this->page_title = __("Login");

      $login_values = array();
      $login_errors = array();

      $post = new Validate($_POST);

      $post->rule('username', 'not_empty')
           ->rule('username', 'min_length', array(1))
           ->rule('username', 'max_length', array(50))
           ->rule('password', 'not_empty')
           ->rule('password', 'min_length', array(6));

      if ($post->check())
      {
         
         $post_array = $post->as_array();
        
         if ($this->auth->login($post_array['username'], $post_array['password'], $remember = TRUE))
         { 
                     Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'index')) );
         }
         else
         {
            ViewMessage::adminMessage(__('Неверные имя пользователя или пароль. Попробуйте еще раз. '), 'error');
         }
      }

      $view = ViewFormError::build($view, $post, $login_values, $login_errors);
      $this->display($view);
   }

}