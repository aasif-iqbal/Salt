<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff_Model
 *
 * @author asif
 */
 class EStore_Model extends CI_Model{
     
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function fetch_categories_for_parent()
    { 

        $query = "SELECT parent_id,parent_category_name
        FROM tbl_category_patents 
        WHERE status = '1'" ;

          $q = $this->db->query($query);

         $final = [];
         if ($q->num_rows() > 0) {
            
            foreach($q->result() as $row){
                $q = "SELECT * FROM tbl_category_children WHERE 
                fk_parent_id = $row->parent_id";
                
                $q_new = $this->db->query($q);
                if ($q_new->num_rows() > 0) {
                    $row->children = $q_new->result();
                }
                array_push($final,$row);
            
           }
           return $final;          
        }
           else {
               return NULL;
           }  
    }
    // To selct Brand name with Product
    // SELECT tp.product_name,tb.brand_name FROM `tbl_products` AS tp  INNER JOIN tbl_brands AS tb ON tp.product_brand_id = tb.brand_id WHERE tp.status=1;
// ================================= Login & Registration =================================
    public function saveRegistration($data, $data_login)
    {
        $this->db->set('user_uuid','UUID()', FALSE);

        if($data && $data_login){            
            $this->db->insert('tbl_registration', $data);    
            $this->db->insert('tbl_login', $data_login);  
            
            return TRUE;
        }else{
            
            $this->db->_error_message();
            return FALSE;
        }         
    }

    public function fetchLoginDetails($login_data)
    {
        
        // $query = "SELECT login_id,phone_no,password,status 
        //           FROM tbl_login WHERE phone_no='$login_data['phone_no']' AND password='$login_data['password']' ";
        
        $query = $this->db->select('*')->from('tbl_login')->where($login_data)->get();
        $query2 = $this->db->select('user_uuid')->from('tbl_registration')->where($login_data)->get();

        if ($query2->num_rows() > 0) {
            $result2 = $query2->result();       
            // var_dump($result2[0]->user_uuid);
        }

        if ($query->num_rows() > 0) {
            $result = $query->result();       
            if(isset($result[0]->status))
            {
                return $data = [
                    'user_uuid' =>$result2[0]->user_uuid,
                    'is_active'=> $result[0]->status,
                    'phone_no'=> $result[0]->phone_no,
                    'password'=> $result[0]->password,
                ];
            }else{
                echo("Not Set");
            }
        }   
        else {
            return NULL;
        }
    }

    // ================ Product_details page ==========================
    public function fetchProductImages($product_uuid)
    {
        $query = "SELECT image_id,product_id,product_uuid,
                  prd_img_1,prd_img_2,prd_img_3,prd_img_4,prd_img_5,prd_img_6,status 
                  FROM tbl_product_images WHERE product_uuid='$product_uuid'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }
    }

    public function fetchSingleProduct($product_uuid)
    {
        $query = "SELECT product_id,product_uuid,product_name,article_no,product_main_image,product_short_description,product_long_description,product_mrp,product_selling_price,discount_percentage,product_size,product_color FROM tbl_main_product WHERE product_uuid='$product_uuid'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }
    }

    public function fetchAvilableSizeVariation($product_uuid)
    {
        $query = "SELECT sz.size_id,
                         sz.size_name,
                         vr.product_size,
                         mp.product_size
                    FROM tbl_sizes AS sz INNER JOIN tbl_product_variation AS vr 
                    ON sz.size_id = vr.product_size 
                    INNER JOIN tbl_main_product AS mp ON vr.product_id = mp.product_id 
                    WHERE mp.product_uuid='$product_uuid' ORDER BY sz.size_id";
                

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }
    }

    public function fetchAvilableColorVariation($product_uuid)
    {
        $query = "SELECT cl.color_id,
                         cl.color_name,
                         cl.hex_code,
                         vr.product_color,
                         mp.product_color
                    FROM tbl_colors AS cl INNER JOIN tbl_product_variation AS vr 
                    ON cl.color_id = vr.product_color 
                    INNER JOIN tbl_main_product AS mp ON vr.product_id = mp.product_id 
                    WHERE mp.product_uuid='$product_uuid' ORDER BY cl.color_id";
                
        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }
    }
// ======================================= Shipping details ====================================

public function getSingleCustomerInfo($user_uuid)
{
    $query = "SELECT * FROM tbl_registration WHERE user_uuid='$user_uuid'";

    $q = $this->db->query($query);        

    if ($q->num_rows() > 0) {
        return $q->result();       
    }   
    else {
        return NULL;
    }
}

public function updateEditedAddress($data, $user_uuid)
{
    // print_r($data['addr_house_no']);
    // print_r($user_uuid);
    // die();
 /*
    $query = "UPDATE `tbl_registration` SET 
                    `addr_house_no` = '".$data['addr_house_no']."',
                    `addr_locality` = '".$data['addr_locality']."',
                    `addr_city` = '".$data['addr_city']."',
                    `addr_pin_code` = '".$data['addr_pin_code']."',
                    `addr_type` = '".$data['addr_type']."'
                     WHERE user_uuid = '".$user_uuid."' ";
*/
/*

*/
    $data = array(
        'receivers_phone_no' => $data['receivers_phone_no'],
        'addr_house_no'      => $data['addr_house_no'],
        'addr_locality'      => $data['addr_locality'],
        'addr_city'          => $data['addr_city'],
        'addr_pin_code'      => $data['addr_pin_code'],
        'addr_type'          => $data['addr_type']
    );
    
    $this->db->where('user_uuid', $user_uuid);
    $this->db->update('tbl_registration',$data); 

    // $this->db->set('addr_house_no', $data['addr_house_no']);
    // $this->db->set('addr_locality', $data['addr_locality']);
    // $this->db->set('addr_city', $data['addr_city']);
    // $this->db->set('addr_pin_code', $data['addr_pin_code']);
    // $this->db->set('addr_type', $data['addr_type']);

    // $this->db->where('user_uuid', $user_uuid);
    // $this->db->update('tbl_registration'); 
    
    

    $afftectedRows = $this->db->affected_rows();
    // var_dump($afftectedRows);
     if ($afftectedRows == 1) {
        return TRUE;
    }else{
        return FALSE;
    }        
}

//======================================= End Shipping details ============================


//============================ Product cart details selected by User =======================


public function saveCartDetails($data)
{
    if($data){                    
            $this->db->insert('tbl_cart', $data);          
        return TRUE;
    }else{        
        $this->db->_error_message();
        return FALSE;
    }      
}

// check before adding new product
public function checkProductExistInCart($product_uuid, $user_uuid, $product_size_id,$product_color_id)
{
    $query = "Select * FROM tbl_cart WHERE product_uuid='{$product_uuid}' AND user_uuid='{$user_uuid}' AND product_size_id='{$product_size_id}' AND product_color_id='{$product_color_id}'";

    $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }
}

//update only when user_uuid,product_uuid,color_id,and size_id will same
public function updateCartDetails($product_uuid, $user_uuid)
{
    $this->db->set('product_quantity', 'product_quantity + 1', FALSE);
    $this->db->where('product_uuid', $product_uuid);
    $this->db->where('user_uuid', $user_uuid);
    $this->db->update('tbl_cart');
}

public function saveCartItemsAfterLogin($cartItems,$userLoginData)
{
    // $cartItems_arr = explode(' ', $cartItems);
    
    // print_r((json_decode($cartItems)[0]->id));
    // print_r($userLoginData);
    // die();
}

public function fetch_product_color($product_uuid,$color_id)
{
    $query = "Select * FROM tbl_product_colors WHERE product_uuid='{$product_uuid}' AND variation_color_id = '{$color_id}'";

    $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }  
}

public function fetchTotalProductQuantity($product_uuid)
{
    $query = "Select `product_quantity` FROM tbl_main_product WHERE product_uuid='{$product_uuid}'";
    // exit($query);
    $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            // print_r($q->result());
            return $q->result();       
        }   
        else {
            return NULL;
        }
}

public function removeItemFromCart($item_local_id = NULL, $product_uuid, $user_uuid)
{
    if($item_local_id != NULL){
        if($item_local_id && $product_uuid){
            $this->db->delete('tbl_cart', array('localstorage_id' => $item_local_id,'product_uuid'=>$product_uuid));
            return TRUE;
        }else{
            echo "Error: " .  $this->db->_error_message();
            return FALSE;
        }
    }else{
        if($user_uuid && $product_uuid){
            $this->db->delete('tbl_cart', array('user_uuid' => $user_uuid,'product_uuid'=>$product_uuid));
            return TRUE;
        }else{
            echo "Error: " .  $this->db->_error_message();
            return FALSE;
        }
    }   
}

public function incrementItemFromCart($item_local_id = NULL, $product_uuid, $user_uuid,$product_count)
{
    /*
        check total_product_quantity(stocks) before adding product_quantity
        also check for 0 ie product_quantity < 0
        print_r(gettype((int)$total_product_quantity));    
        print_r(gettype((int)$product_quantity));    
    */ 
    $total_product_quantity = $this->fetchTotalProductQuantity($product_uuid);
    $total_quantity = $total_product_quantity[0]->product_quantity;

    // print_r(gettype($product_count));
    // echo (int)$product_count;

    // if((int)$total_quantity > (int)$product_count){
        
        if($item_local_id != NULL){
            // Before Login,Product added in Cart
            if($item_local_id && $product_uuid){                        
                    $this->db->set('product_quantity', 'product_quantity + 1', FALSE);                
                    $this->db->where('localstorage_id', $item_local_id);        
                    $this->db->where('product_uuid', $product_uuid);        
                    $this->db->update('tbl_cart');
                return TRUE;
                }else{
                        echo "Error: " .  $this->db->_error_message();
                return FALSE;
            }
        }else{
            // After Login,Product added in Cart
            if($user_uuid && $product_uuid){            
                $this->db->set('product_quantity', 'product_quantity + 1', FALSE);
                $this->db->where('user_uuid', $user_uuid);        
                $this->db->where('product_uuid', $product_uuid);        
                $this->db->update('tbl_cart');
            return TRUE;
            }else{
                echo "Error: " .  $this->db->_error_message();
                return FALSE;
            }
        }
    // }else{ 
    //     return 'Product not in db';
    // }
}

public function decrementItemFromCart($item_local_id = NULL, $product_uuid, $user_uuid,$product_count)
{    
    $total_product_quantity = $this->fetchTotalProductQuantity($product_uuid);
    $total_quantity = $total_product_quantity[0]->product_quantity;
    
    // print_r($product_count);
    // print_r(($total_quantity));

    // if((int)$total_quantity > (int)$product_count){

        if($item_local_id != NULL){
            // Before Login,Product added in Cart
            if($item_local_id && $product_uuid){            
                    $this->db->set('product_quantity', 'product_quantity - 1', FALSE);
                    // $this->db->where('product_quantity <', $total_product_quantity);
                    // $this->db->where('product_quantity >', 0);
                    $this->db->where('localstorage_id', $item_local_id);        
                    $this->db->where('product_uuid', $product_uuid);        
                    $this->db->update('tbl_cart');
                return TRUE;
            }else{
                        echo "Error: " .  $this->db->_error_message();
                return FALSE;
            }
        }else{
            // After Login,Product added in Cart
            if($user_uuid && $product_uuid){            
                $this->db->set('product_quantity', 'product_quantity - 1', FALSE);
                // $this->db->where('product_quantity <', $total_product_quantity);
                // $this->db->where('product_quantity >', 0);
                $this->db->where('user_uuid', $user_uuid);        
                $this->db->where('product_uuid', $product_uuid);        
                $this->db->update('tbl_cart');
            return TRUE;
            }else{
                // echo "Error: " .  $this->db->_error_message();
                return FALSE;
            }
       }
    // }else{
    //     return 'Product not in db';
    // }
}

//======================== my cart page =========================================

public function fetch_cart_items_by_user($user_uuid)
{
    $query = "Select * FROM tbl_cart WHERE user_uuid='{$user_uuid}'";

    $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }  
}

public function fetch_cart_items_by_user_json($user_uuid)
{
    $query = "Select user_uuid,
                     product_uuid,
                     product_name,
                     product_image,
                     product_quantity,
                     product_size_name,
                     product_color_name,
                     product_selling_price 
            FROM tbl_cart WHERE user_uuid='{$user_uuid}'";

    $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }  
}

public function saveCashOnDelivery($data)
{
    // die();
        $this->db->set('order_uuid','UUID()', FALSE);

        if($data){            

            $this->db->insert('tbl_orders', $data);                            
            return TRUE;
        }else{
            
            $this->db->_error_message();
            return FALSE;
        }         
}

public function saveOnlinePayment($data)
{
    // die();
        $this->db->set('order_uuid','UUID()', FALSE);

        if($data){            

            $this->db->insert('tbl_orders', $data);                            
            return TRUE;
        }else{
            
            $this->db->_error_message();
            return FALSE;
        }         
}

public function fetchOrderInfoByUser($user_uuid)
{
    $query = "Select * FROM tbl_orders WHERE user_uuid = '{$user_uuid}'";

    $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }  
}

public function saveShippingInfoByUser($shipping_data){
    
    $this->db->set('shipping_uuid','UUID()', FALSE);

        if($shipping_data){            

            $this->db->insert('tbl_shipping_orders', $shipping_data);                            
            return TRUE;
        }else{
            $this->db->_error_message();
            return FALSE;
        }
}

public function saveUsersRatingNReviews($rating_reviews_data){
    
    $this->db->set('rating_uuid','UUID()', FALSE);

    if($rating_reviews_data){            
        $this->db->insert('tbl_rating_reviews', $rating_reviews_data);                            
        return TRUE;
    }else{
        $this->db->_error_message();
        return FALSE;
    }
}


//======================== product filter page =========================================
    public function getRecordCount($cat_slug, $color_flag, $price_flag, $discount_flag)
    {
       
        $query = "SELECT COUNT(product_uuid) as count From tbl_main_product WHERE status='1' AND slug_cat_child='$cat_slug' "; 
          
        
           
    //    exit($query);
        if($color_flag != 0){
         
             $query .= "AND product_color_id  LIKE '$color_flag%'";
        }

         //For price-flag = 1 ie Rs. 199 to Rs. 599 
         if($price_flag == 1){
            
            $query .= "AND product_actual_price >= '199' AND  product_actual_price <= '599'";            
        }
        
        //For price-flag = 2 ie Rs. 599 to Rs. 999
         if($price_flag == 2){
            
            $query .= "AND product_actual_price >= '599' AND  product_actual_price <= '999'";            
        }

        //For price-flag = 3 ie Rs. 999 to Rs. 1999
        if($price_flag == 3){
                    
            $query .= "AND product_actual_price >= '999' AND  product_actual_price <= '1999'";            
        }

        //For price-flag = 4 ie Rs. 1999 to Rs. 2999
        if($price_flag == 4){
                            
            $query .= "AND product_actual_price >= '1999' AND  product_actual_price <= '2999'";            
        }

        //For price-flag = 5 ie Rs. 2999 to Rs. 5999
        if($price_flag == 5){
                            
            $query .= "AND product_actual_price >= '2999' AND  product_actual_price <= '5999'";            
        }

          //For discount-flag = 1 ie 20% and above
          if($discount_flag == 1){
            
            $query .= "AND product_discount >= '20' AND  product_discount <= '100'";            
        }

        //For discount-flag = 2 ie 20% and above
        if($discount_flag == 2){
            
            $query .= "AND product_discount >= '30' AND  product_discount <= '100'";            
        }

        //For discount-flag = 3 ie 20% and above
        if($discount_flag == 3){
            
            $query .= "AND product_discount >= '50' AND  product_discount <= '100'";            
        }

        //For discount-flag = 4 ie 20% and above
        if($discount_flag == 4){
            
            $query .= "AND product_discount >= '60' AND  product_discount <= '100'";            
        }

        //For discount-flag = 5 ie 20% and above
        if($discount_flag == 5){
            
            $query .= "AND product_discount >= '70' AND  product_discount <= '100'";            
        }


        $q = $this->db->query($query);
        
        return $q->result_array()[0]['count']; 
    }


// Product-filter
public function getProductData($limit, $offset, $cat_slug, $color_flag, $price_flag, $discount_flag)
{
    
    $query = "SELECT * FROM tbl_main_product WHERE status ='1' AND slug_cat_child='$cat_slug' ";
    //$query = "SELECT TP.product_name,TB.brand_name,TP.product_image,TP.product_brand_id,TP.product_actual_price,TP.product_mrp,TP.product_discount FROM `tbl_products` AS TP INNER JOIN tbl_brands
    //          AS TB ON TP.status = TB.status WHERE TP.status ='1'";   

    
    //    exit($query);
    if($color_flag != 0){
        
            $query .= "AND product_color_id  LIKE '$color_flag%'";
    }
 
    //For price-flag = 1 ie Rs. 199 to Rs. 599 
    if($price_flag == 1){
        
        $query .= "AND product_actual_price >= '199' AND  product_actual_price <= '599'";            
    }
    
    //For price-flag = 2 ie Rs. 599 to Rs. 999
     if($price_flag == 2){
        
        $query .= "AND product_actual_price >= '599' AND  product_actual_price <= '999'";            
    }

    //For price-flag = 3 ie Rs. 999 to Rs. 1999
    if($price_flag == 3){
                
        $query .= "AND product_actual_price >= '999' AND  product_actual_price <= '1999'";            
    }

    //For price-flag = 4 ie Rs. 1999 to Rs. 2999
    if($price_flag == 4){
                        
        $query .= "AND product_actual_price >= '1999' AND  product_actual_price <= '2999'";            
    }

    //For price-flag = 5 ie Rs. 2999 to Rs. 5999
    if($price_flag == 5){
                        
        $query .= "AND product_actual_price >= '2999' AND  product_actual_price <= '5999'";            
    }

   
   
    //For discount-flag = 1 ie 20% and above
     if($discount_flag == 1){
        
        $query .= "AND product_discount >= '20' AND  product_discount <= '100'";            
    }

    //For discount-flag = 2 ie 20% and above
    if($discount_flag == 2){
        
        $query .= "AND product_discount >= '30' AND  product_discount <= '100'";            
    }

    //For discount-flag = 3 ie 20% and above
    if($discount_flag == 3){
        
        $query .= "AND product_discount >= '50' AND  product_discount <= '100'";            
    }

    //For discount-flag = 4 ie 20% and above
    if($discount_flag == 4){
        
        $query .= "AND product_discount >= '60' AND  product_discount <= '100'";            
    }

    //For discount-flag = 5 ie 20% and above
    if($discount_flag == 5){
        
        $query .= "AND product_discount >= '70' AND  product_discount <= '100'";            
    }

        $query .= "LIMIT $offset, $limit"; //offset->No. of records to skip and it will chnge after every click to nxt pg.
        //  exit($query);
      $q = $this->db->query($query);
    
     if ($q->num_rows() > 0) {
            return $q->result_array();       
       }   
       else {
           return NULL;
       }  
}




} //class-ends

