<!DOCTYPE html>
<html lang="en">
<style type="text/css">
  /* size of product */
.size-choose div {
  display: inline-block;
}

.size-choose input[type="radio"] {
  display: none;
}

.size-choose input[type="radio"] + label span {
  display: inline-block;
  width: 50px;
  height: 50px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
}

.size-choose input[type="radio"] + label span {
  border: 2px solid #FFFFFF;
  box-shadow: 0 1px 3px 0 rgba(0,0,0,0.33);
}

.size-choose input[type="radio"]#size + label span {
  background-color: #F5F5F5;
}

.size-choose input[type="radio"]:checked + label span {
  background-image: url(image/ring.svg);
  background-repeat: no-repeat;
  background-position: center;
}
/* Pin Code Button */
.pinCode-btn {
  float: right;
  margin-left: -25px;
  margin-top: -38px;
  margin-right: 100px;
  position: relative;
  z-index: 2;
}
  /* Zoom In Product */
figure {
  margin: 0;
  padding: 0;
  background: #fff;
  overflow: hidden;
}
figure:hover+span {
  bottom: -36px;
  opacity: 1;
}
.hover01 figure img {
  -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-transition: .4s ease-in-out;
  transition: .4s ease-in-out;
}
.hover01 figure:hover img {
  -webkit-transform: scale(1.3);
  transform: scale(1.3);
}
.color-box {
  background-color: <?php echo $color_variation->hex_code; ?>;
}

</style>

<?php 
  $userLoginData = $this->session->userdata('userLoginData'); 
  // print_r($userLoginData);
?>

<body class="bg-secondary text-dark bg-opacity-10">

<div class="container-fluid">

        <!-- <h4>Product Details</h4> -->
        <!-- </?php var_dump($product_imgs); ?> -->
        <div class="container-fluid">
<div class="col-md-12 row">
<div id="result"></div>
<?php 
    // $item_count = $this->session->userdata('item_count'); 
    // echo isset($item_count)?$item_count:0;
?>
<div id="result__localstr"></div>


      <div class="col-md-6 row hover01">
  <div id='image_color_id'>
    <?php if(isset($product_imgs)){ ?>
        <div class="mr-2 mt-2">
            <a href="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_1); ?>" data-fancybox="gallery" data-caption="WRONG Tshirt">
                <figure><img style="" src="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_1); ?>" alt="" width="420" height="500"></figure>
            </a>
        </div>    
                <div class="mr-2 mt-2">
                <a href="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_2); ?>" data-fancybox="gallery" data-caption="WRONG Tshirt">
                  <figure><img style="" src="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_2); ?>" alt="" width="420" height="500"></figure>
                </a>
                </div>
                <div class="mr-2 mt-2">
                <a href="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_3); ?>" data-fancybox="gallery" data-caption="WRONG Tshirt">
                  <figure><img style="" src="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_3); ?>" alt="" width="420" height="500"></figure>
                </a>
                </div>
                <div class="mr-2 mt-2">
                <a href="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_4); ?>" data-fancybox="gallery" data-caption="WRONG Tshirt">
                  <figure><img style="" src="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_4); ?>" alt="" width="420" height="500"></figure>
                </a>
                </div>
                <div class="mr-2 mt-2">
                <a href="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_5); ?>" data-fancybox="gallery" data-caption="WRONG Tshirt">
                  <figure><img style="" src="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_5); ?>" alt="" width="420" height="500"></figure>
                </a>
                </div>
                <div class="mr-2 mt-2">
                <a href="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_6); ?>" data-fancybox="gallery" data-caption="WRONG Tshirt">
                  <figure><img style="" src="<?= base_url('upload_img/'.$product_imgs[0]->prd_img_6); ?>" alt="" width="420" height="500"></figure>
                </a>
                </div>
          <?php }else{ echo("<h3>No Image Uploaded yet</h3>");} ?>
        </div><!--image_color_id-->
        <div id='show_image_color_id'></div>
    </div>
      <!-- Product discription -->
      <!-- </?php var_dump($product_main); ?>       -->


      <div class="col-md-4">
        <div id="" style="font-size:25px;"><?= $product_main[0]->product_name; ?></div>
        <!-- hidden tags -->
        <input type="hidden" id="user_uuid" value="<?= isset($userLoginData['user_uuid'])?($userLoginData['user_uuid']):'None'; ?>" />
        
        <input type="hidden" id="product_image" value="<?= $product_main[0]->product_main_image; ?>" name="<?= $product_main[0]->product_main_image; ?>" />
        
        <input type="hidden" id="product_name" value="<?= $product_main[0]->product_name; ?>" name="<?= $product_main[0]->product_name; ?>" />

        <input type="hidden" id="product_selling_price" value="<?= $product_main[0]->product_selling_price; ?>" name="<?= $product_main[0]->product_selling_price; ?>" />

        <input type="hidden" id="product_uuid" value="<?= $product_main[0]->product_uuid; ?>" name="<?= $product_main[0]->product_uuid; ?>" />
      <!-- hidden tags ends -->

        <p class="text-muted"><?= $product_main[0]->product_short_description; ?></p>
        
        <!-- <div class="">
            <h4><span class="sansserif text-info" style="font-size: 14px;">479 Ratings and 8 Reviews&nbsp;&nbsp;</span>
            <span style="font-size: 12px;"><i class="fa fa-star" aria-hidden="true"></i> 4.0 stars</span>
            </h4>
        </div> -->


        <div class="price-wrap">
      <span class="mt-2" style="font-size: 22px;" id=""><?= $product_main[0]->product_selling_price; ?></span>&nbsp;
      <small><span class="mt-2 text-secondary" style="font-size: 18px;" id="product_mrp"><s><?= $product_main[0]->product_mrp; ?></s></span></small>&nbsp;
      <small><span class="mt-2 text-warning" style="font-size: 18px;" id="discount_percentage">(<?= $product_main[0]->discount_percentage; ?>%OFF)</span></small>
      <p class="text-success">inclusive of all taxes</p>
    </div>
    <div>
      <span>SELECT SIZE &nbsp;&nbsp;<button type="button" class="btn btn-white text-danger" data-toggle="modal" data-target=".bd-example-modal-lg" style="font-size: 12px;">SIZE CHART <i class="fa fa-angle-right" aria-hidden="true"></i></button></span>
    </div>
 <!-- </?php var_dump($avilable_size_variation); ?> -->
      <span><?php if($product_main[0]->product_color == '2'){echo('Black');} ?></span>
    <select class="form-select col"  id="product_size" multiple aria-label="multiple select example">
    <option selected><?= $product_main[0]->product_size; ?></option>
      <?php if(isset($avilable_size_variation)){
              foreach($avilable_size_variation as $size_variation): ?>  
      <option value="<?= $size_variation->size_id.'_'.$size_variation->size_name; ?>"><?= $size_variation->size_name; ?></option>
      <?php endforeach; } ?>
    </select>

<!-- </?php var_dump($avilable_color_variation); ?> -->

<select class="form-select mt-3" id="product_color" aria-label="Default select example">
<option selected>Select-Color</option>
<?php if(isset($avilable_color_variation)){
          foreach($avilable_color_variation as $color_variation): ?>  
  <option value="<?= $color_variation->color_id.'_'.$color_variation->color_name; ?>"><?= $color_variation->color_name; ?></option>  
  <?php endforeach; } ?>
</select>

<div class="mt-2">
  <!-- buttons -->
<?php if(isset($avilable_color_variation)){
   
  foreach($avilable_color_variation as $color_variation):
    // print_r($avilable_color_variation);?>
  <div class="form-check form-check-inline">    
    <button type="button" class="btn btn-outline-dark" id='<?= $color_variation->color_id; ?>' onclick="changeProductColor(this.id)"><?= $color_variation->color_name; ?>  
  </button>
  <?php
$peso = $color_variation->hex_code;
echo html_entity_decode($peso);
 
?>
<div style="background-color: <?php echo $color_variation->hex_code?>;">dsadsa</div>

  </div>
  <?php endforeach; } ?>
</div>

<!-- static -->
    <div class="mt-3">
    <!-- if href='' is empty then it will reload the page as its default nature,
    to stop or prevent this we have to use  event.preventDefault() in our function
    
 -->
    <a href="" 
      class="btn btn-outline-dark btn-block btn-lg" 
      id="add_to_cart" 
      role="button" 
      aria-pressed="true">
      <i class="fa fa-shopping-bag" aria-hidden="true">        
          </i>&nbsp;&nbsp;ADD TO BAG</a>&nbsp;&nbsp;
          <!-- <a href="#" class="btn btn-light btn-lg active" role="button" aria-pressed="true"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;&nbsp;WISHLIST</a> -->
      </div>

      <div class="mt-4">DELIVERY OPTIONS <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-truck" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
</svg></div>

 <input type="text" class="form-control w-75 p-3" aria-label="Large" placeholder="Enter Pincode" aria-describedby="inputGroup-sizing-sm">
 <button class="pinCode-btn btn btn-white text-danger">Check</button>
 <p class="text-muted"><small>Please enter PIN code to check Delivery Availability</small></p>

   <div class="text-muted mt-2 font-weight-light">
    <span>100% Original Products</span><br/>
    <span>Free Delivery on order above Rs. 899</span><br/>
    <span>Pay on delivery might be available</span><br/>
    <span>Easy 30 days returns and exchanges</span><br/>
    <span>Try & Buy might be available</span>
  </div>
  



<div class="mt-4">
<span class="font-weight-bold">BEST OFFERS <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2 2v4.586l7 7L13.586 9l-7-7H2zM1 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2z"/>
  <path fill-rule="evenodd" d="M4.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
</svg></span>
 <ul class="font-weight-light" style="font-size: 14px;">
    <li>Coupon code: <strong>FASHION250</strong></li>
    <li >Coupon Discount: Rs. 250 off (check cart for final savings)</li>
    <li>Applicable on: Orders above Rs. 1249 (only on first purchase)</li>
  </ul>
</div>

<br>
<div class="mt-2">
<!-- <span class="font-weight-bold">Specifications</span>
<table class="table">

  <tbody>
    <tr>
      <td>
        <p class="text-muted" style="font-size: 12px;">Fabric</p>
        <p class="font-weight-light">Cotten</p>
      </td>
      <td>
        <p class="text-muted" style="font-size: 12px;">Fit</p>
        <p class="font-weight-light">Slim Fit</p>
      </td>
    </tr>

        <tr>
      <td>
        <p class="text-muted" style="font-size: 12px;">Length</p>
        <p class="font-weight-light">Regular</p>
      </td>
      <td>
        <p class="text-muted" style="font-size: 12px;">Main Trend</p>
        <p class="font-weight-light">New Basics</p>
      </td>
    </tr>

    <tr>
      <td>
        <p class="text-muted" style="font-size: 12px;">Pattern</p>
        <p class="font-weight-light">Solid</p>
      </td>
      <td>
        <p class="text-muted" style="font-size: 12px;">Neck</p>
        <p class="font-weight-light">Round</p>
      </td>
    </tr>
        <tr>
      <td>
        <p class="text-muted" style="font-size: 12px;">Wash Care</p>
        <p class="font-weight-light">Machine Wash</p>
      </td>
      <td>
        <p class="text-muted" style="font-size: 12px;">Occasion</p>
        <p class="" ass="font-weight-light">Casual</p>
      </td>
    </tr>
  </tbody>
</table> -->
</div>
<hr>
<div>
<span>Product Code:&nbsp;<strong>W2N53182</strong></span><br>
<span>Sold by:&nbsp;<strong>Flashstar Commerce</strong></span><br>
<span>Country of origin:&nbsp;<strong>India</strong></span><br>
</div>
<!-- static  end -->
<div>
<?= $product_main[0]->product_long_description; ?>
</div>
      </div><!-- Product discription -->
    </div><!--col-md-12 row-->
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
    <script>

function changeProductColor(color_id){
    // alert(color_id);
    var url = window.location.href;
    url = url.slice(0,21) //return http://localhost/salt/

    var product_uuid = document.getElementById('product_uuid').value;
    
    $.ajax({
      url:"<?php echo base_url('EStore/EStore_Controller/show_product_color_ajax');?>",
      type:'POST',
      data:{
        color_id:color_id,
        product_uuid:product_uuid
      },
      success:function(RespondedData) {  
                    // console.log(RespondedData);  
                    jsonData = JSON.parse(RespondedData);
                    console.log(jsonData);
                    // console.log('msg',jsonData[0]->prod_color_img1);
                    // $val = 'color_img'+  ;
                    document.getElementById('image_color_id').style.display = 'none';
                    var htmlTemp = '';
                    htmlTemp += "<div class='mr-2 mt-2'>";
                    htmlTemp += "<a href='' data-fancybox='gallery' data-caption='WRONG Tshirt'>";
                    htmlTemp += "<figure><img src='<?= base_url(); ?>colors_img/"+jsonData[0]['prod_color_img1']+"' width='420' height='500'></figure>";
                    htmlTemp += "<figure><img src='<?= base_url(); ?>colors_img/"+jsonData[0]['prod_color_img2']+"' width='420' height='500'></figure>";
                    htmlTemp += "<figure><img src='<?= base_url(); ?>colors_img/"+jsonData[0]['prod_color_img3']+"' width='420' height='500'></figure>";
                    htmlTemp += "<figure><img src='<?= base_url(); ?>colors_img/"+jsonData[0]['prod_color_img4']+"' width='420' height='500'></figure>";
                    htmlTemp += "<figure><img src='<?= base_url(); ?>colors_img/"+jsonData[0]['prod_color_img5']+"' width='420' height='500'></figure>";
                    htmlTemp +="</a>";
                    htmlTemp +="</div>";                              
                    // document.getElementById('show_image_color_id').innerHTML = RespondedData;
                    document.getElementById('show_image_color_id').innerHTML = htmlTemp;
                    
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log(XMLHttpRequest);
                    console.log(errorThrown);
                }
    });
}
















      //============ bag item count ========================
      // var item_count__ = JSON.parse(localStorage.getItem('item_count'));
          
      // var bag = document.getElementById('bag');
      //       if(item_count__){
      //           bag.innerHTML = `<i class="fa-solid fa-bag-shopping"></i>&nbsp;Bag(${item_count__})`;
      //         }
      //============ bag item count end ====================

      // product_quantity counter
      
      // var item_count = 0;
      // cart_item_list = [];
      
      
      //check for empty storage
      if(!localStorage.getItem('cart_item_list')){
        let arr = [];
        localStorage.setItem('cart_item_list', JSON.stringify(arr));
      }

      let existing_arr = JSON.parse(localStorage.getItem('cart_item_list'));
      
      var product_quantity = 1;
      
      var add_to_cart = document.getElementById('add_to_cart');
      
      add_to_cart.addEventListener('click', function(e){    
        e.preventDefault();

        // console.log('clicks');    
          
              var user_uuid = document.getElementById('user_uuid').value;
              var product_uuid = document.getElementById('product_uuid').value;
              var product_name = document.getElementById('product_name').value;
              // product_size + product_size_name
              var product_size = document.getElementById('product_size').value;
              //              
              var product_color = document.getElementById('product_color').value;              
              var product_image = document.getElementById('product_image').value;
              // var product_mrp = document.getElementById('product_mrp').value;
              var product_mrp = '999';
              var product_selling_price = document.getElementById('product_selling_price').value;
              // var discount_percentage = document.getElementById('discount_percentage').value;
              var discount_percentage = '10';
          // window.localstorage.clear();  
          console.log(product_size);


        if(user_uuid =='None' || user_uuid == 'undefined'){
          alert('user_not_login')
          
          product_quantity += 1;
          
          //save data to localstorage
          var cart_item_obj = {
              id:'id_' + (new Date()).getTime(),            
              product_image:product_image,
              product_name:product_name,
              product_selling_price:product_selling_price,
              product_size:product_size, 
              product_color:product_color,
              product_quantity:product_quantity
          };
          // alert(JSON.stringify(cart_item_obj));
          
          existing_arr.push(cart_item_obj);         //[{obj1},{obj2}]
          
        //  alert(existing_arr);

          localStorage.setItem("cart_item_list", JSON.stringify(existing_arr));
          
          document.getElementById('result__localstr').innerHTML = JSON.parse(localStorage.getItem('cart_item_list'));                   
          
          var item_count = JSON.parse(localStorage.getItem('item_count'));
          
          // ---------------     COUNTER    -----------------------------
          // if (localStorage.clickcount) {
          //     localStorage.clickcount = Number(localStorage.clickcount)+1;
          //   } else {
          //     localStorage.clickcount = 1;
          //   }
          //   document.getElementById("result").innerHTML = "" + localStorage.clickcount + "-items in Bag";
          
          // console.log("bag"+localStorage.clickcount);
          // --------------- COUNTER END -----------------------------
        }else{
          // alert('user is login')
        
            if (localStorage.clickcount) {
              localStorage.clickcount = Number(localStorage.clickcount)+1;
            } else {
              localStorage.clickcount = 1;
            }
            document.getElementById("result").innerHTML = "" + localStorage.clickcount + "-items in Bag";
          
          console.log("bag"+localStorage.clickcount);
          //save data to database using Ajax
          // alert('login user,,welcome');
          console.log('data:',user_uuid, product_uuid,product_name,product_size,product_color,product_image,product_mrp,product_selling_price,discount_percentage);
                    
          $.ajax({
                url:"<?php echo base_url('EStore/EStore_Controller/add_to_cart_ajax');?>",
                type:"POST",
                data:{
                      item_count:localStorage.clickcount,
                      product_uuid:product_uuid,
                      user_uuid:user_uuid,
                      product_name:product_name,
                      product_size:product_size,
                      product_color:product_color,
                      product_quantity:product_quantity,
                      product_image:product_image,
                      product_mrp:product_mrp,
                      product_selling_price:product_selling_price,
                      discount_percentage:discount_percentage
                    },                
                success:function(RespondedData) {  
                    console.log(RespondedData);                                    
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log(XMLHttpRequest);
                    console.log(errorThrown);
                }
            });       


      //     $.ajax({
      //       url:'<//?= base_url('EStore/EStore_Controller/add_to_cart_ajax');  ?>',
      //       type: 'POST',
      //       data:{
              
      //         // item_count:localStorage.clickcount,
      //         product_uuid:product_uuid,
      //         user_uuid:user_uuid,
      //         product_size:product_size,
      //         product_color:product_color,
      //         product_quantity:product_quantity,
      //         product_image:product_image,
      //         product_mrp:product_mrp,
      //         product_selling_price:product_selling_price,
      //         discount_percentage:discount_percentage
      //       },
      //       // success:function(data, textStatus, jqXHR){
      //       success:function(data){
              
      //         var jsonData = JSON.parse(data);
              
      //         console.log(jsonData); 
      //         // </?php redirect('cart'); ?>
      //         //location.reload();   
      //       },
      //       error:function(XMLHttpRequest, textStatus, errorThrown){
      //         alert(errorThrown);
      //         console.log(XMLHttpRequest); 
      //         console.log(textStatus); 
      //         console.log(errorThrown); 
      //       }
      // });
  }
        // var product_color = document.getElementById("product_color");
        // var value = product_color.value;
        // var text = product_color.options[product_color.selectedIndex].text;
        // console.log(user_uuid);
        // alert(value);
        // alert(text);

      });

  
  
// https://adnan-tech.com/shopping-cart-php-cookies#:~:text=php%20%24conn%20%3D%20mysqli_connect(%22,products%20WHERE%20productCode%20%3D%20'%22%20.
// https://www.javatpoint.com/javascript-localstorage

    </script>
</body>

</html>