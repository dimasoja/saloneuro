<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Updateindex extends Controller_AdminBase
{

    public $template = 'layouts/admin';
    
    public function __construct($request) {
        parent::__construct($request);
        $this->cname = "services";
    }

    public function action_index()
    {
        $offset = $this->request->param('offset');
        // при переиндексации очищаем старую базу индексов
        if ($offset == 1) 
        {
            $index = DB::query(Database::DELETE, 'DELETE FROM `searchindex`');
            $index->execute();
        }
        $data = array();
        // Тут получаем список постов
        $posts = ORM::factory('pages')->where('delete', '=', 0)->offset(100*$offset)->limit(100)->find_all(); 
        foreach ($posts as $post)
        {
            $words = array();
            // Очищаем от html, заменяем Ё на Е и приводим к верхнему регистру
            $title = mb_strtoupper(str_ireplace("ё", "е", strip_tags($post->title)), "UTF-8"); 
            $comments = ORM::factory('comment')->where('post_id', '=', $post->id)->order_by('id', 'ASC')->find_all(); // Получаем комментарии, относящиеся к посту
            $text = $post->text;
            if ($post->type == 1)
            {
                // Тут проводим тоже самое, но с ингредиентами и шагами приготовления. Думаю, хабрасообществу это не так интересно...
            }
            foreach ($comments as $comment)
            {
                // Для сокращения объема примем, что текст поста и комментариев имеет одинаковый вес
                $text = $text.' '.$comment->text; 
            }

            $text = mb_strtoupper (str_ireplace("ё", "е", strip_tags($text)), "UTF-8");
            preg_match_all ('/([a-zа-яё]+)/ui', $title, $word_title); // Разбиваем текст на слова
            preg_match_all ('/([a-zа-яё]+)/ui', $text, $word_text);
            // Получаем нормальную форму слова, например помидоров => помидор
            $start_form_title = $morphy->lemmatize($word_title[1]); 
            $start_form_text = $morphy->lemmatize($word_text[1]);

            foreach ($start_form_title as $k=>$w)
            {
                if (!$w)
                {
                    // Если не получилось определить начальную форму слова, используем исходное слово
                    $w[0] = $k; 
                }
                if (mb_strlen($w[0], "UTF-8") > 2) // Проверяем длину слова, не индексируем короткие слова
                {
                    if (! isset ( $words[$w[0]]))$words[$w[0]] = 0;
                    $words[$w[0]]+= 3; // Устанавливаем вес для слова
                }
            }
            foreach ($start_form_text as $k=>$w)
            {
                // Аналогично для основного текста
            }
            // Тут перебираем массив значений и заносим их в базу
            foreach ($words as $word=>$weight) 
            {
                $data['post_id'] = $post->id;
                $data['word'] = $word;
                $data['weight'] = $weight;
                $addindex = ORM::factory('searchindex');
                $addindex->values($data);
                try
                {
                    $addindex->save();
                }
                catch (ORM_Validation_Exception $e)
                {
                    $errors = $e->errors('validation');
                }
            }
        }
        /* Тут формируем ответ в виде json, чтобы в панели управления вывести динамический блок, и показывать прогрессбар выполнения операции */
        $pcount = ORM::factory('post')->where('delete', '=', 0)->count_all(); 
        if (($pcount - (100*$offset)) > 0)
        {
            $complateu = ($offset) * 100;
            $percent = ($complateu / $pcount) * 100;
            $percent = round($percent, 0);
            $json = array('status'=>'next', 'nextid'=>1+$offset, 'percent'=>$percent);
            $this->response->body(json_encode($json));
        }
        else
        {
            $json = array('status'=>'finish', 'percent'=>100);
            $this->response->body(json_encode($json));
        }
    }
    
    public function action_add() {
        $view = new View('scripts/admin/postcodes/add');
        $this->page_title = __("Add new office");
        
        $view->postcodes = ORM::factory('postcodes')->find_all()->as_array();
        
        if (isset($_POST['name'])) {
            $office = ORM::factory('offices');
            $office->name = $_POST['name'];
            $office->address = $_POST['address'];
            $office->phone = $_POST['phone'];
            $office->mphone = $_POST['mphone'];
            $office->town = $_POST['town'];
            $office->postcode = $_POST['postcode'];
            $office->email = $_POST['email'];
            $office->save();
            if (isset($_POST['postcodes']) && count($_POST['postcodes']) > 0) {
                foreach ($_POST['postcodes'] as $pcode) {
                    $po = ORM::factory('postcodesoffices');
                    $po->id_postcode = $pcode;
                    $po->id_office = $office->id_office;
                    $po->postsubcodes = $_POST['postsubcode_' . $pcode];
                    $po->save();
                }
            }
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'postcodes')) );
        }
        
        $this->display($view);
    }
    
    public function action_edit() {
        $id_office = Request::instance()->param('id', '');
        if (!is_numeric($id_office)) {
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'postcodes')) );
        }
        
        $view = new View('scripts/admin/postcodes/edit');
        $this->page_title = __("Edit office");
        $office = ORM::factory('offices')->where('id_office', '=', $id_office)->find();
        $view->office = $office->as_array();

        $used_postcodes = ORM::factory('postcodesoffices')->where('id_office', '=', $id_office)->find_all()->as_array();
         
        if (count($used_postcodes) > 0) {
            $used_p = array();
            foreach ($used_postcodes as $postcode) {
                $used_p[$postcode->id_postcode] = $postcode->postsubcodes;
            }
            $view->used_postcodes = $used_p;
        }
        
        $view->postcodes = ORM::factory('postcodes')->find_all()->as_array();
        
        if (isset($_POST['name'])) {
            $office->name = $_POST['name'];
            $office->address = $_POST['address'];
            $office->phone = $_POST['phone'];
            $office->mphone = $_POST['mphone'];
            $office->town = $_POST['town'];
            $office->postcode = $_POST['postcode'];
            $office->email = $_POST['email'];
            $office->save();
            
            ORM::factory('postcodesoffices')->where('id_office', '=', $id_office)->delete_all();
            
            if (isset($_POST['postcodes']) && count($_POST['postcodes']) > 0) {
                foreach ($_POST['postcodes'] as $pcode) {
                    $po = ORM::factory('postcodesoffices');
                    $po->id_postcode = $pcode;
                    $po->id_office = $office->id_office;
                    $po->postsubcodes = $_POST['postsubcode_' . $pcode];
                    $po->save();
                }
            }
            Request::instance()->redirect( Route::get('admin')->uri(array('controller' => 'postcodes')) );
        }
        
        $this->display($view);
    }

}