<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Base {

    public $template = 'layouts/common-news';
    public $id;
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "news";
        $this->category = $request->param('category', '');
    }

    public function action_index() {
        $item_founded = false;
        $this->template->css = ORM::factory('settings')->getSetting('css');
        $city_limit = ORM::factory('settings')->getSetting('addr_num');
        $this->template->session_city = Session::instance()->get('city','');
        $this->template->session_cities = ORM::factory('addresses')->limit($city_limit)->where('main','=','on')->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->cities = ORM::factory('addresses')->limit($city_limit)->where('city', '=', $this->template->session_city)->find_all()->as_array();
        $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbPage('Новости и акции', 'news');
        $this->template->id_page = '';

        if($this->category=='') {
            $item_founded = true;
            $view = new View('scripts/news/index');
            $this->template->meta_title = 'Новости';
            //$keywords = $view->page['keywords'];
            //$description = $view->page['description'];
            $this->template->page_title = '';
            $view->news = ORM::factory('news')->where('published','=','on')->find_all()->as_array();
        } else {
            $view = new View('scripts/news/custom');
            $news = ORM::factory('news')->where('published','=','on')->find_all()->as_array();
            $news_found = '';
            foreach($news as $new) {
                $check = strtolower(FrontHelper::transliterate($new->title));
                if ($this->category == $check) {
                    $item_founded = true;
                    $view->new = $new;
                    $meta = ORM::factory('meta')->where('id_new','=',$new->id_new)->find();
                    $this->template->meta_title = $meta->meta_title;
                    $keywords = $meta->keywords;
                    $description = $meta->description;
                    $this->template->page_title = '';
                    $this->template->breadcrumbs = ORM::factory('settings')->generateBreadcrumbNews($new->title, 'news/'.$check);
                }
            }
        }

        if(!$item_founded) {
            header('Location: /error/404');
            exit();
        }
        $this->display($view);
    }

    function transliterate($string) {
        $roman = array("Sch", "sch", 'Yo', 'Zh', 'Kh', 'Ts', 'Ch', 'Sh', 'Yu', 'ya', 'yo', 'zh', 'kh', 'ts', 'ch', 'sh', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', '', 'Y', '', 'E', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', '', 'y', '', 'e');
        $cyrillic = array("Щ", "щ", 'Ё', 'Ж', 'Х', 'Ц', 'Ч', 'Ш', 'Ю', 'я', 'ё', 'ж', 'х', 'ц', 'ч', 'ш', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Ь', 'Ы', 'Ъ', 'Э', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'ь', 'ы', 'ъ', 'э');
        return str_replace($cyrillic, $roman, $string);
    }

   
}