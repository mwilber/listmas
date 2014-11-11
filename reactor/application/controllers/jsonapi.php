<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JSONAPI extends CI_Controller {

	var $_response;

	function JSONAPI(){

		parent::__construct();

		$this->load->model('user_model');

		$this->_response = new stdClass();
		$this->_response->error = new stdClass();

		$this->_response->error->type = 0;
		$this->_response->error->message = "";

	}

	function _JSONout(){
		//header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		echo json_encode($this->_response);
	}

	function _HandleSession($pUserToken = ""){
		if($this->session->userdata('userId') == "" && $pUserToken != ""){
			//Try to restore the user session here
			$this->load->helper('idobfuscator_helper');
			$pUserToken = IdObfuscator::decode($pUserToken);
			$this->user_model->Restore(array('userToken'=>$pUserToken));
		}
		if($this->session->userdata('userId') == ""){
			$this->_response->error->type = -1;
			$this->_response->error->message = "Not logged in";
			return false;
		}else{
			return true;
		}
	}

	function testscan(){
		$this->load->helper('simple_html_dom');

		$html = new simple_html_dom();

		$this->_response->data = new stdClass();
		//$html->load_file('http://www.upcdatabase.com/item/'.$_GET['u']);
		$html->load_file('http://www.upcdatabase.com/item/725439101325');

		# get an element representing the second paragraph
		foreach( $html->find("table.data tr") as $tr ){
			//foreach( $tr->find("td") as $td ){
				if( $tr->children(0)->innertext == "Description" ){
					$description = html_entity_decode($tr->children(2)->innertext);
				}
				if( $tr->children(0)->innertext == "Size/Weight" ){
					$sizeweight = html_entity_decode($tr->children(2)->innertext);
				}
			//}
		}

		$prodData = array('prodName'=>$description, 'prodSize'=>floatval($sizeweight), 'prodUnit'=>trim(str_replace(floatval($sizeweight), "", $sizeweight)));

	}


	function upcscan_old($pUpc){
		$this->load->model('prod_model');

		$tmprec = $this->prod_model->Get(array('prodUpc'=>$pUpc));

		if(count($tmprec) > 0){
			$this->_response->data = $tmprec[0];
		}else{
			// Look up the UPC and store it
			$this->load->helper('simple_html_dom');

			$html = new simple_html_dom();

			$html->load_file('http://www.upcdatabase.com/item/'.$pUpc);
			//$html->load_file('http://www.upcdatabase.com/item/725439101325');

			# get an element representing the second paragraph
			foreach( $html->find("table.data tr") as $tr ){
				//foreach( $tr->find("td") as $td ){
					if( $tr->children(0)->innertext == "Description" ){
						$description = html_entity_decode($tr->children(2)->innertext);
					}
					//if( $tr->children(0)->innertext == "Size/Weight" ){
					//	$sizeweight = html_entity_decode($tr->children(2)->innertext);
					//}
				//}
			}

			$prodData = array('prodName'=>$description, 'prodUpc'=>$pUpc);
			$nId = $this->prod_model->Add($prodData);
			$this->_response->data = $this->prod_model->Get(array('prodId'=>$nId));
		}

		$this->_JSONout();
	}

	function azsearch($pSearch = ""){
		$url="http://ecs.amazonaws.com/onca/xml?".
			"Service=AWSECommerceService&".
			"AWSAccessKeyId=AKIAJNX6ZS7EMGNEGMFQ&".
			"AssociateTag=listmas04-20&".
			"Operation=ItemSearch&".
			"Keywords=".urlencode($pSearch)."&".
			/*"IdType=UPC&".
			"ItemId=".$pUpc."&".*/
			"SearchIndex=All&".
			//"BrowseNode=XXX&".
			//"sort=XXX&".
			"ResponseGroup=Medium";

		//echo $url;

		$secret = 'A2LBiaHMB8ZI3/koCja2ilE3LjkgmeqJWtiYGi4Z';
		$host = parse_url($url,PHP_URL_HOST);
		$timestamp = gmstrftime("%Y-%m-%dT%H:%M:%S.000Z");
		$url=$url. "&Timestamp=" . $timestamp;
		$paramstart = strpos($url,"?");
		$workurl = substr($url,$paramstart+1);
		$workurl = str_replace(",","%2C",$workurl);
		$workurl = str_replace(":","%3A",$workurl);
		$workurl = str_replace("+","%20",$workurl);
		$params = explode("&",$workurl);
		sort($params);
		//print_r($params);
		$signstr = "GET\n" . $host . "\n/onca/xml\n" . implode("&",$params);
		$signstr = base64_encode(hash_hmac('sha256', $signstr, $secret, true));
		$signstr = urlencode($signstr);
		$signedurl = $url . "&Signature=" . $signstr;
		$request = $signedurl;

		//echo $request;
		//die;

		$response = simplexml_load_file($request);

		//print_r($response->Items->Item[0]->DetailPageURL);
		//die;

		if( isset($response->Items->Item[0]->ItemAttributes->Title ) ){

			$this->_response->data = array();

			for( $idx=0; $idx<10; $idx++){
				if( isset($response->Items->Item[$idx]->ItemAttributes->Title) ){
					$description = (string)$response->Items->Item[$idx]->ItemAttributes->Title;
					if( isset($response->Items->Item[$idx]->MediumImage->URL) ) $image = (string)$response->Items->Item[$idx]->MediumImage->URL;
					if( isset($response->Items->Item[$idx]->DetailPageURL) ) $pUrl = (string)$response->Items->Item[$idx]->DetailPageURL;

					$prodData = array('prodName'=>$description, 'prodPhoto'=>$image, 'prodUrl'=>$pUrl);
					array_push($this->_response->data, (object)$prodData);
					//$nId = $this->upc_model->Add($prodData);
					//$this->_response->data = $this->upc_model->Get(array('upcId'=>$nId));
					//$tmpUpc[0]->prodName = $tmpUpc[0]->upcName;
					//$this->_response->data = $tmpUpc;
				}
			}
		}

		$this->_JSONout();
	}

	function qrscan($pQr){

		$this->load->helpers('idobfuscator_helper');
		$this->load->model('prod_model');

		$pQr = IdObfuscator::decode($pQr);

		$this->_response->data = $this->prod_model->Get(array('prodId'=>$pQr));

	}

	function upcscan($pUpc = "999", $pQr = ""){

		if ($pUpc == "qr") {
		    $this->qrscan($pQr);
		}else{

		$this->load->model('upc_model');

		$tmprec = $this->upc_model->Get(array('upcUpc'=>$pUpc));

		if(count($tmprec) > 0){
		//if(false){
			$this->_response->data = $tmprec[0];
		}else{
			$description = "";
			$image = "";
			$pUrl = "";

			$url="http://ecs.amazonaws.com/onca/xml?".
				"Service=AWSECommerceService&".
				"AWSAccessKeyId=AKIAJNX6ZS7EMGNEGMFQ&".
				"AssociateTag=listmas04-20&".
				"Operation=ItemLookup&".
				"IdType=UPC&".
				"ItemId=".$pUpc."&".
				"SearchIndex=All&".
				//"BrowseNode=XXX&".
				//"sort=XXX&".
				"ResponseGroup=Medium";

			$secret = 'A2LBiaHMB8ZI3/koCja2ilE3LjkgmeqJWtiYGi4Z';
			$host = parse_url($url,PHP_URL_HOST);
			$timestamp = gmstrftime("%Y-%m-%dT%H:%M:%S.000Z");
			$url=$url. "&Timestamp=" . $timestamp;
			$paramstart = strpos($url,"?");
			$workurl = substr($url,$paramstart+1);
			$workurl = str_replace(",","%2C",$workurl);
			$workurl = str_replace(":","%3A",$workurl);
			$params = explode("&",$workurl);
			sort($params);
			$signstr = "GET\n" . $host . "\n/onca/xml\n" . implode("&",$params);
			$signstr = base64_encode(hash_hmac('sha256', $signstr, $secret, true));
			$signstr = urlencode($signstr);
			$signedurl = $url . "&Signature=" . $signstr;
			$request = $signedurl;

			//echo $request;
			//die;

			$response = simplexml_load_file($request);

			if( !isset($response->Items->Item[0]) ){
					// Try looking for ISBN
					$url="http://ecs.amazonaws.com/onca/xml?".
						"Service=AWSECommerceService&".
						"AWSAccessKeyId=AKIAJNX6ZS7EMGNEGMFQ&".
						"AssociateTag=listmas04-20&".
						"Operation=ItemLookup&".
						"IdType=ISBN&".
						"ItemId=".$pUpc."&".
						"SearchIndex=All&".
						//"BrowseNode=XXX&".
						//"sort=XXX&".
						"ResponseGroup=Medium";

					$secret = 'A2LBiaHMB8ZI3/koCja2ilE3LjkgmeqJWtiYGi4Z';
					$host = parse_url($url,PHP_URL_HOST);
					$timestamp = gmstrftime("%Y-%m-%dT%H:%M:%S.000Z");
					$url=$url. "&Timestamp=" . $timestamp;
					$paramstart = strpos($url,"?");
					$workurl = substr($url,$paramstart+1);
					$workurl = str_replace(",","%2C",$workurl);
					$workurl = str_replace(":","%3A",$workurl);
					$params = explode("&",$workurl);
					sort($params);
					$signstr = "GET\n" . $host . "\n/onca/xml\n" . implode("&",$params);
					$signstr = base64_encode(hash_hmac('sha256', $signstr, $secret, true));
					$signstr = urlencode($signstr);
					$signedurl = $url . "&Signature=" . $signstr;
					$request = $signedurl;

					//echo $request;
					//die;

					$response = simplexml_load_file($request);
			}

			//print_r($response);
			//die;

			if( isset($response->Items->Item[0]->ItemAttributes->Title) ){
				$description = $response->Items->Item[0]->ItemAttributes->Title;
				if( isset($response->Items->Item[0]->MediumImage->URL) ) $image = $response->Items->Item[0]->MediumImage->URL;
				if( isset($response->Items->Item[0]->DetailPageURL) ) $pUrl = $response->Items->Item[0]->DetailPageURL;

				$prodData = array('upcName'=>$description, 'upcPhoto'=>$image, 'upcUrl'=>$pUrl, 'upcUpc'=>$pUpc);
				$nId = $this->upc_model->Add($prodData);
				$this->_response->data = $this->upc_model->Get(array('upcId'=>$nId));
				//$tmpUpc[0]->prodName = $tmpUpc[0]->upcName;
				//$this->_response->data = $tmpUpc;
			}
		}

		//print_r($this->_response);
		//die;

		$tmpProd = new stdClass();
		if( isset($this->_response->data->upcName) ) $tmpProd->prodName = $this->_response->data->upcName; else $tmpProd->prodName = null;
		if( isset($this->_response->data->upcDescription) ) $tmpProd->prodDescription = $this->_response->data->upcDescription; else $tmpProd->prodDescription = null;
		if( isset($this->_response->data->upcPhoto) ) $tmpProd->prodPhoto = $this->_response->data->upcPhoto; else $tmpProd->prodPhoto = null;
		if( isset($this->_response->data->upcUrl) ) $tmpProd->prodUrl = $this->_response->data->upcUrl; else $tmpProd->prodUrl = null;
		if( isset($this->_response->data->upcUpc) ) $tmpProd->prodUpc = $this->_response->data->upcUpc; else $tmpProd->prodUpc = null;
		$this->_response->data = $tmpProd;

		}

		$this->_JSONout();
	}

	function aztest(){
		$this->load->helper('aws_signed_request');

		$public_key = 'AKIAJNX6ZS7EMGNEGMFQ';
		$private_key = 'A2LBiaHMB8ZI3/koCja2ilE3LjkgmeqJWtiYGi4Z';
		$associate_tag = 'listmas04-20';

		// generate signed URL
		$request = aws_signed_request('com', array(
		        'Operation' => 'ItemSearch',
		        'Keywords' => '017754155993',
				'AssociateTag' => 'listmas04-20'), $public_key, $private_key, $associate_tag);

		// do request (you could also use curl etc.)
		$response = @file_get_contents($request);
		print_r($response);
		if ($response === FALSE) {
		    echo "Request failed.\n";
		} else {
		    // parse XML
		    $pxml = simplexml_load_string($response);
		    if ($pxml === FALSE) {
		        echo "Response could not be parsed.\n";
		    } else {
		        if (isset($pxml->Items->Item->ItemAttributes->Title)) {
		            echo $pxml->Items->Item->ItemAttributes->Title, "\n";
		        }
		    }
		}
	}

	function aztestb(){
		$url="http://ecs.amazonaws.com/onca/xml?".
			"Service=AWSECommerceService&".
			"AWSAccessKeyId=AKIAJNX6ZS7EMGNEGMFQ&".
			"AssociateTag=listmas04-20&".
			"Operation=ItemSearch&".
			"Keywords=017754155993&".
			"SearchIndex=All";
			//"BrowseNode=XXX&".
			//"sort=XXX&".
			//"ResponseGroup=XXX";

		$secret = 'A2LBiaHMB8ZI3/koCja2ilE3LjkgmeqJWtiYGi4Z';
		$host = parse_url($url,PHP_URL_HOST);
		$timestamp = gmstrftime("%Y-%m-%dT%H:%M:%S.000Z");
		$url=$url. "&Timestamp=" . $timestamp;
		$paramstart = strpos($url,"?");
		$workurl = substr($url,$paramstart+1);
		$workurl = str_replace(",","%2C",$workurl);
		$workurl = str_replace(":","%3A",$workurl);
		$params = explode("&",$workurl);
		sort($params);
		$signstr = "GET\n" . $host . "\n/onca/xml\n" . implode("&",$params);
		$signstr = base64_encode(hash_hmac('sha256', $signstr, $secret, true));
		$signstr = urlencode($signstr);
		$signedurl = $url . "&Signature=" . $signstr;
		$request = $signedurl;

		$response = simplexml_load_file($request);

		//print_r($response->Items->Item[0]->ItemAttributes->Title);

		echo $response->Items->Item[0]->ItemAttributes->Title;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
                                      