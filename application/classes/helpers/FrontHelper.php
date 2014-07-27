<?php

defined('SYSPATH') or die('No direct script access.');

class FrontHelper
{

    public function __construct() {

    }

    static function setParamRedirect($param, $value, $controller, $action = 'index', $id = '') {
        Session::instance()->set($param, $value);
        if ($id == '') {
            Request::current()->redirect(Route::get('default')->uri(array('controller' => $controller, 'action' => $action)));
            return;
        } else {
            Request::current()->redirect(Route::get('default')->uri(array('controller' => $controller, 'action' => $action, 'id' => $id)));
            return;
        }
    }

    static function setParamRedirectWithId($param, $value, $controller, $action = 'index', $id) {
        Session::instance()->set($param, $value);
        Request::current()->redirect(Route::get('default')->uri(array('controller' => $controller, 'action' => $action, 'id' => $id)));
        return;
    }

    static function setPaymentRedirect($param, $value, $controller, $action = 'index', $coin, $entity) {
        Session::instance()->set($param, $value);
        Request::current()->redirect('/profile/buycoins/' . $coin . '/' . $entity);
        return;
    }

    static function setRedirect($controller, $action = 'index') {
        Request::instance()->redirect(Route::get('default')->uri(array('controller' => $controller, 'action' => $action)));
        return;
    }

    static function registerFromCookie() {
        $cookie_user = Cookie::get('login', '');
        $cookie_hash = Cookie::get('hash', '');
        $cookie_value = Cookie::get('value', '');
        if (($cookie_hash != '') && ($cookie_user != '') && ($cookie_value != '')) {
            $check = ORM::factory('User')->where($cookie_value, '=', $cookie_user)->find();
            if ($check->hash == $cookie_hash) {
                Auth::instance()->force_login($check->username);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function transliterate($string) {
        $roman = array("Sch", "sch", 'Yo', 'Zh', 'Kh', 'Ts', 'Ch', 'Sh', 'Yu', 'ya', 'yo', 'zh', 'kh', 'ts', 'ch', 'sh', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', '', 'Y', '', 'E', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', '', 'y', '', 'e', '_', '', '');
        $cyrillic = array("Щ", "щ", 'Ё', 'Ж', 'Х', 'Ц', 'Ч', 'Ш', 'Ю', 'я', 'ё', 'ж', 'х', 'ц', 'ч', 'ш', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Ь', 'Ы', 'Ъ', 'Э', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'ь', 'ы', 'ъ', 'э', ' ', ',', '?');
        return str_replace($cyrillic, $roman, $string);
    }

    static function successNotif() {
        $notif = Session::instance()->get('success', '');
        Session::instance()->delete('success');
        return $notif;
    }

    static function errorNotif() {
        $notif = Session::instance()->get('error', '');
        Session::instance()->delete('error');
        return $notif;
    }

    static function setHardRedirect($route) {
        header('Location: ' . $route);
        exit();
    }

    static function getTranslation() {
        $csv = new Translation;
        $csv->load(APPPATH . 'views/translations/translate.csv');
        $rows = $csv->getRows();
        $translation = array();
        foreach ($rows as $row) {
            $translation[$row[0]] = $row[1];
        }
        return $translation;
    }

    static function http_request($url) {
        $curl_handler = curl_init($url);
        curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl_handler);
        curl_close($curl_handler);
        return $response;
    }

    static function updateNodeLine($id) {
        self::http_request(Kohana::$config->load('global.NodeAddress') . '/online/' . $id);
    }

    static function updateNodeRead($id) {
        self::http_request(Kohana::$config->load('global.NodeAddress') . '/message/' . $id);
    }

    static function serverError() {
        die('Server error');
    }

    static function getAvatars($ids) {
        $avatars = array();
        foreach ($ids as $id) {
            $avatars[$id] = ORM::factory('user')->where('id', '=', $id)->find()->thumb;
        }
        return $avatars;
    }

    static function getNames($ids) {
        $avatars = array();
        foreach ($ids as $id) {
            $avatars[$id] = ORM::factory('user')->where('id', '=', $id)->find()->username;
        }
        return $avatars;
    }

    static function getIdsByUsers($users) {
        $ids = array();
        foreach ($users as $user) {
            $ids[] = $user->from;
        }
        return $ids;
    }

    static function getInfoUser($id) {
        $user = ORM::factory('user', $id);
        $info['name'] = $user->username;
        $info['thumb'] = $user->thumb;
        return $info;
    }

    static function getCurrency($code) {
        switch ($code) {
            case 'GB' :
                return 'gbp';
                break;
            case 'US' :
                return 'usd';
                break;
            case 'IE' :
                return 'eur';
                break;
            case 'CA' :
                return 'cad';
                break;
            case 'AU' :
                return 'aud';
                break;
            case 'NZ' :
                return 'nzd';
                break;
            default:
                return 'usd';
                break;
        }
    }

    static function getCurrencyCode($code) {
        switch ($code) {
            case 'GB' :
                return '&pound;';
                break;
            case 'IE' :
                return '&euro;';
                break;
            default:
                return '$';
                break;
        }
    }

    static function getEntityPayment($entity) {
        if ($entity == 'paypal') {
            return 'PayPal';
        } else {
            return 'Credit Card';
        }
    }

    static function getCoinDescription($count) {
        $coins = ORM::factory('costs');
        $coin = $coins->where('coins', '=', $count)->find();
        $geoip = Geoip::getCountryCode();
        $currency = self::getCurrency($geoip['country']);
        $currency_code = self::getCurrencyCode($geoip['country']);
        $result = $coin->$currency . ' ' . $currency_code . ' (loads ' . $coin->coins . ' coins into your account)';
        return $result;
    }

    static function getCost($event) {
        return ORM::factory('actions')->where('event', '=', $event)->find()->coins;
    }

    static function getCostDescription($event) {
        return ORM::factory('actions')->where('event', '=', $event)->find()->description;
    }

    static function checkGold($id_user) {
        $balance = ORM::factory('coins')->getBalance($id_user);
        $goldCost = self::getCost('gold');
        if ($balance > $goldCost) {
            return true;
        } else {
            return false;
        }
    }

    static function makeGold($id_user) {
        $user = ORM::factory('user', $id_user);
        $user->is_gold = '1';
        $user->gold_time = time();
        return $user->save();
    }

    static function isGold($id_user) {
        $is_gold = ORM::factory('user')->isGold($id_user);
        if ($is_gold == '1') {
            return true;
        } else {
            return false;
        }
    }

    static function addPaidChat($id_user) {
        $session = Session::instance();
        $paid = $session->get('paid', '');
        if ($paid == '') {
            $session->set('paid', array($id_user));
        } else {
            $paid[] = $id_user;
            $session->set('paid', $paid);
        }
        return true;
    }

    static function getPaidChat($id_user) {
        $session = Session::instance();
        $paid = $session->get('paid', '');
        if ($paid == '') {
            return false;
        } else {
            foreach ($paid as $id) {
                if ($id == $id_user) {
                    return true;
                }
            }
        }
        return false;
    }

    static function getMinCostGift($id_user) {
        $gifts = ORM::factory('gifts')->order_by('coins', 'asc')->find_all()->as_array();
        $giftcost = self::getCost('gift');
        if (isset($gifts[0])) {
            return $gifts[0]->coins + $giftcost;
        } else {
            return 0;
        }
    }

    static function sendGift($this_user, $id_to, $data) {
        $translator = FrontHelper::getTranslation();
        $transaction = ORM::factory('coins')->saveGiftTransaction($this_user, $id_to, $data);
        if (!$transaction) {
            self::setParamRedirect('error', $translator['text24'], 'profile', 'sendgift', $id_to);
        }
        $giftsusers = ORM::factory('giftsusers')->saveGift($this_user, $id_to, $data);
        self::incrementGiftCount($this_user);
        if (!$giftsusers) {
            self::setParamRedirect('error', $translator['text24'], 'profile', 'sendgift', $id_to);
        }
    }

    static function sendGiftNonGold($this_user, $id_to, $data) {
        $balance = ORM::factory('coins')->getBalance($this_user);
        $giftcost = self::getCostGift($data['id_gift']);
        //if non-gold check balance
        if ($balance > $giftcost) {
            self::sendGift($this_user, $id_to, $data);
            self::setRedirect('profile', 'mygifts');
        } else {
            return View::factory('views/profile/gifts/notenough');
        }
    }

    static function incrementGiftCount($id_user) {
        $user = ORM::factory('user', $id_user);
        $user->gift_count = (int)$user->gift_count + 1;
        $user->save();
        return;
    }

    static function getCostGift($id) {
        $giftcost = self::getCost('gift');
        $giftcostbyid = ORM::factory('gifts')->getCost($id);
        return $giftcost + $giftcostbyid;
    }

    static function changeGold($id) {
        $user = ORM::factory('user', $id);
        if ($user->is_gold == '1') {
            if ($user->gold_time > strtotime('+1 Months')) {
                $user->is_gold == '0';
                $user->gift_count = '0';
                $user->gold_time = 0;
                $user->save();
            }
        }
    }

    static function timeAgo($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second',);
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    static function getGiftsCount($user_id) {
        return count(ORM::factory('giftsusers')->where('to', '=', $user_id)->where('read', '=', '0')->find_all()->as_array());
    }

    static function makeAllGiftsRead($user_id) {
        $gifts = ORM::factory('giftsusers')->where('to', '=', $user_id)->where('read', '=', '0')->find_all()->as_array();
        foreach ($gifts as $gift) {
            $gift->read = '1';
            $gift->save();
        }
    }

    static function isEmailAuth($user_id) {
        $user = ORM::factory('user', $user_id);
        if ($user->email_auth == '1') {
            return true;
        } else {
            return false;
        }
    }

    static function checkAge($date) {
        $birthDate = explode("/", $date);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
        if ($age < 18) {
            return false;
        } else {
            return true;
        }
    }

    static function getCountGiftsGold($id_user) {
        return (int)ORM::factory('user', $id_user)->gift_count;
    }

    static function checkSetting($setting, $user_id) {
        $check_setting = ORM::factory('settings')->where('user', '=', $user_id)->find();
        return $check_setting === "true";
    }

    static function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    static function getEthnicity() {
        $users = ORM::factory('user')->group_by('ethnicity')->find_all()->as_array();
        return $users;
    }

    static function maxsite_str_word($text, $counttext = 10, $sep = ' ') {
        $words = explode($sep, $text);
        if (count($words) > $counttext) {
            $text = join($sep, array_slice($words, 0, $counttext));
        }
        return $text;
    }

    static function output($path, $width, $height, $in_width, $in_height, $additional_path = '') {
        $html = '';
        if (file_exists('.' . $additional_path . $path)) {
            $sizes = ImageWork::getImageSize('.' . $additional_path . $path, $width, $height, $width, $height);
            $margin_left = ($in_height - $sizes['newwidth']) / 2;
            $margin_top = ($in_width - $sizes['newheight']) / 2;
            if ($path != '') {
                $html = "<img src = '" . $additional_path . $path . "' width = '" . $sizes['newwidth'] . "' height = '" . $sizes['newheight'] . "' style = 'margin-top:" . $margin_top . "px;margin-left:" . $margin_left . "px;'/>";
            }
        }
        return $html;
    }

    static function outputRender($path, $width, $height, $in_width, $in_height) {
        $html = '';
        if (file_exists('.' . $path)) {
            $sizes = ImageWork::getImageSize('.' . $path, $width, $height, $width, $height);
            $margin_left = ($in_height - $sizes['newwidth']) / 2;
            $margin_top = ($in_width - $sizes['newheight']) / 2;
            if ($path != '') {
                $html = "<img src = '" . $path . "' width = '" . $sizes['newwidth'] . "' height = '" . $sizes['newheight'] . "' style = 'margin-top:" . $margin_top . "px;margin-left:" . $margin_left . "px;'/>";
            }
        }
        return $html;
    }

    static function outputBigImage($path, $width, $height, $in_width, $in_height) {
        $html = '';
        if (file_exists('.' . $path)) {
            $sizes = ImageWork::getImageSize('.' . $path, $width, $height, $width, $height);
            $margin_left = ($in_height - $sizes['newwidth']) / 2;
            $margin_top = ($in_width - $sizes['newheight']) / 2;
            if ($path != '') {

            }
        }
        return $html;
    }

    static function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }
            // splits all html-tags to scanable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag
                    } else {
                        if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                            // delete tag from $open_tags list
                            $pos = array_search($tag_matchings[1], $open_tags);
                            if ($pos !== false) {
                                unset($open_tags[$pos]);
                            }
                            // if tag is an opening tag
                        } else {
                            if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                                // add tag to the beginning of $open_tags list
                                array_unshift($open_tags, strtolower($tag_matchings[1]));
                            }
                        }
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
                // if the maximum length is reached, get off the loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }
        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }
        // add the defined ending to the text
        $truncate .= $ending;
        if ($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }
        return $truncate;
    }

    static function getFirstProduct() {
        $catalog = ORM::factory('catalog')->where('published', '=', 'on')->find_all()->as_array();
        if (isset($catalog[0])) {
            return $catalog[0]->id;
        }
    }

    static function getProductForBackbone($id_product, $data) {
        $additional_price = 0;
        $product = ORM::factory('catalog')->where('id', '=', $id_product)->find();
        $result = array();
        $result['id'] = $product->id;
        $result['name'] = $product->name;
        $image = ORM::factory('images')->where('id_image', '=', $product->featured)->find();
        if (isset($image->id_image)) {
            $result['image'] = $image->path;
        } else {
            $result['image'] = '';
        }
        $new_mas = array();
        foreach ($data['massages'] as $key => $value) {
            $new_mas[$key] = $value;
            $additional_price += $value;
        }
        $data['massages'] = $new_mas;
        $result['massages'] = $new_mas;

        $product = ORM::factory('catalog')->where('id', '=', $id_product)->find();
        $resulting = array();
        $related_images = array();
        if ($product->featured != '') {
            $related_images[] = ORM::factory('images')->where('id_image', '=', $product->featured)->find();
            $options_images = ORM::factory('options')->where('type', '=', 'image')->where('value', '!=', $product->featured)->where('id_product', '=', $product->id)->find_all()->as_array();
        } else {
            $options_images = ORM::factory('options')->where('type', '=', 'image')->where('id_product', '=', $product->id)->find_all()->as_array();
        }
        foreach ($options_images as $option_image) {
            $related_images[] = ORM::factory('images')->where('id_image', '=', $option_image->value)->find();
        }

        $resulting['related_images'] = $related_images;
        //        $resulting['images'] = $images;
        $massage = ORM::factory('options')->where('id_product', '=', $product->id)->where('type', '=', 'massage')->find_all()->as_array();
        $resulting['gidromassage'] = array();
        $resulting['feetmassage'] = array();
        $resulting['backmassage'] = array();
        $resulting['underoptions'] = array();
        $resulting['othersoptions'] = array();
        $resulting['accessories'] = array();
        $massages_images = array();

        foreach ($massage as $mas) {
            $massage_image = json_decode($mas->value, true);
            if (isset($massage_image[1])) {
                $key = $massage_image[1];
                $id_image = $massage_image[0];
                $forsun = $massage_image[2];
                if (isset($massage_image[4])) {
                    if ($massage_image[5] == '1') {
                        $massage_im = ORM::factory('images')->where('id_image', '=', $id_image)->find();
                        if (isset($massage_im)) {
                            $massages_images[$key] = '.' . $massage_im->path;
                        }
                    }
                    $default_for_massage = $massage_image[4];
                    // если гидромассаж
                    if ($default_for_massage == '1') {
                        if (isset($massage_image[3])) {
                            $resulting['gidromassage']['price'] = $massage_image[3];
                        }
                        if (isset($massage_image[5])) {
                            $resulting['gidromassage']['required'] = $massage_image[5];
                        }
                        $resulting['gidromassage']['image'] = $id_image;
                        $resulting['gidromassage']['forsun'] = $forsun;
                        $gidromassage = ORM::factory('massage')->where('id', '=', $key)->find();
                        if (isset($gidromassage->name)) {
                            $namegidro = $gidromassage->name;
                        } else {
                            $namegidro = '';
                        }
                        $resulting['gidromassage']['option_id'] = $key;
                        $resulting['gidromassage']['name'] = $namegidro;

                    }
                    //если массаж спины или ног
                    if ($default_for_massage == '0') {
                        if (isset($massage_image[6])) {
                            if ($massage_image[6] == '1') {
                                $underoption = array();
                                if (isset($massage_image[3])) {
                                    $underoption['price'] = $massage_image[3];
                                }
                                $underoption['image'] = $id_image;
                                $underoption['forsun'] = $forsun;
                                $gidromassage = ORM::factory('massage')->where('id', '=', $key)->find();
                                if (isset($gidromassage->name)) {
                                    $namegidro = $gidromassage->name;
                                } else {
                                    $namegidro = '';
                                }
                                $underoption['option_id'] = $key;
                                $underoption['pnevmo'] = $gidromassage->electronic;
                                $underoption['name'] = $namegidro;
                                $resulting['underoptions'][] = $underoption;

                            } else {
                                $others = array();
                                if (isset($massage_image[3])) {
                                    $others['price'] = $massage_image[3];
                                }
                                if (isset($massage_image[5])) {
                                    $others['required'] = $massage_image[5];
                                }
                                $others['image'] = $id_image;
                                $others['forsun'] = $forsun;
                                $gidromassage = ORM::factory('massage')->where('id', '=', $key)->find();
                                if (isset($gidromassage->name)) {
                                    $namegidro = $gidromassage->name;
                                } else {
                                    $namegidro = '';
                                }

                                $others['pnevmo'] = $gidromassage->electronic;
                                $others['option_id'] = $key;
                                $others['name'] = $namegidro;
                                $resulting['othersoptions'][] = $others;
                            }
                        }
                    }
                }
            }
        }

        $resulting['baseimageid'] = '';
        $resulting['baseemptyimage'] = '';
        if (isset($related_images[0])) {
            $baseimage = ORM::factory('catalog')->where('published', '=', 'on')->where('id', '=', $product->id)->find();
            if ($baseimage->base != '') {
                $resulting['baseimageid'] = $baseimage->base;
                $baseim = ORM::factory('images')->where('id_image', '=', $baseimage->base)->find();
                if (isset($baseim->path)) {
                    $resulting['baseemptyimage'] = $baseim->path;
                }
            }
            $image = '';
            if (isset($baseim->path)) {
                $image = '.' . $baseim->path;
            }
            $dest = ImageWork::createImage($image);
            if ($dest) {
                imageAlphaBlending($dest, false);
                imageSaveAlpha($dest, true);
                $x1 = imagesx($dest);
                $y1 = imagesy($dest);
                $slate = imagecreatetruecolor($x1, $y1);
                $transparent = imagecolorallocatealpha($slate, 0, 255, 0, 127);
                imagefill($slate, 0, 0, $transparent);
                imagecopy($slate, $dest, 0, 0, 0, 0, imagesx($dest) - 1, imagesy($dest) - 1);
                foreach ($massages_images as $mi) {
                    $src = ImageWork::createImage($mi);
                    imageAlphaBlending($src, false);
                    imageSaveAlpha($src, true);
                    $x2 = imagesx($src);
                    $y2 = imagesy($src);
                    imagecopy($slate, $src, 0, 0, 0, 0, imagesx($src) - 1, imagesy($src) - 1);
                }
                imageAlphaBlending($slate, false);
                imageSaveAlpha($slate, true);
                $mainimagename = '/uploads/mainimage' . time() . '.png';
                $resulting['baseimage'] = $mainimagename;
                imagepng($slate, '.' . $mainimagename);
            } else {
                $resulting['baseimage'] = '';
            }
        } else {
            $resulting['baseimage'] = '';
        }

        $mainimage = ORM::factory('catalog')->where('published', '=', 'on')->where('id', '=', $product->id)->find();
        $mainim = ORM::factory('images')->where('id_image', '=', $mainimage->featured)->find();
        if (isset($mainim->path)) {
            $resulting['mainimage'] = $mainim->path;
        }

        $grades = ORM::factory('options')->where('id_product', '=', $product->id)->where('type', '=', 'grade')->find_all()->as_array();
        foreach ($grades as $grade) {
            $grade_array = json_decode($grade->value);
            if (isset($grade_array[1])) {
                if ($grade_array[1] == '1') {
                    $resulting['bath'] = ORM::factory('grade')->where('id', '=', $grade_array[0])->where('name', 'LIKE', '%Ванна%')->find();
                }
            }
        }
        $massage_price = 0;
        $category_product = ORM::factory('productscat')->where('id', '=', $product->category)->find();
        if ($category_product->massage_on == 'on') {
            if (count($resulting['gidromassage']) > 0) {
                if ($resulting['gidromassage']['required'] == '1') {
                    $massage_price = $resulting['gidromassage']['price'];
                }
            }
        }
        if ($category_product->grade_on == 'on') {
            $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $product->id)->find_all()->as_array();
            $grade_price = 0;

            foreach ($options as $option) {
                $grade_opt = json_decode($option->value);
                $grades = ORM::factory('grade')->where('id', '=', $grade_opt[0])->find();
                if (isset($grade_opt[2])) {
                    if (($grade_opt[2] == 1) || ($grade_opt[1] == 1)) {
                        $grade_price += $grades->price;
                    }
                }
            }

            if (isset($grade_price)) {
                if (count($options) > 0) {
                    $priceglobal = $massage_price + $grade_price;
                } else {
                    $priceglobal = $product->price;
                }
            } else {
                $priceglobal = $product->price;
            }
        } else {
            $priceglobal = $product->price;
        }
        $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $product->id)->find_all()->as_array();
        $maingrades = array();
        $gradestep2 = array();
        $i = 0;
        $data_sel_grade = array();
        foreach ($data['grades'] as $key_grade => $item_grade) {
            $data_sel_grade[] = $key_grade;
            $additional_price += $item_grade;
        }


        if ((count($options) > 0) || (isset($resulting['bath']->name))) {
            foreach ($options as $option) {
                $grade_opt = json_decode($option->value);
                $grades = ORM::factory('grade')->where('id', '=', $grade_opt[0])->find();
                if (isset($grade_opt[2])) {
                    $gradestep2[$i]['price'] = $grades->price;
                    $gradestep2[$i]['name'] = $grades->name;
                    $gradestep2[$i]['id'] = $grades->id;
                    if ($grade_opt[2] == '1') {
                        $maingrades[$i]['name'] = $grades->name;
                        $maingrades[$i]['price'] = $grades->price;
                        $gradestep2[$i]['disabled'] = '1';
                    } else {
                        $gradestep2[$i]['disabled'] = '0';
                    }
                    $gradestep2[$i]['checked'] = '0';
                    if (in_array($grade_opt[0], $data_sel_grade)) {
                        $gradestep2[$i]['checked'] = '1';
                    }
                    $i++;
                }
            }
        }

        $result['image'] = $resulting['baseimage'];
        $result['scheme'] = $product->scheme;
        $result['instruction'] = $product->instruction;
        $result['width'] = $product->width;
        $result['length'] = $product->length;
        if (!isset($resulting['bath']->name)) {
            $result['bathname'] = '';
        } else {
            $result['bathname'] = $resulting['bath']->name;
        }
        $result['gidromassage'] = $resulting['gidromassage'];
        $result['underoptions'] = $resulting['underoptions'];
        $result['othersoptions'] = $resulting['othersoptions'];
        $result['othergrades'] = $maingrades;
        $result['gradestep2'] = $gradestep2;

        if (isset($data['massages'])) {
            $data['massages'] = (array)$data['massages'];

            $order_pre = $post = $data;
            $order = array();

            $post['image'] = FrontHelper::getProductImageForBackbone($post['id']);

            $is_electronic = false;
            foreach ($data as $key => $item) {
                $massage_check = ORM::factory('massage')->where('id', '=', $key)->find();
                if (isset($massage_check->electronic)) {
                    if ($massage_check->electronic == 'on') {
                        $is_electronic = true;
                    }
                }
            }
            if (isset($data['electronic'])) {
                $is_electronic = $data['electronic'];
            }
            $massages_images = array();
            $massage = ORM::factory('options')->where('id_product', '=', $post['id'])->where('type', '=', 'massage')->find_all()->as_array();
            foreach ($massage as $mas) {

                $massage_image = json_decode($mas->value, true);

                if ($is_electronic) {
                    if (isset($massage_image[7])) {
                        $id_image = $massage_image[7];
                        $key = $massage_image[1];
                        $massage_im = ORM::factory('images')->where('id_image', '=', $id_image)->find();
                        if (isset($massage_im)) {
                            if (isset($data['massages'][$key])) {
                                $massages_images[$key] = '.' . $massage_im->path;
                            }
                        }
                    }
                } else {
                    if (isset($massage_image[1])) {
                        $id_image = $massage_image[0];
                        $key = $massage_image[1];
                        $massage_im = ORM::factory('images')->where('id_image', '=', $id_image)->find();

                        if (isset($massage_im)) {
                            if (isset($data['massages'][$key])) {
                                $massages_images[$key] = '.' . $massage_im->path;
                            }
                        }
                    }
                }
            }


            $image = '.' . $post['image'];
            //$desting = ImageWork::createImage($image);
            //imagepng($desting, './uploads/1235.png');
            $dest = ImageWork::createImage($image);
            imageAlphaBlending($dest, false);
            imageSaveAlpha($dest, true);
            $x1 = imagesx($dest);
            $y1 = imagesy($dest);
            $slate = imagecreatetruecolor($x1, $y1);
            $transparent = imagecolorallocatealpha($slate, 0, 255, 0, 127);
            imagefill($slate, 0, 0, $transparent);
            imagecopy($slate, $dest, 0, 0, 0, 0, imagesx($dest) - 1, imagesy($dest) - 1);

            foreach ($massages_images as $mi) {

                $src = ImageWork::createImage($mi);
                imageAlphaBlending($src, false);
                imageSaveAlpha($src, true);
                $x2 = imagesx($src);
                $y2 = imagesy($src);
                imagecopy($slate, $src, 0, 0, 0, 0, imagesx($src) - 1, imagesy($src) - 1);
            }
            imageAlphaBlending($slate, false);
            imageSaveAlpha($slate, true);
            $fn = '/uploads/withopt' . time() . '.png';
            imagepng($slate, '.' . $fn);
            $response = array();
            $response['image'] = $fn;
            $result['image'] = $fn;
            //
            $response['1'] = FrontHelper::outputRender($fn, 60, 60, 60, 60);
            $response['2'] = FrontHelper::outputRender($fn, 420, 400, 420, 400);
        }
        $accessories = array();
        $new_acc = array();
        foreach ($data['accessories'] as $key => $value) {
            $new_acc[$key] = $value;
            $additional_price += $value;
        }
        $data['accessories'] = $new_acc;
        $result['accessories'] = $new_acc;
        $counter = 0;
        $options = ORM::factory('options')->where('type', '=', 'products')->where('id_product', '=', $id_product)->find_all()->as_array();
        if (count($options) > 0) {
            foreach ($options as $option) {
                $image_related = ORM::factory('catalog')->where('id', '=', $option->value)->find();
                $image = ORM::factory('images')->where('id_image', '=', $image_related->featured)->find();
                $related_product = ORM::factory('catalog')->where('id', '=', $option->value)->where('published', '=', 'on')->find();
                if (isset($image->id_image)) {
                    $accessories[$counter]['id'] = $related_product->id;
                    $accessories[$counter]['href'] = "/catalog/".strtolower(FrontHelper::transliterate($category_product->name)) . '/' . strtolower(FrontHelper::transliterate($related_product->name));
                    $accessories[$counter]['name'] = $related_product->name;
                    $accessories[$counter]['price'] = $related_product->price;
                    if (file_exists('.' . $image->path)) {
                        $sizes = ImageWork::getImageSize('.' . $image->path, '40', '40', '41', '41');
                        if ($image->path != '') {
//                            $image_accessory = "<img src='".$image->path."' width='".$sizes['newwidth']."' height='".$sizes['newheight']."' style='margin-top:".((240 - $sizes['newheight']) / 2)."px;margin-left:".((240 - $sizes['newwidth']) / 2)."px;'/>";
                            $image_accessory = "<img src='".$image->path."' width='".$sizes['newwidth']."' height='".$sizes['newheight']."' style='margin-right:10px'/>";
                        }
                    }
                    $accessories[$counter]['image'] = $image_accessory;
                    if(isset($data['accessories'][$related_product->id])) {
                        $accessories[$counter]['checked'] = '1';
                    }
                    $counter++;
                }
            }
        }
        $result['accessories'] = $accessories;
        $priceglobal += $additional_price;
        $result['pricehtml'] = number_format((double)$priceglobal, 0, ' ', ' ');
        $result['price'] = $priceglobal;
        return $result;
    }

    static function getFirstAndLastProductForBackbone($id_product, $result) {
        $categories = self::getBathCategories();

        $leftProduct = Model::factory('catalog')->where('id', '<', $id_product)->where('category', 'in', $categories)->where('published', '=', 'on')->order_by('id', 'desc')->find();
        if (!isset($leftProduct->id)) {
            $leftProduct = Model::factory('catalog')->order_by('id', 'desc')->where('published', '=', 'on')->where('category', 'in', $categories)->find_all()->as_array();
            if (isset($leftProduct[0])) {
                $leftProduct = $leftProduct[0]->id;
            } else {
                $leftProduct = '';
            }
        } else {
            $leftProduct = $leftProduct->id;
        }

        $rightProduct = Model::factory('catalog')->where('id', '>', $id_product)->where('category', 'in', $categories)->where('published', '=', 'on')->find();
        if (!isset($rightProduct->id)) {
            $rightProduct = Model::factory('catalog')->order_by('id', 'asc')->where('category', 'in', $categories)->where('published', '=', 'on')->find_all()->as_array();
            if (isset($rightProduct[0])) {
                $rightProduct = $rightProduct[0]->id;
            } else {
                $rightProduct = '';
            }
        } else {
            $rightProduct = $rightProduct->id;
        }
        $result['leftProduct'] = $leftProduct;
        $result['rightProduct'] = $rightProduct;
        return $result;
    }

    static function getBathCategories() {
        $categories = ORM::factory('productscat')->where('type_filter', '=', 'bath')->find_all()->as_array();
        $ids = array();
        foreach ($categories as $category) {
            $ids[] = $category->id;
        }
        return $ids;
    }

    static function setStep($id) {
        Session::instance()->set('step', $id);
        return true;
    }

    static function getStep() {
        return Session::instance()->get('step', '');
    }

    static function getAvailableSteps() {
        $current_step = self::getStep();
        if ($current_step == '') {
            return false;
        } else {
            switch ($current_step) {
                case '1':
                    return array('1', '2');
                    break;
                case '2':
                    return array('1', '2', '3');
                    break;
                default:
                    return array('1', '2', '3', '4');
                    break;
            }
        }
    }

    static function getStepsForBackbone($steps) {
        if (count($steps) == 2) {
            return array('step1' => '#!/step1', 'step2' => '', 'step3' => '', 'step4' => '');
        }
        if (count($steps) == 3) {
            return array('step1' => '#!/step1', 'step2' => '#!/step2', 'step3' => '', 'step4' => '');
        }
        if (count($steps) == 4) {
            return array('step1' => '#!/step1', 'step2' => '#!/step2', 'step3' => '#!/step3', 'step4' => '');
        }
        return array();
    }

    static function getProductImageForBackbone($id_product) {
        $product = ORM::factory('catalog')->where('id', '=', $id_product)->find();
        $related_images = array();
        if ($product->featured != '') {
            $related_images[] = ORM::factory('images')->where('id_image', '=', $product->featured)->find();
            $options_images = ORM::factory('options')->where('type', '=', 'image')->where('value', '!=', $product->featured)->where('id_product', '=', $product->id)->find_all()->as_array();
        } else {
            $options_images = ORM::factory('options')->where('type', '=', 'image')->where('id_product', '=', $product->id)->find_all()->as_array();
        }
        foreach ($options_images as $option_image) {
            $related_images[] = ORM::factory('images')->where('id_image', '=', $option_image->value)->find();
        }

        $resulting['related_images'] = $related_images;
        $resulting['baseemptyimage'] = '';
        if (isset($related_images[0])) {
            $baseimage = ORM::factory('catalog')->where('published', '=', 'on')->where('id', '=', $product->id)->find();
            if ($baseimage->base != '') {
                $resulting['baseimageid'] = $baseimage->base;
                $baseim = ORM::factory('images')->where('id_image', '=', $baseimage->base)->find();
                if (isset($baseim->path)) {
                    $resulting['baseemptyimage'] = $baseim->path;
                }
            }
        }

        return $resulting['baseemptyimage'];

        $post = Safely::safelyGet($_POST);
        $order_pre = json_decode($post['order']);
        $order_pre = (array)$order_pre;
        $order_pre = (array)$order_pre['massages'];
        $order_pre = (array)$order_pre;
        $order = array();
        foreach ($order_pre as $key => $item) {
            $order[$key] = $item;
        }
        $is_electronic = false;
        foreach ($order as $key => $item) {
            $massage_check = ORM::factory('massage')->where('id', '=', $key)->find();
            if (isset($massage_check->electronic)) {
                if ($massage_check->electronic == 'on') {
                    $is_electronic = true;
                }
            }
        }

        $massages_images = array();
        $massage = ORM::factory('options')->where('id_product', '=', $post['id'])->where('type', '=', 'massage')->find_all()->as_array();
        foreach ($massage as $mas) {
            $massage_image = json_decode($mas->value, true);

            if ($is_electronic) {
                if (isset($massage_image[7])) {
                    $id_image = $massage_image[7];
                    $key = $massage_image[1];
                    $massage_im = ORM::factory('images')->where('id_image', '=', $id_image)->find();
                    if (isset($massage_im)) {
                        if (isset($order[$key])) {
                            $massages_images[$key] = '.' . $massage_im->path;
                        }
                    }
                }
            } else {
                if (isset($massage_image[1])) {
                    $id_image = $massage_image[0];
                    $key = $massage_image[1];
                    $massage_im = ORM::factory('images')->where('id_image', '=', $id_image)->find();
                    if (isset($massage_im)) {
                        if (isset($order[$key])) {
                            $massages_images[$key] = '.' . $massage_im->path;
                        }
                    }
                }
            }
        }

        $image = '.' . $post['image'];
        //$desting = ImageWork::createImage($image);
        //imagepng($desting, './uploads/1235.png');
        $dest = ImageWork::createImage($image);
        imageAlphaBlending($dest, false);
        imageSaveAlpha($dest, true);
        $x1 = imagesx($dest);
        $y1 = imagesy($dest);
        $slate = imagecreatetruecolor($x1, $y1);
        $transparent = imagecolorallocatealpha($slate, 0, 255, 0, 127);
        imagefill($slate, 0, 0, $transparent);
        imagecopy($slate, $dest, 0, 0, 0, 0, imagesx($dest) - 1, imagesy($dest) - 1);
        foreach ($massages_images as $mi) {

            $src = ImageWork::createImage($mi);
            imageAlphaBlending($src, false);
            imageSaveAlpha($src, true);
            $x2 = imagesx($src);
            $y2 = imagesy($src);
            imagecopy($slate, $src, 0, 0, 0, 0, imagesx($src) - 1, imagesy($src) - 1);
        }
        imageAlphaBlending($slate, false);
        imageSaveAlpha($slate, true);
        $fn = '/uploads/withopt' . time() . '.png';
        imagepng($slate, '.' . $fn);
        $response = array();
        $response['0'] = $fn;
        //
        $response['1'] = FrontHelper::outputRender($fn, 60, 60, 60, 60);
        $response['2'] = FrontHelper::outputRender($fn, 420, 400, 420, 400);
        echo json_encode($response);
        die();
    }

    static function evalSumm($grades, $massages, $accessories, $priceglobal) {
        $current_price = $priceglobal;
//        return $data['price'];
        return 0;
    }
}
