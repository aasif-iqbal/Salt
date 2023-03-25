<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
    // echo("<pre/>");
    // var_dump($customer_orders_list[0]); 
    if($customer_orders_list == NULL){
        echo("<h2>NO Order Made By you,Yet!!</h2>");
    }
    ?>

    <div class="container">
    <h4>Your Orders</h4>
    <?php 
    if(isset($customer_orders_list)){
        foreach($customer_orders_list as $list):    
    ?>
    <div class="card" style="">
  <div class="row g-0">
    <div class="col-md-3">
      <img src="<?= base_url('uploads/').$list['product_main_image'];?>" class=" rounded-start" height='200' width='150'>
    </div>
    <div class="col-md-4">
      <div class="card-body">
        <h5 class="card-title"><?= $list['product_name']; ?></h5>
        <p class="card-text">SIZE :<?= $list['product_size_name']; ?></p>
        <p class="card-text">COLOR :<?= $list['product_color_name']; ?></p>
        <a class="btn btn-outline-danger btn-small" href="#" role="button">Cancel Order</a>
        
      </div>
    </div>
    <div class="col-md-5">
      <div class="card-body">
        <h5 class="card-title">conformation code: #<?= $list['conformation_code']; ?></h5>
        <p class="card-text">Shipping Id : #<?= $list['shipping_uuid']; ?></p>
        <p class="card-text">Order Id : #<?= $list['order_uuid']; ?></p>
        <p class="card-text">Order date :<?= $list['ordered_datetime']; ?></p>        
      </div>
    </div>
  </div>
  <p class="card-text"><small class="text-muted">Cancel this order under 15days</small></p>
</div>
<?php endforeach;} ?>
    </div>

</body>
</html>