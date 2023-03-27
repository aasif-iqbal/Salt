<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #return_form{
            display:none;
        }
    </style>
</head>
<body>
    <div class="h3 p-3">Customer Order Cancellation</div>
    <div class="container">
        <h6>order summary</h6>
    <div class="card" style="">
  <div class="row g-0">
    <div class="col-md-3">
      <img src="</?= base_url('uploads/').$list['product_main_image'];?>" class=" rounded-start" height='200' width='150'>
    </div>
    <div class="col-md-4">
      <div class="card-body">
        <h5 class="card-title"></?= $list['product_name']; ?></h5>
        <p class="card-text">SIZE :</?= $list['product_size_name']; ?></p>
        <p class="card-text">COLOR :</?= $list['product_color_name']; ?></p>
        <p class="card-text">Mode of Payment: None/COD/Online</p>
        
      </div>
    </div>
    <div class="col-md-5">
      <div class="card-body">
        <h5 class="card-title">conformation code: #</?= $list['conformation_code']; ?></h5>
        <p class="card-text">Shipping Id : #</?= $list['shipping_uuid']; ?></p>
        <p class="card-text">Order Id : #</?= $list['order_uuid']; ?></p>
        <p class="card-text">Order date :</?= $list['ordered_datetime']; ?></p>        
      </div>
    </div>
  </div>  
</div>

<div class="h6 mt-2">Reason for cancellation</div>
    <div class='my-4' style="margin-left:20%;margin-right:30%;">        
        <p>Why are you returning this?</p>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Change My Mind
            </label>
            </div>
            </li>
            <li class="list-group-item">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Order By mistake
            </label>
            </div></li>
            <li class="list-group-item">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Wrong Size
            </label>
            </div></li>
            <li class="list-group-item">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="other_reason">
            <label class="form-check-label" for="flexRadioDefault1">
                Other
            </label>
            </div>
            <div class="mb-3" id='return_form'>
            <label for="exampleFormControlTextarea1" class="form-label"></label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div></li>
        </ul>  
    </div>
    <hr>
    <h6>Payment status</h6>
    <div class='my-4' style="margin-left:20%;margin-right:30%;">        
    <p>No Payment Done Yet!</p>
    <p>Refund Amount:<strong>&nbsp;Rs.1899</strong></p>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Refund through UPI ID
            </label><span class='float-right bg-success bg-gradient text-white pr-3 pl-3'>Faster</span>
            </div>
            <div class="mt-3 mb-3">
  
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="johndeo@paytm">

        </div>

            </li>
            <li class="list-group-item">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Refund to Bank Account
            </label>
            <br>
            <p class="card-text"><small class="text-muted">Estimated refund timing: 3-5 bussiness days of receiving your return.</small></p>
            </div>
            <div>
            <select class="form-select mt-2" aria-label="Default select example">
                <option selected>Choose Bank</option>
                <option value="1">SBI</option>
                <option value="2">BANK OF INDIA</option>
                <option value="3">ICICI</option>
            </select>
            
            </div>
            <div class="mt-3 mb-3">
                <label for="formGroupExampleInput" class="form-label">Account no.</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="mt-3 mb-3">
                <label for="formGroupExampleInput2" class="form-label">Account no.</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
            </div>
            <div class="mt-3 mb-3">
                <label for="formGroupExampleInput2" class="form-label">IFSC</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
            </div>
            <div class="mt-3 mb-3">
                <label for="formGroupExampleInput2" class="form-label">Branch Name</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
            </div>
            </li>
    </ul>
    </div>
    <hr>
    <h6>Pickup</h6>
    <div class='my-4' style="margin-left:20%;margin-right:30%;">        
        <p>Your package will be picked up by a courier service. Please return the item and packaging in its original condition to avoid pickup cancellation by courier service. More details..</p>
        <p>Printer not required - the carrier will bring your label.
        As we've prioritized our customers' most urgent needs, you will see longer than usual pick-up timeline.</p>
        <hr>
        <div class="h5">Pickup Date & Time</div>
        <p>Sunday, 25 Mar, 2023</p>
        <p>07:00 - 19:00</p>
        <hr>
        <div class="h5">Pickup Address</div>
        <p>Jack & Jill school, Hazaribagh , Hazaribagh, Delhi - 825301</p>
        <p>Address type: Home</p>
        <p><a class="link" href="" role="button">change pickup address</a></p>
        <div id='change_address'>
        <div class="mt-3 mb-3">
                <label for="formGroupExampleInput" class="form-label">Address (House no,Street)</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="mt-3 mb-3">
                <label for="formGroupExampleInput2" class="form-label">Locality / Town</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
            </div>
            <div class="mt-3 mb-3">
                <label for="formGroupExampleInput2" class="form-label">City / District</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="formGroupExampleInput2" class="form-label">Pin Code</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
                </div>
                <div class="col">
                    <label for="formGroupExampleInput2" class="form-label">State</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
                </div>
                <div class="col">
                    <label for="formGroupExampleInput2" class="form-label">Country</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
                </div>
            </div> 
            <div class="col-md g-2 mb-4 pl-2">  
                <label for="floatingInputGrid">Address Type</label>
                    <div class="form-floating">
                    <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="addr_type" id="inlineRadio1" value="1">
                <label class="form-check-label" for="inlineRadio1">Home</label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="addr_type" id="inlineRadio2" value="2">
                <label class="form-check-label" for="inlineRadio2">Work</label>
                </div>


    </div>
  </div>   
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
   
  <button type="button" class="btn btn-outline-primary">CONFIRM YOUR RETURN</button>
</div>
    </div>
    </div>
    
    </div>
    <script>
        let other_reason = document.getElementById('other_reason');
        other_reason.addEventListener('click', function(event){
            if (event.target && event.target.matches("input[type='radio']")) {
                document.getElementById('return_form').style.display = 'block';
            }
        });
    </script>
</body>
</html>