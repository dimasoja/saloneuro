<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Testimonials extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "supplies";
    }

    public function action_index() {
        $view = new View('scripts/admin/testimonials/check');
        $this->page_title = __("Testimonials");

        $hashes = ORM::factory('testimonials')->order_by('id', 'desc')->find_all()->as_array();
        $testimonials = array();
        if (count($hashes) > 0) {
            foreach ($hashes as $key => $hash) {
                $testimonials[$key]['name'] = $hash->name; 
                $testimonials[$key]['surname'] = $hash->surname; 
                $testimonials[$key]['email'] = $hash->email; 
                $testimonials[$key]['date'] = $hash->date;
                $testimonials[$key]['id'] = $hash->id;
                $testimonials[$key]['status'] = $hash->status;
            }
        }
        $view->testimonials = $testimonials;
        $this->display($view);
    }
    

    public function action_changestatus() {
        $get = $_GET;      
        $view = new View('scripts/admin/testimonials/check');
        $changestatus = ORM::factory('testimonials')->where('id', '=', $get['id'])->find();
        $changestatus->status = $get['status'];
        $changestatus->save();
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'testimonials', 'action' => 'index')));
    }

    public function action_delete() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $si = ORM::factory('suppliesimages')->where('id_supplies', '=', $_POST['id_supplies'])->find();
            $img = ORM::factory('images')->where('id_image', '=', $si->id_image)->find();
            @unlink(SYSPATH . $this->_upload_img_dir . $img->path);

            ORM::factory('images')->where('id_image', '=', $si->id_image)->delete_all();
            ORM::factory('suppliesimages')->where('id_supplies', '=', $_POST['id_supplies'])->delete_all();
            ORM::factory('supplies')->where('id_supplies', '=', $_POST['id_supplies'])->delete_all();
        }
    }

    public function action_check() {
        $view = new View('scripts/admin/supplies/check');
        $this->page_title = __("Supplies");
        die(print_r($_REQUEST));
        $hashes = ORM::factory('suppliessales')->order_by('date', 'desc')->find_all()->as_array();
        $users = array();
        if (count($hashes) > 0) {
            foreach ($hashes as $key => $hash) {
                $users[$key] = ORM::factory('userscustomers')->where('id_user', '=', $hash->id_user)->find()->as_array();
                #$objs = ORM::factory('suppliesuser')->select('supplies.price')
                #        ->join('supplies')
                #        ->on('supplies.id_supplies', '=', 'supplies_users.id_supplies')
                #        ->where('hash', '=', $hash->hash)->find_all()->as_array();
                $users[$key]['total_price'] = $hash->total;
                $users[$key]['hash'] = $hash->hash;
                $users[$key]['date'] = $hash->date;
                $users[$key]['payment_status'] = $hash->payment_status;
                $users[$key]['transaction_id'] = $hash->payment_id;
            }
        }
        //echo "<pre>";
        //die(print_r($users));
        $view->supplies = $users;
        $this->display($view);
    }

    public function action_deletegroup() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $ids = substr($_POST['hash'], 0, -1);
            $ids = explode(",", $ids);
            foreach ($ids as $key => $val) {
                $dt = ORM::factory('suppliesuser')->where('hash', '=', $val)->find_all();
                foreach ($dt as $dl) {
                    $dl->delete();
                }
            }
        }
        echo "ok";
    }

    public function action_details() {
        $hash = Request::instance()->param('id', '');
        if ('' == $hash) {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'testimonials', 'action' => 'check')));
        }
        $view = new View('scripts/admin/testimonials/details');
        $this->page_title = __("Testimonials Details");
        $testimonials_info = ORM::factory('testimonials')->where('id', '=', $hash)->find()->as_array();
        $view->testimonials_info = $testimonials_info;
        $this->display($view);
    }

    public function action_changetable() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $check_type = $_POST['check_type'];
            $ids = substr($_POST['sort'], 0, -1);
            $ids = explode(";", $ids);
            foreach ($ids as $key => $val) {
                $dt = ORM::factory('supplies')->where('id_supplies', '=', $val)->find();
                $dt->position = $key;
                $dt->save();
            }
        }
    }

    public function action_editbuttons() {
        $id = Request::instance()->param('id', '');
        if ("" == $id) {
            $id = "abrasives";
        }
        $view = new View('scripts/admin/supplies/editbuttons');
        $this->page_title = __("Edit Buttons");
        $view->id = $id;
        $view->buttons = ORM::factory('sbuttons')->where('type_column', '=', $id)->find_all()->as_array();
        $this->display($view);
    }

    public function action_addbutton() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            $supplies = ORM::factory('supplies')->where('type_column', '=', $_POST['type_column'])->find_all()->as_array();
            if ($_POST['id'] != 0) {
                $button = ORM::factory('sbuttons')->where('id_button', '=', $_POST['id'])->find()->as_array();
                $html = "Title: <input id='title_btn' type='text' name='title' value='" . $button['title'] . "' /> <a href='javascript:void(0);' onclick='del(" . $button['id_button'] . ");'>Delete</a>";
                $html .= "<input type='hidden' id='id_button' value='" . $button['id_button'] . "' />";
            } else {
                $html = "Title: <input id='title_btn' type='text' name='title' value='' />";
                $html .= "<input type='hidden' id='id_button' value='0' />";
            }

            if (!empty($supplies)) {
                $html .= "<br />&nbsp;<br />Select supplies:";
                $html .= "<div style='height: 200px; overflow: auto; margin-top: 15px; width: 450px; margin-bottom: 10px;'>";
                $html .= "<ul style='margin-top: 20px; margin-bottom: 20px; list-style-type: none;'>";
                foreach ($supplies as $supply) {
                    $html .= "<li>";
                    $html .= "<input class='supplies_btn' type='checkbox' name='supplies[" . $supply->id_supplies . "]' value='" . $supply->id_supplies . "' ";
                    $sb = ORM::factory('sb')->where('id_supplies', '=', $supply->id_supplies)->where('id_button', '=', $_POST['id'])->find()->as_array();
                    if (isset($sb['id_supplies'])) {
                        $html .= "checked='checked' ";
                    }
                    $html .= " />";
                    $html .= $supply->title;
                    $html .= "</li>";
                }
                $html .= "</ul>";
                $html .= "</div>";
            }
            $html .= "<div class='clear' style='margin-top: 10px;'></div>";
            $html .= "<input type='button' class='submit' value='SAVE' onclick='save();' />";
            echo $html;
        }
    }

    public function action_add() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            if ($_POST['id'] == 0) {
                $button = ORM::factory('sbuttons');
            } else {
                $button = ORM::factory('sbuttons')->where('id_button', '=', $_POST['id'])->find();
                ORM::factory('sb')->where('id_button', '=', $_POST['id'])->delete_all();
            }
            $button->title = $_POST['t'];
            $button->type_column = $_POST['type_column'];
            $button->save();

            $supplies = substr($_POST['s'], 0, -1);
            $supplies = explode("|", $supplies);
            if (!empty($supplies)) {
                foreach ($supplies as $supply) {
                    $s = ORM::factory('sb');
                    $s->id_supplies = $supply;
                    $s->id_button = $button->id_button;
                    $s->save();
                }
            }
            echo "1";
        } else {
            echo "0";
        }
    }

    public function action_del() {
        $this->auto_render = false;
        if (!empty($_POST)) {
            ORM::factory('sbuttons')->where('id_button', '=', $_POST['id'])->delete_all();
            $supplies = ORM::factory('sb')->where('id_button', '=', $_POST['id'])->delete_all();
            echo "1";
        }
    }

    public function action_delimg() {
        $this->auto_render = false;
        if (isset($_POST)) {
            $img = ORM::factory('images')->where('id_image', '=', $_POST['id_image'])->find();
            unlink(SYSPATH . $this->_upload_img_dir . $img->path);

            ORM::factory('suppliesimages')->where('id_image', '=', $_POST['id_image'])->delete_all();
            ORM::factory('images')->where('id_image', '=', $_POST['id_image'])->delete_all();
        }
    }

}

// 04517a10ee0937f0896c67689ccee608