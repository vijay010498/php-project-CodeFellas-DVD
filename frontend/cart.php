<?php
  include('headers.php');
?>
<div id="wrapper" >
  <div id="gridconatiner">
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
              <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                <div class="card-body p-0">
                  <div class="row g-0">
                    <div class="col-lg-8">
                      <div class="p-5">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                          <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                          <h6 id="itemcount" class="mb-0 text-muted">1</h6>
                        </div>
                        <hr class="my-4">
                        <div id="cartContainer">
                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                  <img
                                    src=""
                                    class="img-fluid rounded-3 cartimg" alt="">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                  
                                  <h6 class="text-black mb-0 product-name"></h6>
                                  <h6 class="text-muted size"></h6>
                                  <h6 class="text-muted quantity">Quantity: </h6>
                                </div>
                                
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                  <h6 class="mb-0 price">$ </h6>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                  <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                            <hr class="my-4">
                        </div>
      
                        <div class="pt-5">
                          <h6 class="mb-0"><a href="product.php" class="text-body"><i
                                class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 bg-grey">
                      <div class="p-5">
                        <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                        <hr class="my-4">
      
                        <div class="d-flex justify-content-between mb-4">
                          <h5 class="text-uppercase quantity">Items </h5>
                          
                          <h5 class="price">$ </h5>
                          
                        </div>
                        <div class="taxes">Taxes: 13%</div>
                        <h5 class="text-uppercase mb-3">Shipping</h5>
      
                        <div class="mb-4 pb-2">
                          <select class="select">
                            <option value="150">Express Delivery- $10</option>
                            <option value="50">Standard delivery - $5</option>
                          </select>
                        </div>
      
                        <h5 class="text-uppercase mb-3">Give promocode</h5>
      
                        <hr class="my-4">
      
                        <div class="d-flex justify-content-between mb-5">
                          <h5 class="text-uppercase">Total price</h5>
                          <h5 id="totalprice">$ </h5>
                        </div>
      
                        <button type="button" class="btn btn-dark btn-block btn-lg" id="calculate"
                          data-mdb-ripple-color="dark" style="margin-bottom:5px;">Calculate Price</button>
                        <a href="checkout.php"><button type="button" class="btn btn-dark btn-block btn-lg" id="checkout"
                            data-mdb-ripple-color="dark">Checkout</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>  
    
  </div>
</div> 
</main>
<?php
  include('footers.php');
?>


