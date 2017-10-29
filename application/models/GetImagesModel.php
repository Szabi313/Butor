<?php
class GetImagesModel extends CI_Model{
	
	function __construct(){
		parent::__construct();
		
		$this->load->database();
	}
	
	// INSERT INTO butor_product (name, img, subcategoryID) VALUES ('új', 'qw', 1) ON DUPLICATE KEY UPDATE name='új', img='qw', subcategoryID=1
	
	public function save($table, $row){
		$sql_insert = sprintf("INSERT INTO %s (", $table);
		$sql_values = sprintf("VALUES (");
		$sql_duplicate = sprintf("ON DUPLICATE KEY UPDATE ");
		
		$sql_del = sprintf("DELETE FROM %s WHERE ", $table);
		
		$wetherDelete = 0;
		
		foreach($row as $key => $value){
			//echo '<br>'.$key.'<br>';
			//echo $value.'<br>';
			//echo $wetherDelete.'<br><br>';
			//echo 'pos: '.strpos($key, 'order' /*&& !$value == '0'*/).'<br>';
			if(strpos($key, 'order' /*&& !$value == '0'*/) !== false){
				//echo 'value: '.$value.'<br><br>';
				if(!$value) $wetherDelete = 1;
			}
			$sql_insert .= sprintf("%s, ", $key);
			$sql_values .= sprintf("'%s', ", $value);
			$sql_duplicate .= sprintf("%s='%s', ", $key, $value);
			if($value /*!= 0*/)$sql_del .= sprintf("%s='%s' AND ", $key, $value);
		}
		
		
		$sql_insert = rtrim($sql_insert, ", ");
		$sql_values = rtrim($sql_values, ", ");
		$sql_duplicate = rtrim($sql_duplicate, ", ");
		$sql_del = rtrim($sql_del, " AND ");
		
		$sql_insert .= ") ";
		$sql_values .= ") ";
		//$sql_duplicate .= ")";
		
		$sql = $sql_insert.$sql_values.$sql_duplicate;
		
		//echo $sql;
		//echo $sql_del;
		
		if(!$wetherDelete)$query = $this->db->query($sql);
		else $query = $this->db->query($sql_del);
	}
}