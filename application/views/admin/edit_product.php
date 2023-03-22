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
    <!-- </?php print_r($productsWithVariations[0]);?> -->
    <div class="container">
    <div class="card p-5">
    
    <h3>update main product</h3>

    <form action="<?= base_url('update-product/').$productsWithVariations[0]['product_uuid']?>" method="POST">
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
    <label for="">Article no.</label>         
      <input type="text" class="form-control" name="product_name" value="<?= $productsWithVariations[0]['product_name']?>"
       placeholder="First name">
    </div>
    <div class="col">
    <label for="">Article no.</label>     
      <input type="text" class="form-control" placeholder="color">
    </div>
  </div>

  <div class="form-row mt-2">
    <div class="col">  
    <label for="">Article no.</label>           
      <input type="text" class="form-control" placeholder="Size">
    </div>
    <div class="col">
    <label for="">Article no.</label>     
      <input type="text" class="form-control" placeholder="Stock">
    </div>
  </div>

  <div class="form-row mt-2">
    <div class="col">    
    <label for="">Article no.</label>         
      <input type="text" class="form-control" placeholder="mrp">
    </div>
    <div class="col">
    <label for="">Article no.</label>     
      <input type="text" class="form-control" placeholder="sp">
    </div>
    <div class="col">
    <label for="">Article no.</label>     
      <input type="text" class="form-control" placeholder="dis">
    </div>
  </div>

  <hr>
  <h3>update product variation</h3>

  <div class="form-row mt-2">
    <div class="col">        
    <label for="">Color</label>     
      <input type="text" class="form-control" name="color" value=""
       placeholder="First name">
    </div>
    <div class="col">
    <label for="">Size</label>     
      <input type="text" class="form-control" placeholder="Last name">
    </div>
  </div>

  <div class="form-row mt-2">
    <div class="col">        
    <label for="">Stocks</label>     
      <input type="text" class="form-control" placeholder="First name">
    </div>
    <div class="col">
    <label for="">MRP</label>     
      <input type="text" class="form-control" placeholder="Last name">
    </div>
  </div>

  <div class="form-row mt-2">
    <div class="col">        
    <label for="">Selling Price</label>     
      <input type="text" class="form-control" placeholder="First name">
    </div>
    <div class="col">
    <label for="">Discount(%)</label>     
      <input type="text" class="form-control" placeholder="Last name">
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