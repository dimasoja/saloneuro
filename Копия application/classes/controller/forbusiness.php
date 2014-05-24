<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Forbusiness extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index() {
        $view = new View('scripts/forbusiness');
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Для бизнеса','forbusiness');
        $this->display($view);
    }
}
