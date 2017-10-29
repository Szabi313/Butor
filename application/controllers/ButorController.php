<?php

class ButorController extends CI_Controller{
	
	public $data;
	public $menu;
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('ButorModel');
		$this->load->helper(array('url'));
		$this->load->library('session');
		
		$this->getProductMenu();
	}
	
	
	public function getNews($newsName=NULL){
		
		$this->data['news'] = $this->ButorModel->getNews($newsName);

	}
	
	
	public function getCompanyInfo($article){
		/*$this->data['news'] =*/ $this->getNews($article);
		
		$this->data['newsTitle'] = $this->data['news'][0]->title;
		
		//var_dump($this->data['news']);
		
		$this->load->view("butor/butor_header", $this->data);
		$this->load->view("butor/butor_product_menu", $this->data);
		$this->load->view("butor/butor_subscribe", $this->data);
		$this->load->view("butor/butor_sponsors", $this->data);
		$this->load->view("butor/butor_news", $this->data);
		//$this->load->view("butor/butor_catetgories_content", $this->data);
		$this->load->view("butor/butor_sponsors_2", $this->data);
		$this->load->view("butor/butor_footer", $this->data);
	}
	
	
	public function getCategories(){
		$this->data['result'] = $this->ButorModel->getCategories();
		
		
		$this->getNews();
		$this->data['news'] = $this->data['news'];
		$this->data['newsTitle'] = "Híreink";
		
		//$this->load->view("butor/categories", $this->data);
		
		$this->load->view("butor/butor_header", $this->data);
		
		$this->load->view("butor/butor_carousel", $this->data);
		$this->load->view("butor/butor_product_menu", $this->data);
		$this->load->view("butor/butor_subscribe", $this->data);
		//$this->getProductMenu();
		$this->load->view("butor/butor_sponsors", $this->data);
		$this->load->view("butor/butor_news", $this->data);
		$this->load->view("butor/butor_catetgories_content", $this->data);
		$this->load->view("butor/butor_sponsors_2", $this->data);
		$this->load->view("butor/butor_footer", $this->data);
		
	}	
	
	public function getCategory($category){
		$this->data['category'] = $category;
		$this->data['product_result'][] = $this->ButorModel->getCategory($category);
		$this->session->set_userdata('current_products', $this->makeOneDimensionalArray($this->data['product_result']));
		//var_dump($this->session->userdata('current_products'));
		//$this->load->view("butor/category", $this->data);
		
		$this->load->view("butor/butor_header", $this->data);
		$this->load->view("butor/butor_product_menu", $this->data);
		$this->load->view("butor/butor_subscribe", $this->data);
		$this->load->view("butor/butor_sponsors", $this->data);
		//$this->load->view("butor/butor_news", $this->data);
		$this->load->view("butor/butor_catetgory_content", $this->data);
		$this->load->view("butor/butor_sponsors_2", $this->data);
		$this->load->view("butor/butor_footer", $this->data);
	}	
	
	public function getSubcategories($category, $all_in=false){
		
		$this->data['category'] = $category;
		
		$this->data['result'] = $this->ButorModel->getSubcategories($category);
		$this->data['link'] = "alkategoria/";
		
		//$this->session->set_userdata('current_products', $this->data['result']);
		
		$this->load->view("butor/butor_header", $this->data);
		$this->load->view("butor/butor_product_menu", $this->data);
		$this->load->view("butor/butor_subscribe", $this->data);
		$this->load->view("butor/butor_sponsors", $this->data);


		if($all_in){
//			$this->data['all_in'] = $all_in;
			foreach($this->data['result'] as $resultItem){
				$this->data['product_result'][]= $this->ButorModel->getSubcategory($resultItem->name);
			}	
			
			$this->session->set_userdata('current_products', $this->makeOneDimensionalArray($this->data['product_result']));
			//var_dump($this->session->userdata('current_products'));
	//		var_dump($this->data['product_result']);
			//$this->session->set_userdata('current_products', $this->data['product_result']);

			$this->load->view("butor/butor_catetgory_content", $this->data);
		}
		else{
			//$this->load->view("butor/subcategories", $this->data);
			//$this->load->view("butor/butor_news", $this->data);
			$this->load->view("butor/butor_subcatetgories_content", $this->data);
		} 
		
		$this->load->view("butor/butor_sponsors_2", $this->data);
		$this->load->view("butor/butor_footer", $this->data);
		
	}
	
	public function getSubcategory($category, $subcategory){
		$this->data['category'] = $category;
		$this->data['subcategory'] = $subcategory;
		//$this->data['result'] = $this->ButorModel->getSubcategory($subcategory);
		$this->data['product_result'][] = $this->ButorModel->getSubcategory($subcategory);
		$this->data['link'] = "alkategoria/";
		
		$this->session->set_userdata('current_products', $this->makeOneDimensionalArray($this->data['product_result']));
		//var_dump($this->session->userdata('current_products'));
		
		//$this->load->view("butor/category", $this->data);
		
		$this->load->view("butor/butor_header", $this->data);
		$this->load->view("butor/butor_product_menu", $this->data);
		$this->load->view("butor/butor_subscribe", $this->data);
		$this->load->view("butor/butor_sponsors", $this->data);
		$this->load->view("butor/butor_catetgory_content", $this->data);
		$this->load->view("butor/butor_sponsors_2", $this->data);
		$this->load->view("butor/butor_footer", $this->data);
	}	
	
	
	public function getProduct($category, $subcategory=0, $product, $productId=null){
		$this->data['result'] = $this->ButorModel->getProduct($product, $productId);
		$this->data['category'] = $category;
		$this->data['subcategory'] = $subcategory;
		
		//$this->session->unset_userdata('current_products');
		if(!$currentProducts = $this->session->userdata('current_products')){
			
			if($subcategory){
				 $currentProducts = $this->makeOneDimensionalArray($this->ButorModel->getSubcategory($subcategory));
			}
			else{
				$categoryInfo = $this->ButorModel->queryCategory($category);
				
				//var_dump($categoryInfo);
				
				if($categoryInfo[0]->all_product){
					$subcategories = $this->ButorModel->getSubcategories($category);
					
					$subcategoryProducts = array();
					foreach($subcategories as $resultItem){
						$subcategoryProducts[]= $this->ButorModel->getSubcategory($resultItem->name);
					}
					$currentProducts = $this->makeOneDimensionalArray($subcategoryProducts);
				}
				else $currentProducts = $this->makeOneDimensionalArray($this->ButorModel->getCategory($category));				
			}
			$this->session->set_userdata('current_products', $currentProducts);
		};
		
		//var_dump($currentProducts);
		
		$pos = $this->searchPos($productId, $currentProducts);
		//echo "pos: ".$pos;
		//var_dump($currentProducts);
		
		$this->data['curr']['img'] = $currentProducts[$pos]->smallPrImg;
		
		if(isset($currentProducts[$pos+1])){
			$this->data['next']['id'] = $currentProducts[$pos+1]->id;
			$this->data['next']['name'] = $currentProducts[$pos+1]->name;
			$this->data['next']['isPV'] = $currentProducts[$pos+1]->isPV;
		}
		
		if(isset($currentProducts[$pos-1])){
			$this->data['prev']['id'] = $currentProducts[$pos-1]->id;
			$this->data['prev']['name'] = $currentProducts[$pos-1]->name;
			$this->data['prev']['isPV'] = $currentProducts[$pos-1]->isPV;
		}
		
		//$this->load->view("butor/product", $this->data);
		
		$this->load->view("butor/butor_header", $this->data);
		$this->load->view("butor/butor_product_menu", $this->data);
		$this->load->view("butor/butor_subscribe", $this->data);
		$this->load->view("butor/butor_sponsors", $this->data);
		//$this->load->view("butor/butor_news", $this->data);
		$this->load->view("butor/butor_product_content", $this->data);
		$this->load->view("butor/butor_sponsors_2", $this->data);
		$this->load->view("butor/butor_footer", $this->data);
		
	}	
	
	
	public function getProductVersions($category, $subcategory=0, $product, $productId=null, $productVersionNumber=null, $json=null){
		
		$this->data['category'] = $category;
		$this->data['subcategory'] = $subcategory;
		
		if(!$productVersionNumber)$productVersionNumber = 0;
		else $productVersionNumber--;
		
		//$currentProducts = $this->session->userdata('current_products');
		
		//$this->session->unset_userdata('current_products');
		if(!$currentProducts = $this->session->userdata('current_products')){
			
			if($subcategory){
				 $currentProducts = $this->makeOneDimensionalArray($this->ButorModel->getSubcategory($subcategory));
			}
			else{
				$categoryInfo = $this->ButorModel->queryCategory($category);
				
				//var_dump($categoryInfo);
				
				if($categoryInfo[0]->all_product){
					$subcategories = $this->ButorModel->getSubcategories($category);
					
					$subcategoryProducts = array();
					foreach($subcategories as $resultItem){
						$subcategoryProducts[]= $this->ButorModel->getSubcategory($resultItem->name);
					}
					$currentProducts = $this->makeOneDimensionalArray($subcategoryProducts);
				}
				else $currentProducts = $this->makeOneDimensionalArray($this->ButorModel->getCategory($category));				
			}
			$this->session->set_userdata('current_products', $currentProducts);
		};
		
		$pos = $this->searchPos($productId, $currentProducts);
		//echo $pos;
		
		if(isset($currentProducts[$pos+1])){
			$this->data['next']['id'] = $currentProducts[$pos+1]->id;
			$this->data['next']['name'] = $currentProducts[$pos+1]->name;
			$this->data['next']['isPV'] = $currentProducts[$pos+1]->isPV;
		}
		
		if(isset($currentProducts[$pos-1])){
			$this->data['prev']['id'] = $currentProducts[$pos-1]->id;
			$this->data['prev']['name'] = $currentProducts[$pos-1]->name;
			$this->data['prev']['isPV'] = $currentProducts[$pos-1]->isPV;
		}
		
		$this->data['product_version_number'] = $productVersionNumber;
		$this->data['result'] = $this->ButorModel->getProductVersions($product, $productId);
		$this->data['json_data']=$this->data['result'];
		//$this->data['link'] = "termek-valtozat/";
		$this->data['link'] = "termek-valtozatok/";
		
		//$this->load->view("butor/subcategories", $this->data);
		//$this->session->set_userdata('current_products', $this->data['result']);
		//var_dump($this->session->userdata('current_products'));
		if(!$json){
		$this->load->view("butor/butor_header", $this->data);
		$this->load->view("butor/butor_product_menu", $this->data);
		$this->load->view("butor/butor_subscribe", $this->data);
		$this->load->view("butor/butor_sponsors", $this->data);
		//$this->load->view("butor/butor_news", $this->data);
		$this->load->view("butor/butor_product_versions_content", $this->data);
		$this->load->view("butor/butor_sponsors_2", $this->data);
		$this->load->view("butor/butor_footer", $this->data);
		}
		else $this->load->view('butor/butor_content_json', $this->data);
	}	
	
	
	public function getProductVersion($version, $versionId=null){
		$this->data['result'] = $this->ButorModel->getProductVersion($version, $versionId);
		
		$pos = $this->searchPos($versionId, $this->session->userdata('current_products'));
		//echo $pos;
		
		/*if(isset($this->session->userdata('current_products')[$pos+1]))$this->data['next'] = $pos+1;
		else $this->data['next'] = false;
		
		if(isset($this->session->userdata('current_products')[$pos-1]))$this->data['prev'] = $pos-1;
		else $this->data['prev'] = false;*/
		
		//$this->load->view("butor/product", $this->data);
		
		$this->load->view("butor/butor_header", $this->data);
		$this->load->view("butor/butor_product_menu", $this->data);
		$this->load->view("butor/butor_subscribe", $this->data);
		$this->load->view("butor/butor_sponsors", $this->data);
		//$this->load->view("butor/butor_news", $this->data);
		$this->load->view("butor/butor_product_content", $this->data);
		$this->load->view("butor/butor_sponsors_2", $this->data);
		$this->load->view("butor/butor_footer", $this->data);
		
	}	
	
	
	public function getProductMenu(){
		$menuTemp = $this->ButorModel->getProductMenu();
		
		//var_dump($this->data['result']);
		
		$this->menu = array();
		
		foreach($menuTemp as $res_key => $res_val){
			if(!isset($this->menu[$res_val->name])){
				$this->menu[$res_val->name] = array();
				$this->menu[$res_val->name]['title'] = $res_val->title;
				if($res_val->subName)$this->menu[$res_val->name]['subcategory'] = array();
				$this->menu[$res_val->name]['all_in'] = $res_val->all_product;
			}
			/*else{
				$this->menu[$res_val->name]['title'] = [$res_val->title]
				$this->menu[$res_val->name]['subcategory'] = [$res_val->subName]
			}*/
			
			if($res_val->subName)$this->menu[$res_val->name]['subcategory'][$res_val->subName] = $res_val->subTitle;
		}
		
		$this->data['menu'] = $this->menu;
		
		//$this->load->view('butor/butor_product_menu-2', $this->data);
		
		//var_dump($this->menu);
		
		/*foreach($this->menu as $key => $value){
			echo "<br>-----------------------------------------------<br>";
			echo $key.': '.$value['title'].'<br>';
			echo "all_in: ".$value['all_in'].'<br>';
			if(isset($value['subcategory'])){
				foreach($value['subcategory'] as $skey => $sval){
					echo '<pre>'.$skey.": ".$sval.'<br></pre>';
				}
			}
		}*/
	}
	
	
	
	public function makeOneDimensionalArray($arrayToMake){
		$productArray = array();
		
		foreach($arrayToMake as $cpKey => $cpItem){
			if(is_array($cpItem)){
				foreach($cpItem as $cpCpItem){
					$productArray[] = $cpCpItem;
				}
			}
			else $productArray[] = $cpItem;
		}
		
		return $productArray;
	}
	
	
	
	public function searchPos($idSearchFor, $arraToSearchFor){
		//echo "valami";
		
		foreach($arraToSearchFor as $cpKey => $cpItem){	
			if($cpItem->id == $idSearchFor){
				return $cpKey;
				break;
			}
		}
		
		//echo "<br><br>".$this->session->userdata('current_product_pos');
	}
	
	public function queryContent(){
		$this->data['json_data'] = $this->session->userdata('current_products');
		$this->load->view('butor/butor_content_json', $this->data);
	}
	
}