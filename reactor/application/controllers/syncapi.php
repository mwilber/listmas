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

		$slTmp = $this->prodlist_model->GetWithDetails(array('tblProdlist.shopListId'=>$pId,'sortBy'=>'prodQty','sortDirection'=>'DESC'));
		$this->_response->data = $slTmp;

		$mw = 510;
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
		//if(($tc*$tc)-(count($slTmp)+1) > 0) $tp++;

		for($idx = 0; $idx<count($slTmp); $idx++){
			if( $idx > ($tc*$tc) ) break;
			$filename = date("U")."_".rand(100, 999).".jpg";
			if($slTmp[$idx]->prodPhoto != ""){
				$size = getimagesize($slTmp[$idx]->prodPhoto);
				if( $size[0] > 0 ){
					file_put_contents(UPLOAD_DIR."/".$filename, file_get_contents($slTmp[$idx]->prodPhoto));
					$tileLayer = new ImageWorkshop(array(
					    'imageFromPath' => UPLOAD_DIR."/".$filename,
					));
					//echo (($mw/$tc)*floor($idx/$tc))."|";

					if( $tileLayer->getWidth() > $tileLayer->getHeight() && $tileLayer->getHeight() < ($mw/$tc) ){
						$tileLayer->resizeInPixel(null, ($mw/$tc)+50, true);
					}elseif( $tileLayer->getWidth() < ($mw/$tc) ){
						$tileLayer->resizeInPixel(($mw/$tc)+50, null, true);
					}

					$tileLayer->cropInPixel(($mw/$tc), ($mw/$tc), 0, 0, 'MM');
					$twitterLayer->addLayer(($idx+1), $tileLayer, (($mw/$tc)*($tp%$tc)), (($mw/$tc)*floor($tp/$tc)), "LT");

					$tp++;

					if( $tp >= (count($slTmp))/2 && $tp < ((count($slTmp))/2)+((($tc*$tc)-1)-count($slTmp)) ){
						$tp+=(($tc*$tc))-count($slTmp);
					}elseif($tp == (floor(($tc*$tc)/2))){
						$tp++;
					}
				}
			}
			// if(($tc*$tc)-(count($slTmp)+1) > 0){
			// 	//if( $tp%(floor( ($tc*$tc)/(($tc*$tc)-(count($slTmp)+1)) )) == 0) $tp++;
			//
			// 	if( $tp%(ceil( (($tc*$tc)-1)/((($tc*$tc-1))-count($slTmp)) )) == 0) $tp++;
			// }
			// if( $tp == (floor(($tc*$tc)/2)) ) $tp++;
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
		//$json = '{"list":{"shoplistId":2241,"shoplistName":"cmas","shoplistEnhanced":"1","shareImage":"","shoplistTheme":null,"shoplistRemoteId":13,"shoplistCheckoff":9991},"prod":[{"prodId":143,"prodName":"Nike Men\'s LeBron XI BHM, BHM-ANTHRACITE/METALLIC GOLD-PURPLE VENOM, 9 M US","prodPhoto":"","prodDescription":"","prodUrl":"http://www.amazon.com/Nike-LeBron-BHM-ANTHRACITE-METALLIC-GOLD-PURPLE/dp/B00I7BUPJA%3Fpsc%3D1%26SubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dmwilbercom-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D","prodUpc":"","prodQty":0},{"prodId":144,"prodName":"nike lebron XII EXT mens hi top trainers 748861 sneakers shoes (uk 9 us 9 eu 44, multi color university red white 900)","prodPhoto":"http://ecx.images-amazon.com/images/I/4170-eQrURL.jpg","prodDescription":"","prodUrl":"http://www.amazon.com/lebron-trainers-748861-sneakers-university/dp/B00PMPSZJG%3Fpsc%3D1%26SubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dmwilbercom-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D16595","prodUpc":"","prodQty":0},{"prodId":145,"prodName":"Nike Air Foamposite One Nrg Style: 521286-800 Size: 9","prodPhoto":"http://ecx.images-amazon.com/images/I/41I0M9FS0ML.jpg","prodDescription":"","prodUrl":"http://www.amazon.com/Nike-Air-Foamposite-One-Style/dp/B00CLVOOTO%3Fpsc%3D1%26SubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dmwilbercom-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeA","prodUpc":"","prodQty":0}]}';
		$obj = json_decode($json);
		$listCode = "";

		$this->load->helper('ImageWorkshop');
		$this->load->helpers('idobfuscator_helper');
		$this->load->library('s3');

		$this->load->model('prod_model');
		$this->load->model('prodlist_model');
		$this->load->model('shoplist_model');

		if(isset($obj->list)){

			if( !isset($obj->list->shoplistCheckoff) ) $obj->list->shoplistCheckoff = 0;
			if( !isset($obj->list->shoplistEnhanced) ) $obj->list->shoplistEnhanced = 0;
			if( !isset($obj->list->shoplistTheme) ) $obj->list->shoplistTheme = 0;

			if( intval($obj->list->shoplistId) <= 0 ){
				$slId = $this->shoplist_model->Add(array('shopListName'=>$obj->list->shoplistName,'shopListEnhanced'=>$obj->list->shoplistEnhanced,'shopListCheckoff'=>0));
				$this->shoplist_model->Update(array('shopListId'=>$slId,'shopListCode'=>IdObfuscator::encode($slId)));
			}else{
				$slId = intval($obj->list->shoplistId);
			}

			// Check the list xfer state
			$slTmp = $this->shoplist_model->Get(array('shopListId'=>$slId));

			if( $obj->list->shoplistCheckoff == $slTmp->shopListCheckoff ){

				if($obj->list->shoplistCheckoff > 0){
					// Wipe existing records
					//echo "xfer here";
					$this->prodlist_model->DeleteList($slId);
				}

				//echo $obj->list->shopListEnhanced;

				if( isset($obj->list->shoplistEnhanced) ){
					$this->shoplist_model->Update(array('shopListId'=>$slId,'shopListName'=>$obj->list->shoplistName,'shopListEnhanced'=>$obj->list->shoplistEnhanced));
				}
				if( isset($obj->list->shoplistTheme) ){
					$this->shoplist_model->Update(array('shopListId'=>$slId,'shopListName'=>$obj->list->shoplistName,'shopListTheme'=>$obj->list->shoplistTheme));
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

							if(isset($fprod->prodQty)){
								$this->prodlist_model->UpdateQty(array('prodQty'=>$fprod->prodQty,'prodId'=>$fprod->prodId,'shopListId'=>$slId));
								unset($fprod->prodQty);
							}

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
					$prodQty = 0;
					if(isset($fprod->prodQty)){
						$prodQty = $fprod->prodQty;
						unset($fprod->prodQty);
					}

					$pId = $this->prod_model->Add($fprod);
					$this->prodlist_model->Add(array('shoplistId'=>$slId,'prodId'=>$pId,'prodAppId'=>$prod->prodRemoteId, 'prodQty'=>$prodQty));
				}

				// Generate the mosiac
				try{
					$mosurl = $this->mosaic($slId);
				}catch(Exception $e){
					$mosurl = "http://www.mylistmas.com/icons/icon_512.png";
				}

				$this->shoplist_model->Update(array('shopListImage'=>$mosurl,'shopListId'=>$slId,'shopListCheckoff'=>0));

				//IdObfuscator::encode($nId)
				$this->_response->data = new stdClass();
				$this->_response->data->shoplistId = $slId;
				$this->_response->data->shoplistRemoteId = $obj->list->shoplistRemoteId;
				//$this->_response->data->shoplistUrl = IdObfuscator::encode($slId);
				$this->_response->data->shoplistUrl = $listCode;
				$this->_response->data->shoplistCheckoff = 0;

				$this->_response->data->shareImage = $mosurl;
			}else{
				$this->_response->error->type = -2;
				$this->_response->error->message = "Invalid Pin";
			}

		}else{
			$this->_response->error->type = -1;
			$this->_response->error->message = "No list data found";
		}
		$this->_JSONout();

		//list.shoplistId
	}


	function xferlist(){
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$listCode = "";

		$this->load->helpers('idobfuscator_helper');

		$this->load->model('shoplist_model');

		if(isset($obj->list)){

			$slId = intval($obj->list->shoplistId);

			// Set 4 digit number here
			$xferid = rand(1000, 9999);
			while(count($this->shoplist_model->Get(array('shopListCheckoff'=>$xferid))) > 0){
				$xferid = rand(1000, 9999);
			}
			$this->shoplist_model->Update(array('shopListId'=>$slId,'shopListCheckoff'=>$xferid));

			$this->_response->data = $this->shoplist_model->Get(array('shopListId'=>$slId));
		}
		$this->_JSONout();
	}

	function restorelist($pPin){

		$this->load->model('shoplist_model');
		$this->load->model('prodlist_model');

		if($pPin > 999){

			$this->_response->list = $this->shoplist_model->Get(array('shopListCheckoff'=>$pPin))[0];
			if(isset($this->_response->list->shopListId)){
				$this->_response->prod = $this->prodlist_model->GetWithDetails(array('tblProdlist.shopListId'=>$this->_response->list->shopListId));
			}
		}
		$this->_JSONout();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
