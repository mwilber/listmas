<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prod extends CI_Controller
{
	var $profile = array(
        'model' => 'prod_model',
        );
	
	// Create
	function add($pFormat="html")
	{
		$model_ref = $this->profile['model'];
		$this->load->model($model_ref); 
	    
		
		$data['format'] = $pFormat;
		$data['fields'] = $this->$model_ref->_fields();
		$data['lookups'] = array();
		
		foreach( $this->$model_ref->_fields() as $name=>$props ){
			if(substr_compare($name, 'Id', -2, 2) === 0){
				if(file_exists(APPPATH."models/".substr($name, 0, -2)."_model.php")){
					// Load up dropdown menu data for join fields
					$modelName = substr($name, 0, -2)."_model";
					$this->load->model($modelName);
					$data['lookups'][$name] = $this->$modelName->_GetRef();
				}
			}
		}
		
	    // Validate form
	    $this->form_validation->set_rules($this->$model_ref->_rq(), 'required', 'trim|required');
	    
	    if($this->form_validation->run())
	    {
	    	
			
			//////////////////////////////////////////////////////////////////////
	    	// Do any record preprocessing here
	    	//////////////////////////////////////////////////////////////////////
	    	
	    	
	    	
	    	
	    	
	    	
	    	
	    	
			
	        // Validation passes
	        $nId = $this->$model_ref->Add($_POST);
	        
			if($pFormat == "html"){
				if($nId)
		        {
		            $this->session->set_flashdata('flashConfirm', 'The item has been successfully added.');
		           redirect($this->uri->segment(1));
		        }
		        else
		        {
	                $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
		            redirect($this->uri->segment(1));
		        }
			}elseif($pFormat == "xml"){
				// TODO: see if we can redirect with flash
				//redirect($this->uri->segment(1)."/details/xml/".$nId);
				
				$this->details("xml", $nId);
			}
	    }else{
	    	$this->load->view('template/template_head');
		    $this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_add_form', $data);
			$this->load->view('template/template_foot');	
	    }
	}

	function asin($pFormat="html")
	{
		$model_ref = $this->profile['model'];
		$this->load->model($model_ref); 
	    
		
		$data['format'] = $pFormat;
		$data['fields'] = $this->$model_ref->_fields();
		$data['lookups'] = array();
		
		foreach( $this->$model_ref->_fields() as $name=>$props ){
			if(substr_compare($name, 'Id', -2, 2) === 0){
				if(file_exists(APPPATH."models/".substr($name, 0, -2)."_model.php")){
					// Load up dropdown menu data for join fields
					$modelName = substr($name, 0, -2)."_model";
					$this->load->model($modelName);
					$data['lookups'][$name] = $this->$modelName->_GetRef();
				}
			}
		}
		
	    // Validate form
	    $this->form_validation->set_rules($this->$model_ref->_rq(), 'required', 'trim|required');
	    
	    if(true)
	    {
	    	
			
			//////////////////////////////////////////////////////////////////////
	    	// Do any record preprocessing here
	    	//////////////////////////////////////////////////////////////////////
	    	$_POST['prodName'] = "";
	    	$_POST['prodDescription'] = "";
			$_POST['prodPhoto'] = "";
			$_POST['prodUrl'] = "";
			
			$url="http://ecs.amazonaws.com/onca/xml?".
				"Service=AWSECommerceService&".
				"AWSAccessKeyId=AKIAJNX6ZS7EMGNEGMFQ&".
				"AssociateTag=listmas-20&".
				"Operation=ItemLookup&".
				"IdType=ASIN&".
				"ItemId=".$_POST['asin']."&".
				//"SearchIndex=All&".
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
				
			$response = simplexml_load_file($request);
			
			//print_r($response);
			//die;
			
			if( isset($response->Items->Item[0]->ItemAttributes->Title) ){
				$_POST['prodName'] = $response->Items->Item[0]->ItemAttributes->Title;
				if( isset($response->Items->Item[0]->MediumImage->URL) ) $_POST['prodPhoto'] = $response->Items->Item[0]->MediumImage->URL;
				if( isset($response->Items->Item[0]->DetailPageURL) ) $_POST['prodUrl'] = $response->Items->Item[0]->DetailPageURL;
			
				//$prodData = array('upcName'=>$description, 'upcPhoto'=>$image, 'upcUrl'=>$pUrl, 'upcUpc'=>$pUpc);		
				//$nId = $this->upc_model->Add($prodData);
				//$this->_response->data = $this->upc_model->Get(array('upcId'=>$nId));
				//$tmpUpc[0]->prodName = $tmpUpc[0]->upcName;
				//$this->_response->data = $tmpUpc;
			}
	    	unset($_POST['asin']);
			
	        // Validation passes
	        $nId = $this->$model_ref->Add($_POST);
	        
			if($pFormat == "html"){
				if($nId)
		        {
		            $this->session->set_flashdata('flashConfirm', 'The item has been successfully added.');
		           redirect($this->uri->segment(1));
		        }
		        else
		        {
	                $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
		            redirect($this->uri->segment(1));
		        }
			}elseif($pFormat == "xml"){
				// TODO: see if we can redirect with flash
				//redirect($this->uri->segment(1)."/details/xml/".$nId);
				
				$this->details("xml", $nId);
			}
	    }else{
	    	$this->load->view('template/template_head');
		    $this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_add_form', $data);
			$this->load->view('template/template_foot');	
	    }
	}
	
    // Retrieve
	function index($pFormat="html")
	{
		$model_ref = $this->profile['model'];
		$this->load->model($model_ref); 
	    
		$data['total_rows'] = $this->$model_ref->Get(array('count' => true));
		$data['records'] = $this->$model_ref->Get(array('sortBy'=>$this->$model_ref->_ds(),'sortDirection'=>'DESC'));
		$data['fields'] = $this->$model_ref->_fields();
		$data['pk'] = $this->$model_ref->_pk();
		
		if($pFormat == "html"){
			if( $this->session->userdata('userEmail') ){
				$this->load->view('template/template_head');
				$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_index', $data);
				$this->load->view('template/template_foot');
			}else{
				redirect('admin/login');
			}
			
		}elseif($pFormat == "xml"){
			$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_index_xml', $data);
		}
		
		
	}
	
	function detail($pId=0,$pFormat="html"){
		$model_ref = $this->profile['model'];
		$this->load->model($model_ref); 
		$data['record'] = $this->$model_ref->Get(array($this->$model_ref->_pk()=>$pId));
		
		if( $pFormat=='json' ){
			header('Content-type: application/json');
			echo json_encode($data['record']);
		}elseif( $pFormat=='html' ){
			echo '<ul>';
			foreach(get_object_vars($data['record']) as $field=>$value){
				echo "<li>{$field}: {$value}</li>";
			}
			echo '</ul>';
		}
	}

	
	function csv($pFormat="html")
	{
		$model_ref = $this->profile['model'];
		$this->load->model($model_ref); 
	    
	    
		$data['total_rows'] = $this->$model_ref->Get(array('count' => true));
		$data['records'] = $this->$model_ref->Get(array('sortBy'=>$this->$model_ref->_ds(),'sortDirection'=>'ACS'));
		$data['fields'] = $this->$model_ref->_fields();
		$data['pk'] = $this->$model_ref->_pk();
		
		$header = "";
		$filedata = "";
		foreach($data['records'][0] as $name=> $value)
		{
		    $header .= $name . "\t";
		}
		
		foreach($data['records'] as $row)
		{
		    $line = '';
		    foreach( $row as $value )
		    {                                            
		        if ( ( !isset( $value ) ) || ( $value == "" ) )
		        {
		            $value = "\t";
		        }
		        else
		        {
		            $value = str_replace( '"' , '""' , $value );
		            $value = '"' . $value . '"' . "\t";
		        }
		        $line .= $value;
		    }
		    $filedata .= trim( $line ) . "\n";
		}
		$filedata = str_replace( "\r" , "" , $filedata );
		
		if ( $filedata == "" )
		{
		    $filedata = "\n(0) Records Found!\n";                        
		}
		
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$this->uri->segment(1)."_export.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header\n$filedata";
				
		
		
	}

	
	function paginated($offset = 0)
	{
		$model_ref = $this->profile['model'];
		$this->load->model($model_ref); 
	    
	    $this->load->library('pagination');
	    
	    $perpage = 10;
		
	    $config['base_url'] = base_url() . $this->uri->segment(1).'/index/';
	    $config['total_rows'] = $this->$model_ref->Get(array('count' => true));
	    $config['per_page'] = $perpage;
	    $config['uri_segment'] = 3;
	    
	    $this->pagination->initialize($config);
	    
	    $data['pagination'] = $this->pagination->create_links();
	    
		$data[$this->uri->segment(1)] = $this->$model_ref->Get(array('sortBy'=>'order','sortDirection'=>'ASC','limit' => $perpage, 'offset' => $offset));
		$data['fields'] = $this->$model_ref->_fields();
		$data['pk'] = $this->$model_ref->_pk();
		
		$this->load->view('template/template_head');
		$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_paginated', $data);
		$this->load->view('template/template_foot');
		
	}
	
	// Update
	function edit($recordId)
	{
		$model_ref = $this->profile['model'];
		$this->load->model($model_ref); 
		
		$data['fields'] = $this->$model_ref->_fields();
		$data['pk'] = $this->$model_ref->_pk();
		$data['rq'] = $this->$model_ref->_rq();
		
		$data['lookups'] = array();
		
		foreach( $this->$model_ref->_fields() as $name=>$props ){
			if(substr_compare($name, 'Id', -2, 2) === 0){
				if(file_exists(APPPATH."models/".substr($name, 0, -2)."_model.php")){
					// Load up dropdown menu data for join fields
					$modelName = substr($name, 0, -2)."_model";
					$this->load->model($modelName);
					$data['lookups'][$name] = $this->$modelName->_GetRef();
				}
			}
		}
	    
		$data['record'] = $this->$model_ref->Get(array($this->$model_ref->_pk() => $recordId));
	    if(!$data['record']) redirect($this->uri->segment(1));
		
		// Validate form
	    $this->form_validation->set_rules($this->$model_ref->_rq(), 'required', 'trim|required');
	    
	    if($this->form_validation->run())
		{
	        // Validation passes
	        $_POST[$this->$model_ref->_pk()] = $recordId;
	        
	        if($this->$model_ref->Update($_POST))
	        {
	            $this->session->set_flashdata('flashConfirm', 'The user has been successfully updated.');
	            redirect($this->uri->segment(1));
	        }
	        else
	        {
                $this->session->set_flashdata('flashError', 'A database error has occured, please contact your administrator.');
	            redirect($this->uri->segment(1));
	        }
	    }
		
		$this->load->view('template/template_head');
		$this->load->view($this->uri->segment(1).'/'.$this->uri->segment(1).'_edit_form', $data);
		$this->load->view('template/template_foot');
	}
	
	// Delete
	function delete($recordId)
	{
		$model_ref = $this->profile['model'];
		$this->load->model($model_ref); 
	    
	    $data['record'] = $this->$model_ref->Get(array($this->$model_ref->_pk() => $recordId));
	    if(!$data['record']) redirect($this->uri->segment(1));
	    
	    $this->$model_ref->Delete($recordId);
	    
	    $this->session->set_flashdata('flashConfirm', 'The user has been successfully deleted.');
	    redirect($this->uri->segment(1));
	}
}