<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_ServicesWorkSamples extends Controller_Base {

    public $template = 'layouts/common';
    private $_pages;
    private $_count_per_page = 16;

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "floorsand_services";

        $count_images = count(ORM::factory('images')->where('part', '=', 'work_samples')->find_all()->as_array());
        $this->_pages = ceil($count_images / $this->_count_per_page);
    }

    public function action_index() {
        $view = new View('scripts/servicesworksamples');

        $this->page_title = __("Services Work Samples");
        $meta = ORM::factory('meta')->where('request', '=', 'services-work-samples')->find_all()->as_array();
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

        $view->images = ORM::factory('images')->where('part', '=', 'work_samples')->limit($this->_count_per_page)->order_by('sort', 'asc')->offset(0)->find_all()->as_array();
        $view->pages = $this->_pages;
        $view->page = 1;
        
       /* $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
        $this->display($view, $keywords, $description);

//        $this->display($view, $keywords, $description);
    }

    public function action_page() {
        $error = false;
        $page = Request::instance()->param('id', '');
        if (!is_numeric($page) || $page > $this->_pages) {
            Request::instance()->redirect(Route::get('servicesworksamples')->uri());
        }

        $view = new View('scripts/servicesworksamples');

        $this->page_title = __("Services Work Samples");
        $meta = ORM::factory('meta')->where('request', '=', 'services-work-samples')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;

        $offset = $this->_count_per_page * ($page - 1);

        $view->images = ORM::factory('images')->where('part', '=', 'work_samples')->limit($this->_count_per_page)->order_by('sort', 'asc')->offset($offset)->find_all()->as_array();
        $view->pages = $this->_pages;
        $view->page = $page;

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');
        ViewHead::addScript('jquery.lightbox.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        ViewHead::addStyle('lightbox.css');
        
      /*  $meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
        $keywords = $meta['value'];
        $meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
        $description = $meta['value'];*/
        $this->display($view, $keywords, $description);

//        $this->display($view, $keywords, $description);
    }

}