<?php

class ImgToDBModel extends CI_Model{
	
	public $images;
	
	function __construct(){
		parent::__construct();
		
		$this->load->helper('file');
		$this->load->database();
	}
	
	public function insertNames($names){
		foreach($names as $nameValue){
			$sql = sprintf("INSERT IGNORE INTO `butor_img` (img) VALUES ('%s')", $nameValue);
			
			$query = $this->db->query($sql);
		}
	}
	
	
	public function getFileNames(){
		$this->images = get_filenames('content/images');
		
		return $this->images;
	}

}