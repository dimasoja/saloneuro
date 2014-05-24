<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Testimonials extends Controller_Base {

    public $template = 'layouts/common';
    private $_count_per_page = 12;

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "supplies";
    }

    public function action_index() {
        $view = new View('scripts/testimonials/index');

        $this->page_title = __("Testimonials");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addScript('testimonials.js');
        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');

      /* $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
		$meta = ORM::factory('meta')->where('request', '=', 'order-supplies-product')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
        $this->display($view, $keywords, $description);

//        $this->display($view, $keywords, $description);
    }
    
    public function action_add() {
        $view = new View('scripts/testimonials/successfull');

        $this->page_title = __("Buy supplies Online");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');

        $data = ORM::factory('testimonials');
        $data->values($_POST);
        $data->date = time();
        $data->save();
        
        
        
        
        $meta = ORM::factory('meta')->where('request', '=', 'order-supplies-product')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
        $this->display($view, $keywords, $description);
    }

}