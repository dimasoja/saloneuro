<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_ServicesWorkSamples extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    private $_upload_img_dir = '../uploads/images/';
    
    private $_pages;
    private $_count_per_page = 8;
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "pages";
        
        $count_images = count(ORM::factory('images')->where('part', '=', 'work_samples')->find_all()->as_array());
        $this->_pages = ceil($count_images / $this->_count_per_page);
    }

    public function action_index()
    {
        $view = new View('scripts/admin/pages/servicesworksamples');
        $this->page_title = __("Services Work Samples");
        
        $view->images = ORM::factory('images')->where('part', '=', 'work_samples')->limit($this->_count_per_page)->order_by('sort', 'asc')->offset(0)->find_all()->as_array();
        $view->pages =  $this->_pages;
        $view->page = 1;
        
        // обработка сортировки весов
        if(isset($_POST['sort'])) {
            foreach ($_POST['sort'] as $key => $val) {
                $image = ORM::factory('images')->where('id_image', '=', $key)->find();
                $image->sort = trim(htmlspecialchars($val));
                $image->save();
            }
            ViewMessage::adminMessage('Videos has been successfully sorted', 'info', true);
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'servicesworksamples')) );
        }
        
        if (isset($_FILES['image_file'])) {
            
            $post = new Validate($_FILES);
            $post->rules('image_file', array(
                                            'Upload::valid' => array(),
                                            'Upload::type' =>array('Upload::type' => array('jpg','png','gif','JPG','jpeg')),
                                            'Upload::size' => array('5M')
                                            )
            );
            if ($post->check()) {
                
                if (isset($_FILES['image_file']['name']) && $_FILES['image_file']['error'] == 0) {
                    $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
                    if ('' == trim($ext))
                    {
                        $ext = 'jpg';
                    }
                    $file_name = md5(microtime()) . '.' . $ext;
                    if (Upload::save($_FILES['image_file'], $file_name, SYSPATH . $this->_upload_img_dir, 0777)) {
                        $img = ORM::factory('images');
                        $img->path = $file_name;
                        $img->part = "work_samples";
                        if ($img->save()) {
                            ViewMessage::adminMessage('Image was successfully uploaded!', 'info', true);
                            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'servicesworksamples')) );
                        }
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
        
        $this->display($view);
    }
    
    public function action_page() {
        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $view = new View('scripts/admin/pages/servicesworksamples');
            $this->page_title = __("Services Work Samples");
            $offset = $this->_count_per_page * ($page - 1);
            $view->images = ORM::factory('images')->where('part', '=', 'work_samples')->limit($this->_count_per_page)->order_by('sort', 'asc')->offset($offset)->find_all()->as_array();
            $view->pages =  $this->_pages;
            $view->page = $page;
            
            $this->display($view);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'servicesworksamples')) );
        }
    }
    
    public function action_delete() {
        $this->auto_render = false;
        $id_image = Request::instance()->param('id', '');
        $this->delete_image($id_image);
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'servicesworksamples')) );
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
        ViewMessage::adminMessage('Image was successfully deleted!', 'info', true);
        
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'servicesworksamples')) );
    }
    
    private function delete_image($id_image) {
        if (is_numeric($id_image)) {
            $del_img = ORM::factory('images')->where('id_image', '=', $id_image)->find();
            @unlink(SYSPATH . $this->_upload_img_dir . $del_img->path);
            if (!$del_img->delete()) {
                ViewMessage::adminMessage('Image was not deleted!', 'error', true);
            }
        }
    }

}