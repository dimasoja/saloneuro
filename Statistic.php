<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Statistic extends Controller_Template {

    public $template = 'layouts/statistic';
    private $game;
    
    public function __construct($request, $response) {
        $userId = Chesterauth::getUser();
        $this->game = Chesterhelper::getGame();      
        View::set_global('agree', Chesterhelper::getPromoAgree($userId));
        View::set_global('game2', $this->game);
        parent::__construct($request, $response);
    }

    public function action_index() {
        /******/
        
        $chesterapi = new Chesterapi();
        $userId = Chesterauth::getUser();
        //$chesterapi->contentConsumed($userId, 'statistic');
        /******/
        $statistic = ORM::factory('statistic1');
        $firstTen = $statistic->getFirstTen();                  
        $this->template->set('countAll', $statistic->countAll($firstTen));     
        $this->template->set('is_present1', Chesterhelper::isPresent1());             
        $this->template->set('rating60', $statistic->get60());  
        $this->template->set('rating10', $statistic->get10());  
        $this->template->set('selfRating', $statistic->getSelfRating('1'));      
        $this->template->set('acceptGift', $statistic->acceptGift()); 
        $statistic = ORM::factory('statistic2');
        $firstTen = $statistic->getFirstTen();                  
        $this->template->set('countAll2', $statistic->countAll($firstTen));     
        $this->template->set('is_present2', Chesterhelper::isPresent2());             
        $this->template->set('rating602', $statistic->get60());  
        $this->template->set('rating102', $statistic->get10());  
        $this->template->set('selfRating2', $statistic->getSelfRating('2'));      
        $this->template->set('acceptGift2', $statistic->acceptGift());         
    }

    public function action_setprize() {
        if (Request::initial()->is_ajax()) {
            $post = $this->request->post();
            $post = Safely::safelyGet($post);
            $prize_id = (int) $post['prizeID'];
            $game = Kohana::$config->load('chesterauth.game');
            
            if (isset($post['action'])) {
                if ($post['action'] == 'setPrize') {
                    if (Chesterhelper::savePrize($prize_id, $game)) {
                        echo Chesterhelper::doSuccess();
                    } else {
                        echo Chesterhelper::doError();
                    }
                }
                if ($post['action'] == 'confirmprize') { 
                    /******/
                    $userId = Chesterauth::getUser();
                    $chesterapi = new Chesterapi();
                    $statistic = $chesterapi->receivePrize($userId);
                    /******/
                    if (Chesterhelper::confirmPrize($prize_id, $game)) {
                        echo Chesterhelper::doSuccess();
                    } else {
                        echo Chesterhelper::doError();
                    }
                }
            }

            exit();
        }
    }

    public function action_sendstat() {
        if (Request::initial()->is_ajax()) {
            $post = $this->request->post();
            $post = Safely::safelyGet($post);
            $url = $post['route'];
            $userId = Chesterauth::getUser();
            $chesterapi = new Chesterapi();
            //$chesterapi->contentConsumed($userId, $url);
            exit();
        }
    }

}

