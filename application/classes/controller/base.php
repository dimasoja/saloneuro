<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller_Template {

    public function __construct($request) {
        parent::__construct($request);
        ViewHead::addStyle('luba.css');
        $published = ORM::factory('pages')->where('browser_name', '=', $request->uri)->find()->published;
        if ((isset($published)) and ($published != 'on') and ($request->uri != '')) {
            $request = Request::factory('error/404')->execute();
            echo $request->send_headers()->response;
        }
    }

    public function display(& $view, $keywords = "", $description = "") {
        $this->template->site_name = ORM::factory('settings')->getSetting('title');
       // $this->template->page_title = '';
        $this->template->page_title_split = '';
        if (isset($this->page_title)) {
         //   $this->template->page_title = $this->page_title;
            $this->template->page_title_split = ' :: ';
        }        
       $this->template->content = $view;
        $this->template->keywords = $keywords;
        $this->template->description = $description;
        $this->template->bottom_adsense = ORM::factory('adsense')->where('short_name', '=', 'fs_bottom_adsense')->find()->text;
        if (isset($this->cname)) {
            $this->template->cname = $this->cname;
        } else {
            $this->template->cname = "";
        }

        if (isset($this->gallery_images)) {
            $this->template->gallery_images = $this->gallery_images;
        } else {
            $this->template->gallery_images = array();
        }
        $images = ORM::factory('images')->where('part', '=', 'work_samples')->find_all()->as_array();
        foreach ($images as $image) {
            $postdata[$image->id_image] = ORM::factory('postmeta')->getDataById($image->id_image);
        }
        $this->template->menu = ORM::factory('menu')->where('published','=','on')->where('parent','=','on')->where('type','=','topmenu')->order_by('position', 'asc')->find_all()->as_array();
        $this->template->certificates = ORM::factory('certificates')->where('featured','=','on')->find_all()->as_array();
        $city_limit = ORM::factory('settings')->getSetting('addr_num');

        $geo_data = Geoipthermo::getData();
        $geo_data = simplexml_load_string($geo_data);
        $geo_data = $geo_data->ip;
        if(isset($geo_data->city))
            $this->template->city = $geo_data->city;
        else
            $this->template->city = '';
        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city','=', $geo_data->city)->find_all()->as_array();
        $this->template->order_cities = ORM::factory('addresses')->group_by('city')->find_all()->as_array();
        $this->template->all_cities = ORM::factory('addresses')->find_all()->as_array();
        $this->template->sliderdata_home = ORM::factory('postmeta')->get_for_home($postdata);
        $this->template->sliderdata_business = ORM::factory('postmeta')->get_for_business($postdata);    
        $this->template->products_home = ORM::factory('products')->where('published','=','on')->where('type','=','for_home')->find_all();
        $this->template->products_business = ORM::factory('products')->where('published','=','on')->where('type','=','for_business')->find_all();       
    }

    public function display_ajax($view) {
        $this->auto_render = false;
        echo $view;
    }

}

