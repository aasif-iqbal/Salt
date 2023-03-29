<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <h2>cart from db </h2> -->
    <!-- </?php echo("<pre>"); ?> -->
     <!-- </?php print_r($cart_items); ?> -->

    <div class="container">
        <div class="h1 mt-3 mb-3" style='margin-left:42%'>Shopping Bag</div>
        <div class="row">
            <div class="col-8">
                <?php         
                $total = 0;
                $total_quantity_inCart = 0;

                if(isset($cart_items)){
                    foreach($cart_items as $item):
                        // print_r($item);
                ?>
            <div class="card mb-3" style="">
                <div class="row g-0">
                    <div class="col-md-2">
                    <img src="<?= base_url('uploads/'.$item->product_image); ?>" class="img-fluid" alt="..." height="200"  width="100">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <!-- hidden tags -->
                        <input type="hidden" id="user_uuid" value="<?= isset($item->user_uuid)?($item->user_uuid):'None'; ?>" />
                        
                        <input type="hidden" id="product_uuid" value="<?= $item->product_uuid; ?>" name="<?= $item->product_uuid; ?>" />
                        
                        <input type="hidden" id="product_count" value="<?= isset($item->product_quantity)?($item->product_quantity):'0'; ?>" />

                        <!-- hidden tags ends -->
                        <h5 class="card-title"><?= $item->product_name; ?></h5>
                        <p class="card-text">Rs.<?= ($item->product_selling_price * $item->product_quantity); ?></p>
                        <!-- <span class="card-text"> id: </?= $item->product_uuid; ?></span> -->
                        <p class="card-text"><small class="text-muted">
                        
                        <div class="d-inline">
                            <button id='decrement_item' value='<?= $item->product_uuid; ?>'
                            onclick='decrement_item(this.value)'>-</button>
                        </div>
                        <span class="d-inline card-text"><?= $item->product_quantity; ?></span>
                        <div class="d-inline">
                            <button id='increment_item' value='<?= $item->product_uuid; ?>' onclick='increment_item(this.value)'>+</button>
                        </div>
                        <button id='remove_item' value='<?= $item->product_uuid; ?>' onclick='remove_item(this.value)'>Remove</button></small>
                        <span id='msg'></span>
                        </p>
                    </div>
                    </div>
                </div>
        </div>
        <?php
        //total price in cart/bag
     $subtotal = $item->product_quantity * $item->product_selling_price;
     $total += $subtotal;

    
    //  set session to maintain cart value
    $total_quantity_inCart += $item->product_quantity;
    $cart_value = $this->session->set_userdata('cart_value', $total_quantity_inCart);
    //  print_r($total_quantity_inCart);
    //  print_r($total);
    endforeach; } else { ?>
        <div>Your Bag is Empty</div>
        <div><button>Continue to shopping</button></div>
    <?php } ?>
            </div>
            <div class="col-4">
                <div class="card" style="">
                    <div class="card-body">
                        <h5 class="card-title">Total</h5>
                        
                        <?php 
                        $userLoginData = $this->session->userdata('userLoginData'); 
                        if(isset($userLoginData['user_uuid'])){
                        
                        if(isset($cart_items)){
                            foreach($cart_items as $item):
                           ?> 
                                <!-- <p class="card-text"></?= $total; ?></p> -->
                           <?php endforeach; }?>
                           <p class="card-text"><?= $total; ?></p>
                        <!-- if user login, Then redirect to payment pg -->
                            <a href="<?= base_url('shipping');?>" class="btn btn-primary">Continue--</a>
                        <?php } else { ?>                                                
                        <!-- if user Not login, Then redirect to login pg -->
                        <a href="<?= base_url('login');?>" class="btn btn-primary">Checkout</a>
                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</body>
<script>
    /*
        - if user add item to cart without login then he/she will get localStorage_id
        - if user login,then add item to cart then he/she will get user_uuid(from session)
    */
    
    var product_uuid     = document.getElementById('product_uuid');
    var user_uuid        = document.getElementById('user_uuid');
    var product_count    = document.getElementById('product_count');
    
function increment_item(id){
    // alert(id);
    // alert(product_count.value);
    $.ajax({
            url:'<?= base_url('EStore/EStore_Controller/increment_item_from_cart_ajax');  ?>',
            type: 'POST',
            data:{              
                item_local_id:increment_item.value,
                product_uuid:id,
                user_uuid:user_uuid.value,
                product_count:product_count.value
            },
            success:function(data, textStatus, jqXHR){              
              var jsonData = JSON.parse(data);              
              //console.log(jsonData); 
              if(jsonData === 'Product not in db'){
                document.getElementById('msg').innerHTML = jsonData;
              }else{
                location.reload();              
              }              
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                console.log(textStatus);   
            }
        });        
}

function decrement_item(id){
    // alert(product_count.value);
    $.ajax({
            url:'<?= base_url('EStore/EStore_Controller/decrement_item_from_cart_ajax');  ?>',
            type: 'POST',
            data:{              
                item_local_id:increment_item.value,
                product_uuid:id,
                user_uuid:user_uuid.value,
                product_count:product_count.value
            },
            success:function(data, textStatus, jqXHR){              
              var jsonData = JSON.parse(data);              
              console.log(jsonData);  
              location.reload();             
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                console.log(textStatus);   
            }
        });
}

function remove_item(id){
    $.ajax({
            url:'<?= base_url('EStore/EStore_Controller/remove_item_from_cart_ajax');  ?>',
            type: 'POST',
            data:{              
                item_local_id:increment_item.value,
                product_uuid:id,
                user_uuid:user_uuid.value,                
            },
            success:function(data, textStatus, jqXHR){              
              var jsonData = JSON.parse(data);              
              console.log(jsonData); 
              location.reload();   
            //   <//?php $this->session->unset_userdata('cart_value'); ?>            
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                console.log(textStatus);   
            }
        });
}

  
/*
    var remove_item = document.getElementById('remove_item');
    if(remove_item){
    remove_item.addEventListener('click',function(){
        // alert(remove_item.value);
        $.ajax({
            url:'</?= base_url('EStore/EStore_Controller/remove_item_from_cart_ajax');  ?>',
            type: 'POST',
            data:{              
                item_local_id:increment_item.value,
                product_uuid:product_uuid.value,
                user_uuid:user_uuid.value
            },
            success:function(data, textStatus, jqXHR){              
              var jsonData = JSON.parse(data);              
              console.log(jsonData);               
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                console.log(textStatus);   
            }
        });
    });    
}

    var increment_item = document.getElementById('increment_item');
    if(increment_item){
    increment_item.addEventListener('click',function(){
        // alert(increment_item.value)
        $.ajax({
            url:'</?= base_url('EStore/EStore_Controller/increment_item_from_cart_ajax');  ?>',
            type: 'POST',
            data:{              
                item_local_id:increment_item.value,
                product_uuid:product_uuid.value,
                user_uuid:user_uuid.value
            },
            success:function(data, textStatus, jqXHR){              
              var jsonData = JSON.parse(data);              
              console.log(jsonData);               
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                console.log(textStatus);   
            }
        });
    });
}

    var decrement_item = document.getElementById('decrement_item');
    if(decrement_item){
    decrement_item.addEventListener('click',function(){
        
        $.ajax({
            url:'<//?= base_url('EStore/EStore_Controller/decrement_item_from_cart_ajax');  ?>',
            type: 'POST',
            data:{              
                item_local_id:increment_item.value,
                product_uuid:product_uuid.value,
                user_uuid:user_uuid.value
            },
            success:function(data, textStatus, jqXHR){              
              var jsonData = JSON.parse(data);              
              console.log(jsonData);               
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                console.log(textStatus);   
            }
        });
    });
}
*/
</script>
</html>