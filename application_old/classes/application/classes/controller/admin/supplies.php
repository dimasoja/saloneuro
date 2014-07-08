<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Supplies extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "supplies";
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
    }

    public function action_index() {

        ViewHead::addScript('fancybox2/lib/jquery-1.7.2.min.js');
        ViewHead::addScript('fancybox2/lib/jquery.mousewheel-3.0.6.pack.js');
        ViewHead::addScript('fancybox2/source/jquery.fancybox.js?v=2.0.6');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-media.js?v=1.0.0');
        ViewHead::addStyle('fancybox2/source/jquery.fancybox.css?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
        
        $id = Request::instance()->param('id', '');
        if ($id == '') {
            $id = "abrasives";
        }
        $view = new View('scripts/admin/supplies/index');
        $this->page_title = __("Supplies");
        $view->supplies = ORM::factory('supplies')->getSupplies($id);
        $view->buttons = ORM::factory('sbuttons')->where('type_column', '=', $id)->find_all()->as_array();
        $view->manufacturers = ORM::factory('manufacturer')->where('type_column', '=', $id)->find_all()->as_array();
        $view->id = $id;

        if (!empty($_POST)) {
            $supply = ORM::factory('supplies');
            $supply->title = $_POST['title'];
            $supply->code = $_POST['code'];
            $supply->price = $_POST['price'];

            if (isset($_POST['type_of_star'])) {
                $supply->type_star = $_POST['type_of_star'];
            }

            if ($_POST['manufacturer'] == 0) {
                if (isset($_POST['manufacturer_new'])) {
                    $man = ORM::factory('manufacturer');
                    $man->type_column = $_POST['type_column'];
                    $man->title = $_POST['manufacturer_new'];
                    $man->save();
                    $supply->id_manufacturer = $man->id_manufacturer;
                }
            } else {
                $supply->id_manufacturer = $_POST['manufacturer'];
            }
            $supply->keywords = $_POST['keywords'];
            $supply->type_column = $_POST['type_column'];
            $supply->info = nl2br($_POST['info']);
            $supply->save();

            if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if ('' == trim($ext)) {
                    $ext = 'jpg';
                }
                $file_name = md5(microtime()) . '.' . $ext;
                if (Upload::save($_FILES['image'], $file_name, SYSPATH . $this->_upload_img_dir, 0777)) {
                    $img = ORM::factory('images');
                    $img->path = $file_name;
                    $img->part = "supplies";
                    $img->save();

                    $si = ORM::factory('suppliesimages');
                    $si->id_supplies = $supply->id_supplies;
                    $si->id_image = $img->id_image;
                    $si->save();
                }
            }

            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'supplies')));
        }

        ViewHead::addScript('ckeditor/ckeditor.js');
        ViewHead::addScript('tablednd.js');
        $this->display($view);
    }

    public function action_edit() {
        $id = Request::instance()->param('id', '');

        if (!is_numeric($id)) {
            Request::instance()->redirect(Route::get('admin')->uri());
        }

        $view = new View('scripts/admin/supplies/edit');
        $this->page_title = __("Supplies Edit");
        $view->supplies = ORM::factory('supplies')->where('id_supplies', '=', $id)->find();
        $view->buttons = ORM::factory('sbuttons')->where('type_column', '=', $view->supplies->type_column)->find_all()->as_array();
        $view->manufacturers = ORM::factory('manufacturer')->where('type_column', '=', $view->supplies->type_column)->find_all()->as_array();
        $view->image = ORM::factory('suppliesimages')
                ->select('images.path')
                ->join('images')
                ->on('images.id_image', '=', 'supplies_images.id_image')
                ->where('id_supplies', '=', $id)
                ->find()
                ->as_array();

        if (!empty($_POST)) {
            $supply = $view->supplies;
            $supply->title = $_POST['title'];
            $supply->code = $_POST['code'];
            $supply->price = $_POST['price'];
            $supply->keywords = $_POST['keywords'];
            if ($_POST['manufacturer'] == 0) {
                if (isset($_POST['manufacturer_new'])) {
                    $man = ORM::factory('manufacturer');
                    $man->type_column = $_POST['type_column'];
                    $man->title = $_POST['manufacturer_new'];
                    $man->save();
                    $supply->id_manufacturer = $man->id_manufacturer;
                }
            } else {
                $supply->id_manufacturer = $_POST['manufacturer'];
            }
            if (isset($_POST['type_of_star'])) {
                $supply->type_star = $_POST['type_of_star'];
            }
            $supply->type_column = $_POST['type_column'];
            $supply->info = $_POST['info'];

            $supply->save();

            if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
                if (isset($_POST['old_image'])) {
                    $img = ORM::factory('images')->where('id_image', '=', $_POST['old_image'])->find();
                    unlink(SYSPATH . $this->_upload_img_dir . $img->path);

                    ORM::factory('suppliesimages')->where('id_image', '=', $_POST['old_image'])->delete_all();
                    ORM::factory('images')->where('id_image', '=', $_POST['old_image'])->delete_all();
                }
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if ('' == trim($ext)) {
                    $ext = 'jpg';
                }
                $file_name = md5(microtime()) . '.' . $ext;
                if (Upload::save($_FILES['image'], $file_name, SYSPATH . $this->_upload_img_dir, 0777)) {
                    $img = ORM::factory('images');
                    $img->path = $file_name;
                    $img->part = "supplies";
                    $img->save();

                    $si = ORM::factory('suppliesimages');
                    $si->id_supplies = $supply->id_supplies;
                    $si->id_image = $img->id_image;
                    $si->save();
                }
            }

            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'supplies')));
        }
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
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
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'supplies', 'action' => 'check')));
        }

        $view = new View('scripts/admin/supplies/details');
        $this->page_title = __("Supplies Details");
        $view->settings = ORM::factory('settings')->getSettings('supplies');
        $info = array();

        #$user_info = ORM::factory('suppliesuser')->select('users.*', 'supplies_users.*')
        #        ->join('users')
        #        ->on('users.id_user', '=', 'supplies_users.id_user')
        #        ->where('supplies_users.hash', '=', $hash)
        #        ->find()->as_array();

        $ss_info = ORM::factory('suppliessales')->where('hash', '=', $hash)->where('id_user', '!=', '0')->find()->as_array();
        $user_info = ORM::factory('userscustomers')->where('id_user', '=', $ss_info['id_user'])->find()->as_array();
        $info['name'] = $user_info['name'];
        $info['surname'] = $user_info['surname'];
        $info['company'] = $user_info['company'];
        $info['special_notes'] = $user_info['special_notes'];
        $info['email'] = $user_info['email'];
        $info['address'] = $user_info['address'];
        $info['town'] = $user_info['town'];
        $info['postcode'] = $user_info['postcode'];
        $info['phone'] = $user_info['phone'];
        $info['mphone'] = $user_info['mphone'];
        $info['payment_status'] = $ss_info['payment_status'];
        $info['delivery_options'] = $ss_info['delivery_options'];
        $info['auto_send'] = $ss_info['auto_send'];

        #$supplies = ORM::factory('suppliesuser')->select('supplies.*')
        #        ->join('supplies')
        #        ->on('supplies.id_supplies', '=', 'supplies_users.id_supplies')
        #        ->where('supplies_users.hash', '=', $hash)->find_all()->as_array();

        $info['supplies'] = $ss_info['supplies'];
        $view->info = $info;
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