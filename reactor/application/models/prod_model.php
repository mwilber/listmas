<?php

class Prod_Model extends CI_Model
{
	var $table = "tblProd";
	var $pk = "prodId";
	var $ds = "prodTimeStamp";  //Default sortby field 
	var $rq = "prodName";		//Required field (you'll need to mod the form validation if there isn't one)
	var $fields = array(
		 'prodName' => array('label'=>'Name','type'=>'varchar','constraint'=>50),
		 'unitId' => array('label'=>'Unit','type'=>'int'),
		 'prodSize' => array('label'=>'Size','type'=>'decimal','constraint'=>'10,2'),
		 'prodUnit' => array('label'=>'Name','type'=>'varchar','constraint'=>20),
		 'prodUpc' => array('label'=>'UPC','type'=>'varchar','constraint'=>50),
		);
		
	//prodName TEXT, unitId INTEGER, prodSize REAL DEFAULT 0, prodUpc TEXT, prodTimeStamp INTEGER
				
	
	/** Utility Methods **/
	function _required($required, $data)
	{
		foreach($required as $field)
			if(!isset($data[$field])) return false;
			
		return true;
	}
	
	function _default($defaults, $options)
	{
		return array_merge($defaults, $options);
	}
	
	function _fields(){
		return $this->fields;
	}
	
	function _table(){
		return $this->table;
	}
	
	function _pk(){
		return $this->pk;
	}
	// Return default sort field
	function _ds(){
		return $this->ds;
	}
	// Return required field
	function _rq(){
		return $this->rq;
	}
	// Return an array of id and required field
	function _GetRef(){
		$this->db->select($this->pk.",".$this->rq);
		$query = $this->db->get($this->table);
		
		return $query->result_array();
	}
	
	
	/** CRUD Methods **/
	
	function Get($options = array()){
		
		foreach ($this->fields as $key => $value) {
			if(isset($options[$key]))
				$this->db->where($key, $options[$key]);
		}
		if(isset($options[$this->pk]))
				$this->db->where($this->pk, $options[$this->pk]);
		
		// limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'], $options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);
		
		// sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'], $options['sortDirection']);
		
		$query = $this->db->get($this->table);
		//echo "SQL:".$this->db->last_query();
		
		if(isset($options['count'])) return $query->num_rows();
		
		if(isset($options[$this->pk])) return $query->row(0);
			
		return $query->result();
	}
	
	function GetList($pListId){
		/*$sql = " a.prodId,a.prodName,a.prodQuantity,a.prodMultiple,a.prodPrice,a.prodCheckoff,a.prodSalePrice,a.unitId, ";
		$sql .= "(a.prodPrice/(a.prodQuantity*a.prodMultiple)) as unitPrice, ";
		$sql .= "(SELECT (b.prodPrice/(b.prodQuantity*b.prodMultiple)) as unitPriceB FROM tblProd AS b WHERE b.prodId = a.prodCompareId ) as prodCompare ";
		$sql .= "FROM `tblProd` AS a WHERE shoplistId = ".$pListId." ";
		$sql .= "ORDER BY a.prodCheckoff,".$this->_ds()." DESC";*/
		
/*SELECT a.prodId,a.prodName,a.prodQuantity,a.prodPrice,a.prodCheckoff,a.prodSalePrice,  
(b.prodPrice/(b.prodQuantity*b.prodMultiple)) as prodCompareUnitPrice, 
((b.prodPrice/(b.prodQuantity*b.prodMultiple)) * (a.prodQuantity*a.prodCheckoff)) as prodCompareSalePrice, 
FROM tblProd AS a, tblProd AS b WHERE b.prodId = a.prodCompareId AND a.shoplistId = 332*/
		
		$sql = "a.prodId,a.prodName,a.prodQuantity,a.prodPrice,a.unitId, a.shoplistId, a.profileId, a.prodCompareId, a.prodMultiple, a.prodCheckoff,a.prodSalePrice,  ";
		$sql .= "IFNULL((a.prodPrice/(a.prodQuantity*a.prodMultiple)),0) as prodUnitPrice, ";
		$sql .= "IFNULL((b.prodPrice/(b.prodQuantity*b.prodMultiple)),0) as prodCompareUnitPrice, ";
		$sql .= "IFNULL(((b.prodPrice/(b.prodQuantity*b.prodMultiple)) * (a.prodQuantity*a.prodCheckoff)),0) as prodCompareSalePrice, ";
		$sql .= "u.unitName, ";
		$sql .= "cu.unitName as prodCompareUnit ";
		$sql .= "FROM tblProd AS a ";
		$sql .= "LEFT OUTER JOIN tblUnit AS u ON a.unitId = u.unitId ";
		$sql .= "LEFT OUTER JOIN tblProd AS b ON b.prodId = a.prodCompareId ";
		$sql .= "LEFT OUTER JOIN tblUnit as cu ON b.unitId = cu.UnitId ";
		$sql .= "WHERE a.shoplistId = ".$pListId." ";
		$sql .= "ORDER BY a.prodCheckoff, a.".$this->_ds()." DESC";
		
		$this->db->select($sql, FALSE);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function GetDetail($pProdId){
		
		/*$sql = " a.prodId,a.prodName,a.prodQuantity,a.prodMultiple,a.prodPrice,a.prodCheckoff,a.prodSalePrice,a.unitId, ";
		$sql .= "(a.prodPrice/(a.prodQuantity*a.prodMultiple)) as unitPrice, ";
		$sql .= "(SELECT ua.unitName FROM tblUnit AS ua WHERE ua.unitId=a.unitId) AS unitName, ";
		$sql .= "(SELECT (b.prodPrice/(b.prodQuantity*b.prodMultiple)) as unitPriceB FROM tblProd AS b WHERE b.prodId = a.prodCompareId ) as prodCompare, ";
		$sql .= "(SELECT unitName FROM tblProd AS c,tblUnit WHERE c.prodId = a.prodCompareId AND tblUnit.unitId=c.unitId ) as prodCompareUnit ";
		
		$sql .= "FROM `tblProd` AS a WHERE prodId = ".$pProdId." ";
		$sql .= "ORDER BY a.prodPrice,".$this->_ds()." DESC";*/
		
/*SELECT a.prodId,a.prodName,a.prodQuantity,a.prodMultiple,a.prodPrice,a.prodCheckoff,a.prodSalePrice,u.unitName, 
(a.prodPrice/(a.prodQuantity*a.prodMultiple)) as unitPrice, 
IFNULL((b.prodPrice/(b.prodQuantity*b.prodMultiple)),0) as prodCompareUnitPrice, 
IFNULL(((b.prodPrice/(b.prodQuantity*b.prodMultiple)) * (a.prodQuantity*a.prodCheckoff)),0) as prodCompareSalePrice, 
cu.unitName as prodCompareUnit 
FROM `tblProd` AS a 
INNER JOIN tblUnit as u ON a.unitId = u.UnitId
LEFT OUTER JOIN tblProd AS b ON b.prodId = a.prodCompareId
INNER JOIN tblUnit as cu ON a.unitId = cu.UnitId
WHERE a.prodId = 1618*/
		
		$sql = "a.prodId,a.prodName,a.shoplistId,a.storeId,a.prodQuantity,a.prodMultiple,a.prodPrice,a.prodCompareId,a.prodCheckoff,a.prodSalePrice, a.unitId,IFNULL(u.unitName,\"\") as unitName, ";
		$sql .= "IFNULL((a.prodPrice/(a.prodQuantity*a.prodMultiple)),0) as unitPrice, ";
		$sql .= "IFNULL((b.prodPrice/(b.prodQuantity*b.prodMultiple)),0) as prodCompareUnitPrice, ";
		$sql .= "IFNULL(((b.prodPrice/(b.prodQuantity*b.prodMultiple)) * (a.prodQuantity*a.prodCheckoff)),0) as prodCompareSalePrice, ";
		$sql .= "cu.unitName as prodCompareUnit ";
		$sql .= "FROM `tblProd` AS a ";
		$sql .= "LEFT OUTER JOIN tblUnit as u ON a.unitId = u.UnitId ";
		$sql .= "LEFT OUTER JOIN tblProd AS b ON b.prodId = a.prodCompareId ";
		$sql .= "LEFT OUTER JOIN tblUnit as cu ON b.unitId = cu.UnitId ";
		$sql .= "WHERE a.prodId = ".$pProdId." ";
		$sql .= "ORDER BY a.prodPrice, a.".$this->_ds()." DESC";
		
		$this->db->select($sql, FALSE);
		
		$query = $this->db->get();
		
		return $query->row(0);
	}

	function GetNames($pName){
		$sql = "prodName,prodQuantity,prodMultiple,prodPrice,unitName,a.unitId FROM tblProd AS a ";
		$sql .= "LEFT OUTER JOIN tblUnit as u ON a.unitId = u.UnitId ";
		$sql .= "WHERE prodName LIKE '".$pName."%';";
		
		$this->db->select($sql, FALSE);
		
		$query = $this->db->get();
		
		$arrResult = array();
		foreach( $query->result() as $prod ){
			$tmpData = "<span>";
			$tmpData .= ' <span class="name">'.$prod->prodName.'</span>';
			$tmpData .= ' <span class="formula">';
			$tmpData .= ' <span class="quantity">'.(float)$prod->prodQuantity.'</span>';
			$tmpData .= ' <span class="unit">'.$prod->unitName.'</span>';
			$tmpData .= ' x <span class="multiple">'.(float)$prod->prodMultiple.'</span>';
			$tmpData .= ' @ <span class="price">'.$prod->prodPrice.'</span>';
			$tmpData .= '<span class="unitid">'.$prod->unitId.'</span>';
			$tmpData .= '</span></span>';
			
			array_push($arrResult,$tmpData);
		}
		return $arrResult;
	}
	
	function Add($options = array())
	{
		// required values
		//if(!$this->_required(
		//	array('userEmail', 'userPassword'),
		//	$options)
		//) return false;
		
		$this->db->insert($this->table, $options);
		
		return $this->db->insert_id();
	}
	
	/*SELECT a.prodName,a.prodQuantity,a.prodMultiple,a.prodPrice,a.unitId, (a.prodPrice/(a.prodQuantity*a.prodMultiple)) as unitPrice, (SELECT b.prodPrice FROM tblProd AS b WHERE b.prodId = a.prodId ) as prodCompare FROM `tblProd` AS a WHERE shoplistId = 326*/
	
	function Update($options = array())
	{

		foreach ($this->fields as $key => $value) {
			if(isset($options[$key]))
				$this->db->set($key, $options[$key]);
		}

		$this->db->where($this->pk, $options[$this->pk]);
		
		$this->db->update($this->table);
		
		return $this->db->affected_rows();
	}
	
	function Delete($pId)
	{
		$this->db->delete($this->table, array($this->pk => $pId)); 	
	}
	
	
	/** Upload Methods **/
	
	
	function manageFile($pFbId){
		
		$filename = date("U")."_".rand(100, 999).".jpg";
		
		$config['upload_path'] = UPLOAD_DIR;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name'] = $pFbId.".jpg";

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('upload_form', $error);
			return $error;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			//$this->load->view('upload_success', $data);
			return $data;
		}
	}
	
	function manageFile64($pData, $pPath, $pPrefix){
		
		$filename = date("U")."_".rand(100, 999).".jpg";
		
		$file = base64_decode($pData);  //base64_decode
		$fullFilePath = $pPath.'/'.$filename;
		
		//echo "putting file at: ".$fullFilePath;
	
		if (file_put_contents($fullFilePath, $file)) {
			return $filename;
		} else {
			echo "There was an error uploading the file, please try again!";
			return "";
		}
	}
	
	/*
		Function createthumb($name,$filename,$new_w,$new_h)
		creates a resized image
		variables:
		$name		Original filename
		$filename	Filename of the resized image
		$new_w		width of resized image
		$new_h		height of resized image
	*/	
	function createthumb($pName, $pPath, $new_w)
	{
		//echo "name: ".$pName."<br/>";
		$system=explode(".",$pName);
		//echo "system2: ".$system[count($system)-1]."<br/>";
		if (preg_match("/jpg|jpeg|JPG/",$system[count($system)-1])){$im=imagecreatefromjpeg($pPath."/".$pName);}
		if (preg_match("/png|PNG/",$system[count($system)-1])){$im=imagecreatefrompng($pPath."/".$pName);}
		
		list($width, $height) = array(imagesx($im),imagesy($im));
		    
	    // Get the scale based on the requested dimension
	    $scale = $width/$new_w;
	    
	    // X&Y scales remain the same because resizing will always be proportionate
	    $xscale=$scale;
	    $yscale=$scale;
	    
	    // Recalculate new size with default ratio
	    if ($yscale>$xscale){
	        $new_width = round($width * (1/$yscale));
	        $new_height = round($height * (1/$yscale));
	    }
	    else {
	        $new_width = round($width * (1/$xscale));
	        $new_height = round($height * (1/$xscale));
	    }
	
	    // Resize the original image
	    $imageResized = imagecreatetruecolor($new_width, $new_height);
	    imagealphablending( $imageResized, false );
		imagesavealpha( $imageResized, true );
	    
	    $imageTmp     = $im;
	    imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
		
	/*	$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
		if ($old_x > $old_y) 
		{
			$thumb_w=$new_w;
			$thumb_h=$old_y*($new_h/$old_x);
		}
		if ($old_x < $old_y) 
		{
			$thumb_w=$old_x*($new_w/$old_y);
			$thumb_h=$new_h;
		}
		if ($old_x == $old_y) 
		{
			$thumb_w=$new_w;
			$thumb_h=$new_h;
		}
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); */
		
		//echo "creating image: ".$system[count($system)-1]." sys1: ".$system[1]." filename: ".$filename;
		
		if (preg_match("/png/",$system[count($system)-1])){
			imagepng($imageResized,$pPath."/thumb_".$pName); 
		} else {
			imagejpeg($imageResized,$pPath."/thumb_".$pName); 
		}
		imagedestroy($im); 
		imagedestroy($imageResized);
		
		return "thumb_".$pName;
	}
}

?>