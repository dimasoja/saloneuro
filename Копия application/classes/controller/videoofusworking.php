<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_VideoOfUsWorking extends Controller_Base {

    public $template = 'layouts/common';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index() {
        $view = new View('scripts/videoofusworking');

        $this->page_title = __("Video of Us working");
        $meta = ORM::factory('meta')->where('request', '=', 'video-of-us-working')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addScript('jquery.lightbox.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        ViewHead::addStyle('lightbox.css');

        $view->videos = ORM::factory('videos')->order_by('sort', 'asc')->find_all()->as_array();
        
        /*$meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
        $this->display($view, $keywords, $description);

        //  $this->display($view, $keywords, $description);
    }

}