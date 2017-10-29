<?php

class ImgtoDB extends CI_Controller{
	
	public $images;
	
	function __construct(){
		parent::__construct();
		
		//$this->load->helper('file');
		$this->load->model('ImgToDBModel');
		
		//$this->images = new Array();
	}
	
	public function insertNames(){
		//$this->images = get_filenames('content/images');
		$this->images = $this->ImgToDBModel->getFileNames('content/images');
		
		var_dump($this->images);
		
		$this->ImgToDBModel->insertNames($this->images);
	}
	
	
}