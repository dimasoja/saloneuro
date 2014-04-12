<?php
/***************************************************************************************************
	Defination		: HSBC Payment CLASS Method With PASS And API
	Developed By	: Reazaul Karim - Rubel
	Emai			: reazulk@gmail.com
	Web				: http://www.apprain.com
	Blog			: http://reazulk.wordpress.com
	Terms			: This class is free for use. I request not to remove the author information
	Date			: September 05, 2009
***************************************************************************************************/

class hsbc
{
	var $ccpa_data	= array();
	var $xml_date	= array();
	var $pass_url	= "https://www.ccpa.hsbc.com/ccpa";
	var $api_url	= "https://www.secure-epayments.apixml.hsbc.com";
	var $payment_mode = 'P';
	var $xmldata = array();
	var $ccparesultscode = NULL;
	var $cavv = NULL;
	var $xid = NULL;
	var $debug = false;

	/**
	 * Adding All pass filed
	 */
	function add_pass_field($k=NULL, $v=NULL)
	{
		$this->ccpa_data[$k]=$v;
	}

	/**
	 * Send All PASS parameter to HSBC network
	 */
	function send_pass()
	{
		echo "<html>\n";
		echo "<head><title>Processing Payment...</title><style type=\"text/css\">body{font-size:12px;font-family:arial}</style></head>\n";
		echo "<body onLoad=\"document.forms['hsbc_form'].submit();\">\n";
		echo "<center><h2>Please wait, your order is being processed.";
		echo " .</h2></center>\n";
		echo "<form method=\"post\" name=\"hsbc_form\" ";
		echo "action=\"".$this->pass_url."\">\n";

		foreach ($this->ccpa_data as $name => $value) {
			echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
		}
		echo "<center><br/><br/>If you are not automatically redirected to ";
		echo "hsbc within 5 seconds...<br/><br/>\n";
		echo "<input type=\"submit\" value=\"Click Here\"></center>\n";

		echo "</form>\n";
		echo "</body></html>\n";
	}	
	
	/**
	 *	Generate API XML
	 */
	function get_api_xml()
	{

		$xml= '<?xml version="1.0" encoding="UTF-8"?>
			   <EngineDocList>
				<DocVersion DataType="String">1.0</DocVersion>
				<EngineDoc>
				 <ContentType DataType="String">OrderFormDoc</ContentType> 
				 <User>
				  <Name DataType="String">' . $this->xmldata['name'] . '</Name>
				  <Password DataType="String">' . $this->xmldata['password'] . '</Password>
				  <ClientId DataType="S32">' . $this->xmldata['clientid'] . '</ClientId> 
				  <CardholderPan DataType="String">' . $this->xmldata['cardholderpan'] . '</CardholderPan>
				 </User>
				 <Instructions>
				  <Pipeline DataType="String">Payment</Pipeline> 
				 </Instructions>
				 <OrderFormDoc>
				  <Mode DataType="String">' . $this->payment_mode  . '</Mode>
				  <Consumer>           
				   <PaymentMech>
					<Type DataType="String">CreditCard</Type> 
					<CreditCard>
					 <Number DataType="String">' . $this->xmldata['number'] . '</Number>
					 <Cvv2Val DataType="String">' . $this->xmldata['cvv2val'] . '</Cvv2Val>
					 <Cvv2Indicator DataType="String">1</Cvv2Indicator> 
					 <Expires DataType="ExpirationDate">' . $this->xmldata['expires'] . '</Expires>'; 

		$this->xmldata['issuenum'] = isset($this->xmldata['issuenum']) ? $this->xmldata['issuenum'] : "";
		$this->xmldata['startdate'] = isset($this->xmldata['startdate']) ? $this->xmldata['startdate'] : "";
		if( $this->xmldata['issuenum'] != ""  && $this->xmldata['startdate'] != "" )
		{
			$xml=$xml.	'<IssueNum DataType="String">' . $this->xmldata['issuenum'] . '</IssueNum>
						 <StartDate DataType="StartDate">' .$this->xmldata['startdate'] . '</StartDate>';
		}

		$xml=$xml.	'</CreditCard>
				   </PaymentMech>
				  </Consumer> 
				  <Transaction>
				   <Type DataType="String">Auth</Type>
				   <CurrentTotals>
					<Totals>
					 <Total DataType="Money" Currency="826">' . $this->xmldata['total'] . '</Total> 
					</Totals>
				   </CurrentTotals>';

					$xml=$xml. $this->pass_result_xml();

					$xml=$xml.'</Transaction>
					<BillTo>
						<Location>
						<Email>' . $this->xmldata['email'] . '</Email>
						<Address>
							<Name DataType="String">' . $this->xmldata['name'] . '</Name>
							<Street1 DataType="String">' . $this->xmldata['street1'] . '</Street1>
							<Street2 DataType="String">' . $this->xmldata['street2'] . '</Street2>
							<City DataType="String" >' . $this->xmldata['city'] . '</City>
							<StateProv DataType="String" >' . $this->xmldata['stateprov'] . '</StateProv>
							<PostalCode DataType="String">' . $this->xmldata['postalcode'] . '</PostalCode>
							<Country DataType="String">' . $this->xmldata['country'] . '</Country>
						</Address>
						</Location>
					</BillTo>
					</OrderFormDoc>
					</EngineDoc>
					</EngineDocList>';

		return $xml;
	}

	/**
	 *  Update API XML based on PASS parameter
	 */
	function pass_result_xml()
	{
		$xml = "";
			  switch($this->ccparesultscode)
			   {
				case 0:
					$xml=$xml.'<PayerSecurityLevel DataType="S32">2</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String">'.urlencode($this->cavv).'</PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String">'.urlencode($this->xid).'</PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32">13</CardholderPresentCode>';
				break;
				case 1:
					$xml=$xml.'<PayerSecurityLevel DataType="S32">5</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32">13</CardholderPresentCode>';
				break;
				case 2:
					$xml=$xml.'<PayerSecurityLevel DataType="S32">1</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32">13</CardholderPresentCode>';
				break;
				case 3:
					$xml=$xml.'<PayerSecurityLevel DataType="S32">6</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String">'.urlencode($this->cavv).'</PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String">'.urlencode($this->xid).'</PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32">13</CardholderPresentCode>';
				break;
				case 4:
					$xml=$xml.'<PayerSecurityLevel DataType="S32">4</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				break;
				case 5:
					$xml=$xml.'<PayerSecurityLevel DataType="S32"></PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				break;
				case 6:
					$xml=$xml.'<PayerSecurityLevel DataType="S32"></PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				break;
				case 7:
					 $xml=$xml.'<PayerSecurityLevel DataType="S32">4</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				 break;
				case 8:
					$xml=$xml.'<PayerSecurityLevel DataType="S32">4</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				 break;
				case 9:
					$xml=$xml.'<PayerSecurityLevel DataType="S32">4</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				break;
				case 10:
					 $xml=$xml.'<PayerSecurityLevel DataType="S32">4</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				break;
				case 11:
					 $xml=$xml.'<PayerSecurityLevel DataType="S32">4</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				break;
				case 12:
					$xml=$xml.'<PayerSecurityLevel DataType="S32">4</PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				break;
				case 14:
					$xml=$xml.'<PayerSecurityLevel DataType="S32"></PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32">14</CardholderPresentCode>';
				break;
				default:
					$xml=$xml.'<PayerSecurityLevel DataType="S32"></PayerSecurityLevel>';
					$xml=$xml.'<PayerAuthenticationCode DataType="String"></PayerAuthenticationCode>';
					$xml=$xml.'<PayerTxnId DataType="String"></PayerTxnId>';
					$xml=$xml.'<CardholderPresentCode DataType="S32"></CardholderPresentCode>';
				break;
					
			} 
		return $xml;
	}

	/**
	 * Execute API XMLS
	 */
	function execute_api()
	{
		$xml = $this->get_api_xml();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$price = 100;
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		ob_start();
		$result_xml = curl_exec($ch);
		curl_close ($ch);
		ob_end_clean();
		
		if( $this->debug )
		{
			return $result_xml;
		}
		else
		{
			return $this->get_value_by_tag_Name( $result_xml, '<TransactionStatus DataType="String">', '</TransactionStatus>');
		}
	}

	/**
	 * A simple process to retrive XML data
	 */
	function get_value_by_tag_Name( $str, $s_tag, $e_tag)
	{
		$s = strpos( $str,$s_tag) + strlen( $s_tag);
		$e = strlen( $str);
		$str= substr($str, $s, $e);				
		$e = strpos( $str,$e_tag);
		$str= substr($str,0, $e);
		$str= substr($str,0, $e);				
		return  $str;
	}
}
?>
