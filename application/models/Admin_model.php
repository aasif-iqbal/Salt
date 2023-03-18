<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_Model
 *
 * @author asif
 */
 class Admin_Model extends CI_Model{
     
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function fetch_categories_for_parent__()
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

    public function insertParentInfo($data)
    {
        if($data){
            $this->db->insert('tbl_category_patents', $data);    
        }else{
            $this->db->_error_message();
        }          
    }
   
    public function insertChildInfo($data)
    {
        if($data){
            $this->db->insert('tbl_category_children', $data);    
        }else{
            $this->db->_error_message();
        }          
    }

    public function showTable()
    {
        $query = "SELECT parent.parent_id,parent.parent_category_name,child.child_id,child.child_category_name,child.fk_parent_id FROM tbl_category_patents AS parent INNER JOIN tbl_category_children AS child ON parent.parent_id = child.fk_parent_id WHERE parent.status='1' ORDER BY parent.parent_category_name";

        $q = $this->db->query($query);        

         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return array();
           }  
    }

    public function showParent()
    {
        $query = "SELECT parent_id,parent_category_name FROM tbl_category_patents WHERE status='1'";

        $q = $this->db->query($query);        

         if ($q->num_rows() > 0) {
                return $q->result();       
           }   
           else {
               return array();
           }  
    }    

    public function saveProductDetails($data)
    {
        $this->db->set('product_uuid','UUID()', FALSE);
        if($data){
            
            $this->db->insert('tbl_main_product', $data);    
        }else{
            $this->db->_error_message();
        }         
    }

    public function fetchProductList()
    {
        $query = "SELECT product_id,product_uuid,product_name,article_no FROM tbl_main_product WHERE status='1'";

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
        $query = "SELECT product_id,product_uuid,product_color,product_name,article_no,product_main_image FROM tbl_main_product WHERE product_uuid='$product_uuid'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
               return $q->result();       
          }   
          else {
              return NULL;
          }  
    }
    
    public function fetchProductVariationDetails($product_id)
    {
        $query = "SELECT variant_id,product_id,product_uuid,product_size,
        product_color,product_mrp,product_selling_price,discount_percentage,
        product_quantity FROM tbl_product_variation WHERE product_uuid='$product_id'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
               return $q->result();       
          }   
          else {
              return NULL;
          }    
    }

    public function saveProductVariationDetails($data)
    {
        // print_r($data);
        if($data){            
            $this->db->insert('tbl_product_variation', $data); 
            return TRUE;   
        }else{
            $this->db->_error_message();
            return FALSE;
        }            
    }

    public function saveMultipleImagesForMainProduct($data)
    {
        if($data){            
            $this->db->insert('tbl_product_images', $data); 
            return TRUE;   
        }else{
            $this->db->_error_message();
            return FALSE;
        }            
        //
        // return $this->db->insert_batch('tbl_product_images',$image);
    }

    public function showColorsByVariationTable($product_uuid)
    {
        // Show how many variation have this Single Product
        $query = "SELECT variant_id,product_uuid,
        product_color,product_color_name FROM tbl_product_variation WHERE product_uuid='$product_uuid'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
               return $q->result();       
          }   
          else {
              return NULL;
          }    
    }
		
    public function saveMultipleImagesForProductColor($data){
        if($data){            
            $this->db->insert('tbl_product_colors', $data); 
            return TRUE;   
        }else{
            $this->db->_error_message();
            return FALSE;
        }            
    }

    public function fetchParentCategories()
    {
        $query = "SELECT parent_id,parent_category_name,slug
                 FROM tbl_category_patents WHERE status='1'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
               return $q->result();       
          }   
          else {
              return NULL;
          }      
    }

    public function fetchCategoriesByParentId($main_parent_cat)
    {
        $query = "SELECT child_id,child_category_name,slug
        FROM tbl_category_children WHERE status='1' AND  fk_parent_id='$main_parent_cat'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        } 
    }

    public function showSizes(){
        $query = "SELECT size_id,size_name FROM tbl_sizes WHERE status='1'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }
    }

    public function showSizes_Obj(){
        $query = "SELECT size_id,size_name FROM tbl_sizes WHERE status='1'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result_array();       
        }   
        else {
            return NULL;
        }
    }

    public function showColors(){
        $query = "SELECT color_id,color_name FROM tbl_colors WHERE status='1'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result();       
        }   
        else {
            return NULL;
        }
    }

    public function showShippingInfo()
    {
        $query = "SELECT * FROM tbl_shipping_orders WHERE status='1'";

        $q = $this->db->query($query);        

        if ($q->num_rows() > 0) {
            return $q->result_array();       
        }   
        else {
            return NULL;
        }
    }

} //class-ends

