<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Pages extends Controller_AdminBase
{

    public $template = 'layouts/admin';

    public function __construct($request) {
        parent::__construct($request);
        $this->page_title = 'Страницы';
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        $this->cname = "pages";
    }

    public function action_index() {
        $view = new View('scripts/admin/pages/index');
        $sort = Request::instance()->param('sort', '');
        if (isset($_GET['order_by'])) {
            $order = $sort;
            $sort_by = $_GET['order_by'];
        } else {
            $order = '';
            $sort_by = '';
        }
        if (isset($_GET['code'])) {
            $model = ORM::factory('pages')->where('title', 'like', '%' . $_GET['code'] . '%')->where('is_bottom', '=', 0);
            if ($order != '') {
                $model->order_by($sort_by, $order);
            }
            $view->top_pages = $model->find_all()->as_array();
            $view->return = 'yes';
            $view->code = $_GET['code'];
        } else {
            $model = ORM::factory('pages')->where('is_bottom', '=', 0);
            if ($order != '') {
                $model->order_by($sort_by, $order);
            }
            $view->top_pages = $model->find_all()->as_array();
            $view->return = 'no';
        }
        $view->bottom_pages = ORM::factory('pages')->where('is_bottom', '=', 1)->find_all()->as_array();
        $this->display($view);
    }

    public function action_descrimage() {
        $id = $_GET['id'];
        $text = $_GET['text'];
        $image = ORM::factory('images')->where('id_image', '=', $id)->find();
        $image->descr = $text;
        $image->save();
        die('ok');


    }

    public function action_edit() {

        $id = Request::instance()->param('id', '');
        if (!is_numeric($id) || $id == '') {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages')));
        }
        $view = new View('scripts/admin/pages/edit');
        //читаем сообщение об успехе (может содержать ошибку)
        if (isset($_GET['success'])) {
            $view->success = $_GET['success'];
        }
        $content = ORM::factory('pages')->where('id_page', '=', $id)->find();
        $content_data = $content->as_array();
        if (!$content_data['id_page']) {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages')));
        }
        $page_id = ORM::factory('pages')->where('id_page', '=', $id)->find()->id_page;
        if ($_POST) {
            $url = $_POST['browser_name'];
            $find_url = ORM::factory('meta')->where('request', '=', $url)->find();
            $success = '';
            if (($find_url->request == $_POST['browser_name']) and ($id != $find_url->id_page)) {
                $_POST['browser_name'] = '';
                $success = 'found_url';
            }
            $meta = ORM::factory('meta')->where('id_page', '=', $page_id)->find();
            $meta->keywords = $_POST['keywords'];
            $meta->request = $_POST['browser_name'];
            $meta->description = $_POST['description'];
            $meta->save();
            $content->browser_name = $_POST['browser_name'];
            if (isset($_POST['published'])) {
                $published = 'on';
            } else {
                $published = 'off';
            }
            $content->published = $published;
            $content->value = $_POST['content'];
            $content->type = $_POST['type'];
            $content->title = $_POST['title'];
            $content->updated_at = strtotime("now");
            //reindex Data
            ORM::factory('settings')->reindexData();
            if ($content->save()) {
                if ($success == 'found_url') {
                    Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages', 'action' => 'edit', 'id' => $content->id_page)) . '?success=' . $success);
                } else {
                    Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages', 'action' => 'edit', 'id' => $id)) . '?success=ok');
                }
            } else {
                ViewMessage::adminMessage('Error save', 'error');
            }
        }

        $meta = ORM::factory('meta')->where('id_page', '=', $page_id)->find();
        $view->keywords = $meta->keywords;
        $view->description = $meta->description;
        $view->id = $id;
        $view->portfolio = ORM::factory('images')->where('id_page', '=', $id)->find_all()->as_array();
        $view->browser_name = $content_data['browser_name'];
        $view->published = $content_data['published'];
        $view->title = $content_data['title'];
        $view->text = $content_data['value'];
        $view->type = $content_data['type'];
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
    }

    public function action_add() {
        $view = new View('scripts/admin/pages/add');
        $this->page_title = __("Страницы");
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
    }

    public function action_new() {
        $view = new View('scripts/admin/pages/index');
        if ($_POST) {
            $success = '';
            $post = $_POST;
            //проверяем наличие url в базе            
            $url = $post['browser_name'];
            $find_url = ORM::factory('meta')->where('request', '=', $url)->find()->request;
            if ($find_url == $post['browser_name']) {
                //если нашли такой же url в базе
                $post['browser_name'] = '';
                $success = 'found_url';
            }
            $meta = ORM::factory('meta');
            $meta->request = $post['browser_name'];
            $meta->keywords = $post['keywords'];
            $meta->description = $post['description'];
            $content = ORM::factory('pages');
            if (isset($_POST['published'])) {
                $published = 'on';
            } else {
                $published = 'off';
            }
            $post['value'] = $post['content'];
            $content->values($post);
            $content->created_at = strtotime("now");
            $content->save();
            $meta->id_page = $content->id_page;
            $meta->save();
            ORM::factory('settings')->reindexData();
            if ($success != '') {
                Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages', 'action' => 'edit', 'id' => $content->id_page)) . '?success=' . $success);
            }
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages')));

        }
    }

    public function action_deletechecked() {
        $ids = Request::instance()->param('id', '');
        if ('' != $ids) {
            $ids = substr($ids, 0, -1);

            $ids = explode('~', $ids);
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    $this->delete_page($id);
                }
            }
        }
        ORM::factory('settings')->reindexData();
        ViewMessage::adminMessage('Выбранные страницы успешно удалены', 'info', true);

        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages', 'action' => 'index')));
    }

    private function delete_page($id_page) {
        if (is_numeric($id_page)) {
            $del_page = ORM::factory('pages')->where('id_page', '=', $id_page)->find();
            $meta = ORM::factory('meta')->where('id_page', '=', $del_page->id_page)->find();
            $meta->delete();
            ORM::factory('settings')->reindexData();
            if (!$del_page->delete()) {
                $meta = ORM::factory('meta')->where('id_page', '=', $del_page->id_page)->find();
                $meta->delete();
                ViewMessage::adminMessage('Ошибка: Пользователь не был удален!', 'error', true);
            }
        }
    }

    public function action_changepublished() {
        $model = ORM::factory('pages')->where('id_page', '=', $_GET['id'])->find();
        $model->published = $_GET['change'];
        $model->save();
        echo "ok";
        exit();
    }

    public function action_uploadimage() {
        try {
            $id = $_POST['id'];
            $uploaddir = './uploads/';
            $file = $uploaddir . basename($_FILES['uploadfile']['name']);
            $path_info = pathinfo($file);
            $ext = "." . $path_info['extension'];
            $filetypes = array('.jpg', '.gif', '.bmp', '.png', '.JPG', '.BMP', '.GIF', '.PNG', '.jpeg', '.JPEG');
            $filename = str_replace($ext, '', $_FILES['uploadfile']['name']);
            $filename = str_replace('.', '', $filename);
            $filename = $this->transliterate($filename);
            $filename = str_replace(' ', '', $filename);
            $file = $uploaddir . $filename . $ext;
            if (!in_array($ext, $filetypes)) {
                echo "<p>Тип расширения не подходит</p>";
            } else {
                if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
                    $src = '';
                    switch ($ext) {
                        case '.jpg':
                            $src = imagecreatefromjpeg($file);
                            break;
                        case '.jpeg':
                            $src = imagecreatefromjpeg($file);
                            break;
                        case '.gif':
                            $src = imagecreatefromgif($file);
                            break;
                        case '.png':
                            $src = imagecreatefrompng($file);
                            $src = $this->imagetranstowhite($src);
                            break;
                        default:
                            $src = imagecreatefromjpeg($file);
                            break;
                    }
                    $time_add = time();
                    imagejpeg($src, $uploaddir . $filename . $time_add . '.jpg', 100);
                    $images = ORM::factory('images');
                    $images->path = '/uploads/' . $filename . $time_add . '.jpg';
                    $images->id_page = $id;
                    $images->part = 'pages';
                    $images->save();
                    echo $images->id_image . '~/uploads/' . $filename . $time_add . '.jpg';
                    exit();
                } else {
                    echo 'error';
                }
            }
        } catch (Exception $e) {
            die($e);
        }
        die();
    }

    function action_deleteimg() {
        $id = $_GET['id'];
        $image_find = ORM::factory('images')->where('id_image', '=', $id)->where('part', '=', 'pages')->find();
        $path = '.' . $image_find->path;
        //unlink($path);
        ORM::factory('images')->where('id_image', '=', $id)->delete_all();
        echo 'ok';
        exit();
    }


}