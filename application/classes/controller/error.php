<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Error extends Controller {
 

    public function action_404()
    { 
        die('its a 404 page');
        $this->request->status = 404;
        $this->request->headers['HTTP/1.1'] = '404';
        //Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'index')));
    }
    
    public function action_admin()
    { 
        die('its a admin page');
        $this->request->status = 404;
        $this->request->headers['HTTP/1.1'] = '404';
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'login')));
    }
    
    public function action_403()
    {
        die(print_r('its a admin page'));
        $this->request->status = 403;
        $this->request->headers['HTTP/1.1'] = '403';
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'login')));
    }
 
    public function action_500()
    {
        $this->request->status = 500;
        $this->request->headers['HTTP/1.1'] = '500';
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'login')));
    }
} // End Error