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
	
	function shoplist(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		
		$this->load->helper('ImageWorkshop');
		$this->load->helpers('idobfuscator_helper');
		$this->load->library('s3');
		
		$this->load->model('prod_model');
		$this->load->model('prodlist_model');
		$this->load->model('shoplist_model');
		
		if( $obj->list->shoplistId > 0 ){
			$slTmp = $this->shoplist_model->Get(array('shopListId'=>$obj->list->shoplistId));
			$slId = $slTmp->shopListId;
		}else{
			$slId = $this->shoplist_model->Add(array('shoplistName'=>$obj->list->shoplistName));
		}
		
		
		// Clear out existing prods
		$this->prodlist_model->DeleteList($slId);
		
		
		foreach( $obj->prod as $prod ){
			$prod->prodRemoteId = $prod->prodId;
			unset($prod->prodId);
			
			if( strpos($prod->prodPhoto, "data:image/png;base64,") === 0 ){
				// Process the photo
				$imageData = explode('base64,',$prod->prodPhoto); 
				$imageData = $this->prod_model->manageFile64($imageData[1], UPLOAD_DIR, '');
				
				
				$twitterLayer = new ImageWorkshop(array(
				    'imageFromPath' => UPLOAD_DIR."/".$imageData,
				));
				
				// Resize the image so the smallest dimension equals the desired dimension
				if( $twitterLayer->getWidth() > $twitterLayer->getHeight() ){
					$twitterLayer->resizeInPixel(null, 1024, true);
				}else{
					$twitterLayer->resizeInPixel(1024, null, true);
				}
				$twitterLayer->cropInPixel(1024, 1024, 0, 0, 'MM');
				
				$image = $twitterLayer->getResult();
	 
				//header('Content-type: image/jpeg');
				//imagejpeg($image, null, 95); // JPG with a quality of 95%
				$twitterLayer->save(UPLOAD_DIR."/", $imageData, CREATE_FOLDERS, BACKGROUND_COLOR, JPEG_IMAGE_QUALITY);
				
				
				$prod->prodPhoto = $this->s3->upload(UPLOAD_DIR."/".$imageData, $imageData);
			}
			
			$pId = $this->prod_model->Add($prod);
			$this->prodlist_model->Add(array('shoplistId'=>$slId,'prodId'=>$pId));
		}

		//IdObfuscator::encode($nId)
		$this->_response->data = new stdClass();
		$this->_response->data->shoplistId = $slId;
		$this->_response->data->shoplistRemoteId = $obj->list->shoplistRemoteId;
		$this->_response->data->shoplistUrl = IdObfuscator::encode($slId);
		
		
		$this->_JSONout();
		
		//list.shoplistId
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
