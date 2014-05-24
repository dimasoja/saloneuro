<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Consult extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index() {
        $view = new View('scripts/consult');
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Консультация','consult');
        $this->display($view);
    }

    public function action_new() {
        $consult = ORM::factory('consult');
        $post = $_POST;
        $consult->name = trim(htmlspecialchars($post['name']));
        $consult->email = trim(htmlspecialchars($post['email']));
        $consult->response = trim(htmlspecialchars($post['response']));
        $consult->created = strtotime('now');
        $consult->save();
        $subject = 'Консультация';
        $body_params = array(
                             'Имя'      =>$consult->name, 
                             'e-mail'   =>$consult->email, 
                             'Вопрос'    =>$consult->response,                             
                             'Открыта'   =>date('Y-m-d H:i:s', $consult->created)
                       );
        $settings = ORM::factory('settings');        
        $sendLetter = $settings->sendLetter($admin_email = $settings->getSetting('admin_email'), $subject, $settings->paramsToHtml($body_params));
        die('success');
//        Request::instance()->redirect(Route::get('consult')->uri(array('controller' => 'consult', 'action' => 'success')));
    }

    public function action_success() {
        $view = new View('scripts/consult/success');
        $this->display($view);
    }

}
