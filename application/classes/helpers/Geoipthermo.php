<?php

defined('SYSPATH') or die('No direct script access.');

class Geoipthermo
{

    private $ip;
    private $allowed_regions;

    function __construct() {
        $this->ip = Request::$client_ip;
    }

    /*
     * get region code by getData()  (INT/False)   
     */

    public function getRegion() {

        $data = $this->getData();

        if (isset($data->region)) {
            return (int)$data->region;
        } else {
            return FALSE;
        }
    }

    /*
     * get All Data by IP (Array)    
     */

    public static function getData() {
        $ip = Request::$client_ip;
        $ip = '178.76.234.123';
        try {
            $data = file_get_contents('http://ipgeobase.ru:7020/geo?ip=' . $ip);
        } Catch (Exception $e) {
            $data = '<?xml version="1.0" encoding="windows-1251"?><ip-answer><ip value="178.76.234.123"><inetnum>178.76.216.0 - 178.76.234.255</inetnum><country>RU</country><city>Ростов-на-Дону</city><region>Ростовская область</region><district>����� ����������� �����</district><lat>47.233189</lat><lng>39.715000</lng></ip></ip-answer>';
        }
        return $data;
        //return Geoip3::instance()->record_chester($ip);
    }

    /*
     * Check user from Moscow by IP (TRUE/FALSE)     
     */

    public function checkMoscow() {

        if (!$this->getRegion()) {
            return FALSE;
        }

        if (in_array($this->getRegion(), $this->allowed_regions)) {
            return TRUE;
        }

        return FALSE;
    }

}

?>
