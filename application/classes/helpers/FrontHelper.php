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
        $roman = array("Sch", "sch", 'Yo', 'Zh', 'Kh', 'Ts', 'Ch', 'Sh', 'Yu', 'ya', 'yo', 'zh', 'kh', 'ts', 'ch', 'sh', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', '', 'Y', '', 'E', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', '', 'y', '', 'e', '_', '','');
        $cyrillic = array("Щ", "щ", 'Ё', 'Ж', 'Х', 'Ц', 'Ч', 'Ш', 'Ю', 'я', 'ё', 'ж', 'х', 'ц', 'ч', 'ш', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Ь', 'Ы', 'Ъ', 'Э', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'ь', 'ы', 'ъ', 'э', ' ',',','?');
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
        header('Location: '.$route);
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

    static function output($path, $width, $height, $in_width, $in_height, $additional_path='') {
        $html = '';
        if (file_exists('.' .$additional_path. $path)) {
            $sizes = ImageWork::getImageSize('.' .$additional_path. $path, $width, $height, $width, $height);
            $margin_left = ($in_height - $sizes['newwidth'])/2;
            $margin_top = ($in_width - $sizes['newheight'])/2;
            if ($path != '') {
                $html = "<img src = '".$additional_path.$path."' width = '".$sizes['newwidth']."' height = '".$sizes['newheight']."' style = 'margin-top:".$margin_top."px;margin-left:".$margin_left."px;'/>";
            }
        }
        return $html;
    }

    static function outputRender($path, $width, $height, $in_width, $in_height) {
        $html = '';
        if (file_exists('.' . $path)) {
            $sizes = ImageWork::getImageSize('.' . $path, $width, $height, $width, $height);
            $margin_left = ($in_height - $sizes['newwidth'])/2;
            $margin_top = ($in_width - $sizes['newheight'])/2;
            if ($path != '') {
                $html = "<img src = '".$path."' width = '".$sizes['newwidth']."' height = '".$sizes['newheight']."' style = 'margin-top:".$margin_top."px;margin-left:".$margin_left."px;'/>";
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
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length+$content_length> $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1]+1-$entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
                // if the maximum length is reached, get off the loop
                if($total_length>= $length) {
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
        if($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }
        return $truncate;
    }

}
