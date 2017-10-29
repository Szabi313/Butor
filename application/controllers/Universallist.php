<?php


/*
 * 
 *  CSAK AZ ALAP JOGOSULTSÁG VIZSGÁLATA VAN MEG BENNE, EZÉRT MY_CONTROLLER
 *  AZ URI-NKÉNTI VIZSGÁLAT A KITERJESZTETT VÁLTOZATÁBAN LESZ
 * 
 */




class Universallist extends CI_Controller{
	
	public $class;
	public $opt;
	public $error_message_del;
	public $data;
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('universallist_model');
		$this->load->helper(array('url', 'form'/*, 'file' 'directory'*/));
		$this->load->library('form_validation');
		$this->load->model('swim_model');
		$this->config->load('universallist_config');
		$this->load->model('user_model');
		
		
	
		
		//$this->load->model('VisibilityAccess');
		
		$this->class = "Universallist";
		//echo "UL: ".get_class();
		
		//$this->load->model('URIAccessedList_model');
		//$this->opt = null;
		
		 $this->load->library('session');

		// $this->session->set_userdata('ldap_username', 'Szabi');
	}
	
	
	public function index($table = NULL, $itemID=NULL, $isUpdate=FALSE, $alternateForm=NULL){
		
		
		if(!$this->user_model->checkUserLoginAndAccess( /*"universallist/ul_list" */ $this->uri->uri_string(), get_class($this), false))return ;
		
	//	var_dump($data['imgs']);
		
		try{
			$data = $this->getTable($table);
		
			$data['action'] = $this->uri->uri_string();
			
			
			foreach ($data['field_list'] as $fl_item){
				if($fl_item->Key != "PRI" && $fl_item->Type != "tinyint(1)"){
					if(stristr($fl_item->Type, "int"))$is_num = "|numeric";
					else $is_num = null;
					if($fl_item->Null == 'NO'){
						$this->form_validation->set_rules($fl_item->Field, $fl_item->Field, "required".$is_num);
						$data['required'][$fl_item->Field] = 1;
					}
				}
				
			}
		
		}
		catch (Exception $e){
			$data['error_message'] = $e->getMessage();
		}
		
		if($this->form_validation->run() === false){
			
			//$data['imgs'] = directory_map('content/images', 1);
			
			//$data['imgs'] = get_filenames('content/images');
			if($alternateForm)$form=$alternateForm;
			else $form = 'ul_new';
			$this->load->view("universallist/ul_menu");
			$this->load->view('universallist/'.$form, $data);
		}
		else $this->saveNew($table);
	
	}
	
	
	
	public function getTable($table){
		$data = array();
		
		$data['table'] = $table;
		
		$this->universallist_model->getTableInfo($table);
		
		$data['field_list'] = $this->universallist_model->field_list;
		
		
		$this->universallist_model->checkCategories($table);
		
		
		
		$data['categories'] = $this->universallist_model->categories;
		$data['categories_fields'] = $this->universallist_model->categories_fields;
		
/*
 * A BEJELÖLTETLEN CHECKBOX NEM JELENIK MEG A _POST-BAN, EZÉRT UPDATE-NÉL AMIKOR 0 ÉRTÉKRE AKARJUK FRISSÍTENI, 
 * VALAHOGY TUDATNI KELL A FELDOLGOZÓ FÜGGVÉNNYEL, HOGY AZ ÉRTÉKE 0
 */		

/*
 * ******************************************************************************************
 */		
		
		return $data;
	}
	
	
	
	public function editItem($table=NULL, $itemToEdit=NULL){
		
		if(!$this->user_model->checkUserLoginAndAccess( /*"universallist/ul_list" */ $this->uri->uri_string(), get_class($this), false))return ;
		
		if(!$itemToEdit || !$table)return false;
		
		try{
			$data = $this->getTable($table);

			$data['itemToEdit'] = $this->universallist_model->editItem($table, $itemToEdit);
			
			$data['action'] = $this->uri->uri_string();
			 
	
			foreach ($data['field_list'] as $fl_item){
				if($fl_item->Key != "PRI" && $fl_item->Type != "tinyint(1)"){
					if(stristr($fl_item->Type, "int"))$is_num = "|numeric";
					else $is_num = null;
					if($fl_item->Null == 'NO')$this->form_validation->set_rules($fl_item->Field, $fl_item->Field, "required".$is_num);
				}
				
			}
		}
		catch (Exception $e){
			$data['error_message'] = $e->getMessage();
		
		}
		
		if($this->form_validation->run() === false){
			//$data['imgs'] = get_filenames('content/images');
			$this->load->view("universallist/ul_menu");
			$this->load->view('universallist/ul_new', $data);
		}
		else $this->updateItem($table, $itemToEdit=NULL);
	}
	
	
	
	public function saveNew($table){
		if($this->input->is_ajax_request())$isAjax = true;
		else $isAjax = false;
		
		
		$data['error_message'] = null;
		
		$post_info = $this->input->post();
		
		
		
		try{
			$this->universallist_model->getTableInfo($table);
			
			
			$this->universallist_model->saveNew($table, $post_info);
		}
		catch(Exception $e){
			$data['error_message'] = $e->getMessage();
		}
		
		$this->getList($table);
	}
	
	
	
	public function updateItem($table=NULL, $itemID=NULL){
		
		$post_info = $this->input->post();
		$data['error_message'] = null;
		
		try {
			$this->universallist_model->getTableInfo($table);
			
			foreach ($this->universallist_model->field_list as $listItem){
				
				if ($listItem->Key == "PRI" && isset($post_info[$listItem->Field])){
					$updateIDValue = $post_info[$listItem->Field];
					$updateID= $listItem->Field;
					unset($post_info[$listItem->Field]);
				}
				
				if(!isset($post_info[$listItem->Field]) && $listItem->Type == "tinyint(1)") $post_info[$listItem->Field] = "0"; //echo $listItem->Field."<br><br>";
			}
			
	
			$this->universallist_model->update($table, $post_info, $updateID, $updateIDValue);
			//$this->db->where($updateID, $updateIDValue);
			//$this->db->update($table, $post_info);

		}
		catch (Exception $e){
			$data['error_message'] = $e->getMessage();
		}
		
		$this->getList($table);
	}
	
	
	
	protected function getURIs($table){
		$uris = array();
		
		$uris['uri'] = $this->uri->slash_segment(1).$this->config->item('update_view_'.get_class()).DIRECTORY_SEPARATOR.$table.DIRECTORY_SEPARATOR;
		$uris['new_uri'] = $this->uri->slash_segment(1).$this->config->item('new_view_'.get_class()).DIRECTORY_SEPARATOR.$table;
			
		$uris['form_uri'] = $this->uri->segment(1).DIRECTORY_SEPARATOR.$this->config->item('list_view_'.get_class()).DIRECTORY_SEPARATOR.$table;
		
		
		return $uris;
		
	}
	
	
	
	public function getList($table, $category=NULL/*, $class=NULL*/){
		
		//$this->VisibilityAccess->getAccesses($this->session->userdata("username"));
		
		//var_dump($this->session->userdata());
		
		
		if(!$this->user_model->checkUserLoginAndAccess( /*"universallist/ul_list" */ $this->uri->uri_string(), get_class($this), false))return ;
		
		//if($this->session->userdata("username"))echo "valami";
		//else echo "semmi";

		//var_dump($this->session->userdata());
		
		if($category)$category = $this->uri->uri_to_assoc(4);
		
			
		try{
			
			$this->getTable($table);
			
			foreach ($this->universallist_model->field_list as $field){
				if($field->Key == 'PRI'){
					$this->data['key'] = $field->Field;
					break;
				}
			}
			
			if($this->input->post('delete'))$this->data['error_message_del'] = $this->deleteItem($table, $this->data['key']);
			
			$this->data['list'] = $this->universallist_model->getList($table, $category/*, $categoryValue*/);
			
		// echo "valami"; 	
		/*
		 * CSAK AZ ELSŐ SZEGMENS LEHET A SZERKESZTÉS AZONOSÍTÓJA
		 */
			//$data['uri'] = $this->uri->slash_segment(1).$this->config->item('update_view_'.get_class(/* $this */)).DIRECTORY_SEPARATOR.$table.DIRECTORY_SEPARATOR;
			//$data['uri'] = $this->getUpdateUri($table);
			
			$uriTable = $this->getURIs($table);
			$this->data['uri'] = /*$this->getURIs($table)*/$uriTable['uri'];
			
			$this->data['new_uri'] = $this->uri->slash_segment(1).$this->config->item('new_view_'.get_class(/* $this */)).DIRECTORY_SEPARATOR.$table;
			
			
			
			$this->data['form_uri'] = $this->uri->segment(1).DIRECTORY_SEPARATOR.$this->config->item('list_view_'.get_class()).DIRECTORY_SEPARATOR.$table;
		}
		catch (Exception $e){
			$this->data['error_message'] = $e->getMessage();
		}
		
		if(!$this->data['table'] = $this->config->item($table))$this->data['table'] = $table;
		
		//echo $this->uri->slash_segment(1).$this->config->item('new_view_'.get_class(/* $this */)).DIRECTORY_SEPARATOR.$table;
		//echo get_class();
		//echo "<br>";
		//echo $this->data['new_uri'];
		
		//echo $this->config->item('new_view_Universallist');
		//echo "<br>";
		
		
		//echo $this->uri->segment(2);
		
		
		//if($this->config->item('list_view_Universallist') == $this->uri->segment(2)){
			$this->load->view("universallist/attaches");
			$this->load->view("universallist/ul_menu");
			$this->load->view("universallist/ul_list", $this->data);
		//}
		
		//return $this->data;
	}
	
	
	
	
	
	
	
	
	
	
	public function deleteItem($table, $keyID){
		$post_info_delete = $this->input->post('delete');
		$this->error_message_del = array();
		
		foreach ($post_info_delete as  $pi_item){
			try{
				$this->universallist_model->deleteItem($table, $keyID, $pi_item );
			}
			catch(Exception $e){
				$this->error_message_del[] = $e->getMessage();
			}
		}
		
		return $this->error_message_del;
	}
	
	
	
	
}


