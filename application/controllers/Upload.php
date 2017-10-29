<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
			//	$this->load->library('image_lib');
				$this->load->model('user_model');
        }

        public function index()
        {
                if(!$this->user_model->checkUserLoginAndAccess( /*"universallist/ul_list" */ $this->uri->uri_string(), get_class($this), false))return ;
				
				$this->load->view("universallist/ul_menu");
				$this->load->view('get_images/upload-form', array('error' => ' ' ));
        }

        public function do_upload()
        {
				if(!$this->user_model->checkUserLoginAndAccess( /*"universallist/ul_list" */ $this->uri->uri_string(), get_class($this), false))return ;
        	
                $config['upload_path']          = './content/images/';
                
                if($this->input->post('path'))$config['upload_path'] .= $this->input->post('path');
                
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000;
                $config['max_width']            = 10000;
                $config['max_height']           = 10000;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view("universallist/ul_menu");
						$this->load->view('get_images/upload-form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        
                        $data['upload_data']['path'] = $this->input->post('path');
                        //echo "path 1: ".$this->input->post('path');

                        $this->load->view("universallist/ul_menu");
						$this->load->view('get_images/upload-success', $data);
						
						
/*
 ******************** KÉP MÉRETEZÉS *******************************************************************************************************
 */ 
 
						$this->load->library('image_lib');
						
						if(!preg_match('/(\/sm\/)/', $config['upload_path'])){
							$config2['image_library'] = 'gd2';
							$config2['source_image'] =  $config['upload_path'].$data['upload_data']['orig_name'];
							$config2['width']         = 1024;

							$this->image_lib->initialize($config2);
							
							if ( ! $this->image_lib->resize())
							{
								echo $this->image_lib->display_errors();
							}
							
							if(preg_match('/(\/lg\/)/', $config['upload_path'])){
								$config2['image_library'] = 'gd2';
								$config2['source_image'] =  $config['upload_path'].$data['upload_data']['orig_name']; 
								$config2['new_image'] =  preg_replace('/\/lg\//', "/sm/", $config['upload_path']); 
								$config2['height']       = 100;
						
								$this->image_lib->clear();
								$this->image_lib->initialize($config2);

								if ( ! $this->image_lib->resize())
								{
									echo $this->image_lib->display_errors();
								}
							}
						}
						else{
							$config2['image_library'] = 'gd2';
							$config2['source_image'] =  $config['upload_path'].$data['upload_data']['orig_name'];
							$config2['new_image'] =  preg_replace('/\/sm\//', "/lg/", $config['upload_path']);
							$config2['width']         = 1024;

							$this->image_lib->clear();
							$this->image_lib->initialize($config2);
							
							if ( ! $this->image_lib->resize())
							{
								echo $this->image_lib->display_errors();
							}	
							
							
							$config2['image_library'] = 'gd2';
							$config2['source_image'] =  $config['upload_path'].$data['upload_data']['orig_name']; 
							$config2['height']       = 100;
							unset($config2['width']);
							unset($config2['new_image']);
					
							$this->image_lib->clear();
							$this->image_lib->initialize($config2);

							if ( ! $this->image_lib->resize())
							{
								echo $this->image_lib->display_errors();
							}
						}
				}
/*
 ******************** KÉP MÉRETEZÉS VÉGE *******************************************************************************************************
 */				
		}
}
?>