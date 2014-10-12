<?php

class Coupon_Model extends CI_Model
{
	var $table = "tblCoupon";
	var $pk = "couponId";
	var $ds = "couponTimeStamp";  //Default sortby field 
	var $rq = "couponAmount";		//Required field (you'll need to mod the form validation if there isn't one)
	var $fields = array(
		 'couponAmount' => array('label'=>'Price','type'=>'decimal','constraint'=>'10,2'),
		 'couponMultiple' => array('label'=>'Multiple','type'=>'int'),
		 'couponCount' => array('label'=>'Count','type'=>'int'),
		 'prodId' => array('label'=>'Product','type'=>'int'),
		);

	 	 	 	
							
	
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
	
	
	function DeleteByProd($pId)
	{
		$this->db->delete($this->table, array('prodId' => $pId)); 	
	}
}

?>