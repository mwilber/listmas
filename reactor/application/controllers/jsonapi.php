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
		header('Access-Control-Allow-Origin: *');
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
	

	function upcscan($pUpc){
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
					if( $tr->children(0)->innertext == "Size/Weight" ){
						$sizeweight = html_entity_decode($tr->children(2)->innertext);
					}
				//}
			}
			
			$prodData = array('prodName'=>$description, 'prodSize'=>floatval($sizeweight), 'prodUnit'=>trim(str_replace(floatval($sizeweight), "", $sizeweight)), 'prodUpc'=>$pUpc);		
			$nId = $this->prod_model->Add($prodData);
			$this->_response->data = $this->prod_model->Get(array('prodId'=>$nId));
		}
		
		$this->_JSONout();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
