<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Forhome extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index() {
        $view = new View('scripts/forhome');
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Для дома','forhome');
        $this->display($view);
    }
}
