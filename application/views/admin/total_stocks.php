<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h2>Stocks</h2>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    

    
</head>
<body>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>


<div class='container-fluid'>
<div class="table-responsive">

<table class="table  table-bordered"  id="example" style="width:100%">

  <thead>
    <tr>
      <th scope="col" class="table-dark">Product__Name</th>
      <th scope="col" class="table-active">Article</th>
      <th scope="col" class='table-info'>M_Color</th>  
      <th scope="col" class='table-info'>M_Size</th>
      <th scope="col" class='table-info'>M_Stock</th>
      <th scope="col" class='table-info'>MRP</th>
      <th scope="col" class='table-info'>SP</th>
      <th scope="col" class='table-info'>DIS(%)</th>
      <th scope="col" class='table-success'>V_Color</th>          
      <th scope="col" class='table-success'>V_Size</th>
      <th scope="col"class='table-success'>V_Stock</th>
      <th scope="col" class='table-success'>MRP</th>
      <th scope="col" class='table-success'>SP</th>
      <th scope="col" class='table-success'>DIS(%)</th>
      <th scope="col" class='table-danger'>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // echo('<pre/>');
    // print_r($total_stocks);

    if(isset($total_stocks)){
        foreach($total_stocks as $stock):
    ?>
    <tr>
      <th scope="row" class="table-dark"><?= $stock['product_name']; ?></th>
      <th scope="row" class="table-active"><?= $stock['article_no']; ?></th>
      
      <td class='table-info'><?= $stock['main_color']; ?></td>
      <td class='table-info'><?= $stock['main_size']; ?></td>
      <td class='table-info'><?= $stock['main_stocks']; ?></td> 
      <td class='table-info'><?= $stock['main_mrp']; ?></td> 
      <td class='table-info'><?= $stock['main_sp']; ?></td> 
      <td class='table-info'><?= $stock['main_discount']; ?></td> 
      
      <td class='table-success'><?= $stock['color_v']; ?></td>                 
      <td class='table-success'><?= $stock['size_v']; ?></td>            
      <td class='table-success'><?= $stock['stocks_v']; ?></td>       
      <td class='table-success'><?= $stock['mrp_v']; ?></td> 
      <td class='table-success'><?= $stock['sp_v']; ?></td> 
      <td class='table-success'><?= $stock['discount_v']; ?></td> 
      
      <td class='table-danger'>
        <a href="<?= base_url('edit-product/').$stock['product_uuid'].'/'.$stock['variation_uuid']; ?>" role="button" class="btn btn-info btn-sm">E</a>
        <button type="button" class="btn btn-light btn-sm">X</button>
      </td> 
    </tr>
    <?php endforeach; } ?>
  </tbody>
</table>
</div>
</div>
<script>
  $(document).ready(function () {
    $('#example').DataTable();
});
  </script>
</body>
</html>