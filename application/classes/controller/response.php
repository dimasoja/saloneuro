<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Response extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index() {
        $view = new View('scripts/response');
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Оставить отзыв','response');
        $this->display($view);
    }


    public function action_new() {
        $response = ORM::factory('response');
        $post = $_POST;
        $response->name = trim(htmlspecialchars($post['name']));
        $response->email = trim(htmlspecialchars($post['email']));
        $response->response = trim(htmlspecialchars($post['response']));
        $response->to = trim(htmlspecialchars($post['to']));
        $response->created = strtotime('now');
        $response->save();
        $subject = 'Новый отзыв на сайте';
        $body_params = array(
                             'Имя'      =>$response->name, 
                             'e-mail'   =>$response->email, 
                             'Отзыв'    =>$response->response, 
                             'Относится'=>ORM::factory('products')->where('id_product','=',$response->to)->find()->title,
                             'Открыт'   =>date('Y-m-d H:i:s', $response->created)
                       );
        $settings = ORM::factory('settings');        
        $sendLetter = $settings->sendLetter($admin_email = $settings->getSetting('admin_email'), $subject, $settings->paramsToHtml($body_params));        
        Request::instance()->redirect(Route::get('response')->uri(array('controller' => 'response', 'action' => 'success')));
    }

    public function action_success() {
        $view = new View('scripts/response/success');
        $this->display($view);
    }

}