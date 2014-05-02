<?php defined('SYSPATH') or die('No direct script access.');

class Model_Settings extends ORM {

    protected $_table_name  = 'settings';
    protected $_primary_key = 'id_setting';
    private $_upload_img_dir = '../uploads/images/';
    protected $_types = array('for_business'=>'Для бизнеса', 'for_home'=>'Для дома');
    protected $_links = array('for_business'=>'/forbusiness', 'for_home'=>'/forhome');
    
    public function getSettings($type = "", $return = "array") {
        if ($type != "") {
            $this->where('type', '=', $type);
        }
        $settings = $this->find_all()->as_array();
		$settings_main = array();
        foreach ($settings as $setting) {
			$settings_main[$setting->short_name] = $setting->value;
        }
        return $settings_main;
    }
    
    public function generateBreadcrumbProducts($id_product) {    
        $html = '';        
        $html .= '<a href="/">Главная</a> > ';
        $product = ORM::factory('products')->where('id_product','=',$id_product)->find();
        $html .= '<a href="'.$this->_links[$product->type].'">'.$this->_types[$product->type].'</a> / ';
        $html .= '<a href="/'.$product->browser_name.'">'.$product->title.'</a>';
        return $html;
    }
    
    public function generateBreadcrumbPage($title, $link) {
        $html = '';
        $html .= '<a href="/">Главная</a> > ';
        $html .= '<a href="/'.$link.'">'.$title.'</a>';
        return $html;
    }

    public function generateBreadcrumbInformation($type, $title1='', $link1='', $title2='', $link2='') {
        $html = '';
        if($type=='index') {
            $html .= '<a href="/">Главная</a> > ';
            $html .= '<a href="/information">Информация</a> ';
        }
        if($type=='category') {
            $html .= '<a href="/">Главная</a> > ';
            $html .= '<a href="/information">Информация</a> > ';
            $html .= '<a href="/'.$link1.'">'.$title1.'</a>';
        }
        if($type=='inner') {
            $html .= '<a href="/">Главная</a> > ';
            $html .= '<a href="/information">Информация</a> > ';
            $html .= '<a href="/'.$link1.'">'.$title1.'</a> > ';
            $html .= '<a href="/'.$link2.'">'.$title2.'</a>';
        }
        return $html;
    }

    public function generateBreadcrumbCatalog($type, $title1='', $link1='', $title2='', $link2='') {
        $html = '';
        if($type=='index') {
            $html .= '<a href="/">Главная</a> > ';
            $html .= '<a href="/catalog">Продукция</a> ';
        }
        if($type=='category') {
            $html .= '<a href="/">Главная</a> > ';
            $html .= '<a href="/catalog">Продукция</a> > ';
            $html .= '<a href="/'.$link1.'">'.$title1.'</a>';
        }
        if($type=='inner') {
            $html .= '<a href="/">Главная</a> > ';
            $html .= '<a href="/catalog">Продукция</a> > ';
            $html .= '<a href="/'.$link1.'">'.$title1.'</a> > ';
            $html .= '<a href="/'.$link2.'">'.$title2.'</a>';
        }
        return $html;
    }
    public function getSetting($setting) {
        $setting = $this->where('short_name','=',$setting)->find();
        return $setting->value;
    }
    
    public function saveSetting($setting, $value) {
	$setting_data = $this->where('short_name','=',$setting)->find();
	$setting_data->value = $value;
	    return $setting_data->save();
    }
    
    public function sendLetter($to, $subject, $body) {
        $mail = new PHPMailer();
        //$mail->From = "admin@notification.com";
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;      
        $mail->isHTML();        
        if ($mail->Send()) {
            return 'send:ok';        
        }
    }
    
    public function paramsToHtml($params) {
        $html = '';
        foreach($params as $key=>$value) {
            $html .= '<h2>'.$key.'</h2>'.$value.'</br>';
        }
        return $html;
    }
    
    public function reindexData($type='') {
        $searchind = ORM::factory('searchindex');
        $searchind->delete_all();
        $posts = ORM::factory('pages')->where('published','=','on')->find_all()->as_array();
        foreach ($posts as $post) {
            $words = array();
            $title = mb_strtoupper(str_ireplace("ё", "е", strip_tags($post->title)), "UTF-8");
            $text = mb_strtoupper(str_ireplace("ё", "е", strip_tags($post->value)), "UTF-8");
            preg_match_all('/([a-zа-яё]+)/ui', $title, $word_title); // Разбиваем текст на слова
            preg_match_all('/([a-zа-яё]+)/ui', $text, $word_text);
            $dir = $_SERVER['DOCUMENT_ROOT'] . 'application/classes/helpers/Morphy/dicts/';

            $lang = 'ru_RU';
            $opts = array(
                'storage' => PHPMORPHY_STORAGE_FILE,
            );
            try {
                $morphy = new phpMorphy($dir, $lang, $opts);
            } catch (phpMorphy_Exception $e) {
                die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
            }            
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
                        
            // Тут перебираем массив значений и заносим их в базу
            foreach ($words as $word=>$weight) 
            {
                
                $data['post_id'] = $post->id_page;
                $data['word'] = $word;
                $data['weight'] = $weight;
                $data['type'] = $type;
                
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
        
        
        
        
        
        
        $posts = ORM::factory('products')->where('published','=','on')->find_all()->as_array();
        foreach ($posts as $post) {
            $words = array();
            $title = mb_strtoupper(str_ireplace("ё", "е", strip_tags($post->title)), "UTF-8");
            $text = mb_strtoupper(str_ireplace("ё", "е", strip_tags($post->content)), "UTF-8");
            preg_match_all('/([a-zа-яё]+)/ui', $title, $word_title); // Разбиваем текст на слова
            preg_match_all('/([a-zа-яё]+)/ui', $text, $word_text);
            $dir = $_SERVER['DOCUMENT_ROOT'] . 'application/classes/helpers/Morphy/dicts/';

            $lang = 'ru_RU';
            $opts = array(
                'storage' => PHPMORPHY_STORAGE_FILE,
            );
            try {
                $morphy = new phpMorphy($dir, $lang, $opts);
            } catch (phpMorphy_Exception $e) {
                die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
            }            
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
                        
            // Тут перебираем массив значений и заносим их в базу
            foreach ($words as $word=>$weight) 
            {
                $data['post_id'] = '';
                $data['product_id'] = $post->id_product;
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
            
            return true;
    }

    public function deleteItem($model, $id) {
ORM::factory($model)->where('id','=',$id)->delete_all();
       //var_dump($op);
       //die();
    }

    public function uploadLogo($file) {
        if (isset($file['logo']['name']) && $file['logo']['error'] == 0) {
            $ext = pathinfo($file['logo']['name'], PATHINFO_EXTENSION);
            if ('' == trim($ext)) {
                $ext = 'jpg';
            }
            $file_name = md5(microtime()) . '.' . $ext;

            if (Upload::save($file['logo'], $file_name, SYSPATH . $this->_upload_img_dir, 0777)) {
                var_dump($this->saveSetting('logo', $file_name));
                if ($this->saveSetting('logo', $file_name)) {
                    ViewMessage::adminMessage('Логотип загружен.', 'info', true);
                    Request::instance()->redirect(Route::get('admin')->uri(array('controller' => 'index', 'action' => 'index')));
                }
            } else {
                ViewMessage::adminMessage("Произошла ошибка.", 'error');
            }
        } else {
            ViewMessage::adminMessage("Изображение было загружено с ошибкой.", 'error');
        }
    }
    
}