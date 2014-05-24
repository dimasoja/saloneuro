<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Complex extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        
        $this->cname = "complex";
    }

    public function action_index() {
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Заказать комплексные услуги','complex');        
        $view = new View('scripts/complex');        
        $view->complexs = ORM::factory('complex')->find_all()->as_array();
        $this->display($view);
    } 

    public function action_product() {
           $id_product = Request::instance()->param('id', '');   
           $view = new View('scripts/complex/makeorder');                
           $view->product = ORM::factory('complex')->where('id','=',$id_product)->find();           
           $this->display($view);
    }
    public function action_new() {
        $consult = ORM::factory('complexorders');
        $post = $_POST;
        $consult->name = trim(htmlspecialchars($post['name']));
        $consult->email = trim(htmlspecialchars($post['email']));
        $consult->response = trim(htmlspecialchars($post['response']));
        $consult->id_product = trim(htmlspecialchars($post['product']));
        $consult->created = strtotime('now');
        $consult->save();
        $subject = 'Комплексные услуги';
        $body_params = array(
                             'Имя'      =>$consult->name, 
                             'e-mail'   =>$consult->email, 
                             'Комментарий'    =>$consult->response,
                             'Услуга' => ORM::factory('complex')->where('id','=',$consult->id_product)->find()->name,                             
                             'Открыто'   =>date('Y-m-d H:i:s', $consult->created)
                       );
        $settings = ORM::factory('settings');        
        $sendLetter = $settings->sendLetter($admin_email = $settings->getSetting('admin_email'), $subject, $settings->paramsToHtml($body_params));        
        Request::instance()->redirect(Route::get('complex')->uri(array('controller' => 'complex', 'action' => 'success')));
    }

    public function action_success() {
        $view = new View('scripts/complex/success');
        $this->display($view);
    }

}
