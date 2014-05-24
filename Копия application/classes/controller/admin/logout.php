<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Logout extends Controller
{

   public function action_index()
   {
      Auth::instance()->logout($destroy=FALSE);
      Request::instance()->redirect( Route::get('admin')->uri() );
   }

}