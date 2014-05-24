<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_ContactUs extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "contactus";
    }

    public function action_index() {
        $view = new View('scripts/contactus');

        $this->page_title = __("Contact us");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("Ask any questions for an instant response. This site will answer all your floor sanding questions - simply ask!");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        /* $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();

          $keywords=$meta['value'];
          $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
          $description=$meta['value']; */
        $meta = ORM::factory('meta')->where('request', '=', 'contact-us')->find_all()->as_array();
        $keywords = $meta['0']->keywords;
        $description = $meta['0']->description;
        $this->display($view, $keywords, $description);

        //$this->display($view, $keywords, $description);
    }

    public function action_send() {
        if (isset($_POST['email'])) {
            $settings_array = ORM::factory('settings')->getSettings('other', 'object');
            $to = trim($settings_array['fs_admin_email']);
            $from = $_POST['email'];
            $subject = "New message from FloorSandUK: User " . $_POST['txt_name'];
            $message = $_POST['enquiry'];
            $contactus = ORM::factory('contactus')->where('email', '=', $_POST['email'])->find();
            $contactus->name = $_POST['txt_name'];
            $contactus->email = $_POST['email'];
            $contactus->save();
            if (Email::send($to, $from, $subject, $message)) {
                ViewMessage::adminMessage('Enquiry was sent succesfully.<br />Thanks for contacting us, we will be back in touch with you shortly.', 'info', true);
            } else {
                ViewMessage::adminMessage('Email was not sent!', 'error', true);
            }
        }
        Request::instance()->redirect(Route::get('contactus')->uri());
    }

    function action_ajaxform() {
        $captcha_session = Session_Native::instance()->get('qaptcha_key', '');
        Session_Native::instance()->delete('captcha_code');
        $get = $_GET;
        $contact = ORM::factory('contactus');
        $contact->name = trim(htmlspecialchars($get['name']));
        $contact->email = trim(htmlspecialchars($get['email']));
        $contact->question = trim(htmlspecialchars($get['question']));
        $contact->created = time();
        $captcha_code = $get['captcha_code'];
        if ($captcha_code == $captcha_session) {
            if ($contact->save()) {
                $subject = 'Отправили форму "Связаться с нами"';
                $body_params = array(
                    'Имя' => $contact->name,
                    'e-mail' => $contact->email,
                    'Вопрос' => $contact->question                    
                );
                $settings = ORM::factory('settings');
                $settings->sendLetter($settings->getSetting('fs_admin_email'), $subject, $settings->paramsToHtml($body_params));
                echo 'yes';
            }
        } else {
            echo 'no';
        }
        exit();
    }

}