<?php

class GetImages extends CI_Controller{
	
	public $dirMap;
	
	function __construct(){
		
		parent::__construct();
		
		$this->load->helper(array('directory', 'url'));
		$this->load->model('GetImagesModel');
		
		$this->config->load('getimages_config');
	}
	
	
	public function getImages($dir=null){
		
		$this->dirMap = directory_map($this->config->item('base_dir').$dir);
		
		$data['dirmap'] = $this->dirMap;
		$this->load->view('get_images/dir_map', $data);
		//var_dump($data['dirmap']);
	}
	
	public function save($table){
		//$data = array(array('name'=>'valami1', 'img'=>'qw', 'subcategoryID'=>'1', 'product_order'=>1), array('name'=>'valami3', 'img'=>'qw', 'subcategoryID'=>'3', 'product_order'=>2), array('name'=>'valami4', 'img'=>'qw', 'subcategoryID'=>'4', 'product_order'=>0));
		
		$data = file_get_contents("php://input");
		
		$data = json_decode($data);
		
		foreach($data as $row){
			$this->GetImagesModel->save($table, $row);
		}
	}
	
	
	
	public function querySelectedProducts($table){
		$data = array('categoryID'=>'2', 'subcategoryID'=>'2');
		
		//$data = file_get_contents("php://input");
		
		//$data = json_decode($data);
		
		$data['dirmap'] = $this->GetImagesModel->querySelectedProducts($table, $data);
		
		$this->load->view('get_images/dir_map', $data);
	}
	
	public function makeDir(){
		
		if(!$dir=$this->input->post('newDir'))$dir = './content/images/sm/salami';
		mkdir($dir);
		if(preg_match('/\/sm\//', $dir)){
			$dir = preg_replace('/\/sm\//', '/lg/', $dir);
			mkdir($dir);
		}
		elseif(preg_match('/\/lg\//', $dir)){
			$dir = preg_replace('/\/lg\//', '/sm/', $dir);
			mkdir($dir);
		}
		
	}
	
}