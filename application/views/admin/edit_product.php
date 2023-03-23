<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- <form method="post" action="</?php echo base_url('update/'.$data->emp_id);?>">   -->
    <?php 
    // echo("<pre>");
    // print_r($productsWithVariations[0]);
    ?>
    <div class="container">
    <div class="card p-5">
    
    <h3>update main product</h3>
<hr>
    <form action="<?= base_url('update-product/').$productsWithVariations[0]['product_uuid'].'/'.$productsWithVariations[0]['variation_uuid']?>" method="POST">
  <div class="form-row">
    <div class="col">   
        <label for="">Product Unique Id</label>     
      <input type="text" class="form-control" placeholder="<?= $productsWithVariations[0]['product_uuid'];?>" readonly>
    </div>
    <div class="col">
    <label for="">Article no.</label>     
      <input type="text" class="form-control" placeholder="<?= $productsWithVariations[0]['article_no']?>"readonly>
    </div>
  </div>

  <div class="form-row mt-2">
    <div class="col">    
    <label for="">Product Name</label>         
      <input type="text" class="form-control" name="product_name" value="<?= $productsWithVariations[0]['product_name']?>"
       placeholder="First name">
    </div>
    <div class="col">
    <label for="">Product Color</label>     
      <!-- <input type="text" class="form-control" value="</?= $productsWithVariations[0]['main_color']?>" placeholder="color"> -->
      <select class="form-control" name="product_color" id="exampleFormControlSelect1">
      <option value='<?= $productsWithVariations[0]['main_color_id'].'_'.$productsWithVariations[0]['main_color'] ?>'><?= $productsWithVariations[0]['main_color'] ?></option>      
        <?php 
        if(isset($product_colors)){
        foreach($product_colors as $color):?>
        
      <option value='<?= $color->color_id.'_'.$color->color_name; ?>'><?= $color->color_name; ?></option>      
      <?php endforeach;}?>
    </select>
    </div>
  </div>

  <div class="form-row mt-2">
  <div class="col">  
    <label for="">Product Size</label>           
       
      <select class="form-control" name="product_size" id="exampleFormControlSelect1">
      <option value='<?= $productsWithVariations[0]['main_size_id'].'_'.$productsWithVariations[0]['main_size'] ?>'><?= $productsWithVariations[0]['main_size'] ?></option>      
        <?php 
        if(isset($product_sizes)){
        foreach($product_sizes as $size):?>        
      <option value='<?= $size->size_id.'_'.$size->size_name; ?>'><?= $size->size_name; ?></option>      
      <?php endforeach;}?>
    </select>
    </div>

    <div class="col">
    <label for="">Product Quantity</label>     
      <input type="text" class="form-control" name="product_quantity" value="<?= $productsWithVariations[0]['main_stocks']?>" placeholder="Stock">
    </div>
  </div>

  <div class="form-row mt-2">
    <div class="col">    
    <label for="">Product MRP</label>         
      <input type="text" class="form-control" name="product_mrp" value="<?= $productsWithVariations[0]['main_mrp']?>" placeholder="mrp">
    </div>
    <div class="col">
    <label for="">Selling Price</label>     
      <input type="text" class="form-control" name="product_selling_price" value="<?= $productsWithVariations[0]['main_sp']?>" placeholder="sp">
    </div>
    <div class="col">
    <label for="">Discount (%)</label>     
      <input type="text" class="form-control" name="discount_percentage" value="<?= $productsWithVariations[0]['main_discount']?>" placeholder="dis">
    </div>
  </div>

  <hr>
  <h3>update product variation</h3>
  <hr>

  <div class="form-row mt-2">
  <div class="col">   
    <label for="">Variation Unique Id</label>     
      <input type="text" class="form-control" placeholder="<?= $productsWithVariations[0]['variation_uuid'];?>" readonly>
    </div>

    <div class="col">        
    <label for="">Color</label>     
    <select class="form-control" name="product_color_v" id="">
      <option value='<?= $productsWithVariations[0]['color_v_id'].'_'.$productsWithVariations[0]['color_v'] ?>'><?= $productsWithVariations[0]['color_v'] ?></option>      
        <?php 
        if(isset($product_colors)){
        foreach($product_colors as $color):?>
        
      <option value='<?= $color->color_id.'_'.$color->color_name; ?>'><?= $color->color_name; ?></option>      
      <?php endforeach;}?>
    </select>
    </div>
    
  </div>

  <div class="form-row mt-2">
  
  <div class="col">
    <label for="">Size</label>     
    <select class="form-control" name="product_size_v" id="">
      <option value='<?= $productsWithVariations[0]['size_v_id'].'_'.$productsWithVariations[0]['size_v'] ?>'><?= $productsWithVariations[0]['size_v'] ?></option>      
        <?php 
        if(isset($product_sizes)){
        foreach($product_sizes as $size):?>        
      <option value='<?= $size->size_id.'_'.$size->size_name; ?>'><?= $size->size_name; ?></option>      
      <?php endforeach;}?>
    </select>
    </div>

    <div class="col">        
    <label for="">Stocks</label>     
    <input type="text" class="form-control" name="product_quantity_v" value="<?= $productsWithVariations[0]['stocks_v']?>" placeholder="stock">
    </div>
    

  </div>

  <div class="form-row mt-2">
  <div class="col">
    <label for="">MRP</label>     
    <input type="text" class="form-control" name="product_mrp_v" value="<?= $productsWithVariations[0]['mrp_v']?>" placeholder="mrp">
    </div>

    <div class="col">        
    <label for="">Selling Price</label>     
    <input type="text" class="form-control" name="product_selling_price_v" value="<?= $productsWithVariations[0]['sp_v']?>" placeholder="sp">
    </div>
    <div class="col">
    <label for="">Discount(%)</label>     
    <input type="text" class="form-control" name="discount_percentage_v" value="<?= $productsWithVariations[0]['discount_v']?>" placeholder="dis">
    </div>
  </div>


    <hr>
    <div class="float-right">
    <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
        <a class="btn btn-primary" href="#" role="button">Delete</a>
 
    

    </div>
</form>

    </div>
    
    
    
</body>
</html>