<?php

class ButorModel extends CI_Model{
		function __construct(){
		parent::__construct();
		
		$this->load->database();
	}
	
	
	public function getNews($newsName){
		
		if(!$newsName)$sql = sprintf("SELECT * FROM butor_news WHERE active=1 ORDER BY news_order");
		else $sql = sprintf("SELECT * FROM butor_news WHERE name='%s'", $newsName);
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	

	public function getCategories(){
		
		$sql = sprintf("SELECT butor_category.id, butor_category.name, butor_category.title, butor_category.img as imgName, butor_subcategory.id as isSubCategory, all_product FROM `butor_category` LEFT JOIN butor_subcategory ON butor_subcategory.categoryID=butor_category.id WHERE active=1 GROUP BY butor_category.name ORDER BY cat_order");
	
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	
	public function getCategory($category){
	
		$sql = sprintf("SELECT butor_product.id, butor_product.name, butor_product.title, butor_product.small_img smallPrImg, butor_product.img PrImg, butor_product.text PrText, butor_category.text CaText, butor_category.title CaTitle, butor_category.all_product, butor_product_version.id isPV FROM butor_product LEFT JOIN butor_category ON butor_product.categoryID=butor_category.id LEFT JOIN butor_product_version ON butor_product_version.productID=butor_product.id WHERE butor_category.name='%s' AND butor_product.active=1 GROUP BY butor_product.name ORDER BY product_order", $category);
		
		$query = $this->db->query($sql);
		
		return $query->result();

	}
	

	public function getSubcategories($category){
		
		$sql = sprintf("SELECT butor_subcategory.id,butor_subcategory.name, butor_subcategory.title as subcategoryTitle, butor_category.title, butor_subcategory.img, butor_category.text FROM butor_subcategory LEFT JOIN butor_category ON butor_category.id=butor_subcategory.categoryID  WHERE butor_category.name='%s' ORDER BY subcategory_order", $category);
	
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	
	public function getSubcategory($subcategory){
	
		$sql = sprintf("SELECT butor_product.id, butor_product.product_separator sep, butor_product.name, butor_product.title, butor_product.small_img smallPrImg, butor_product.img PrImg, butor_product.text PrText, butor_subcategory.text CaText, butor_subcategory.text_top CaTopText, butor_subcategory.title CaTitle, butor_category.title CaMainTitle, butor_category.text CaMainText, butor_product_version.id isPV	FROM `butor_product` LEFT  JOIN butor_subcategory ON butor_product.subcategoryID=butor_subcategory.id LEFT JOIN butor_category ON butor_category.id=butor_subcategory.categoryID LEFT JOIN butor_product_version ON butor_product_version.productID=butor_product.id WHERE butor_subcategory.name='%s' AND butor_product.active=1 GROUP BY butor_product.name  ORDER BY product_order", $subcategory);
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	
	public function getProduct($product, $productId=null){
	
		if(!$productId)$sql = sprintf("SELECT butor_product.id, butor_product.name, butor_product.title, butor_product_version.name as vName, butor_product.img, butor_product.text FROM butor_product LEFT JOIN butor_product_version ON butor_product.id=butor_product_version.productID WHERE butor_product.name='%s' AND butor_product.active=1 GROUP BY butor_product.name", $product);
		else $sql = sprintf("SELECT butor_product.id, butor_product.name, butor_product.title, butor_product_version.name as vName, butor_product.img, butor_product.text FROM butor_product LEFT JOIN butor_product_version ON butor_product.id=butor_product_version.productID WHERE butor_product.id=%d AND butor_product.active=1 GROUP BY butor_product.name", $productId);

		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	
	public function getProductVersions($product, $productId=null){
	
		/*if(!$productId)$sql = sprintf("SELECT butor_product_version.id, butor_product_version.title as subcategoryTitle, butor_product_version.name, butor_product.title, butor_product_version.small_img as img, butor_product.text PrText, butor_product_version.text, butor_product.name Pname, butor_product.id Pid FROM butor_product_version LEFT JOIN butor_product ON butor_product.id=butor_product_version.productID WHERE butor_product.name='%s' ORDER BY product_version_order", $product);
		else*/ $sql = sprintf("SELECT butor_product_version.id, butor_product_version.title as subcategoryTitle, butor_product_version.name, butor_product.title, butor_product_version.small_img as img, butor_product.text PrText, butor_product_version.text, butor_product.name Pname, butor_product.id Pid FROM butor_product_version LEFT JOIN butor_product ON butor_product.id=butor_product_version.productID WHERE butor_product.id=%d ORDER BY product_version_order", $productId);

		//echo $sql;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	
	public function getProductVersion($version, $versionId= null){
	
		if(!$versionId)$sql = sprintf("SELECT butor_product_version.id, butor_product_version.name, butor_product_version.title Vtitle, butor_product_version.img, butor_product_version.text, butor_product.title FROM `butor_product_version` LEFT JOIN butor_product ON butor_product.id=butor_product_version.productID WHERE butor_product_version.name='%s'", $version);
		else $sql = sprintf("SELECT butor_product_version.id, butor_product_version.name, butor_product_version.title Vtitle, butor_product_version.img, butor_product_version.text, butor_product.title FROM `butor_product_version` LEFT JOIN butor_product ON butor_product.id=butor_product_version.productID WHERE butor_product_version.id=%d", $versionId);

				
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	
	
	public function getProductMenu(){
		$sql = sprintf("SELECT butor_category.id, butor_category.name, butor_category.title, butor_category.img as imgName, butor_subcategory.id as isSubCategory, butor_subcategory.name subName, butor_subcategory.title subTitle, all_product FROM `butor_category` LEFT JOIN butor_subcategory ON butor_subcategory.categoryID=butor_category.id WHERE active=1 ORDER BY cat_order, subcategory_order");
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function queryCategory($category){
		$sql = sprintf("SELECT * FROM butor_category WHERE name='%s'", $category);
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	
}