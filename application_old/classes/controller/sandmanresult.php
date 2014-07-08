<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SandmanResult extends Controller_Base
{

    public $template = 'layouts/common';
    
    public function __construct($request)
    {
        parent::__construct($request);
        $this->cname = "floorsand_services";
    }

    public function action_index()
    {
        $view = new View('scripts/sandmanresult/index');

        $this->page_title = __("Sandman Results");
        $keywords = __("floor sanding, floor sanding manchester, floor sanding stockport, wood floor sanding, floor sanding services, wood floor restoration, expert floor sanding cost, floor sanding company, sanding wood floors, wooden floor sanding, wood flooring sanding, wood floor sanding manchester, commercial floor sanding, school floor sanding, church floor sanding, hotel floor sanding specialists, dustless floor sanding, hardwood floor sanding service");
        $description = __("");

        ViewHead::addScript('jquery.js');
        ViewHead::addScript('dw_scrollObj.js');
        ViewHead::addScript('dw_hoverscroll.js');
        ViewHead::addScript('swfobject_modified.js');
        ViewHead::addScript('main_functions.js');

        ViewHead::addStyle('scrolling.css');
        ViewHead::addStyle('menu.css');
        $view->postcode = "";
        
        if (isset($_POST['postcode'])) {
            $postcodes = explode(" ", $_POST['postcode']);
            
            $office = ORM::factory('postcodes')->select('offices.name', 'offices.address', 'offices.phone', 'offices.town', 'offices.postcode', 'offices.email', 'offices.mphone', 'postcodes_offices.postsubcodes')
                                                ->join('postcodes_offices')
                                                ->on('postcodes_offices.id_postcode', '=', 'postcodes.id_postcode')
                                                ->join('offices')
                                                ->on('offices.id_office', '=', 'postcodes_offices.id_office')
                                                ->where('postcodes.district', '=', $postcodes[0])
                                                ->find()
                                                ->as_array();
            if (isset($office['postsubcodes'])) {
                $postsubcodes = str_replace(" ", "", $office['postsubcodes']);
                $postsubcodes = explode(',', $postsubcodes);
                if (isset($postcodes[1]) && in_array($postcodes[1][0], $postsubcodes)) {
                    $view->office = $office;
                }
            }
            $view->postcode = $_POST['postcode'];
        }
 /*$meta = ORM::factory('settings')->where('short_name', '=', 'keywerds')->find()->as_array();
		
		$keywords=$meta['value'];
		$meta = ORM::factory('settings')->where('short_name', '=', 'description')->find()->as_array();
		$description=$meta['value'];*/
		$meta = ORM::factory('meta')->where('request', '=', 'sandman-result')->find_all()->as_array();
		$keywords =	$meta['0']->keywords; 
        $description = $meta['0']->description;
        $this->display($view, $keywords, $description);

//        $this->display($view, $keywords, $description);
    }

}