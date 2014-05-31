<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Slider extends Controller_AdminBase {

    public $template = 'layouts/admin';
    private $_upload_img_dir = '../uploads/images/';
    private $_pages;
    private $_count_per_page = 80;

    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "slider";
        ViewHead::addScript('fancybox2/lib/jquery.mousewheel-3.0.6.pack.js');
        ViewHead::addScript('fancybox2/source/jquery.fancybox.js?v=2.0.6');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-media.js?v=1.0.0');
        ViewHead::addStyle('black-fancybox.css?v=1.0.2');
        ViewHead::addStyle('topmenu/style.css');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
        ViewHead::addScript('slider/index.js');
        $count_images = count(ORM::factory('images')->where('part', '=', 'slider')->find_all()->as_array());
        $this->_pages = ceil($count_images / $this->_count_per_page);
    }

    function cmp($a, $b) {
        $a1 = ORM::factory('postmeta')->getValue($a->id_image, 'sort', 'image');
        $b1 = ORM::factory('postmeta')->getValue($b->id_image, 'sort', 'image');

        if ($a1 == $b1) {
            return 0;
        }
        return ($a1 < $b1) ? -1 : 1;
    }

    public function action_index() {
        $view = new View('scripts/admin/pages/slider');
        $this->page_title = __("Слайдер на главной странице");

        $images = ORM::factory('images')->where('part', '=', 'work_samples')->limit($this->_count_per_page)->order_by('sort', 'asc')->offset(0)->find_all()->as_array();
        uasort($images,array($this, 'cmp'));
        foreach($images as $key=>$image) {
            $images[$key]->sort = ORM::factory('postmeta')->getValue($image->id_image, 'sort', 'image');
        }
        $view->images = $images;

        //$view->images =
        $view->pages = $this->_pages;
        $view->page = 1;

        // обработка сортировки весов
        if (isset($_POST['sort'])) {
            foreach ($_POST['sort'] as $key => $val) {
                $image = ORM::factory('images')->where('id_image', '=', $key)->find();
                $image->sort = trim(htmlspecialchars($val));
                $image->save();
            }
            ViewMessage::adminMessage('Videos has been successfully sorted', 'info', true);
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'slider')));
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

                        $file = SYSPATH .$this->_upload_img_dir.$file_name;
                        $path_info = pathinfo($this->_upload_img_dir.$file_name);
                        $ext = "." . $path_info['extension'];
                        $filename = str_replace($ext, '', $file_name);
                        $filename = str_replace('.', '', $filename);
                        $filename = FrontHelper::transliterate($filename);
                        $filename = str_replace(' ', '', $filename);                        
                       // $file = $uploaddir . $folder . '/' . $filename . $ext;
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
			  
			 imagejpeg($src, SYSPATH .$this->_upload_img_dir . $filename . '.jpg', 100);	
			 $res_image = Image::factory(SYSPATH .$this->_upload_img_dir . $filename . '.jpg', 'GD');
			  $width = 970;
			  $height = 400;
			  $width_image = $res_image->width;
			  $height_image = $res_image->height;
			  if (($width_image > $width) or ($height_image > $height)) {
				$res_image->resize($width, $height, Image::AUTO)->save(SYSPATH .$this->_upload_img_dir . $filename . '.jpg', 100);
			  }
                        $image = imagecreatefromjpeg(SYSPATH .$this->_upload_img_dir . $filename . '.jpg');                        
                     //   $width = imagesx($image);
                     //   $height = imagesy($image);
                     //   $mask = imagecreatetruecolor($width, $height);
                     //   $red = imagecolorallocate($image, 20, 246, 14);
                     //   $transparent = imagecolorallocate($mask, 20, 246, 14);
                     //   imagecolortransparent($mask, $transparent);

                      //  imagefilledellipse($mask, $width / 2, $height / 2, 100, 100, $transparent);


                      //  $mask = imagecreatefrompng('./images/mask.png');
                       // imageAlphaBlending($mask, true);
                        //imageSaveAlpha($mask, true);
                        // imagepng($mask, './uploads/12.png');

			 $uploaddir = './uploads/';
                      //  imagecopy($image, $mask, 0, 0, 0, 0, $width, $height);
                     //   imagepng($image, $uploaddir . '10.png');
                        //imagejpeg($image, $uploaddir . '10'.jpg', 100);
                      //  imagecolortransparent($image, $red);
                      //  imagefill($image, 0, 0, $red);
//                    header('Content-type: image/png');
                        $name = time();
                        imagepng($image, $uploaddir .'/images/'. $name .'.png');
                        $img = ORM::factory('images');
                        $img->path =  $name .'.png';
                        $img->part = "work_samples";
                        if ($img->save()) {
                            ViewMessage::adminMessage('Изображение успешно загружено!', 'info', true);
                            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'slider')));
                        }
                        die();
                    } else {
                        ViewMessage::adminMessage("Couldn't work Upload::save", 'error');
                    }
                } else {
                    ViewMessage::adminMessage("Image was uploaded with error", 'error');
                }
            } else {
                ViewMessage::adminMessage("Couldn't upload image. This file is not image", 'error');
            }
        }
        $view->all_pages = ORM::factory('pages')->order_by('title', 'asc')->find_all()->as_array();
        $view->products = ORM::factory('products')->order_by('title', 'asc')->find_all()->as_array();
        $this->display($view);
    }

    public function action_page() {
        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $view = new View('scripts/admin/pages/slider');
            $this->page_title = __("Services Work Samples");
            $offset = $this->_count_per_page * ($page - 1);
            $view->images = ORM::factory('images')->where('part', '=', 'work_samples')->limit($this->_count_per_page)->order_by('sort', 'asc')->offset($offset)->find_all()->as_array();
            $view->pages = $this->_pages;
            $view->page = $page;

            $this->display($view);
        } else {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'slider')));
        }
    }

    public function action_delete() {
        $this->auto_render = false;
        $id_image = Request::instance()->param('id', '');
        $this->delete_image($id_image);
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'slider')));
    }

    public function action_deleteall() {
        $this->auto_render = false;
        $ids = Request::instance()->param('id', '');
        if ('' != $ids) {
            $ids = substr($ids, 0, -1);

            $ids = explode('|', $ids);
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    $this->delete_image($id);
                }
            }
        }
        ViewMessage::adminMessage('Изображение успешно загружено', 'info', true);

        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'slider')));
    }

    private function delete_image($id_image) {
        if (is_numeric($id_image)) {
            $del_img = ORM::factory('images')->where('id_image', '=', $id_image)->find();
            @unlink(SYSPATH . $this->_upload_img_dir . $del_img->path);
            if (!$del_img->delete()) {
                ViewMessage::adminMessage('Изображение нельзя удалить!', 'error', true);
            }
        }
    }

    function action_savevalues() {
        $req = $_GET;
        $id = $req['id'];
        unset($req['id']);

        foreach ($req as $key => $value) {
            $postmeta = ORM::factory('postmeta');
            $postmeta->saveValue($id, $key, $value, 'image');
        }
        echo '1';
        exit();
    }

    public function action_saveparent() {
        $get = $_GET;
        $id = $_GET['id'];
        $productById = ORM::factory('products')->where('id_product', '=', $id)->find();
        $post_id = $_GET['id_image'];
        ORM::factory('postmeta')->saveValue($post_id, 'link', $productById->browser_name, 'image');
        echo $productById->title;
        exit();
    }

    function transliterate($string) {
        $roman = array("Sch", "sch", 'Yo', 'Zh', 'Kh', 'Ts', 'Ch', 'Sh', 'Yu', 'ya', 'yo', 'zh', 'kh', 'ts', 'ch', 'sh', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', '', 'Y', '', 'E', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', '', 'y', '', 'e');
        $cyrillic = array("Щ", "щ", 'Ё', 'Ж', 'Х', 'Ц', 'Ч', 'Ш', 'Ю', 'я', 'ё', 'ж', 'х', 'ц', 'ч', 'ш', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Ь', 'Ы', 'Ъ', 'Э', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'ь', 'ы', 'ъ', 'э');
        return str_replace($cyrillic, $roman, $string);
    }
    
    }