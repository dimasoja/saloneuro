<?php
defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Topmenu extends Controller_AdminBase {

    public $template = 'layouts/admin';

    public function __construct($request) {
        $this->cname = "menu";
        $this->page_title = 'Меню';
        parent::__construct($request);        
        ViewHead::addScript('fancybox2/lib/jquery.mousewheel-3.0.6.pack.js');
        ViewHead::addScript('fancybox2/source/jquery.fancybox.js?v=2.0.6');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
        ViewHead::addScript('fancybox2/source/helpers/jquery.fancybox-media.js?v=1.0.0');
        ViewHead::addStyle('black-fancybox.css?v=1.0.2');
        ViewHead::addStyle('topmenu/style.css');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
        ViewHead::addStyle('fancybox2/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
        ViewHead::addScript('topmenu/index.js');
    }

    public function action_index() {
        $view = new View('scripts/admin/topmenu/index');        
        $view->menus = ORM::factory('menu')->getMenuForIndex();
        $this->display($view);
    }

    public function action_edit() {

        $id = Request::instance()->param('id', '');        
        if (!is_numeric($id) || $id == '') {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages')));
        }
        $view = new View('scripts/admin/topmenu/edit');
        //читаем сообщение об успехе (может содержать ошибку)
        if (isset($_GET['success'])) {
            $view->success = $_GET['success'];
        }        
        if ($_POST) {     
            $success = '';
            $post = $_POST;
            if (!isset($_POST['published'])) $post['published'] = 'off';        
            $menu = ORM::factory('menu')->where('id','=',$id)->find();
            if(isset($menu->values($post)->save()->id)) {                   
                ViewMessage::adminMessage('Пункт меню <b>"'.$post['title'].'"</b> изменен', 'info', true);                
            } else {                            
                ViewMessage::adminMessage('Произошла ошибка', 'info', true);                
            }
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'topmenu')));
        }
        $menu = ORM::factory('menu')->where('id', '=', $id)->find();
        $view->id = $id;
        $view->title = $menu->title;        
        $view->position = $menu->position;
        $view->parent = $menu->parent;
        $view->parent_title = ORM::factory('menu')->where('id','=', $menu->parent)->find()->title;
        $view->uri = $menu->uri;
        $view->published = $menu->published;
        $view->classes = $menu->classes;                                
        $view->pages = ORM::factory('pages')->where('published','=','on')->order_by('title', 'asc')->find_all()->as_array();
        $view->products = ORM::factory('products')->order_by('title', 'asc')->find_all()->as_array();  
        $view->menu = ORM::factory('menu')->getMenuForEdit($id);
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
    }

    public function action_add() {
        $view = new View('scripts/admin/topmenu/add');
        $this->page_title = __("Add New Page");
        $view->menu = ORM::factory('menu')->getMenuForEdit('');

        $view->pages = ORM::factory('pages')->where('published','=','on')->order_by('title', 'asc')->find_all()->as_array();
        $view->products = ORM::factory('products')->order_by('title', 'asc')->find_all()->as_array();  
        $this->display($view);
    }

    public function action_new() {
        $view = new View('scripts/admin/topmenu/index');
        if ($_POST) {
            $success = '';
            $post = $_POST;
            if (!isset($_POST['published'])) $post['published'] = 'off';        
            $menu = ORM::factory('menu');
            if(isset($menu->values($post)->save()->id)) {                   
                ViewMessage::adminMessage('Пункт меню добавлен', 'info', true);                
            } else {                            
                ViewMessage::adminMessage('Произошла ошибка', 'info', true);                
            }
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'topmenu')));
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
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'pages', 'action' => 'index')));
    }

    private function delete_page($id_page) {
        if (is_numeric($id_page)) {
            $del_page = ORM::factory('pages')->where('id_page', '=', $id_page)->find();
            $meta = ORM::factory('meta')->where('id_page', '=', $del_page->id_page)->find();
            $meta->delete();
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
    
    public function action_delete() {
        $id = Request::instance()->param('id', '');
        ORM::factory('menu')->where('id','=', $id)->delete_all();
        ORM::factory('menu')->where('parent','=', $id)->delete_all();
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'topmenu')));
    }

}