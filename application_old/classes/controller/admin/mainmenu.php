<?php
defined('SYSPATH') or die('No direct script access.');
class Controller_Admin_Mainmenu extends Controller_AdminBase {

    public $template = 'layouts/admin';

    public function __construct($request) {
        $this->cname = "menu";
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
        $view = new View('scripts/admin/mainmenu/index');        
        $view->menus = ORM::factory('menu')->getMainMenuForIndex();           
        $this->display($view);
    }

    public function action_edit() {
        $id = Request::instance()->param('id', '');        
        if (!is_numeric($id) || $id == '') {
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'mainmenu')));
        }
        $view = new View('scripts/admin/mainmenu/edit');
        //читаем сообщение об успехе (может содержать ошибку)
        if (isset($_GET['success'])) {
            $view->success = $_GET['success'];
        }        
        if ($_POST) {  
            $position = $_POST['position'];
            $menu_position = ORM::factory('menu')->where('type','=','mainmenu')->where('for','=',$_POST['for'])->where('id','<>', $id)->where('position','=',$position)->where('published','=','on')->find();            
            if(isset($menu_position->id)) {         
                $menus = ORM::factory('menu')->where('type','=','mainmenu')->where('position','>=',$position)->where('published','=','on')->find_all()->as_array();
                foreach($menus as $menu) {
                    $mn = ORM::factory('menu')->where('id','=', $menu->id)->find();
                    $mn->position = $mn->position+1;
                    $mn->save();
                }
            }
            $success = '';
            $post = $_POST;
            if (!isset($_POST['published'])) $post['published'] = 'off';        
            $menu = ORM::factory('menu')->where('id','=',$id)->where('type','=','mainmenu')->find();
            if(isset($menu->values($post)->save()->id)) {
                $menu = ORM::factory('menu')->where('type','=','mainmenu')->where('published','=','on')->where('for','=',$_POST['for'])->order_by('position', 'ASC')->find_all()->as_array();                                
                $count=1;
                foreach($menu as $mn) {
                     $menu= ORM::factory('menu')->where('id','=',$mn->id)->find();
                     $menu->position = $count; 
                     $menu->save();
                     $count++;
                }
                ViewMessage::adminMessage('Пункт меню <b>"'.$post['title'].'"</b> изменен', 'info', true);                
            } else {                            
                ViewMessage::adminMessage('Произошла ошибка', 'info', true);                
            }
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'mainmenu')));
        }
        $menu = ORM::factory('menu')->where('id', '=', $id)->where('type','=','mainmenu')->find();
        $view->id = $id;
        $view->title = $menu->title;        
        $view->position = $menu->position;
        $view->parent = $menu->parent;
        $view->type = $menu->for;
        $view->parent_title = ORM::factory('menu')->where('id','=', $menu->parent)->where('type','=','mainmenu')->find()->title;
        $view->uri = $menu->uri;
        $view->published = $menu->published;
        $view->classes = $menu->classes;                                
        $view->pages = ORM::factory('pages')->where('published','=','on')->order_by('title', 'asc')->find_all()->as_array();  
        $view->products = ORM::factory('products')->order_by('title', 'asc')->find_all()->as_array();  
        $view->menu = ORM::factory('menu')->getMainMenuForEdit($id);
        ViewHead::addScript('ckeditor/ckeditor.js');
        $this->display($view);
    }

    public function action_add() {
        $view = new View('scripts/admin/mainmenu/add');
        $this->page_title = __("Add New Page");
        $view->menu = ORM::factory('menu')->getMainMenuForEdit('');    
        $view->pages = ORM::factory('pages')->where('published','=','on')->order_by('title', 'asc')->find_all()->as_array();  
        $view->products = ORM::factory('products')->order_by('title', 'asc')->find_all()->as_array();  
        $this->display($view);
    }

    public function action_new() {
        $view = new View('scripts/admin/mainmenu/index');
        if ($_POST) {
            $position = $_POST['position'];
            $menu_position = ORM::factory('menu')->where('type','=','mainmenu')->where('id','<>', $id)->where('for','=',$_POST['for'])->where('position','=',$position)->where('published','=','on')->find();            
            if(isset($menu_position->id)) {         
                $menus = ORM::factory('menu')->where('type','=','mainmenu')->where('position','>=',$position)->where('published','=','on')->find_all()->as_array();
                foreach($menus as $menu) {
                    $mn = ORM::factory('menu')->where('id','=', $menu->id)->find();
                    $mn->position = $mn->position+1;
                    $mn->save();
                }
            }
            $success = '';
            $post = $_POST;
            if (!isset($_POST['published'])) $post['published'] = 'off';        
            $menu = ORM::factory('menu');
            $post['type'] = 'mainmenu';
            if(isset($menu->values($post)->save()->id)) { 
                $menu = ORM::factory('menu')->where('type','=','mainmenu')->where('published','=','on')->where('for','=',$_POST['for'])->order_by('position', 'ASC')->find_all()->as_array();
                $count=1;
                foreach($menu as $mn) {
                     $menu= ORM::factory('menu')->where('id','=',$mn->id)->find();
                     $menu->position = $count; 
                     $menu->save();
                     $count++;
                }
                ViewMessage::adminMessage('Пункт меню добавлен', 'info', true);                
            } else {                            
                ViewMessage::adminMessage('Произошла ошибка', 'info', true);                
            }
            Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'mainmenu')));
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
        Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'mainmenu')));
    }

}