<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SyncAPI extends CI_Controller {
	
	var $_response;
	
	function SyncAPI(){
		
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
	

	function gallerylist(){
		$this->load->model('artwork_model');
		$this->_response->data = $this->artwork_model->Get(array('sortBy'=>$this->artwork_model->_ds(),'sortDirection'=>'DESC'));
		
		$this->_JSONout();
	}
	
	function prod(){
		
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		
		$this->load->model('prod_model');
		foreach( $obj as $prod ){
			$tmprec = $this->prod_model->Get(get_object_vars($prod));
			if(count($tmprec) <= 0) $this->prod_model->Add($prod);
		}
		
		//$this->_response->data = ;
		$this->_JSONout();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
