<?php
class Universallist_model extends CI_Model{
	
	public $field_list;
	public $categories;
	public $categories_fields;
	public $foreignkeys;
	
	function __construct(){
		parent::__construct();
		
		$this->load->database();
		
		$categories = array();
		$categories_fields = array();
	}
	
	
	public function getTableInfo($table){
		//$sql = "show create table swimming_passes";
		$sql = sprintf("SHOW COLUMNS FROM %s", $table);
		//$sql = "SHOW CREATE TABLE proba";
		
		$query = $this->db->query($sql);
		
		//if($this->db->_error_number() || $query->num_rows < 1)throw New Exception($this->config->item('db_error').$this->db->_error_message());
		$this->field_list = $query->result();
		
		//var_dump($this->field_list);
		
	}
	
	
	
	public function getAllCategories($table){
		
		$sql = sprintf("SELECT table_name, column_name, referenced_table_name, referenced_column_name FROM information_schema.key_column_usage WHERE table_name='%s' AND referenced_table_name IS NOT NULL;", $table);
		
		$query = $this->db->query($sql);
		
		//if($this->db->_error_number() || $query->num_rows < 1)throw New Exception($this->config->item('db_error').$this->db->_error_message());
		
		return $query->result();
	}
	
	
	
/*
 * A KATEGÓRIÁKAT TARTALMAZÓ TÁBLA MEZŐINEK VIZSGÁLATA:
 * A PRIMARY KEY MEGKERESÉSE, EZ LESZ A SELECT OPTION VALUE
 * KATEGÓRIANEVEK AZ ELSŐ NEM KULCSMEZŐ, EZ LESZ A SELECT OPTION TEXT
 */
	
	public function getPrimaryKey($categories_fields, $column_name=null){
		
		if(!is_array($categories_fields) /*|| !$column_name*/)return false;
		
		
		if($column_name)$table_array = $categories_fields[$column_name];
		else $table_array = $categories_fields;
			
		foreach ($table_array as $cf_item){
			if($cf_item->Key == "PRI")$table_array['primary_key'] = $cf_item->Field;
			else if(!isset($table_array['non_primary_key']))$table_array['non_primary_key'] = $cf_item->Field;
		}
		
		//var_dump($categories_fields);
		/*foreach ($categories_fields[$column_name] as $cf_item){
			if($cf_item->Key == "PRI")$categories_fields[$column_name]['primary_key'] = $cf_item->Field;
			else if(!isset($categories_fields[$column_name]['non_primary_key']))$categories_fields[$column_name]['non_primary_key'] = $cf_item->Field;
		}*/
		
		//var_dump($categories_fields);
		
		if($column_name)$categories_fields[$column_name] = $table_array;
		else $categories_fields = $table_array;
		
		return $categories_fields;
		//return $table_array;
	}
/*
 *************************************************************************
 */	
	
	
	public function getCategories($foreignkeys){
		
		if(!is_array($foreignkeys))return false;
		

		
	/*
	 * AZ ÖSSZES FOREIGN KEY-HEZ LEKÉRI AZ ÖSSZES REKORDOT A HIVATKOZOTT TÁBLÁBÓL (KATEGÓRIÁK, CATEGORIES TÖMB)
	 */	
		
		foreach ($foreignkeys as $fk_item){

			$this->swim_model->getCategories($fk_item->referenced_table_name);
			$this->categories[$fk_item->column_name] = $this->swim_model->categories;
				
	/*
	 * A KATEGÓRIÁKAT TARTALMAZÓ TÁBLA MEZŐINEK VIZSGÁLATA (KATEGÓRIÁKHOZ TARTOZÓ MEZŐK, CATEGORIES_FIELDS TÖMB):
	 * A PRIMARY KEY MEGKERESÉSE, EZ LESZ A SELECT OPTION VALUE
	 * KATEGÓRIANEVEK AZ ELSŐ NEM KULCSMEZŐ, EZ LESZ A SELECT OPTION TEXT
	 */
			$this->getTableInfo($fk_item->referenced_table_name);
			$this->categories_fields[$fk_item->column_name] = $this->field_list;
				
				
			$this->categories_fields = $this->getPrimaryKey($this->categories_fields, $fk_item->column_name);
		}
		return $this->categories_fields;
		
		
	}
	
	
	
	public function checkCategories($table){
		
		if(!$this->field_list)return false;
		
		foreach ($this->field_list as $item){
			if($item->Key == "MUL"){
				$this->foreignkeys = $this->getAllCategories($table);
				
				$this->getCategories($this->foreignkeys);
				//$this->categories = $this->categories;
				
				break;
			}
		}
		
	}
	
	
	
	public function editItem($table, $item){
		
		$sql = sprintf("SELECT * FROM %s WHERE id=%d", $table, $item);
		
		$query = $this->db->query($sql);
		
		 $error_array = $this->db->error();
		
		if($error_array['code'] || $query->num_rows() < 1)throw New Exception($this->config->item('db_error').$error_array["message"]); 		
		//if(/*$this->db->_error_number() ||*/ $query->num_rows() < 1)throw New Exception($this->config->item('db_error').$this->db->_error_message());
		
		return $query->result();
	}
	
	
	
	public function saveNew($table, $post_info){
		
		
	//	$sql = $this->db->set($post_info)->get_compiled_insert($table);
	//	$this->db->query($sql);
	//	$this->db->insert($table, $post_info);
		
		//if($this->db->_error_number())throw New Exception($this->config->item('db_error').$this->db->_error_message());
		
		$sql = sprintf("INSERT INTO %s (", $table);
		$sql_values = " VALUES (";
	//	$sql_values = NULL;
		
		//$post_info_count = count($post_info)-2;
		//$i = 0;
		
		//var_dump($post_info);
		
		foreach ($post_info as $pi_key => $pi_value){
			
		if($pi_key !='0'){
				$sql .= "`" .$pi_key."`, ";
				
				if(!$pi_value || $pi_value == ""){
					$sql_values .= "NULL, ";
					//echo "pi value: ".$pi_value;
				}
				else $sql_values .= "'".str_replace(array('"', "'"), array('\"', "\'"), $pi_value)."', ";
		}
			/*	if($i < $post_info_count){
					$sql .= ", ";
					$sql_values .= ", ";
				}
				else{
					$sql .= ") VALUES (";
					$sql_values .= ")";
				}*/
	//		}
			
	//			$i++;
	//		}
		}
		
		$sql = rtrim($sql, ", ");
		$sql_values = rtrim($sql_values, ", ");
		
		$sql .= ")";
		$sql_values .= ")";
		
		$sql .= $sql_values;
		
		$this->db->query($sql);
		
		//echo "<br>".$sql."<br>";$
	}
	
	//UPDATE butor_product SET name='valami', categoryID='6' WHERE id=1
	
	public function update($table, $post_info, $updateID, $updateIDValue){
		
		$sql = sprintf("UPDATE %s SET ", $table);
		
		foreach($post_info as $pi_key => $pi_item){
			if(!$pi_item || $pi_item == "")$sql .= sprintf("%s=NULL, ", $pi_key);
			else $sql .= sprintf("%s='%s', ", $pi_key, str_replace(array('"', "'"), array('\\"', "\\'"), $pi_item) );
		}
		
		$sql = rtrim($sql, ", ");
		
		$sql .= sprintf(" WHERE %s=%d", $updateID, $updateIDValue);
		
		$this->db->query($sql);
	}

	
	
	public function getList($table, $category=NULL/*, $categoryValue*/){
		
		 
		
		//if(!$category)$sql = sprintf("SELECT * FROM %s", $table);
		//else $sql = sprintf("SELECT * FROM %s WHERE ", $table);
		
		//$query = $this->db->query($sql);
		
		if(!$category)$query = $this->db->get($table);
		else $query = $this->db->get_where($table, $category /*array($category=>$categoryValue)*/);
		
		//var_dump( $query->result() );
		//var_dump( $this->db->error() );
		
		$error_array = $this->db->error();
		
		if(/*$this->db->_error_number()*/ $error_array['code'] || $query->num_rows() < 1)throw New Exception($this->config->item('db_error').$error_array["message"]/*$this->db->_error_message()*/);
		
		return $query->result();
	}
	
	
	
	public function deleteItem($table, $keyID, $itemID){
		
		$this->db->delete($table, array($keyID=>$itemID));
		
		 $error_array = $this->db->error();
		
		if(/*$this->db->_error_number()*/ $error_array["code"] || $this->db->affected_rows() < 1)throw New Exception($this->config->item('db_insert_error').$itemID." ".$error_array["message"]/*.". ".$this->db->_error_message()*/);
	}
}