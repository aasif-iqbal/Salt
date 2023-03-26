<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EStore_Controller extends CI_Controller {

	function __construct() {
        parent::__construct(); 
		
		$this->load->helper('url');
        
        $this->load->model('EStore_model');
	}


	public function index()
	{
		
	}

	public function showProductsByCategories($category_slug='')
	{
		// echo('here'); 
		$data['item_count'] = $this->session->userdata('item_count');			

		$data['nav_categories'] = $this->EStore_model->fetch_categories_for_parent();
		$data['category_slug'] = $category_slug;
		$this->load->view('eStore/libs');
		$this->load->view('eStore/nav', $data);
		$this->load->view('eStore/product_filter.php', $data);
		$this->load->view('eStore/footer');

		
	}
//============================  User Login & Registration ============================
	public function showUserRegistration()
	{
		/* 
			1. Collect user data ie name,phone number,address (user form)
			2. Insert all, also generate uuid() for single user in Reg_table and not in login_table
			3. Fetch uuid,phone_no from  Reg_table of last_inserted_data;
			4. update login_table set uuid where phone_no, = $phone_no;

			get last_inserted_id: $mysqli->insert_id;
		*/
		$this->load->view('eStore/libs');
		$this->load->view('eStore/register');
	}

	public function showUserLogin()
	{
		$this->load->view('eStore/libs');		
		$this->load->view('eStore/login');		
	}

	public function checkForLogin(){
		// From localstorage
		$cartItems = $this->input->post('cartItems');
		
		$login_data['phone_no'] = $this->input->post('chk_phone_no');
		$login_data['password'] = $this->input->post('chk_password');
		
		if(isset($login_data) && !empty($login_data)){

			$isValid = $this->EStore_model->fetchLoginDetails($login_data);
// var_dump($isValid);die();
			if($isValid != NUll && $login_data['phone_no'] === $isValid['phone_no'] 
				&& $login_data['password'] === $isValid['password']){
					
					if($isValid['is_active'] === '1'){

						$userLoginData = $isValid;
						//Set userdata into session
						$this->session->set_userdata('userLoginData', $userLoginData);
																		
						// var_dump($userLoginData);
						$this->load->view('eStore/libs');	
						// $this->load->view('eStore/checkout', $userLoginData);

						//if user is login then save to localsession(cart items) to tbl_cart
						$this->EStore_model->saveCartItemsAfterLogin($cartItems, $userLoginData);

						redirect(base_url('/')); 
					}else{
						$err['msg'] = 'Inactive Username';
						$this->load->view('eStore/libs');	
						$this->load->view('eStore/login', $err);
					}
				}else{
					echo("Worng Username or Password");
					$err['msg'] = 'Worng Username or Password';
					$this->load->view('eStore/libs');	
					$this->load->view('eStore/login',$err);
				}
			}		
	}
	// send localstorage data to controller in codeigniter
	public function checkForLogin_ajax(){

	}

	public function submitRegistration(){
		
		$data['user_name'] 			= $this->input->post('user_name');
		$data['email'] 				= $this->input->post('email');
		$data['phone_no'] 			= $this->input->post('phone_no');
		$data['password'] 			= $this->input->post('password_val');
		$data['receivers_phone_no'] = $this->input->post('receivers_phone_no');
		$data['addr_house_no'] 		= $this->input->post('addr_house_no');
		$data['addr_locality'] 		= $this->input->post('addr_locality');
		$data['addr_city'] 			= $this->input->post('addr_city');
		$data['addr_pin_code'] 		= $this->input->post('addr_pin_code');
		$data['addr_state'] 		= $this->input->post('addr_state');
		$data['addr_country'] 		= $this->input->post('addr_country');		
		$data['addr_type'] 			= $this->input->post('addr_type');

		//Login_table
		$data_login['phone_no'] = $data['phone_no'];
		$data_login['password'] = $data['password'];
		 
		$status = $this->EStore_model->saveRegistration($data, $data_login);
		if($status){

			redirect(base_url('login'));    
		}
		// var_dump($data);
	}

	public function logout(){
		//Unset session
		$this->session->unset_userdata('userLoginData');
		$this->session->unset_userdata('cart_value');
		
		// $this->load->view('eStore/libs');
		// $this->load->view('Welcome');
		redirect(base_url('/')); 
	}
//=========================== End User Login & Registration =======================
	
// ========================== Show Product Details ================================
	public function showProductDetails($product_uuid = NULL)
	{
		// print_r(current_url());
		// echo($product_uuid);
		
		$data['product_imgs'] = $this->EStore_model->fetchProductImages($product_uuid);
		$data['product_main'] = $this->EStore_model->fetchSingleProduct($product_uuid);
		
		//avilable_size_var (Price will same)
		$data['avilable_size_variation'] = $this->EStore_model->fetchAvilableSizeVariation($product_uuid);
		$data['avilable_color_variation'] = $this->EStore_model->fetchAvilableColorVariation($product_uuid);
		$data['nav_categories'] = $this->EStore_model->fetch_categories_for_parent();		
		
		$data['item_count'] = $this->session->userdata('item_count');			
		
		//Ratings and Reviews
		$data['rating_reviews'] = $this->EStore_model->fetch_reviews_rating_for_product($product_uuid);		
		
		$data['rateResult'] = $this->EStore_model->fetch_product_rating_number($product_uuid);

		$this->load->view('eStore/libs');
		$this->load->view('eStore/nav', $data);
		$this->load->view('eStore/product_details', $data);
		$this->load->view('eStore/footer');
	}
	public function show_product_color_ajax(){
		
		$color_id = $this->input->post('color_id');
		$product_uuid = $this->input->post('product_uuid');

		$data = $this->EStore_model->fetch_product_color($product_uuid, $color_id);

		echo json_encode($data);
	}

// ========================== End Show Product Details ===================================

// =================================== Add to Cart =======================================
	public function add_to_cart_ajax()
	{
		$item_count = $this->input->post('item_count');
		$this->session->set_userdata('item_count', $item_count);			
		// print_r('here');
		// die();
		$data['product_uuid']  = $this->input->post('product_uuid');
		$data['user_uuid'] 	   = $this->input->post('user_uuid');
		$data['product_name']  = $this->input->post('product_name');				
		
		//for product_size and product_size_name
		$result_explode_size = $this->input->post('product_size');
		$result_explode_size = explode('_', $result_explode_size);
		$data['product_size_id'] = $result_explode_size[0];
		$data['product_size_name'] = $result_explode_size[1];	
		
		//for product_color and product_color_name
		$result_explode_color = $this->input->post('product_color');
		$result_explode_color = explode('_', $result_explode_color);
		$data['product_color_id'] = $result_explode_color[0];
		$data['product_color_name'] = $result_explode_color[1];		

		$data['product_quantity'] = $this->input->post('product_quantity');
		$data['product_image'] = $this->input->post('product_image')?$this->input->post('product_image'):'0';
		$data['product_mrp'] = $this->input->post('product_mrp')?$this->input->post('product_mrp'):0;
		$data['product_selling_price'] = $this->input->post('product_selling_price')?$this->input->post('product_selling_price'):0;
		$data['product_discount'] = $this->input->post('discount_percentage')?$this->input->post('discount_percentage'):0;
			
		$data['item_count'] = $item_count;

		if($data['product_uuid']  && $data['user_uuid']){
			//send pro_uuid and user_uuid to db and check, if avilable then update,else insert
			//Also check for color and Size
			//same product have diff color and size, So it will not update 
			//same product have diff color and size, will inserted with new cart_id
			$product_status = $this->EStore_model->checkProductExistInCart(
								$data['product_uuid'], 
								$data['user_uuid'],
								$data['product_size_id'],
								$data['product_color_id']
							);	

			if($product_status == NULL)	{
				//insert
				// print_r('insert');die();
				$status = $this->EStore_model->saveCartDetails($data);
				$status = 'insert';
			}else{
				//update only when user_uuid,product_uuid,color_id,and size_id will same
				// print_r('update');die(); // update product_quantity
				$status = $this->EStore_model->updateCartDetails($data['product_uuid'], $data['user_uuid']);	
				$status = 'update';
			}
		}		
		//Update product when user add same product(product_uuid_same and user_uuid)
		// echo($item_count);		
		echo json_encode($status);
	}

	public function myCart()
	{
		$data['item_count'] = $this->session->userdata('item_count');			

		$data['nav_categories'] = $this->EStore_model->fetch_categories_for_parent();
		
		//for login user
		$session_user_data = $this->session->userdata('userLoginData');
		
		if(isset($session_user_data)){
			// print_r($session_user_data);
			$user_uuid = $session_user_data['user_uuid'];
			if(isset($user_uuid)){
				$data['cart_items'] = $this->EStore_model->fetch_cart_items_by_user($user_uuid);
			}
			$this->load->view('eStore/libs');
			$this->load->view('eStore/nav', $data);
			$this->load->view('eStore/my_cart_db.php', $data);
			$this->load->view('eStore/footer');

		}else{
			//Data  from localstorage
			$this->load->view('eStore/libs');
			$this->load->view('eStore/nav', $data);
			$this->load->view('eStore/my_cart.php', $data);
			$this->load->view('eStore/footer');
		}						
	}

	// remove item from cart - From Database
	public function remove_item_from_cart_ajax(){
		/*
		case - if user is login then we have to use user_uuid and product_uuid
		case - if user is login and add item to card then localStorage_id will return NULL
		case - if user is Not-Login then we have to use localStorage_id and product_uuid		
		*/
		$item_local_id = $this->input->post('item_local_id');
		$product_uuid = $this->input->post('product_uuid');
		$user_uuid = $this->input->post('user_uuid');

		$status = $this->EStore_model->removeItemFromCart($item_local_id,$product_uuid,$user_uuid);
				
		echo json_encode($status);
	}

	public function increment_item_from_cart_ajax(){
		/*
		case - if user is login then we have to use user_uuid and product_uuid
		case - if user is login and add item to card then localStorage_id will return NULL
		case - if user is Not-Login then we have to use localStorage_id and product_uuid		
		*/
		$item_local_id 	  = $this->input->post('item_local_id');
		$product_uuid 	  = $this->input->post('product_uuid');
		$user_uuid 		  = $this->input->post('user_uuid');
		$product_count 	  = $this->input->post('product_count');
		
		
		$status = $this->EStore_model->incrementItemFromCart($item_local_id, $product_uuid,$user_uuid, $product_count);
		
		echo json_encode($status);
	}

	public function decrement_item_from_cart_ajax(){
		/*
		case - if user is login then we have to use user_uuid and product_uuid
		case - if user is login and add item to card then localStorage_id will return NULL
		case - if user is Not-Login then we have to use localStorage_id and product_uuid		
		*/

		$item_local_id 	  = $this->input->post('item_local_id');
		$product_uuid 	  = $this->input->post('product_uuid');
		$user_uuid 		  = $this->input->post('user_uuid');
		$product_count 	  = $this->input->post('product_count');				
		
		$status = $this->EStore_model->decrementItemFromCart($item_local_id, $product_uuid,$user_uuid, $product_count);
		
		echo json_encode($status);
	}
//============================== End Add to Cart =======================================

// ================================= Shipping_details ======================================

public function shippingDetails(){
	
	$data['nav_categories'] = $this->EStore_model->fetch_categories_for_parent();
	$userLoginData = $this->session->userdata('userLoginData'); 
	// print_r($userLoginData);
	// if(isset($userLoginData)){
		
	// }

	$user_uuid = $userLoginData['user_uuid'] ? $userLoginData['user_uuid']:'NULL';

	$data['customerInfo'] = $this->EStore_model->getSingleCustomerInfo($user_uuid);
	
	$data['customerCartItems'] = $this->EStore_model->fetch_cart_items_by_user($user_uuid);
	
	//For Json Data	to store in tbl_orders
	$data['customerCartItems_Json'] = $this->EStore_model->fetch_cart_items_by_user_json($user_uuid);

	$this->load->view('eStore/libs');
	$this->load->view('eStore/nav', $data);
	$this->load->view('EStore/Shipping_details', $data);
	$this->load->view('eStore/footer');	
}

public function editCustomerAddress(){
	// $data['nav_categories'] = $this->EStore_model->fetch_categories_for_parent();
	$userLoginData = $this->session->userdata('userLoginData'); 
	// print_r($userLoginData);
	$data['customerInfo'] = $this->EStore_model->getSingleCustomerInfo($userLoginData['user_uuid']);

	$this->load->view('eStore/libs');
	// $this->load->view('eStore/nav', $data);
	$this->load->view('EStore/edit_customer_address', $data);
	// $this->load->view('eStore/footer');	

}

public function submitEditedAddress(){

		$userLoginData = $this->session->userdata('userLoginData'); 
	 
	
		// $data['user_name'] = $this->input->post('user_name');		 
		// $data['phone_no'] = $this->input->post('phone_no');
		 
		
		$data['receivers_phone_no'] = $this->input->post('receivers_phone_no');
		$data['addr_house_no'] 		= $this->input->post('addr_house_no');
		$data['addr_locality'] 		= $this->input->post('addr_locality');
		$data['addr_city'] 			= $this->input->post('addr_city');
		$data['addr_pin_code'] 		= $this->input->post('addr_pin_code');
		// $data['addr_state'] = $this->input->post('addr_state');
		// $data['addr_country'] = $this->input->post('addr_country');		
		
		$data['addr_type'] 			= $this->input->post('addr_type');
		
		// print_r($data);die();
		$user_uuid = $userLoginData['user_uuid'];
		$updatedAddress = $this->EStore_model->updateEditedAddress($data, $user_uuid);
		
		if($updatedAddress){
			redirect(base_url('shipping')); 
		}else{
			echo('Not Edited');
		}

}

private function generateRandomNumber(){
	return mt_rand(100000,999999);
}

public function cashOnDelivery_ajax()
{
	$data['productInfo_json'] = $this->input->post('productInfo_json');	
	
	$cart_items_selectedByUser = json_decode($data['productInfo_json'], true);
	
	foreach ($cart_items_selectedByUser as $item) {
		$data['user_uuid'] = $this->input->post('user_uuid');
		$data['transaction_datetime'] = date('Y-m-d H:i:s');
		$data['transaction_status'] = '1';
		$data['conformation_code'] = $this->generateRandomNumber();
		//Inserting into table orders
		$status =  $this->EStore_model->saveCashOnDelivery($data);
	}
	

	// $data['user_uuid'] = $this->input->post('user_uuid');
	// $data['transaction_datetime'] = date('Y-m-d H:i:s');
	// $data['transaction_status'] = '1';
	// $data['conformation_code'] = $this->generateRandomNumber();		 

	// $status =  $this->EStore_model->saveCashOnDelivery($data);
	
	//After Payment is made, Info in send to order_shipping tbl
	if($status){
		$user_uuid = $data['user_uuid'];
		//get last inserted id
		$order_info = $this->EStore_model->fetchOrderInfoByUser($user_uuid);
		
		// print_r(count($order_info));		 
			$shipping_data['order_uuid'] = $order_info[0]->order_uuid;
			$shipping_data['user_uuid'] = $order_info[0]->user_uuid;
			$shipping_data['product_json'] = $order_info[0]->productInfo_json;
			$shipping_data['payment_mode'] = $order_info[0]->transaction_status;
			$shipping_data['shipping_status'] = 0; //Pending
			$shipping_data['conformation_code'] = $data['conformation_code'];
			
			$status2 = $this->EStore_model->saveShippingInfoByUser($shipping_data);		

		// Mapping all shipping-product with user_uuid
		$json_string = $order_info[0]->productInfo_json;
		// Decode the JSON string to a PHP array
		$cart_items = json_decode($json_string, true);
		// var_dump($cart_items);die();
		// Loop through the array to process each cart item
		foreach ($cart_items as $item) {
			
			$mapping_data['user_uuid'] = $item['user_uuid'];
			$mapping_data['product_uuid'] = $item['product_uuid'];
			$mapping_data['product_name'] = $item['product_name'];			
			$mapping_data['shipping_status'] = $shipping_data['shipping_status'];
			$mapping_data['delivery_confirm_code'] = $shipping_data['conformation_code'];
			

			$this->EStore_model->saveMappingData($mapping_data);
		}
		// die();
	}else{
		echo json_encode("Not set");	
	}
	//if $status && $status2 is true
	echo json_encode($status);
}

public function onlinePayment_ajax()
{
	$data['transaction_id'] = $this->input->post('payment_id');
	
	$data['productInfo_json'] = $this->input->post('productInfo_json');
	/*
		loop each product with new order_uuid So that, 
		User will able to cancel single product with single order_uuid
		$val = $data['productInfo_json'];
	*/

	$data['total_amount'] = $this->input->post('total_amount');	
	$data['user_uuid'] = $this->input->post('user_uuid');
	
	
	$data['transaction_datetime'] = date('Y-m-d H:i:s');

	$status =  $this->EStore_model->saveOnlinePayment($data);
	echo json_encode($status);	 	
}


public function thankYouPage()
{
	$this->load->view('eStore/libs');
	return $this->load->view('eStore/thankyou');
}

public function customer_orders()
{
	$userLoginData = $this->session->userdata('userLoginData'); 
	$user_uuid = $userLoginData['user_uuid'];

	$data['nav_categories'] = $this->EStore_model->fetch_categories_for_parent();

	$data['customer_orders_list'] = $this->EStore_model->fetch_order_list_for_Customer($user_uuid);

	$this->load->view('eStore/libs');
	$this->load->view('eStore/nav', $data);
	$this->load->view('EStore/customer_orders',$data);
	$this->load->view('eStore/footer');	
}

public function customerOrderCancellation()
{
	$userLoginData = $this->session->userdata('userLoginData'); 
	$user_uuid = $userLoginData['user_uuid'];

	$data['nav_categories'] = $this->EStore_model->fetch_categories_for_parent();


	$this->load->view('eStore/libs');
	$this->load->view('eStore/nav', $data);
	$this->load->view('EStore/customer_order_cancellation');
	$this->load->view('eStore/footer');	
}
// ============================== End Shipping_details ==================================

// ==============================

public function saveRatings()
{
	
	$data['rating_title']  = $this->input->post('title');
	$data['rating_number'] = $this->input->post('rating');
	$data['product_uuid']  = $this->input->post('product_uuid');
	$data['user_uuid'] 	   = $this->input->post('user_uuid');
	$data['user_name']     = $this->input->post('user_name');
	
	$data['rating_comment'] = $this->input->post('comment');
	
	// isVerifiedBuyer	- ie he/she purchased item
	$verifiedBuyer = $this->EStore_model->fetchVerifiedBuyer($data['user_uuid'],$data['product_uuid']);
	
	if($verifiedBuyer[0]['shipping_status'] == '1')
	{
		$data['isVerifiedBuyer'] = '1';
		// print_r($verifiedBuyer[0]['shipping_status']);die();
	}else{
		$data['isVerifiedBuyer'] = '0';
	}

	$status =  $this->EStore_model->saveUsersRatingNReviews($data);
	echo json_encode($status);	 
	// echo($title);die();
}













// ================================= Product-Details Page ==================================

	public function product_filter_ajax()
	{
		$cat_slug = $this->input->post('cat_slug');
		//post-data
		$pageNumber = $this->input->post('pgNum');
		$per_page = $this->input->post('perPg');
		// echo json_encode($cat_slug);die();
		
		//-----------Getting total Number of  Records From database------------------
		$total_rows = $this->EStore_model->getRecordCount($cat_slug, $color_flag=0, $price_flag=0, $discount_flag=0);
		// echo json_encode($total_rows);die();
		$linkData = $this->createLink($pageNumber, $per_page, $total_rows, $cat_slug,$color_flag=0, $price_flag=0, $discount_flag=0);
        // print_r($linkData['total_pages']);die(); 

										// Limit-$per_page, offset-$linkData['offset']
		$tableData = $this->EStore_model->getProductData($per_page, $linkData['offset'],$cat_slug, $color_flag=0, $price_flag=0, $discount_flag=0);
			// var_dump($tableData);
		echo json_encode(array('perPageOptions' => $linkData['perPageOptions'],
                                'pageLink' => $linkData['pageLink'],
                                'tableData' => $tableData,
                                'totalRow' => $linkData['total_pages'],
                                'currentPg'=>$linkData['current_page']
                                ));
	}	

	 // ############################ pagination library ##################################
	 private function createLink($i, $per_page, $total_rows, $cat_slug, $color_flag=0,$price_flag=0,$discount_flag=0){ // here $i is requested Page
		// print_r($i); // 1
		// print_r($per_page); //10
		// print_r($total_rows); // 32054
		//-------------calculating total number of pages---------------------------------------
				$l = 0;  // Total Number Of Page
				if($total_rows % $per_page){
					$l=intval($total_rows/$per_page)+1;
				}
				else{
					$l=intval($total_rows/$per_page);
				}
			   
				if($l==1){ $i=1;}
		
				//------------Page Link Configuration -------------------------
				$config=[
					"full_tag_open" => "<ul class='pagination'>",
					"full_tag_close" => "</ul>",
		
					"first_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'showProduct(1 '.",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."')".'" class="page-link">First'.'</a></li>',
					
					//search for $link.=$config['last_tag']; and uncomment
					"last_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'showProduct('.$l.",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."')".'" class="page-link">Last'.'</a></li>',
		
		
					"next_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'showProduct('.($i+1).",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."')".'" class="page-link">>'.'</a></li>',
					"next_tag_mute" => '<li class="page-item"><p class="page-link">></p></li>',
					 
		
					"prev_tag" => '<li class="page-item"><a href="javascript:void(0)" onclick="'.'showProduct('.($i-1).",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."')".'" class="page-link"><'.'</a></li>',
					"prev_tag_mute" => '<li class="page-item"><p class="page-link"><</p></li>',
					
		
					"num_tag_open" => '<li class="page-item"><a href="javascript:void(0)" onclick="showProduct(',
					"num_tag_mid" => ')" class="page-link">',
					"num_tag_close" =>'</a></li>',
		
					"cur_tag" => '<li class="page-item active"><a href="javascript:void(0)" onclick="showProduct('.$i.",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."')".'" class="page-link">'.$i.'</a></li>',
					
				];
		
				//--------------- Creating Page Link ---------------------------------------------
					$pageLink = $this->pageLinkFun($config,$i,$l,$cat_slug,$color_flag,$price_flag, $discount_flag);
		
				// ---------------------Creating Per Page Options----------------------------------
					$perPageOptions = $this->perPageOptionsFun($per_page);
		
				// --------------------- Getting Offset -------------------------------------------
		
					$offset=$this->calculateOffset($i,$per_page);
				//  print_r($l);die();// total pg no
				//------Putting Page Link, Per Page Options And offset  into one array ------------
					$linkData=array(
						'pageLink' => $pageLink,
						'perPageOptions' => $perPageOptions,
						'offset' => $offset,
						'total_pages'=>$l,
						'current_page'=>$i
					);
					return $linkData;
			}
		
			private function pageLinkFun($config,$i,$l,$cat_slug,$color_flag,$price_flag,$discount_flag){
		
				//--------------- Creating Page Link -----------------------------------
		
				$link=$config['full_tag_open'];
		
				if($i>3 && $l!=1){
					$link.=$config['first_tag'];
				}
				if($i>1 && $l!=1){
					$link.=$config['prev_tag'];
				}
		
				if($l==1){
					$link.=$config['prev_tag_mute'];
					
				}
		
				if(($i-2)>=1){
		
					$link.=$config['num_tag_open'];
					$link.=$i-2;
					$link.=",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."'";
					$link.=$config['num_tag_mid'];
					$link.=$i-2;
					$link.=$config['num_tag_close'];
		
					$link.=$config['num_tag_open'];
					$link.=$i-1;
					$link.=",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."'";
					$link.=$config['num_tag_mid'];
					$link.=$i-1;
					$link.=$config['num_tag_close'];
		
					$link.=$config['cur_tag'];
				}
				else if(($i-1)>=1){
		
					$link.=$config['num_tag_open'];
					$link.=$i-1;
					$link.=",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."'";
					$link.=$config['num_tag_mid'];
					$link.=$i-1;
					$link.=$config['num_tag_close'];
		
					$link.=$config['cur_tag'];
				}
				else{
					$link.=$config['cur_tag'];
				}
		
		
				if(($i+2)<=$l){
		
					$link.=$config['num_tag_open'];
					$link.=$i+1;
					$link.=",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."'";
					$link.=$config['num_tag_mid'];
					$link.=$i+1;
					$link.=$config['num_tag_close'];
		
					$link.=$config['num_tag_open'];
					$link.=$i+2;
					// $link.=",'".$cat_slug."','".$color_flag."'";
					$link.=",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."'";
					$link.=$config['num_tag_mid'];
					$link.=$i+2;
					$link.=$config['num_tag_close'];
				}
				else if(($i+1)<=$l){
		
					$link.=$config['num_tag_open'];
					$link.=$i+1;
					// $link.=",'".$cat_slug."','".$color_flag."'";
					$link.=",'".$cat_slug."','".$color_flag."','".$price_flag."','".$discount_flag."'";
					$link.=$config['num_tag_mid'];
					$link.=$i+1;
					$link.=$config['num_tag_close'];
				}
		
				if(($i+2)<$l){
					$link.=$config['next_tag'];
					$link.=$config['last_tag'];
				}
				else if(($i+1)<=$l){
					$link.=$config['next_tag'];
				}
		
				if($l==1){
					$link.=$config['next_tag_mute'];
				}
		
				$link.=$config['full_tag_close'];
		
				return $link;
			}
		
		
			private function perPageOptionsFun($per_page){
		
				// ---------------------Creating Per Page Options------------------------	
		
				$perPageOptions='<select id="perPage" name="perPage">';
		
				for($k=10; $k<=100; $k+=10){
					if($per_page=="".$k){
						$perPageOptions.='<option selected value="';
						$perPageOptions.=$k;
						$perPageOptions.='">';
						$perPageOptions.=$k;
						$perPageOptions.='</option>';
					}
					else{
						$perPageOptions.='<option value="';
						$perPageOptions.=$k;
						$perPageOptions.='">';
						$perPageOptions.=$k;
						$perPageOptions.='</option>';
					}
				}
									 
				$perPageOptions.='</select>';
		
		
				return $perPageOptions;
			}
			private function calculateOffset($requestedPg,$per_page){
				// --------------------- Calculating Offset ------------------------
				$offset = ($requestedPg-1)*$per_page;
				return $offset;
			}
}
