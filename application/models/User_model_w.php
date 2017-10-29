<?php
class User_model_w extends CI_Model{
	
	public $existing_user;
	public $not_existing_user;
	public $user;
	public $wrong_psw;
	
	function __construct(){
		//parent::__construct();
		
		$this->load->database();
		$this->load->library('encrypt');
		
		$this->existing_user = "Ez a felhasználónév már létezik";
		$this->not_existing_user = "Hibás felhasználónév vagy jelszó";
		$this->wrong_psw = "Nem megfelelő jelszó";
	}
	
	

	public function getUserList($tableArg = "felhasznalok") {
		$query = $this->db->get($tableArg);
		
		
		return $query->result();
	}
	
	
	public function add_user(){
		
		$encrypted_psw = $this->encrypt->encode($this->input->post('psw'));
		
		//$sql = "INSERT INTO felhasznalok (felhasznalonev, jelszo, csoport) VALUES ('".$this->input->post('usr')."', '".$encrypted_psw."')";
		//$sql = sprintf("INSERT INTO felhasznalok (felhasznalonev, jelszo, csoport) VALUES ('%s', '%s', %d)", $this->input->post('usr') , $encrypted_psw, $this->input->post('group'));
		$sql = sprintf("INSERT INTO felhasznalok (felhasznalonev, jelszo) VALUES ('%s', '%s')", $this->input->post('usr') , $encrypted_psw);

		
		$this->db->query($sql);
		
		//echo $this->db->affected_rows();
		//echo "valami";
		$error_array = $this->db->error();
		//var_dump( $error_array);
		
		
		if($this->db->affected_rows() < 0 || $error_array['code'])throw new Exception($this->existing_user);
	}
	
	
	public function check_user(){
		
		//$encrypted_psw = $this->encrypt->encode($this->input->post('psw'));
		
		
		
		$sql = "SELECT * FROM felhasznalok WHERE felhasznalonev = '".$this->input->post('usr')."'";

		$query = $this->db->query($sql);
		
		if($query->num_rows() == 0) throw new Exception($this->not_existing_user);
		else{
			$this->user = $query->row();
			
			
			$decrypted_psw = $this->encrypt->decode($this->user->jelszo);
			
			
			//if($decrypted_psw == $this->input->post('psw'))$this->session->set_userdata($this->user);
			if($decrypted_psw == $this->input->post('psw')){
				$this->session->set_userdata("username", $this->user->felhasznalonev);
				$this->session->set_userdata("userID", $this->user->id);
				$this->session->set_userdata("groupID", $this->user->csoport);
			}
			else throw new Exception($this->wrong_psw);
		}
	}
	
	
	
	public function limitGroupAccess( $groupID, $categoryName, $categoryValue ){
		$sql = sprintf("INSERT INTO group_access (groupID, category_name, category_value) VALUES (%d, '%s', '%s')", $groupID, $categoryName, $categoryValue );
		
		$query = $this->db->query($sql);
		
		//return $query->result();
	}
	
	
	public function deleteGroupAccessLimitation( $limitationId ){
		 $sql = sprintf("DELETE FROM group_access WHERE id=%d", $limitationId);
		
		$query = $this->db->query($sql);
		
		//$return $query->result();
	}
	
	
	public function deleteAllGroupAccessLimitation( $groupId, $table ){
		 $sql = sprintf("DELETE FROM %s WHERE groupID=%d", $table, $groupId);
		
		$query = $this->db->query($sql);
		
		//$return $query->result();
	} 	
	
	
	
	
	
	public function deleteUser( $user) {
		 $sql = sprintf("DELETE FROM felhasznalok WHERE felhasznalonev ='%s'", $user);
		 $query = $this->db->query($sql);

	}
	
	
	public function updateUser( $groupID, $user) {
		 //$sql = sprintf("UPDATE felhasznalok SET csoport=%d WHERE felhasznalonev='%s'", $groupID, $user);
		 $sql = sprintf("UPDATE felhasznalok SET csoport=%d WHERE id='%d'", $groupID, $user);
		
		 $query = $this->db->query($sql);

	}
	
	
	public function getGroupAccess($groupId, $categoryValue = "no_access") {
		$sql = sprintf ("SELECT category_name FROM group_access WHERE category_value='%s' AND groupID=%d", $categoryValue, $groupId);
		$query = $this->db->query ($sql);
		return $query ->result();
	}
	
	
	
/*	public function is_logged_in(){
		if(isset($this->session->userdata('felhasznalonev')) && !empty($this->session->userdata('felhasznalonev')))return $this->session->userdata('username');
		else return false;
	} */
	
}