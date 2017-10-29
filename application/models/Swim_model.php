<?php
class Swim_model extends CI_Model{
	
	public $affected_rows;
	public $categories;
	public $inserted_id;
	public $date;
	//public $inserted_string;
	
	public $visitors;
	
	public $all_visitors;
	
	public $clients;
	
	
	
	function __construct(){
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('file');
		
		date_default_timezone_set("Europe/Budapest");
	}
	
	
	
	
	public function addClient($name, $category_id){
		
		$datestring = "%Y-%m-%d %H:%i:%s";
		$time = time(); //gmt_to_local(time(), 'UP2');
		$date_buy = mdate($datestring, $time);
		//echo "<br>";
		
		
		$sql = sprintf("INSERT INTO swimming_clients (name, category_id, date_buy) VALUES ('%s', %d, '%s')", $name, $category_id, $date_buy);
		
		$query = $this->db->query($sql);
		
		if($this->db->_error_number() == 1452)throw New Exception($this->config->item('category_not_exist'));
		else if($this->db->_error_number())throw New Exception($this->config->item('db_error'));
		
		if($this->db->affected_rows() < 1)throw New Exception($this->config->item('no_insert'));
		else {
			$this->affected_rows = $this->db->affected_rows();
		 	$this->inserted_id = $this->db->insert_id();
		 	$this->date = $date_buy;
		 	//$this->inserted_string = $this->db->insert_string();
		}
		
		
		
		$sql = sprintf("INSERT INTO swimming_clients_expire_dates (client_id, buy_or_update_date) VALUES (%d, '%s')", $this->db->insert_id(), $date_buy);
		
		$query = $this->db->query($sql);
		
		if($this->db->_error_number() == 1452)throw New Exception($this->config->item('category_not_exist'));
		else if($this->db->_error_number())throw New Exception($this->config->item('db_error'));
		
		if($this->db->affected_rows() < 1)throw New Exception($this->config->item('no_insert'));
	}
	
	
	
	public function getCategories($category_type=NULL){
		
		if(!$category_type)$sql = sprintf("SELECT * FROM swimming_client_category ORDER BY name");
		else $sql = sprintf("SELECT * FROM %s ORDER BY name", $category_type);
		
		$query = $this->db->query($sql);
		
		$this->categories = $query->result();
		
		
		if(/*$this->db->_error_number() ||*/ $query->num_rows()< 1)throw New Exception($this->config->item('no_category'));
		//echo "VALAMI";
	}
	
	
	
	
	public function checkUser($barcode, $times_remaining_arg=NULL){
		
		$id = substr($barcode, 0, (count($barcode)-1-14));
		//$date_from_barcode = substr($barcode, 5);
		//echo $date_from_barcode;
		
		//echo $id;
		
		//$sql = sprintf("SELECT * FROM swimming_clients WHERE id=%d", $id);
		
		$sql = sprintf("SELECT id, buy_or_update_date as date_buy FROM swimming_clients RIGHT JOIN swimming_clients_expire_dates ON id=client_id WHERE id=%d", $id);
		
		$query = $this->db->query($sql);
		//$row = $query->row();
		
		//$exp_date = date('Y-m-d H:i:s', (strtotime($row->date_buy) + 365*24*60*60));
		//echo $exp_date;
		
		if($query->num_rows() < 1)throw new Exception($this->config->item('non_existing_user'));
		else{
			$row = $query->row();
			//echo str_replace(array(':',' ','-'), null, $row->date_buy);
			
			if(substr($barcode, 5) == str_replace(array(':',' ','-'), null, $row->date_buy)){
				$exp_date = date('Y-m-d H:i:s', (strtotime($row->date_buy) + 365*24*60*60));
				
				if($exp_date < date('Y-m-d H:i:s', time()) ) throw New Exception($this->config->item('existing_user_expired'));
				else if($times_remaining_arg){
					$sql = sprintf("INSERT INTO swimming_log_client_entry (client_id) VALUES (%d)", $id);
					$query = $this->db->query($sql);
				}
			}
			else throw new Exception($this->config->item('non_existing_user'));
		}
	}
	
	
	
	public function getIdCardExpDate($client){
		
		$sql = sprintf("SELECT buy_or_update_date as date_buy FROM swimming_clients RIGHT JOIN swimming_clients_expire_dates ON id=client_id WHERE id=%d", $client);
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() < 1)throw new Exception($this->config->item('non_existing_user'));
		else{
			$row = $query->row();
			return $row->date_buy;
		}
	}
	
	
	
	public function visitors($visitor=null){
	
		if(!$visitor)$sql = sprintf("SELECT entry_date, client_id, name FROM swimming_log_client_entry LEFT JOIN swimming_clients ON swimming_clients.id=client_id");
		else $sql = sprintf("SELECT entry_date, client_id, name FROM swimming_log_client_entry LEFT JOIN swimming_clients ON swimming_clients.id=client_id WHERE client_id=%d", $visitor);
		
		$query = $this->db->query($sql);
		
		if($this->db->_error_number())throw New Exception($this->config->item('no_result'));
		else if($query->num_rows < 1)throw New Exception($this->config->item('no_visitor'));
		
		return $this->visitors = $query->result();
		
		
// 		$sql = sprintf("SELECT * FROM swimming_clients");
// 		$query = $this->db->query($sql);
// 		$this->all_visitors = $query->result();
	}
	
	
	
	public function getTimesRemaining($client=NULL){
		if(!$client)return false;
		
		$sql = sprintf("SELECT client_id, Sum(times)-(SELECT Count(*) FROM swimming_log_client_entry WHERE client_id=%d) Times_remaining FROM swimming_passes RIGHT JOIN swimming_pass_types ON pass_id=swimming_pass_types.id WHERE client_id=%d", $client, $client);
		
		$query = $this->db->query($sql);
		
		if($this->db->_error_number())throw New Exception($this->config->item('no_result'));
		else if($query->num_rows < 1)throw New Exception($this->config->item('no_client'));
		else{
			$row = $query->row();
			if($row->client_id == NULL)throw New Exception($this->config->item('no_pass'));
			if($row->Times_remaining <= 0)throw New Exception($this->config->item('pass_expired'));
		}
		
		return $this->clients = $query->result(); //$this->clients;
	}
	
	
	
	
	
	public function clients($client=NULL){
		if(!$client)$sql = sprintf("SELECT swimming_clientS.id, name, date_buy, category FROM swimming_clients LEFT JOIN swimming_client_category ON swimming_client_category.id = category_id ORDER BY name");
		else $sql = sprintf("SELECT swimming_clientS.id as sc_id, name, date_buy, category FROM swimming_clients LEFT JOIN swimming_client_category ON swimming_client_category.id = category_id WHERE swimming_clientS.id=%d ORDER BY name", $client);

		$query = $this->db->query($sql);
		if($this->db->_error_number())throw New Exception($this->config->item('no_result'));
		else if($query->num_rows < 1 && !$client)throw New Exception($this->config->item('no_client'));
		else if($query->num_rows < 1 )throw New Exception($this->config->item('non_existing_user'));
		
		//$this->clients = $query->result();
		
		return $this->clients = $query->result(); //$this->clients;
	}
	
	
	
	public function addPass($client=NULL, $pass_type=NULL){
		
		if(!$client || !$pass_type)throw New Exception($this->config->item('no_category_or_client'));
		$sql = sprintf("INSERT INTO swimming_passes (client_id, pass_id) VALUES (%d, %d)", $client, $pass_type);
		
		$query = $this->db->query($sql);
		
		if($this->db->_error_number() == 1452)throw New Exception($this->config->item('category_or_client_not_exist'));
		else if($this->db->_error_number())throw New Exception($this->config->item('db_error'));
		
		if($this->db->affected_rows() < 1)throw New Exception($this->config->item('no_insert'));
		//else return true;
	}

	
	public function savePic($userId, $file64){
		//$file = fopen($filename, $mode);
		
		if($file64){
			$picArray = explode(',', $file64);
			$pic = base64_decode($picArray[1]);
			
			//if(write_file('files/intranet/files/passes/'.$userId.".png", $pic))echo "ok";
			//else echo "not ok";
			
			return write_file('files/intranet/files/passes/'.$userId.".png", $pic);
		}
		else return false;
	}
	
}