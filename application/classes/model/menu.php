<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Menu extends ORM {

    protected $_table_name = 'menu';
    protected $_primary_key = 'id';

    function getMenuForIndex() {
        $menus = $this->where('parent', '=', '0')->where('type', '=', 'topmenu')->order_by('position', 'asc')->find_all()->as_array();
        $result_menu = '<div class="menu">';
        foreach ($menus as $menu) {
            $result_menu .= '<div class="parent"><span class="size13">&#10154;</span><a id="orange-white" href="/admin/topmenu/edit/' . $menu->id . '">' . $menu->title . '</a></div>';
            $result_menu .= $this->getChildList($menu->id);
        }
        $result_menu .= '</div>';
        return $result_menu;
    }

    function getMenuForEdit($found_id) {
        $menus = $this->where('parent', '=', '0')->where('published','=','on')->where('type','=','topmenu')->order_by('position', 'asc')->find_all()->as_array();
        $result_menu = '<div class="menu">
            <div class="parent-menu"><span class="size13">&#10154;</span><a id="orange-white" onClick=\'addToParent("0", this)\' rel="Корень">Корень</a></div><br/>';
        foreach ($menus as $menu) {
            if ($found_id == $menu->id)
                $block = 'href="javascript:void(0);"'; else
                $block = 'onClick=addToParent("' . $menu->id . '",this)';
            $result_menu .= '<div class="parent-menu"><a id="orange-white" ' . $block . ' rel="'. $menu->title .'">' . $menu->title . ' : ' . $menu->position . '</a></div>';
            $result_menu .= $this->getChildListForEdit($menu->id, $found_id);
        }
        $result_menu .= '</div>';
        return $result_menu;
    }

    function getChildListForEdit($id, $found_id) {
        $child_menu = $this->getMenuById($id);
        $result = '';
        if (isset($child_menu[0])) {
            $result .= '<div class="second-child">';
            foreach ($child_menu as $cm) {
                if ($found_id == $cm->id)
                    $block = 'href="javascript:void(0);"'; else
                    $block = 'onClick=addToParent("' . $cm->id . '",this)';
                $result .= '<div class="third"><span class="size13">&#10154;</span><a id="orange-white" ' . $block . ' rel="'. $cm->title .'" >' . $cm->title . ' : ' . $cm->position . '</a></div>';
                $result .= $this->getChildListThirdForEdit($cm->id, $found_id);
            }
            $result .= '</div>';
        }
        return $result;
    }

    function getChildList($id) {
        $child_menu = $this->getMenuById($id);
        $result = '';
        if (isset($child_menu[0])) {
            $result .= '<div class="second-child">';
            foreach ($child_menu as $cm) {
                $result .= '<div class="third"><span class="size13">&#10154;</span><a id="orange-white" href="/admin/topmenu/edit/' . $cm->id . '">' . $cm->title . '</a></div>';
                $result .= $this->getChildListThird($cm->id);
            }
            $result .= '</div>';
        }
        return $result;
    }

    function getMenuById($id) {
        return $this->where('parent', '=', $id)->where('type', '=', 'topmenu')->order_by('position', 'asc')->find_all()->as_array();
    }

    function getChildListThird($id) {
        $child_menu = $this->getMenuById($id);
        $result = '';
        if (isset($child_menu[0])) {
            $result .= '<div class="third-child">';
            foreach ($child_menu as $cm) {
                $result .= '<div class="fourth"><span class="size13">&#10154;</span><a id="orange-white" href="/admin/topmenu/edit/' . $cm->id . '">' . $cm->title . '</a></div>';
                //$result .= $this->getChildListThird($cm->id);
            }
            $result .= '</div>';
        }
        return $result;
    }

    function getChildListThirdForEdit($id, $found_id) {

        $child_menu = $this->getMenuById($id);
        $result = '';
        if (isset($child_menu[0])) {
            $result .= '<div class="third-child">';
            foreach ($child_menu as $cm) {
                if ($found_id == $cm->id)
                    $block = 'href="javascript:void(0);"'; else
                    $block = '';
                //$block='onClick=addToParent("'.$cm->id.'","' . $cm->title . '")';
                $result .= '<div class="fourth"><span class="size13">&#10154;</span><a id="orange-white" ' . $block . ' >' . $cm->title . ' : ' . $cm->position . '</a></div>';
                //  $result .= $this->getChildListThirdForEdit($cm->id);
            }
            $result .= '</div>';
        }
        return $result;
    }

    function getMainMenuForIndex() {
        $menus = $this->where('parent', '=', '0')->where('type', '=', 'mainmenu')->where('for', '=', 'for_home')->order_by('position', 'asc')->find_all()->as_array();
        $result_menu = '<div class="span6"><div class="widget"><div class="widget-header"><h5>Для дома</h5></div><div class="widget-content"><div class="menu">';
        foreach ($menus as $menu) {
            $result_menu .= '<div class="parent"><span class="size13">&#10154;</span><a id="orange-white" href="/admin/mainmenu/edit/' . $menu->id . '">' . $menu->title . '</a></div>';
            $result_menu .= $this->getMainChildList($menu->id, 'for_home');
        }
        $result_menu .= '</div></div></div></div>';
        $menus = $this->where('parent', '=', '0')->where('type', '=', 'mainmenu')->where('for', '=', 'for_business')->order_by('position', 'asc')->find_all()->as_array();
        $result_menu .= '<div class="span6" style="clear:both;margin-left:0px;"><div class="widget"><div class="widget-header"><h5>Для бизнеса</h5></div><div class="widget-content"><div class="menu">';
        foreach ($menus as $menu) {
            $result_menu .= '<div class="parent"><span class="size13">&#10154;</span><a id="orange-white" href="/admin/mainmenu/edit/' . $menu->id . '">' . $menu->title . '</a></div>';
            $result_menu .= $this->getMainChildList($menu->id, 'for_business');
        }
        $result_menu .= '</div></div></div></div>';
        return $result_menu;
    }

    function getMainMenuForEdit($found_id) {
        $result_menu = '<div class="parent-menu"><a id="orange-white" onClick=\'addToParent("0", this)\' rel="Корень" >Корень</a></div><br/>';
        $menus = $this->where('parent', '=', '0')->where('type', '=', 'mainmenu')->where('for', '=', 'for_home')->order_by('position', 'asc')->find_all()->as_array();
        $result_menu .= '<h3 style="color:white">Для дома</h3><div class="menu">';            
        foreach ($menus as $menu) {
            if ($found_id == $menu->id)
                $block = 'href="javascript:void(0);"'; else
                $block = 'onClick=\'addToParent("' . $menu->id . '" , this)\'';
            $result_menu .= '<div class="parent-menu"><span class="size13">&#10154;</span><a id="orange-white" ' . $block . ' rel="'. $menu->title .'" >' . $menu->title . ' : ' . $menu->position . '</a></div>';
            $result_menu .= $this->getMainChildListForEdit($menu->id, $found_id);
        }
        $result_menu .= '</div>';
        $menus = $this->where('parent', '=', '0')->where('type', '=', 'mainmenu')->where('for', '=', 'for_business')->order_by('position', 'asc')->find_all()->as_array();
        $result_menu .= '<h3 style="color:white">Для бизнеса</h3><div class="menu">';            
        foreach ($menus as $menu) {
            if ($found_id == $menu->id)
                $block = 'href="javascript:void(0);"'; else
                $block = 'onClick=\'addToParent("' . $menu->id . '" , this)\'';
            $result_menu .= '<div class="parent-menu"><span class="size13">&#10154;</span><a id="orange-white" ' . $block . ' rel="'. $menu->title .'" >' . $menu->title . ' : ' . $menu->position . '</a></div>';
            $result_menu .= $this->getMainChildListForEdit($menu->id, $found_id);
        }
        $result_menu .= '</div>';
        return $result_menu;
    }

    function getMainChildListForEdit($id, $found_id) {
        $child_menu = $this->getMainMenuById($id);
        $result = '';
        if (isset($child_menu[0])) {
            $result .= '<div class="second-child">';
            foreach ($child_menu as $cm) {
                if ($found_id == $cm->id)
                    $block = 'href="javascript:void(0);"'; else
                    $block = 'onClick=addToParent("' . $cm->id . '",this)';
                $result .= '<div class="third"><span class="size13">&#10154;</span><a id="orange-white" ' . $block . '  rel="'. $cm->title .'" >' . $cm->title . ' : ' . $cm->position . '</a></div>';
                $result .= $this->getMainChildListThirdForEdit($cm->id, $found_id);
            }
            $result .= '</div>';
        }
        return $result;
    }

    function getMainChildList($id, $type = 'for_home') {
        $child_menu = $this->getMainMenuById($id, $type);
        $result = '';
        if (isset($child_menu[0])) {
            $result .= '<div class="second-child">';
            foreach ($child_menu as $cm) {
                $result .= '<div class="third"><span class="size13">&#10154;</span><a id="orange-white" href="/admin/mainmenu/edit/' . $cm->id . '">' . $cm->title . '</a></div>';
                $result .= $this->getMainChildListThird($cm->id);
            }
            $result .= '</div>';
        }
        return $result;
    }

    function getMainMenuById($id, $type = 'for_home') {
        return $this->where('parent', '=', $id)->where('type', '=', 'mainmenu')->where('for', '=', $type)->order_by('position', 'asc')->find_all()->as_array();
    }

    function getMainChildListThird($id) {
        $child_menu = $this->getMainMenuById($id);
        $result = '';
        if (isset($child_menu[0])) {
            $result .= '<div class="third-child">';
            foreach ($child_menu as $cm) {
                $result .= '<div class="fourth"><span class="size13">&#10154;</span><a id="orange-white" href="/admin/mainmenu/edit/' . $cm->id . '">' . $cm->title . '</a></div>';
                //$result .= $this->getChildListThird($cm->id);
            }
            $result .= '</div>';
        }
        return $result;
    }

    function getMainChildListThirdForEdit($id, $found_id) {

        $child_menu = $this->getMainMenuById($id);
        $result = '';
        if (isset($child_menu[0])) {
            $result .= '<div class="third-child">';
            foreach ($child_menu as $cm) {
                if ($found_id == $cm->id)
                    $block = 'href="javascript:void(0);"'; else
                    $block = '';
                //$block='onClick=addToParent("'.$cm->id.'","' . $cm->title . '")';
                $result .= '<div class="fourth"><span class="size13">&#10154;</span><a id="orange-white" ' . $block . ' >' . $cm->title . ' : ' . $cm->position . '</a></div>';
                //  $result .= $this->getChildListThirdForEdit($cm->id);
            }
            $result .= '</div>';
        }
        return $result;
    }

}