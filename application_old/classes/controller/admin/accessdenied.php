<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Accessdenied extends Controller_AdminBase {

    public $template = 'layouts/admin';

    public function action_index() {
        $view = new View('scripts/admin/accessdenied');
        $this->display($view);
    }
}
