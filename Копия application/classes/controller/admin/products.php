<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Products extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 8;

    public function __construct($request) {
        parent::__construct($request);
        ViewHead::addScript('ckeditor/ckfinder/ckfinder.js');
        ViewHead::addStyle('admin/style-upload.css');
        ViewHead::addStyle('admin/jquery.fileupload-ui.css');
        $this->cname = "Услуги";
    }

    public function action_index() {
        $view = new View('scripts/admin/products/index');
        $sort = Request::instance()->param('sort', '');
        if (isset($_GET['order_by'])) {
            $order = $sort;
            $sort_by = $_GET['order_by'];
        } else {
            $order = '';
            $sort_by = '';
        }
        if (isset($_GET['code'])) {
            $model = ORM::factory('products')->where('title', 'like', '%' . $_GET['code'] . '%');
            if ($order != '') {
                $model->order_by($sort_by, $order);
            }
            $view->top_pages = $model->find_all()->as_array();
            $view->return = 'yes';
            $view->code = $_GET['code'];
        } else {
            $model = ORM::factory('products');
            if ($order != '') {
                $model->order_by($sort_by, $order);
            }
            $view->top_pages = $model->find_all()->as_array();
            $view->return = 'no';
        }
        $this->display($view);
    }

    public function action_edit() {
        $id = Request::instance()->param('id', '');
        if (!is_numeric($id) || $id == '') {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products')));
        }
        $view = new View('scripts/admin/products/edit');
        //читаем сообщение об успехе (может содержать ошибку)
        if (isset($_GET['success'])) {
            $view->success = $_GET['success'];
        }
        $content = ORM::factory('products')->where('id_product', '=', $id)->find();
        $content_data = $content->as_array();
        if (!$content_data['id_product']) {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products')));
        }
        $page_id = ORM::factory('products')->where('id_product', '=', $id)->find()->id_product;
        if ($_POST) {
            $url = $_POST['browser_name'];
            $find_url = ORM::factory('meta')->where('request', '=', $url)->find();
            $success = '';
            if (($find_url->request == $_POST['browser_name']) and ($id != $find_url->id_product)) {
                $_POST['browser_name'] = '';
                $success = 'found_url';
            }
            $meta = ORM::factory('meta')->where('id_product', '=', $page_id)->find();
            $meta->keywords = $_POST['keywords'];
            $meta->request = $_POST['browser_name'];
            $meta->description = $_POST['description'];
            $meta->save();
            $content->browser_name = $_POST['browser_name'];
            if (isset($_POST['published']))
                $published = 'on';
            else
                $published = 'off';
            $content->published = $published;
            $content->type = $_POST['type'];
            $content->content = $_POST['content'];
            $content->title = $_POST['title'];
            $content->updated_at = strtotime("now");
            ORM::factory('settings')->reindexData();
            if ($content->save()) {
                 $pi = ORM::factory('productsitems');
               if(isset($_POST['value-type'])) {
                 $pi->savePi($_POST['value-type'], $content->id_product);   
                }
                if ($success == 'found_url') {
                    Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products', 'action' => 'edit', 'id' => $content->id_product)) . '?success=' . $success);
                } else {
                    Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products', 'action' => 'edit', 'id' => $id)) . '?success=ok');
                }
            } else {
                ViewMessage::adminMessage('Error save', 'error');
            }
        }
        if (isset($_FILES['image_file'])) {

            $post = new Validate($_FILES);
            $post->rules('image_file', array(
                'Upload::valid' => array(),
                'Upload::type' => array('Upload::type' => array('jpg', 'png', 'gif', 'JPG', 'jpeg')),
                'Upload::size' => array('5M')
                    )
            );
            if ($post->check()) {

                if (isset($_FILES['image_file']['name']) && $_FILES['image_file']['error'] == 0) {
                    $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
                    if ('' == trim($ext)) {
                        $ext = 'jpg';
                    }
                    $file_name = md5(microtime()) . '.' . $ext;
                    if (Upload::save($_FILES['image_file'], $file_name, SYSPATH . $this->_upload_img_dir, 0777)) {
                        $img = ORM::factory('images');
                        $check = $img->where('part', '=', 'products')->where('id_page', '=', $id)->find()->as_array();
                        if (isset($check['id_image'])) {
                            $img = $img->where('id_page', '=', $id);
                            $img->path = $file_name;
                        } else {
                            $img->path = $file_name;
                            $img->id_page = $id;
                            $img->part = "products";
                        }
                        if ($img->save()) {
                            ViewMessage::adminMessage('Изображение успешно загружено!', 'info', true);
                            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products', 'action' => 'edit', 'id' => $content->id_product)));
                        }
                    } else {
                        ViewMessage::adminMessage("Произошла ошибка.", 'error');
                    }
                } else {
                    ViewMessage::adminMessage("Изображение было загружено с ошибкой.", 'error');
                }
            } else {
                ViewMessage::adminMessage("Нельзя загрузить изображение, так как оно таковым не является.", 'error');
            }
        }

        $meta = ORM::factory('meta')->where('id_product', '=', $page_id)->find();
        $view->keywords = $meta->keywords;
        $view->description = $meta->description;
        $view->id = $id;
        $view->types = ORM::factory('productsitems')->where('to','=',$page_id)->find_all()->as_array();
        $view->image = ORM::factory('images')->where('id_page', '=', $id)->where('part', '=', 'products')->find()->as_array();
        $view->browser_name = $content_data['browser_name'];
        $view->type = $content_data['type'];
        $view->published = $content_data['published'];
        $view->title = $content_data['title'];
        $view->text = $content_data['content'];
        $view->portfolio = ORM::factory('images')->where('part', '=', 'other')->where('id_page', '=', $id)->find_all()->as_array();
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
    }

    public function action_add() {
        $view = new View('scripts/admin/products/add');
        $this->page_title = __("Add New Page");
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
    }

    public function action_new() {
        $view = new View('scripts/admin/products/index');
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
            $content = ORM::factory('products');
            if (isset($_POST['published']))
                $published = 'on';
            else
                $published = 'off';
            $content->values($post);
            $content->created_at = strtotime("now");
            $id_prod = $content->save();
            $pi = ORM::factory('productsitems');
            if(isset($_POST['value-type'])) {
                  $pi->savePi($_POST['value-type'], $id_prod->id_product);            
            }
            $meta->id_product = $content->id_product;
            $meta->save();
            if (isset($_FILES['image_file'])) {

                $post = new Validate($_FILES);
                $post->rules('image_file', array(
                    'Upload::valid' => array(),
                    'Upload::type' => array('Upload::type' => array('jpg', 'png', 'gif', 'JPG', 'jpeg')),
                    'Upload::size' => array('5M')
                        )
                );
                if ($post->check()) {

                    if (isset($_FILES['image_file']['name']) && $_FILES['image_file']['error'] == 0) {
                        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
                        if ('' == trim($ext)) {
                            $ext = 'jpg';
                        }
                        $file_name = md5(microtime()) . '.' . $ext;
                        if (Upload::save($_FILES['image_file'], $file_name, SYSPATH . $this->_upload_img_dir, 0777)) {
                            $img = ORM::factory('images');

                            $img->path = $file_name;
                            $img->id_page = $meta->id_product;
                            $img->part = "products";

                            if ($img->save()) {
                                ViewMessage::adminMessage('Изображение успешно загружено!', 'info', true);
                                Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products', 'action' => 'edit', 'id' => $content->id_product)));
                            }
                        } else {
                            ViewMessage::adminMessage("Произошла ошибка.", 'error');
                        }
                    } else {
                        ViewMessage::adminMessage("Изображение было загружено с ошибкой.", 'error');
                    }
                } else {
                    ViewMessage::adminMessage("Нельзя загрузить изображение, так как оно таковым не является.", 'error');
                }
            }
            if ($success != '') {
                ORM::factory('settings')->reindexData();
                Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products', 'action' => 'edit', 'id' => $content->id_product)) . '?success=' . $success);
            }
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products')));
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

        ViewMessage::adminMessage('Выбранные страницы успешно удалены', 'info', true);

        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products', 'action' => 'index')));
    }

    private function delete_page($id_product) {
        if (is_numeric($id_product)) {
            $del_page = ORM::factory('products')->where('id_product', '=', $id_product)->find();
            $meta = ORM::factory('meta')->where('id_product', '=', $del_page->id_product)->find();
            $meta->delete();
            if (!$del_page->delete()) {
                $meta = ORM::factory('meta')->where('id_product', '=', $del_page->id_product)->find();
                $meta->delete();
                ORM::factory('settings')->reindexData();
                ViewMessage::adminMessage('Ошибка: Пользователь не был удален!', 'error', true);
            }
        }
    }

    public function action_changepublished() {
        $model = ORM::factory('products')->where('id_product', '=', $_GET['id'])->find();
        $model->published = $_GET['change'];
        $model->save();
        echo "ok";
        exit();
    }

    private function delete_image($id_image) {
        if (is_numeric($id_image)) {
            $del_img = ORM::factory('images')->where('id_image', '=', $id_image)->find();
            @unlink(SYSPATH . $this->_upload_img_dir . $del_img->path);
            if (!$del_img->delete()) {
                ViewMessage::adminMessage('Не получилось удалить изображение!', 'error', true);
            }
        }
    }

    public function action_delete() {
        $this->auto_render = false;

        $id_image = Request::instance()->param('id', '');
        $id = ORM::factory('images')->where('id_image', '=', $id_image)->find()->id_page;
        $this->delete_image($id_image);
        ORM::factory('settings')->reindexData();
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'products', 'action' => 'edit', 'id' => $id)));
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
//                    imagepng($src, $uploaddir . $filename . $time_add . '.png', 100);
//                    $image = imagecreatefromjpeg($uploaddir . $filename . $time_add . '.jpg');
//
//                    $width = imagesx($image);
//                    $height = imagesy($image);
//                    $mask = imagecreatetruecolor($width, $height);
//                    $red = imagecolorallocate($image, 0, 0, 0);
//                    $transparent = imagecolorallocate($mask, 255, 0, 0);
//                    imagecolortransparent($mask, $transparent);
//                    
//                    imagefilledellipse($mask, $width / 2, $height / 2, 100, 100, $transparent);
//                    
//                    
//                    $mask = imagecreatefrompng('./images/mask.png');
//                    imageAlphaBlending($mask, true);
//                    imageSaveAlpha($mask, true);
//                   // imagepng($mask, './uploads/12.png');
//                    
//                    
//                    imagecopy($image, $mask, 0, 0, 0, 0, $width, $height);
//                    imagepng($image, $uploaddir . '10.png');
//                    //imagejpeg($image, $uploaddir . '10'.jpg', 100);
//                    imagecolortransparent($image, $red);
//                    imagefill($image, 0, 0, $red);
////                    header('Content-type: image/png');
//                    imagepng($image, $uploaddir.'11.png');
//                    imagedestroy($image);
//                    imagedestroy($mask);
                    
                    
                    
                    $images = ORM::factory('images');
                    $images->path = '/uploads/' . $filename . $time_add . '.jpg';
                    $images->id_page = $id;
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

    function transliterate($string) {
        $roman = array("Sch", "sch", 'Yo', 'Zh', 'Kh', 'Ts', 'Ch', 'Sh', 'Yu', 'ya', 'yo', 'zh', 'kh', 'ts', 'ch', 'sh', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', '', 'Y', '', 'E', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', '', 'y', '', 'e');
        $cyrillic = array("Щ", "щ", 'Ё', 'Ж', 'Х', 'Ц', 'Ч', 'Ш', 'Ю', 'я', 'ё', 'ж', 'х', 'ц', 'ч', 'ш', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Ь', 'Ы', 'Ъ', 'Э', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'ь', 'ы', 'ъ', 'э');
        return str_replace($cyrillic, $roman, $string);
    }

    function imagetranstowhite($trans) {
        $w = imagesx($trans);
        $h = imagesy($trans);
        $white = imagecreatetruecolor($w, $h);
        $bg = imagecolorallocate($white, 255, 255, 255);
        imagefill($white, 0, 0, $bg);
        imagecopy($white, $trans, 0, 0, 0, 0, $w, $h);
        return $white;
    }

    function action_deleteimg() {
        $id = $_GET['id'];
        $image_find = ORM::factory('images')->where('id_image', '=', $id)->find();
        $path = '.' . $image_find->path;
        unlink($path);
        ORM::factory('images')->where('id_image', '=', $id)->delete_all();
        echo 'ok';
        exit();
    }

}