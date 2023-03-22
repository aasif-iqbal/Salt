<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	function __construct() {
        parent::__construct(); 
		
		$this->load->helper('url');
        $slug = '';
        $this->load->model('Admin_model');
	}

	// Slug-generator
	public static function slugify($text, string $divider = '-')
	{
	// replace non letter or digits by divider
	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, $divider);

	// remove duplicate divider
	$text = preg_replace('~-+~', $divider, $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
	}

	public function index()
	{	
		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');	
		$this->load->view('admin/index');
		$this->load->view('admin/footer');
	}	

	// upload image for ads on main page of website i.e banner
	public function uploadBanner()
	{
		$this->load->view('admin/banner');
	}

	public function add_categories()
	{
		
		// $data['categories_all'] = $this->Admin_model->fetch_categories_for_parent__();
		$data['categories_all'] = $this->Admin_model->showTable();
		$data['showParent'] = $this->Admin_model->showParent();
		 
		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');
		// main-contain
		$this->load->view('admin/add_categories', $data);

		$this->load->view('admin/footer');
	}

	public function getParentInfo()
	{
		$parent_name = $this->input->post('parent_cat_name');
		$data['parent_category_name'] = $parent_name;
		$slug = Admin_Controller::slugify($parent_name);
		$data['slug'] = $slug;		
		$data['status'] = 1;

		$this->Admin_model->insertParentInfo($data);

		$this->session->set_flashdata('add_menu', 'Record has been added');
		redirect(base_url('add-categories'));    
	}

	public function getChildInfo()
	{
		
		$child_name = $this->input->post('child_category_name');
		$data['child_category_name'] = $child_name;
		$slug = Admin_Controller::slugify($child_name);
		$data['slug'] = $slug;
		$data['fk_parent_id'] = $this->input->post('fk_parent_id');
		$data['status'] = 1;
		// print_r($data);die();
		$this->Admin_model->insertChildInfo($data);
		
		$this->session->set_flashdata('add_menu', 'Record has been added');
		redirect(base_url('add-categories'));    		
	}

	public function add_products()
	{
		$data['parent_category'] = $this->Admin_model->fetchParentCategories();
		$data['product_sizes'] = $this->Admin_model->showSizes();
		$data['product_colors'] = $this->Admin_model->showColors();

		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');
		// main-contain
		$this->load->view('admin/add_products', $data);

		$this->load->view('admin/footer');
	}

	public function getCategories_ajax()
	{
		$main_parent_cat = $this->input->post('main_parent_cat');
		$categoriesList = $this->Admin_model->fetchCategoriesByParentId($main_parent_cat);
		
		echo (json_encode($categoriesList));
	}

	public function show_product_list()
	{
		$data['product_list'] = $this->Admin_model->fetchProductList();

		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');
		// main-contain
		$this->load->view('admin/product_list', $data);

		$this->load->view('admin/footer');
	}

	public function add_variation($product_uuid)
	{
		// print_r($product_uuid);
		$data['selected_product'] = $this->Admin_model->fetchSingleProduct($product_uuid);
		$data['product_sizes'] = $this->Admin_model->showSizes();
		
		$data['product_colors'] = $this->Admin_model->showColors();
		$data['variation'] = $this->Admin_model->fetchProductVariationDetails($product_uuid);

		// $data['product_sizes_obj'] = $this->Admin_model->showSizes_Obj();
		// $value = $data['product_sizes_obj'];

		// $obj = [];

		// foreach($value as $val){
			
		// 	$size_id = $val['size_id'];
			
		// 	$obj.array_push($val['size_id'],$val['size_id']);
		// }
		// var_dump($obj);
		// die();
		
		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');
		// main-contain
		$this->load->view('admin/add_variation', $data);

		$this->load->view('admin/footer');
	}
// ============================= Add Product Images =================================

	public function add_images($product_uuid)
	{
		// print_r($product_uuid);
		$data['selected_product'] = $this->Admin_model->fetchSingleProduct($product_uuid);
		
		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');
		// main-contain
		$this->load->view('admin/add_images', $data);

		$this->load->view('admin/footer');

	}

		// Store image for add_image to each product(for product details page)
		public function store_image()
		{
			$data = [];		
	
			$count_img = count($_FILES['files']['name']);
			// print_r($count_img);
			if($count_img <= 6){
	
			for($i=0; $i < $count_img; $i++)
			{   
				if(!empty($_FILES['files']['name'][$i])){
				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type']= $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name']= $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error']= $_FILES['files']['error'][$i];
				$_FILES['file']['size']= $_FILES['files']['size'][$i];  
				
				$config['upload_path']   = './upload_img/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']      = '10000000';
				$config['file_name'] 	 = $_FILES['files']['name'][$i];
				// $config['overwrite']     = FALSE;			
	
				$this->upload->initialize($config);
				//$this->load->library('upload', $config);
	
					if($this->upload->do_upload('file')){
						$uploadedData = $this->upload->data();
						$filename = $uploadedData['file_name'];
	
						$data['totalFiles'][] = $filename;
						// print_r($data['totalFiles']);
					}else{
						$error = array('error' => $this->upload->display_errors());						   
						print_r($error);
						
					}
				}
			}
		}else{
			print_r("mx=6");die();
		}
			// var_dump($_FILES);
			echo("<pre/>");
			// print_r($data['totalFiles']);
			$dataInfo = $data['totalFiles'];
			// print_r($dataInfo[0]);
			// die();
			$data = array(
				'product_id' => $this->input->post('product_id'),
				'product_uuid' => $this->input->post('product_uuid'),
				'prd_img_1' => isset($dataInfo[0])?$dataInfo[0]:0,
				'prd_img_2' => isset($dataInfo[1])?$dataInfo[1]:0,
				'prd_img_3' => isset($dataInfo[2])?$dataInfo[2]:0,
				'prd_img_4' => isset($dataInfo[3])?$dataInfo[3]:0,
				'prd_img_5' => isset($dataInfo[4])?$dataInfo[4]:0,
				'prd_img_6' => isset($dataInfo[5])?$dataInfo[5]:0,
				// 'created_time' => date('Y-m-d H:i:s')
			 );
			 print_r($data);
			//  die();
			 $result_set =  $this->Admin_model->saveMultipleImagesForMainProduct($data);
			 if($result_set){
				redirect(base_url('product-list'));    
			 }else{
				print_r('errorr');
				die();
			 }
		}
// ============================= End Add Product Images =================================


// ============================ Add Colored Images For Product ==========================

	public function add_colored_images($product_uuid)
	{
		// print_r($product_uuid);
		$data['selected_product'] = $this->Admin_model->fetchSingleProduct($product_uuid);
		$data['product_colors'] = $this->Admin_model->showColorsByVariationTable($product_uuid);

		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');
		// main-contain
		$this->load->view('admin/add_colored_images', $data);

		$this->load->view('admin/footer');

	}

	public function store_colored_image()
	{
		$data = [];		

    	$count_img = count($_FILES['files']['name']);
		// print_r($count_img);
		if($count_img <= 6){

		for($i=0; $i < $count_img; $i++)
		{   
			if(!empty($_FILES['files']['name'][$i])){
			$_FILES['file']['name'] = $_FILES['files']['name'][$i];
			$_FILES['file']['type']= $_FILES['files']['type'][$i];
			$_FILES['file']['tmp_name']= $_FILES['files']['tmp_name'][$i];
			$_FILES['file']['error']= $_FILES['files']['error'][$i];
			$_FILES['file']['size']= $_FILES['files']['size'][$i];  
			
			$config['upload_path']   = './colors_img/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']      = '10000000';
			$config['file_name'] 	 = $_FILES['files']['name'][$i];
			// $config['overwrite']     = FALSE;			

			$this->upload->initialize($config);
			//$this->load->library('upload', $config);

				if($this->upload->do_upload('file')){
					$uploadedData = $this->upload->data();
					$filename = $uploadedData['file_name'];

					$data['totalFiles'][] = $filename;
					// print_r($data['totalFiles']);
				}else{
					$error = array('error' => $this->upload->display_errors());						   
					print_r($error);
					
				}
			}
		}
	}else{
		print_r("mx=6");die();
	}
		// var_dump($_FILES);
		// echo("<pre/>");
		// print_r($data['totalFiles']);
		$dataInfo = $data['totalFiles'];
		// print_r($dataInfo[0]);
		// die();
		$result_explode_color = $this->input->post('product_color');
		$result_explode_color = explode('_', $result_explode_color);
		$data = array(						
			// 'variation_id' = 
			//for product_color and product_color_name			
			'variation_color_id' => $result_explode_color[0],
			'variation_color_name' => $result_explode_color[1],
			'product_uuid' => $this->input->post('product_uuid'),
			'prod_color_img1' => isset($dataInfo[0])?$dataInfo[0]:0,
			'prod_color_img2' => isset($dataInfo[1])?$dataInfo[1]:0,
			'prod_color_img3' => isset($dataInfo[2])?$dataInfo[2]:0,
			'prod_color_img4' => isset($dataInfo[3])?$dataInfo[3]:0,
			'prod_color_img5' => isset($dataInfo[4])?$dataInfo[4]:0,			
			// 'created_time' => date('Y-m-d H:i:s')
		 );
		//  print_r($data);
		//  die();
		$result_set =  $this->Admin_model->saveMultipleImagesForProductColor($data);
		 if($result_set){
			redirect(base_url('product-list'));    
		 }else{
			print_r('errorr= data not inserted successfully');
			die();
		 }
	}

// ========================= End Add Colored Images For Product ==========================	

	public function submit_products()
	{
		$data['product_name'] = $this->input->post('product_name');
		// print_r($data);die();
		$slug_product = $data['product_name'];
		$data['slug_product'] = Admin_Controller::slugify($slug_product);
		$data['brand_name'] = 'ZARA';
		$data['article_no'] = $this->input->post('article_no');
		$data['parent_cat_id'] = $this->input->post('parent_cat_id');
		//for child_id and slug
		$result_explode = $this->input->post('child_cat_id');
		$result_explode = explode('|', $result_explode);
		$data['child_cat_id'] = $result_explode[0];
		$data['slug_cat_child'] = $result_explode[1];				
		
		$data['product_short_description'] = $this->input->post('product_short_description');
		$data['product_long_description'] = $this->input->post('product_long_description');
		
		//for product_size and product_size_name
		$result_explode_size = $this->input->post('product_size');
		$result_explode_size = explode('_', $result_explode_size);
		$data['product_size'] = $result_explode_size[0];
		$data['product_size_name'] = $result_explode_size[1];	
		
		//for product_color and product_color_name
		$result_explode_color = $this->input->post('product_color');
		$result_explode_color = explode('_', $result_explode_color);
		$data['product_color'] = $result_explode_color[0];
		$data['product_color_name'] = $result_explode_color[1];	
		
		$data['product_quantity'] = $this->input->post('product_quantity'); //stocks
		$data['product_mrp'] = $this->input->post('product_mrp');
		$data['product_selling_price'] = $this->input->post('product_selling_price');
		$data['discount_percentage'] = $this->input->post('discount_percentage');
			// Image upload
			if(!empty($_FILES['userfile']['name'])){ 
				   // Set preference 
				//    $config['upload_path']          =  base_url('images');
				//    $config['upload_path']          =  base_url().'uploads/';
				   $config['upload_path']          =  './uploads/';
				   $config['allowed_types']        = 'gif|jpg|png';
				   $config['max_size']             = 100000; //in kbs
				//    $config['max_width']            = 1024;
				//    $config['max_height']           = 768;
			
				//    $this->load->library('upload', $config);
				   $this->upload->initialize($config);	
				
				   if ( ! $this->upload->do_upload('userfile'))
				   {
						
					$error = array('error' => $this->upload->display_errors());						   
						//    print_r($error);						
				   }
				   else
				   {
						$image_data = array('upload_data' => $this->upload->data());						
				   } 
				}else{ 
					//    $image_data['response'] = 'failed-2'; 					
				} 

				$data['product_main_image'] = $image_data['upload_data']['file_name'];
				$data['product_main_image'] = isset($data['product_main_image'])?$data['product_main_image']:"default_img";
				// var_dump($data);
				// die();
		$saveProductDetails = $this->Admin_model->saveProductDetails($data);
		redirect(base_url('add-products'));    
		}
	
	
	public function submit_product_variation_ajax()
	{
		$data['product_id'] = $this->input->post('product_id');
		$data['product_uuid'] = $this->input->post('product_uuid');		

		//for product_size and product_size_name
		$result_explode_size = $this->input->post('product_size');
		$result_explode_size = explode('_', $result_explode_size);
		$data['product_size'] = $result_explode_size[0];
		$data['product_size_name'] = $result_explode_size[1];	
		
		//for product_color and product_color_name
		$result_explode_color = $this->input->post('product_color');
		$result_explode_color = explode('_', $result_explode_color);
		$data['product_color'] = $result_explode_color[0];
		$data['product_color_name'] = $result_explode_color[1];		

		$data['product_quantity'] = $this->input->post('product_quantity');
		$data['product_mrp'] = $this->input->post('product_mrp');
		$data['product_selling_price'] = $this->input->post('product_selling_price');
		$data['discount_percentage'] = $this->input->post('discount_percentage');
		
		$saveProductDetails = $this->Admin_model->saveProductVariationDetails($data);
		
		echo json_encode($saveProductDetails);
		// show notification for product upload successsubmit_product_variation
		// $this->add_variation($data['product_uuid']);
		//redirect(base_url('add-variation/').$data['product_uuid']); 
	}

	public function show_shipping()
	{
		$data['shipping_info'] = $this->Admin_model->showShippingInfo();

		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');
		
		// main-contain
		$this->load->view('admin/show_shipping', $data);

		$this->load->view('admin/footer');	
	}

	public function show_shipping_status()
	{
		$this->load->view('admin/header');	
		$this->load->view('status');	
	}

	public function update_shipping_status()
	{
		$conformation_code = $this->input->post('conformation_code');
		
		$updatedStatus = $this->Admin_model->checkForUpdateShipping($conformation_code);

		if($updatedStatus == TRUE){
			var_dump("Status_updated");die();
		}else{
			print_r('Not Status_updated');
		}
		
	}
	
	public function show_total_stocks(){
		
		$data['total_stocks'] = $this->Admin_model->total_stocks();

		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');
		
		// main-contain
		$this->load->view('admin/total_stocks', $data);

		$this->load->view('admin/footer');	
	}

	public function edit_product_with_variation($product_uuid){
		// var_dump($product_uuid);die();

		$data['productsWithVariations'] = $this->Admin_model->fetchProductsWithVariations($product_uuid);
		$this->load->view('admin/header');	
		$this->load->view('admin/side_nav');	
		$this->load->view('admin/top_nav');

		$this->load->view('admin/edit_product', $data);
		
		$this->load->view('admin/footer');	
	}

	public function update_product_with_variation($product_uuid)
	{
		$main_product['product_name'] = $this->input->post('product_name');
		var_dump($product_name);die();
	}


/*
	public function uploadVideos(){
        try{
            $imgId="img";
            $tmp_file=$_FILES["files"]["tmp_name"];
            $file_name=$_FILES["files"]["name"];

            if($tmp_file!=null){
				$length=count($tmp_file);
				$uploadedlength=0;
                for($i=0; $i<count($tmp_file); $i++){

                    $filename = explode(".",$file_name[$i]);

					$ext = end($filename);

					$newfileName = $imgId."-".rand().".".$ext;
                    $path = "images/".$newfileName;

                    if(in_array($ext,array('jpeg','jpg','png','gif'))){

                        if(move_uploaded_file($tmp_file[$i],"./".$path)){
                           $uploadedlength++;
                        }
                        else{
							// failed to upload
                        }
                    }
                    else{
                            echo "Wrong file format";
                    }
                }

                if($uploadedlength==$length){
                    //echo($newfileName);die();
                    
                    //sending image file to model
                    $this->Banner_Model->saveBannerPath($newfileName);
					
                    //echo "Success";
                    redirect(base_url('banner')); 
				}
				else{
					echo "Failed to upload file";
				}
            }
            else{
                echo "File note found to upload";
            }
        }
        catch(Exception $e){
            echo "Internal Server Error";
        }
    }
*/




}
