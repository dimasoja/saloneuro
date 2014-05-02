<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Callback extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "callback";
    }

    public function action_index() {
        $view = new View('scripts/callback');
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Заказать обратный звонок','callback');
        $this->display($view);
    }

    public function action_new() {
        $response = ORM::factory('callback');
        $post = Safely::safelyGet($_POST);
        $response->name = trim(htmlspecialchars($post['name']));
        $response->phone = trim(htmlspecialchars($post['phone']));
        $response->time_from = trim(htmlspecialchars($post['time_from']));
        $response->time_to = trim(htmlspecialchars($post['time_to']));        
       // $response->response = trim(htmlspecialchars($post['response']));
        $response->created = strtotime('now');
        $subject = 'На сайте заказали звонок';
        $body_params = array(
                             'Имя'      =>$response->name, 
                             'e-mail'   =>$response->phone, 
                             'Сообщение'    =>$response->response, 
                             'Позвонить...'=>$response->time_from.'-'.$response->time_to,
                             'Открыт'   =>date('Y-m-d H:i:s', $response->created)
                       );
        $settings = ORM::factory('settings');     
        $admin_email = $settings->getSetting('admin_email');        
        $sendLetter = $settings->sendLetter($admin_email, $subject, $settings->paramsToHtml($body_params)); 
        $response->save();
        die('success');
        //FrontHelper::setRedirect('index');
    }

    public function action_success() {
//        $view = new View('scripts/callback/success');
//        $this->display($view);
        FrontHelper::setRedirect('index');
    }

            public function action_delete() {
        $id = $_GET['id'];
        ORM::factory('consult')->where('id','=',$id)->delete_all();
        //ORM::factory('settings')->deleteItem('response','$id');
         $this->action_index();
    }

}