<?php

defined('SYSPATH') or die('No direct script access.');

class AdminHelper {

    public function __construct() {
        
    }

    static function setParamRedirect($param, $value, $controller, $action = 'index', $id = '') {
        Session::instance()->set($param, $value);
        if ($id == '') {
            Request::instance()->redirect(Route::get('admin')->uri(
                            array(
                                'controller' => $controller,
                                'action' => $action
                            )
            ));
            return;
        } else {
            Request::current()->redirect(Route::get('admin')->uri(
                            array(
                                'controller' => $controller,
                                'action' => $action,
                                'id' => $id
                            )
            ));
            return;
        }
    }

    static function setParamRedirectWithId($param, $value, $controller, $action = 'index', $id) {
        Session::instance()->set($param, $value);
        Request::instance()->redirect(Route::get('admin')->uri(
                        array(
                            'controller' => $controller,
                            'action' => $action,
                            'id' => $id
                        )
        ));
        return;
    }

    static function setPaymentRedirect($param, $value, $controller, $action = 'index', $coin, $entity) {
        Session::instance()->set($param, $value);
        Request::instance()->redirect('/profile/buycoins/' . $coin . '/' . $entity);
        return;
    }

    static function setRedirect($controller, $action = 'index') {
        Request::instance()->redirect(Route::get('admin')->uri(
                        array(
                            'controller' => $controller,
                            'action' => $action
                        )
        ));
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
        $roman = array("Sch", "sch", 'Yo', 'Zh', 'Kh', 'Ts', 'Ch', 'Sh', 'Yu', 'ya', 'yo', 'zh', 'kh', 'ts', 'ch', 'sh', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', '', 'Y', '', 'E', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', '', 'y', '', 'e');
        $cyrillic = array("Щ", "щ", 'Ё', 'Ж', 'Х', 'Ц', 'Ч', 'Ш', 'Ю', 'я', 'ё', 'ж', 'х', 'ц', 'ч', 'ш', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Ь', 'Ы', 'Ъ', 'Э', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'ь', 'ы', 'ъ', 'э');
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
        if ($balance > $goldCost)
            return true;
        else
            return false;
    }

    static function makeGold($id_user) {
        $user = ORM::factory('user', $id_user);
        $user->is_gold = '1';
        $user->gold_time = time();
        return $user->save();
    }

    static function isGold($id_user) {
        $is_gold = ORM::factory('user')->isGold($id_user);
        if ($is_gold == '1')
            return true;
        else
            return false;
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
                if ($id == $id_user)
                    return true;
            }
        }
        return false;
    }

    static function getMinCostGift($id_user) {
        $gifts = ORM::factory('gifts')->order_by('coins', 'asc')->find_all()->as_array();
        $giftcost = self::getCost('gift');
        if (isset($gifts[0]))
            return $gifts[0]->coins + $giftcost;
        else
            return 0;
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
        $user->gift_count = (int) $user->gift_count + 1;
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

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
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
        if ($age < 18)
            return false;
        else
            return true;
    }

    static function getCountGiftsGold($id_user) {
        return (int) ORM::factory('user', $id_user)->gift_count;
    }

    static function checkSetting($setting, $user_id) {
        $check_setting = ORM::factory('settings')->where('user', '=', $user_id)->find();
        return $check_setting === "true";
    }

    static function saveImage($path, $type, $to) {
        $imageThumb = ImageWork::generateImageThumbPhotos($path);
        $images = ORM::factory('images');
        $images->path = $path;
        $images->thumb = $imageThumb;
        $images->type = $type;
        $images->to = $to;
        $images->save();
    }

    static function saveReport($data) {
        ORM::factory('reports')->values($data)->save();
    }

    static function setAdminRedirect($redirect) {
        header('Location: ' . $redirect);
        exit();
    }

    static function getPhotos($id) {
        return ORM::factory('images')->getAllReports($id);
    }

    static function deleteReportsImg($id) {
        return ORM::factory('images')->deleteImage($id);
    }

    static function deleteReportsImages($ids) {
        foreach ($ids as $id) {
            $for_redirect = self::deleteReportsImg($id);
            if ($for_redirect != NULL) {
                $id_for = $for_redirect;
            }
        }
        return $id_for;
    }

    static function deleteReport($id) {
        return ORM::factory('reports', $id)->delete();
    }

    static function saveConcert($data) {
        $concert = ORM::factory('concerts');
        return $concert->values($data)->save();
    }

    static function editConcert($data, $id) {
        if (isset($data['firmconcert'])) { 
            $data['preview'] = '/images/events/event-preview-che.png';
        } else {
            $data['preview'] = '/images/events/event-preview.png';
        }
        $concert = ORM::factory('concerts', $id);
        return $concert->values($data)->save();
    }

    static function saveConcertPhotoPreview($image, $id, $checkfirm) {        
        $imageThumb = ImageWork::generateImageThumbConcert($image);
        $concert = ORM::factory('concerts', $id);
        $concert->image = $image;
        $concert->imageBig = $imageThumb;
        if ($checkfirm == 'on') {
            $concert->preview = '/images/events/event-preview-che.png';
        } else {
            $concert->preview = '/images/events/event-preview.png';
        }
        $concert->previewBig = '/images/events/event-preview-big.png';
        return $concert->save();
    }

    static function deleteConcert($id) {
        return ORM::factory('concerts', $id)->delete();
    }

    static function withoutImage($id, $checkfirm) {        
        $concert = ORM::factory('concerts', $id);
        $concert->image = '/images/events/event-preview.png';
        $concert->imageBig = '/images/events/event-preview-big.png';
        if ($checkfirm == 'on') {
            $concert->preview = '/images/events/event-preview-che.png';
        } else {
            $concert->preview = '/images/events/event-preview.png';
        }
        $concert->previewBig = '/images/events/event-preview-big.png';
        return $concert->save();
    }

}

?>
