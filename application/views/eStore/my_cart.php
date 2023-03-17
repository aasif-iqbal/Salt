<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Cart</h2>
    <div class='container'>
        <div class="row">
            <div class='col-8' id="myData"></div>
            <div class='col-4' id="total_price"></div>
        </div>
        
    </div>
    <?php 
    // $userLoginData = isset($this->session->userdata('userLoginData'));
    
    // echo('<pre/>');
    // print_r($cart_items);
    ?>
    <script>
        var cart_items = JSON.parse(localStorage.getItem('cart_item_list'));
        
        console.log("cart_items",cart_items);

        if(cart_items){

            var output = document.getElementById('myData');
            var total_price = document.getElementById('total_price');
            
            var local_st_value = JSON.stringify(cart_items)
            
            // output.innerHTML = local_st_value;
        
            // console.log((local_st_value));
            var url = window.location.href;
            url = url.slice(0,21) //return http://localhost/salt/

        const data = JSON.parse(local_st_value);
        // console.log((data));
//--------------------------------------------------------------------------------------
        var  item_count = Object.keys(cart_items).length;
        // console.log(item_count);
        localStorage.setItem('item_count', item_count);
//---------------------------------------------------------------------------------------
        
        var total_product_sum = 0.0;

        data.forEach((item) => {        
    
    let id = item.id;
    // console.log("items",id);
        output.innerHTML += `<div class="card mb-3" style="">
                <div class="row g-0">
                    <div class="col-md-2">
                    <img src="${url}/uploads/${item.product_image}" class="img-fluid" alt="..." height="200"  width="100">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">${item.product_name}</h5>
                        <p class="card-text">Rs.${item.product_selling_price}</p>
                        <span class="card-text"> id: ${item.id}</span>
                        <p class="card-text"><small class="text-muted">
                        
                        <div class="d-inline"><button id='plus' value='${id}' onclick='minus("${id}")'>-</button></div>
                        <span class="d-inline card-text"> ${item.product_quantity} </span>
                        <div class="d-inline"><button id='plus' value='${id}' onclick='plus("${id}")'>+</button></div>

                        <button id='${item.id}' onclick='remove(${item.id})'>Remove</button></small></p>
                    </div>
                    </div>
                </div>
        </div>`; 
        
        var item_count = JSON.parse(localStorage.getItem('item_count'));
        total_product_sum = Number(item.product_selling_price) + Number(total_product_sum);   
        // total_product_sum = (total_product_sum * item_count);
        }); 
        
        total_price.innerHTML +=`<div class="card" style="">
                                    <div class="card-body">
                                        <h5 class="card-title">Total</h5>
                                        <p class="card-text">${total_product_sum}</p>
                                        <a href="<?= base_url('login');?>" class="btn btn-primary">Checkout</a>
                                    </div>
                                </div>`;    
    
        }
        // Checkout->login->(if_new)->registation (For Non-Login User)
    
    function remove(id){
        
        let itemArray = JSON.parse(localStorage.getItem('cart_item_list')) || [];
        let index = itemArray.findIndex(item => item.id === id.id); // Assuming id is the unique identifier property of the object
        // console.log(index);        
        itemArray.splice(index, 1);  //remove selected indexed item      
        // console.log(itemArray);                
        localStorage.setItem('cart_item_list', JSON.stringify(itemArray));
        window.location.reload();
    }    

    function plus(id){
        
        // console.log(id);
        let itemArray = JSON.parse(localStorage.getItem('cart_item_list')) || [];
        // let index = itemArray.findIndex(item => item.id === id.id);  
        itemArray.forEach(array_elem => {
                   if(id === array_elem.id){
                    array_elem.product_quantity = Number(array_elem.product_quantity) + 1;
                    item_count = item_count + array_elem.product_quantity;
                    localStorage.setItem('item_count', item_count);
                   }          
                   
                   localStorage.setItem('cart_item_list', JSON.stringify(itemArray));
        }); 
        console.log(item_count);
        console.log(itemArray);       
        // setItemCount();    
    }

    function minus(id){
        // console.log(id);
        let itemArray = JSON.parse(localStorage.getItem('cart_item_list')) || [];
        
        itemArray.forEach(array_elem => {
                   if(id === array_elem.id){
                        if(array_elem.product_quantity > 0){
                        array_elem.product_quantity = Number(array_elem.product_quantity) - 1;
                        item_count = Math.abs(array_elem.product_quantity - item_count);
                        localStorage.setItem('item_count', item_count);
                    }
                    else{                        
                        console.log('check');
                    }
            }          
                   
                   localStorage.setItem('cart_item_list', JSON.stringify(itemArray));
        }); 
        console.log(item_count);
        console.log(itemArray);  
        // setItemCount();        
    }

//================================ bag item count ======================================
/*
function setItemCount(){
        var item_count = JSON.parse(localStorage.getItem('item_count'));
        console.log(item_count);
        var bag = document.getElementById('bag');
        if(item_count){
            bag.innerHTML = `<i class="fa-solid fa-bag-shopping"></i>&nbsp;Bag(${item_count})`;
        }else{
            bag.style.display = "none";
        }
    }
    setItemCount();
    */
//=============================== bag item count end ===================================
    </script>
</body>
</html>