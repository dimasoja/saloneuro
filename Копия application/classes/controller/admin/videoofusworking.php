<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_VideoOfUsWorking extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    private $_count_per_page = 8;
    private $_pages;
    
    private $_upload_img_dir = '../uploads/images/';
    private $_upload_video_dir = '../uploads/videos/';
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "pages";
        
        $count_videos = count(ORM::factory('videos')->find_all()->as_array());
        $this->_pages = ceil($count_videos / $this->_count_per_page);
    }

    public function action_index()
    {
        $view = new View('scripts/admin/pages/videoofusworking');
        $this->page_title = __("Videos of Us Working");
        
        $view->videos = ORM::factory('videos')->limit($this->_count_per_page)->order_by('sort', 'asc')->offset(0)->find_all()->as_array();
        $view->page = 1;
        $view->pages = $this->_pages;
        
        // обработка сортировки весов
        if(isset($_POST['sort'])) {
            foreach ($_POST['sort'] as $key => $val) {
                $vid = ORM::factory('videos')->where('id_video', '=', $key)->find();
                $vid->sort = trim(htmlspecialchars($val));
                $vid->save();
            }
            ViewMessage::adminMessage('Videos has been successfully sorted', 'info', true);
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'videoofusworking')) );
        }
        
        if (isset($_FILES['thumbnail'])) {
            
            $post = new Validate($_FILES);
            $post->rules('thumbnail', array(
                                            'Upload::valid' => array(),
                                            'Upload::type' => array('Upload::type' => array('jpg','png','gif','JPG','jpeg')),
                                            'Upload::size' => array('5M')
                                            ))
                 ->rules('videofile', array(
                                            'Upload::valid' => array(),
                                            'Upload::type' => array('Upload::type' => array('mp4', 'flv', 'f4v', 'mov', '3gp', '3g2' ,'FLV', 'F4V', 'MOV', '3GP', '3G2')),
                                            'Upload::size' => array('100M')
                                            )
                 );
            if ($post->check()) {
                if (isset($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['error'] == 0 && isset($_FILES['videofile']['name']) && $_FILES['videofile']['error'] == 0) {
                    $ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                    if ('' == trim($ext))
                    {
                        $ext = 'jpg';
                    }
                    
                    $ext2 = pathinfo($_FILES['videofile']['name'], PATHINFO_EXTENSION);
                    if ('' == trim($ext2)) {
                        $ext2 = 'flv';
                    }
                    $thumbnail_name = md5(microtime());
                    $videofile_name = $thumbnail_name . '.' . $ext2;
                    $thumbnail_name .= '.' . $ext;
                    if (Upload::save($_FILES['thumbnail'], $thumbnail_name, SYSPATH . $this->_upload_img_dir, 0777) &&
                        Upload::save($_FILES['videofile'], $videofile_name, SYSPATH . $this->_upload_video_dir, 0777)) {
                        $video = ORM::factory('videos');
                        $video->filename = $videofile_name;
                        $video->thumbnail = $thumbnail_name;
                        if ($video->save()) {
                            ViewMessage::adminMessage('Video was successfully uploaded!', 'info', true);
                            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'videoofusworking')) );
                        }
                    } else {
                        ViewMessage::adminMessage("Upload error", 'error');
                    }
                } else {
                    ViewMessage::adminMessage("Video was uploaded with error", 'error');
                }
            } else {
                ViewMessage::adminMessage('Upload error', 'error', true);
            }
        }
        
        $this->display($view);
    }
    
    public function action_page() {
        $page = Request::instance()->param('id', '');
        if (is_numeric($page)) {
            $view = new View('scripts/admin/pages/videoofusworking');
            $this->page_title = __("Video of Us Working");
            $offset = $this->_count_per_page * ($page - 1);
            $view->videos = ORM::factory('videos')->limit($this->_count_per_page)->order_by('sort', 'asc')->offset($offset)->find_all()->as_array();
            $view->pages =  $this->_pages;
            $view->page = $page;
            
            $this->display($view);
        } else {
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'videoofusworking')) );
        }
    }
    
    public function action_delete() {
        $this->auto_render = false;
        $id_video = Request::instance()->param('id', '');
        $this->delete_video($id_video);
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'videoofusworking')) );
    }
    
    public function action_deleteall() {
        $this->auto_render = false;
        $ids = Request::instance()->param('id', '');
        if ('' != $ids) {
            $ids = substr($ids, 0, -1);
            
            $ids = explode('|', $ids);
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    $this->delete_video($id);
                }
            }
        }
        ViewMessage::adminMessage('Videos was successfully deleted!', 'info', true);
        
        Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'videoofusworking')) );
    }
    
    private function delete_video($id_video) {
        if (is_numeric($id_video)) {
            $del_video = ORM::factory('videos')->where('id_video', '=', $id_video)->find();
            @unlink(SYSPATH . $this->_upload_img_dir . $del_video->thumbnail);
            @unlink(SYSPATH . $this->_upload_video_dir . $del_video->filename);
            if (!$del_video->delete()) {
                ViewMessage::adminMessage('Video was not deleted!', 'error', true);
            }
        }
    }

}