<?php
defined('SYSPATH') or die('No direct script access.');

class AdminInfo {

    public function __construct() {
        
    }

    public function getInfoMessage() {
        $information = Session::instance()->get('information', '');
        Session::instance()->delete('information', '');
        return $information;
    }

    public function setInfoRedirect($information, $controller, $action='index') {
        Session::instance()->set('information', $information);        
        HTTP::redirect(Route::get('admin')->uri(
                        array(
                            'controller' => $controller,
                            'action' => $action
                        )
        ));
        return;
    }
    
    public function setParamRedirect($param, $value, $controller, $action) {
        Session::instance()->set($param, $value);
        HTTP::redirect(Route::get('default')->uri(
                        array(
                            'controller' => $controller,
                            'action' => $action
                        )
        ));
        return;       
    }

}

?>
