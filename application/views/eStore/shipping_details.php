<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <h4>Shipping details</h4> -->

    <?php 
    // $userLoginData = $this->session->userdata('userLoginData');
    // var_dump($customerInfo[0]);
    ?>
    <!-- </?=  print_r(json_encode($customerCartItems)); ?> -->

    <div class="container">
        <div class="row mt-4">
            <div class="col-8">                
                <div class="card mb-4" style="">
                    <div class="card-body">    
                        <input type='hidden' value='<?= $customerInfo[0]->user_uuid;?>' id='user_uuid' />                       
                        <p class='h4' id='username' value='<?= $customerInfo[0]->user_name ?>'>Hi, <?= $customerInfo[0]->user_name ?></p>                     
                        <h6 class="card-subtitle mb-2 text-muted">Address</h6>
                        <p class="card-text">
                        <?= $customerInfo[0]->addr_house_no;?> ,
                        <?= $customerInfo[0]->addr_locality;?> ,
                        <?= $customerInfo[0]->addr_city;?> ,
                        <?= $customerInfo[0]->addr_pin_code;?>,
                        <?= $customerInfo[0]->addr_state;?>,
                        <?= $customerInfo[0]->addr_country;?>                        
                            <br>
                        Address type: <?= ($customerInfo[0]->addr_type=='1')?'Home':'Work';?>
                            <br>
                            <p class="">Phone on: +91-<?= $customerInfo[0]->receivers_phone_no;?><br>
                            <small class="text-muted">Phone no of a person who revieves parcel</small></p>
                        </p>
                        <a href="<?= base_url('edit-addr') ?>" class="card-link link-dark float-right">Edit</a>                        
                    </div>
                </div>
                <div class="card mb-3">
                <div class="card-body">
                    <p>Your Product will delivered on 5-7 days.</p>
                </div>
            </div>
                <div class="row">
                    <?php 
                    $total = 0;
                    $total_quantity_inCart = 0;
                    $product_arr = [];
                    if(isset($customerCartItems)){
                    foreach($customerCartItems as $cartItem):
                        $product_arr = $cartItem->product_name;
                        // print_r($product_arr);
                    ?>
                    
                        <div class="col-6">                             
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                    <img src="<?= base_url('uploads/'.$cartItem->product_image); ?>" class="rounded-start" alt="" height='200' width='150'>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title" id='product_name'><?= $cartItem->product_name; ?></h5>
                                            <p class="card-text"><?= ($cartItem->product_selling_price * $cartItem->product_quantity) ?></p>
                                            <p class="card-text" id='product_quantity'><small class="text-muted">item quantity: <?= $cartItem->product_quantity; ?></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <? 
                        //total price in cart/bag
                        $subtotal = (($cartItem->product_quantity)*($cartItem->product_selling_price));
                        $total += $subtotal;
                    endforeach; }?>                                                  
                </div>
            </div>
            
            <div class="col-4" style="margin-top:30%;">
                <div class="card" style="">
                        <div class="card-body">
                            <h5 class="card-title">Total</h5>
                            <!-- <p class="card-text">Rs. 899</p> -->
                            <p class="card-text">-----------</p>
                            <p class="card-text" id='total_amount'>Total:Rs. <?= $total; ?></p>
                            
                            <button class='btn btn-dark mt-1' id="rzp-button1" value="pay" onclick="pay_now_online()">Online Payment</button>

                            <button class='btn btn-dark mt-1 float-right' onclick="pay_now_cod()">Cash on delivery</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- sample upi and card name -->
    <!-- https://razorpay.com/docs/payments/payment-gateway/web-integration/hosted/test-integration -->
        <script>
            var project_info = `<?= json_encode($customerCartItems_Json) ?>`;
            projectInfo_Json = JSON.parse(project_info);
            // console.log(typeof(projectInfo_Json));
            projectInfo_Json = (JSON.stringify(projectInfo_Json));
            
            var product_name = document.getElementById('product_name');
            let product_quantity = document.getElementById('product_quantity');
            let total_amount = document.getElementById('total_amount');
            let user_uuid = document.getElementById('user_uuid');

            // For new api-key
            //https://dashboard.razorpay.com/app/website-app-settings/api-keys
            // function pay_now_online(){
            //     console.log(projectInfo_Json);
            // }

            function pay_now_online(){
                //updating pending payment when payment is completed..
                var options = {
                     "key": "rzp_test_p6TTjiqWqUW7c7", 
                    "amount": 2*100,  // 100ps ie 1Rs
                    "currency": "INR",
                    "name": "Fifth Object",
                    "description": "Company description",
                    "image": "https://s3.amazonaws.com/rzp-mobile/images/rzp.jpg",
                    // "callback_url": "http://localhost/Payment-Gateway-Razorpay/thank_you.php", //Your Thank-you page                    
                    
                    "handler": function (response){                        
                        jQuery.ajax({
                            type:'post',
                            url:'<?= base_url('eStore/EStore_Controller/onlinePayment_ajax'); ?>',
                            data:{
                                payment_id:response.razorpay_payment_id,productInfo_json:projectInfo_Json,
                                total_amount:2,
                                user_uuid:user_uuid.value
                            },            
                            success:function(data){
                                //  alert(data);
                                // window.location.href="thank_you.php"
                                window.location.href = "<?= base_url('thanks');?>";
                            }
                        })
                                console.log(response); //return obj
                                 
                                console.log(response.razorpay_payment_id);
                    }
                //handler-end                    
                //    "image": "https://example.com/your_logo",
                //    "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                //  "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/", //Your Thank-you page                    
                }; //options-end

                var rzp1 = new Razorpay(options);
                //document.getElementById('rzp-button1').onclick = function(e){
                
                    rzp1.open();
                //e.preventDefault();
                //}  
//                 var rzp1 = new Razorpay(options);
//   document.getElementById('rzp-button1').onclick = function (e) {
//     rzp1.open();
//     e.preventDefault();
//   }

            }

            function pay_now_cod(){
                var product_name = document.getElementById('product_name');
                let product_quantity = document.getElementById('product_quantity');
                let total_amount = document.getElementById('total_amount');
                let user_uuid = document.getElementById('user_uuid');
                 
                // console.log(username.value);
                // console.log(user_uuid.value);
                // window.location.href = "</?= base_url('thanks');?>";
               $.ajax({
                    url:'<?= base_url('eStore/EStore_Controller/cashOnDelivery_ajax'); ?>',
                    method:'POST',
                    data:{
                        'productInfo_json':projectInfo_Json,
                        'user_uuid':user_uuid.value
                    },
                    success:function(data){
                        console.log('productInfo_json:',data);
                        //window.location.href = "<?= base_url('thanks');?>";

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        console.log(XMLHttpRequest);
                        console.log(errorThrown);
                }
                })
            }
        </script>
</body>
</html>