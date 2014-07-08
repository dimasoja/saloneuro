<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Captcha extends Controller_Base {

    public $template = 'layouts/common';
    private $_upload_img_dir = '../uploads/users/';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    function action_captcha() {              
        $aResponse['error'] = false;

        if (isset($_POST['action']) && isset($_POST['qaptcha_key'])) {
            $_SESSION['qaptcha_key'] = false;

            if (htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'qaptcha') {
                $_SESSION['qaptcha_key'] = $_POST['qaptcha_key'];
                echo json_encode($aResponse);
            } else {
                $aResponse['error'] = true;
                echo json_encode($aResponse);
            }
        } else {
            $aResponse['error'] = true;
            echo json_encode($aResponse);
        }
        exit();
    }

}