<?php
class Users_w extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('user_model_w', 'user_model');

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->config->load('users_config');
		
	}
	
	public function userList(){
		$data['users'] = $this->user_model->getUserList();
		$data['title'] = "Name of users";
		
		//$this->load->view('templates/header', $data);
		$this->load->view('users/userlist', $data);
		//$this->load->view('templates/footer');
	}
	
	
	public function signin(){
	
	
		$this->form_validation->set_rules('usr', 'Felhasználónév', 'required');
		$this->form_validation->set_rules('psw', 'Jelszó', 'required');
	//	$this->form_validation->set_rules('group', 'Csoport', 'required');
	
//	 $data['valami'] = "Azabi";
//	$data['groups'] = $this->user_model->getUserList("csoportok");
		
	//	echo "Szabi";
	//	 var_dump($data);
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('users/signin'/*, $data*/);
		}
		else{
			try {
				$this->user_model->add_user();
				
				$data['insert_message'] = "A regisztráció sikeres volt.";
				$this->load->view('users/signedin', $data);
			}
			catch (Exception $e){
				$data['insert_message'] = $e->getMessage();
				$this->load->view('users/signedin', $data);
			}
			
			
			
		}
	
	}
	
	
	
	public function check_user(){

			/*echo "valami2 <br>";
			var_dump($this->session->userdata());*/


		$this->form_validation->set_rules('usr', 'Felhasználónév', 'required');
		$this->form_validation->set_rules('psw', 'Jelszó', 'required');
		
		if(/* isset( */$this->session->userdata('username')/* ) && !empty($this->session->userdata('username')) */) {
			$data['title'] = "belépés";
			$data['user_data_data'] = $this->session->userdata('username');
			// $this->load->view('tarcsak/html');
			
			//var_dump( $this->session->userdata());
			
			
			
			
/*
 * VALAMIÉRT ELFELEJTI A REDIRECT_AFTER_LOGIN SESSION ELEMET, EZÉRT EGYENESBE KAPJA A lista/lista/butor_category-T
 
 */

			//$this->load->view('templates/header', $data);
			redirect($this->config->item('default_redirect')); //$this->load->view('users/logedin', $data);
			//$this->load->view('templates/footer', $data);
		}
		else{
		
			if ($this->form_validation->run() === FALSE) {
				$data['title'] = "belépés";
				//$this->load->view('templates/header', $data);
				$this->load->view('users/login');
				//$this->load->view('templates/footer', $data);
			}
			else{
				try {
					$this->user_model->check_user();
					$data['check_message'] = "Sikeres belépés!";
					$data['user_data_data'] = $this->session->userdata('username');
					
				//	$this->load->view('tarcsak/html');
					
				  if($this->session->userdata('redirect_after_login'))redirect($this->session->userdata('redirect_after_login')); //$this->load->view ($this->session->userdata('redirect_after_login'));
					else redirect($this->config->item('default_redirect')); //$this->load->view('users/logedin', $data);
					//$this->load->view('templates/header', $data);
				//	$this->load->view('users/logedin', $data);
					//$this->load->view('templates/footer', $data);
				}
				catch (Exception $e){
					$data['check_message'] = $e->getMessage();
					//$this->load->view('templates/header', $data);
					$this->load->view('users/logedin', $data);
					$this->load->view('users/login');
					//$this->load->view('templates/footer', $data);
				}
			}
		}
	}
	
	
	
	public function logout(){
		$this->session->set_userdata('username', null);
		$this->session->set_userdata('userID', null);
		$this->session->set_userdata('groupID', null);
		
		$data['title'] = "belépés";
		//$this->load->view('templates/header', $data);
		redirect($this->config->item('default_redirect')); //$this->load->view('users/login');
		//$this->load->view('templates/footer', $data);
		
	}
	
	public function getGroups (){
		 $data['users'] = $this->user_model-> getUserList ("csoportok");
			$this->load->view('users/userlist', $data);
	}
	
	
	public function updateUser($userId, $groupId){
			 $data['users'] = $this->user_model->updateUser( $groupId, $userId);
			$this->load->view('users/userlist', $data);

	}
	

	public function deleteUser($userId){
			 $data['users'] = $this->user_model->deleteUser( $userId );
			$this->load->view('users/userlist', $data);

	}
	
	
	
	public function limitGroupAccess( $groupID, $categoryName, $categoryValue ){
		 $this->user_model-> limitGroupAccess ($groupID, $categoryName, $categoryValue) ;
	}
	
	public function deleteGroupAccessLimitation($limitationId) {
		 $this->user_model-> deleteGroupAccessLimitation($limitationId) ;
	}
	
	
	public function deleteAllGroupAccessLimitation($groupId, $table="group_access") {
		 $this->user_model-> deleteAllGroupAccessLimitation($groupId, $table) ;
	}
	
	
	public function setGroupAccess ($categoryValue="no_access"){
		$json = file_get_contents('php://input');
		
		$dataObj = json_decode( $json);
		
		$this->deleteAllGroupAccessLimitation($dataObj->groupId);
		
		foreach($dataObj->fields as $fieldValue){
			$this->limitGroupAccess($dataObj->groupId, $fieldValue, $categoryValue);
		}
	}
	
	
	public function getGroupAccess($groupId, $categoryValue = "no_access"){
		$data['users'] = $this->user_model-> getGroupAccess($groupId, $categoryValue);
		$this->load->view ('users/userlist', $data);
	}
	
		
} 