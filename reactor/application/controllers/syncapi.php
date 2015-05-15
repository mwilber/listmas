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
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
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

	function _ProcessProd($pProd){

		$pProd->prodRemoteId = $pProd->prodId;
		unset($pProd->prodId);

		if( strpos($pProd->prodPhoto, "data:image/png;base64,") === 0 ){
			// Process the photo
			$imageData = explode('base64,',$pProd->prodPhoto);
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


			$pProd->prodPhoto = $this->s3->upload(UPLOAD_DIR."/".$imageData, $imageData);
		}

		return $pProd;
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

	function mosaic($pId){
		$this->load->model('prodlist_model');
		$this->load->helper('imageworkshop_helper');
		$this->load->library('s3');

		$slTmp = $this->prodlist_model->GetWithDetails(array('tblProdlist.shopListId'=>$pId));
		$this->_response->data = $slTmp;

		$mw = 360;
		$tc = 3;

		$twitterLayer = new ImageWorkshop(array(
		    'width' => $mw,
			'height' => $mw,
			'backgroundColor' => 'e3343f'
		));

		$logoLayer = new ImageWorkshop(array(
			'imageFromPath' => "../images/logo.png",
		));
		$logoLayer->resizeInPixel(($mw/$tc)-24, null, true);
		$twitterLayer->addLayer(0, $logoLayer, floor($tc/2)*($mw/$tc)+12, floor($tc/2)*($mw/$tc)+12, "LT");


		$tp = 0;
		//Get the number of gaps
		//echo ($tc*$tc)-(count($slTmp)+1);
		if(($tc*$tc)-(count($slTmp)+1) > 0) $tp++;

		for($idx = 0; $idx<count($slTmp); $idx++){
			if( $idx > ($tc*$tc) ) break;
			$filename = date("U")."_".rand(100, 999).".jpg";
			file_put_contents(UPLOAD_DIR."/".$filename, file_get_contents($slTmp[$idx]->prodPhoto));
			$tileLayer = new ImageWorkshop(array(
			    'imageFromPath' => UPLOAD_DIR."/".$filename,
			));
			//echo (($mw/$tc)*floor($idx/$tc))."|";
			$tileLayer->cropInPixel(($mw/$tc), ($mw/$tc), 0, 0, 'MM');
			$twitterLayer->addLayer(($idx+1), $tileLayer, (($mw/$tc)*($tp%$tc)), (($mw/$tc)*floor($tp/$tc)), "LT");

			$tp++;
			if( $tp == (floor(($tc*$tc)/2)) ) $tp++;
			if(($tc*$tc)-(count($slTmp)+1) > 0){
				if( $tp%(floor( ($tc*$tc)/(($tc*$tc)-(count($slTmp)+1)) )) == 0) $tp++;
			}
			//if( $tp == floor(($tc*$tc)/(($tc*$tc)-(count($slTmp)+1)))+1  ) $tp++;
			//if( $tp%(($tc*$tc)-(count($slTmp)+1)) == 0 ) $tp++;
		}

		//
		//	echo $prod->prodPhoto;
		//}
		$imageData = date("U")."_".rand(100, 999).".jpg";
		$image = $twitterLayer->getResult();
		$twitterLayer->save(UPLOAD_DIR."/", $imageData, CREATE_FOLDERS, 'e3343f', 100);


		$remotefile = $this->s3->upload(UPLOAD_DIR."/".$imageData, $imageData);

		//header('Content-type: image/jpeg');
		//imagejpeg($image, null, 95); // We chose to show a JPG with a quality of 95%

		//Delete all the temp files
		foreach(glob(UPLOAD_DIR.'/*_*.jpg') as $file)
		    if(is_file($file))
		        @unlink($file);

		//echo $remotefile;
		return $remotefile;
		//$this->_JSONout();
	}

	function shoplist(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$listCode = "";

		$this->load->helper('ImageWorkshop');
		$this->load->helpers('idobfuscator_helper');
		$this->load->library('s3');

		$this->load->model('prod_model');
		$this->load->model('prodlist_model');
		$this->load->model('shoplist_model');

			if( intval($obj->list->shoplistId) <= 0 ){
				$slId = $this->shoplist_model->Add(array('shopListName'=>$obj->list->shoplistName));
				$this->shoplist_model->Update(array('shopListId'=>$slId,'shopListCode'=>IdObfuscator::encode($slId)));
			}else{
				$slId = intval($obj->list->shoplistId);
			}
			$slTmp = $this->shoplist_model->Get(array('shopListId'=>$slId));
			$slId = $slTmp->shopListId;
			$listCode = $slTmp->shopListCode;

			// Clear out existing prods
			//$this->prodlist_model->DeleteList($slId);

			$listRS = $this->prodlist_model->Get(array('shopListId'=>$slId));

			foreach( $listRS as $rsprod ){

				$foundRS = false;

				foreach( $obj->prod as $key=>$prod ){

					if( $prod->prodId == $rsprod->prodAppId ){

						$foundRS = true;
						$pId = $rsprod->prodId;
						$fprod = $this->_ProcessProd($prod);
						$fprod->prodId = $pId;

						$this->prod_model->UpdateB($fprod);
						unset($obj->prod[$key]);
						break;
					}
				}

				if( !$foundRS ){
					// Record not found in json so delete it
					$this->prod_model->Delete($rsprod->prodId);
					$this->prodlist_model->Delete($rsprod->prodListId);
				}
			}
			// Add in any new items
			foreach( $obj->prod as $key=>$prod ){
				$fprod = $this->_ProcessProd($prod);
				$pId = $this->prod_model->Add($fprod);
				$this->prodlist_model->Add(array('shoplistId'=>$slId,'prodId'=>$pId,'prodAppId'=>$prod->prodRemoteId));
			}

			//IdObfuscator::encode($nId)
			$this->_response->data = new stdClass();
			$this->_response->data->shoplistId = $slId;
			$this->_response->data->shoplistRemoteId = $obj->list->shoplistRemoteId;
			//$this->_response->data->shoplistUrl = IdObfuscator::encode($slId);
			$this->_response->data->shoplistUrl = $listCode;
			try{
				$this->_response->data->shareImage = $this->mosaic($slId);
			}catch(Exception $e){
				$this->_response->data->shareImage = "http://www.mylistmas.com/icons/icon_512.png";
			}


		$this->_JSONout();

		//list.shoplistId
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
