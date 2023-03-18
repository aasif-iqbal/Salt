<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Shipping</h3>
    
    <!-- </?php print_r($shipping_info); ?> -->
    <div class="container-fluid">
    <div class="table-responsive">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Shipping No.</th>
      <th scope="col">Order No.</th>
      <th scope="col">Customer Id.</th>
      <th scope="col">Product Info.</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Shipping Status</th>
      <th scope="col">Confirmation Code</th>
      <th scope="col">Shipping Address</th>
      <th scope="col">Order Datetime</th>
      <th scope="col">Reciver Phone No</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(isset($shipping_info)){
        foreach($shipping_info as $row):
            if($row['shipping_status'] == 0){
                $value = '<p style="background:red;color:white;">Pending</p>';
            }else{
                $value = 'Shipped';
            }
           $array = json_decode($row['product_json'], true);
    ?>
    <tr>
      <th scope="row"><?= $row['shipping_id']; ?></th>
      <td><?= $row['shipping_uuid']; ?></td>
      <td><?= $row['order_uuid']; ?></td>
      <td><?= $row['user_uuid']; ?></td>
      <td><?= 'User_uuid:'.$array[0]['user_uuid']; ?></td>
      <td><?= $row['payment_status']; ?></td>
      <td><?= $value; ?></td>
      <td> 58769 </td>
      <td><?= $row['shipping_address']; ?></td>
      <td><?= $row['order_datetime']; ?></td>
      <td><?= $row['reciver_phone_no']; ?></td>      
      <td>
        <!-- <button type="button" class="btn btn-info">Edit</button> -->
        <a class="btn btn-info" href="<?=  base_url('status'); ?>" role="button">Edit</a>
      </td>
    </tr>
    <?php
      endforeach;}  
    ?>
  </tbody>
</table>
</div>
</div>
</body>
</html>