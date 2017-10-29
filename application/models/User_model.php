<?php
class User_model extends CI_Model{
	
	public function authenticateWinUser(){
		
		$this->load->helper('url');
		
		$this->config->load('user_config');
		$this->load->library('NoLoggingException');
		$this->load->library('NoAccessException');
		
		$this->load->database();
		
		$this->load->library('encrypt');
	}
	
	
	
	
	
	
	public function checkUserLoggingIn(){

		if(!$this->session->userdata('username')){
			throw New NoLoggingException($this->config->item('no_logging_in'));
		}
	}
	
	
	
	
	public function getModulAccessException($className){
		if(!$this->getModulAccess($className, $this->session->userdata('username'), $this->session->userdata('groupID')))throw New NoAccessException($this->config->item('no_access'));
	}
	
	
	
	
	
	/*public function checkUser($classname, $url_taskname, $url_taskname_no_access, $data_no_access_index="no_access", $fallback='user/form'){
		
		$user_ok = false;
		
		if(!$this->session->userdata('username')){
			//$this->load->view('apply/attaches');
			$this->load->view($fallback);
		
			$this->session->set_userdata('redirect_after_login', $url_taskname);
		}
		else if(!$this->getModulAccess($classname, $this->session->userdata('username'))){
			$data[$data_no_access_index] = $this->config->item('no_access');
			$this->load->view($url_taskname_no_access, $data);
		}
		else{
			//$this->load->view("upload/upload_form");
			$user_ok = true;
		}
		
		return $user_ok;
	}*/
	
	
	
	
	
	public function getModulAccess($className, $username/*=NULL*/, $group=NULL){
	
		//if(!$username)return false;
	
		$modul_access = false;
		
		
		
	
		$sql = sprintf("SELECT * FROM modul_access WHERE modulname='%s' AND (username='%s' OR username=%d)", $className, $username, $group);
		//$sql = sprintf("SELECT username, modulname, csoport FROM modul_access LEFT JOIN felhasznalok ON felhasznalonev=username WHERE modulname='%s' AND (username='%s' OR username=csoport)", $className, $username);
		//$sql = sprintf("SELECT * FROM modul_access WHERE modulname='%s'", $className);
		
		$query = $this->db->query($sql);
		
		//var_dump($query->result());
		
		//echo "<br>";
		//echo $query->num_rows();
		//echo "<br>";
		
	
		if($query->num_rows() > 0)$modul_access = true;
		/*foreach ($query->result() as $row){
			if($row->username == $username)$modul_access = true;
		}*/
	
		
		
		
		if(!$modul_access){
			$sql = sprintf("SELECT * FROM acl WHERE username='%s'", $username);
			$query = $this->db->query($sql);
				
			if($query->num_rows() > 0){
				$row = $query->row();
					
				if($row->access_level == 0)$modul_access = true;
			}
		}
	
		return $modul_access;
	}
	
	
	
	public function checkUserLoginAndAccess($redirect_after_login = null, $className, $needAccess=true, $is_ajax=FALSE){
		
		//$this->load->model('user_model');
		$this->load->library(array('NoLoggingException', 'NoAccessException', 'session'));
		
	
		try {
			$this->user_model->checkUserLoggingIn();
			if($needAccess)$this->user_model->getModulAccessException($className);
		}
		catch(NoLoggingException $e){
			if($redirect_after_login)$this->session->set_userdata('redirect_after_login', $redirect_after_login);
			
			//$this->load->view('user/attaches');
			//$this->load->view('user/form');
			if(!$is_ajax) redirect('users/login'); //$this->load->view('users/login');
			return false;
		}
		catch (NoAccessException $e){
			//$this->load->view('user/attaches');
			$this->load->view('users/no_access');
			return false;
		}
		
		//$this->load->view($redirect_after_login);
	
		
		return true;
	
	}
	
	
	public function checkUserTable($usr, $psw){
		
		//echo "valami";
		
		$query = $this->db->get_where('felhasznalok', array('felhasznalonev' => $usr));
		
		$result = $query -> result();
		
		if($this->encrypt->decode($result[0] -> jelszo) != $psw)return false;
		
		//var_dump($result[0] -> felhasznalonev);
		//var_dump($result[0] -> jelszo);
		//echo $query->num_rows();
		
		if($query->num_rows())return $result[0] -> felhasznalonev;
		else return false;
	}
	
	
	
	
}