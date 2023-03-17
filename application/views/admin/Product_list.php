<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <div class="container">
      <h4>Product-List</h4>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Article No.</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- <//?php var_dump($product_list); ?> -->
    <?php 
    if(isset($product_list)){
    foreach($product_list as $row):?>
    <tr>
      <th><?= $row->product_id; ?></th>
      <td><?= $row->product_name; ?></td>
      <td><?= $row->article_no; ?></td>
      <td>
      <a href="<?= base_url('add-variation/').$row->product_uuid; ?>" class="btn btn-primary" role="button" aria-pressed="true">Add Variation</a>
      <a href="<?= base_url('add-images/').$row->product_uuid; ?>" class="btn btn-primary" role="button" aria-pressed="true">Add Images</a>
      <a href="<?= base_url('add-colored-images/').$row->product_uuid; ?>" class="btn btn-primary" role="button" aria-pressed="true">Add Color</a>
      </td>
    </tr>
    <?php endforeach;}else{ ?>
      <tr>
        <td>No Data</td>
        <td>No Data</td>
        <td>No Data</td>
        <td>No Data</td>
      </tr>
      <?php } ?>
    
  </tbody>
</table>
    </div>
    
</head>
<body>
    
</body>
</html>