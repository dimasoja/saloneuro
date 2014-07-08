<?php
class globaliris {

    private $cardname;
    private $company;
    private $address;
    private $town;
    private $postcode;
    private $cardnumber;
    private $expdate;
    private $number;
    private $merchantamount;
    private $orderid;

function getData($cardname, $cardnumber, $expdate, $merchantamount, $number, $payid) { 

    $this->cardname = $cardname;
    $this->cardnumber = $cardnumber;
    $this->expdate = $expdate;
    $this->merchantamount = $merchantamount*100;
    $this->number = $number;    
    $this->merchantid = "floorsand";
    $this->secret = "PeX1MSNCGT";
    $this->account = "internet";
    $this->merchantcurrency = "GBP";
    $this->cardtype = 'VISA';
    $this->chosenamount = $this->merchantamount;
    $this->chosencurrency = $this->merchantcurrency;
    $this->rate = "1";
    $URL = "https://remote.globaliris.com/realauth";

    $timestamp = strftime("%Y%m%d%H%M%S");
    mt_srand((double) microtime()*1000000);
    if($payid=='') {
        $this->orderid = $timestamp."-".mt_rand(1, 999); 
    } else {
        $this->orderid = $payid;
    }
    $tmp = "$timestamp.$this->merchantid.$this->orderid.$this->merchantamount.$this->merchantcurrency.$this->cardnumber";
    $md5hash = md5($tmp);
    $tmp = "$md5hash.$this->secret";
    $md5hash = md5($tmp);

    $this->xml_parser = xml_parser_create();
    xml_set_element_handler($this->xml_parser, "startElement", "endElement");
    xml_set_character_data_handler($this->xml_parser, "cDataHandler");

    $xml = "<request type='auth' timestamp='$timestamp'> 
                <merchantid>$this->merchantid</merchantid>
                <account>$this->account</account>
                <orderid>$this->orderid</orderid>
                <amount currency='$this->merchantcurrency'>".$this->merchantamount."</amount>
                <card> 
                   <number>$this->cardnumber</number>
                   <expdate>$this->expdate</expdate>
                   <type>$this->cardtype</type> 
                   <chname>$this->cardname</chname> 
                   <cvn>
                        <number>$this->number</number>
                   </cvn>
                </card> 
                <autosettle flag='1'/>
                <dccinfo>
                <ccp>fexco</ccp>
                <type>1</type>
                <rate>$this->rate</rate>
                <amount currency='$this->chosencurrency'>$this->chosenamount</amount>
                </dccinfo>
                <md5hash>$md5hash</md5hash>
                <tssinfo>
                    <address type=\"billing\">
                        <country>ie</country>
                    </address>
                </tssinfo>
           </request>";


     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, "https://remote.globaliris.com/realauth");
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_USERAGENT, "payandshop.com php version 0.9");
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
     $this->response = curl_exec ($ch);

     curl_close ($ch);
//     //$this->response = preg_replace ( "/[[:space:]]+/", " ", $this->response );
//     $this->response = preg_replace ( "/[\n\r]/", "", $this->response );
//
//     if (!xml_parse($this->xml_parser, $this->response)) {
//        die(sprintf("XML error: %s at line %d",
//         xml_error_string(xml_get_error_code($this->xml_parser)),
//         xml_get_current_line_number($this->xml_parser)));
//     }
//     //die(print_r($this->response));
//     //xml_parser_free($this->xml_parser);
//     return 
 return simplexml_load_string($this->response);

}}

$parentElements = array();
$TSSChecks = array();
$currentElement = 0;
$currentTSSCheck = "";


function startElement($parser, $name, $attrs) {
    global $parentElements;
    global $currentElement;
    global $currentTSSCheck;

    array_push($parentElements, $name);
    $currentElement = join("_", $parentElements);

    foreach ($attrs as $attr => $value) {
        if ($currentElement == "RESPONSE_TSS_CHECK" and $attr == "ID") {
            $currentTSSCheck = $value;
        }

        $attributeName = $currentElement."_".$attr;

        global $$attributeName;
        $$attributeName = $value;
    }
}

function cDataHandler($parser, $cdata) {
    global $currentElement;
    global $currentTSSCheck;
    global $TSSChecks;

    if ( trim ( $cdata ) ) {
        if ($currentTSSCheck != 0) {
            $TSSChecks["$currentTSSCheck"] = $cdata;
        }

        global $$currentElement;
        $$currentElement = $cdata;
    }

}

function endElement($parser, $name) {
    global $parentElements;
    global $currentTSSCheck;

    $currentTSSCheck = 0;
    array_pop($parentElements);
}

