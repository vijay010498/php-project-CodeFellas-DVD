<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVD Fellas</title>
    <!--bootstap css link--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #07508e;" aria-label="Fourth navbar example">
        <div class="container-fluid">
            <a class="navbar-brand me-4" href="index.php"><h3><i class="fas fa-compact-disc"></i> DVD</h3></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarsExample04">
                <form class="me-2">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                </form>
                <ul class="navbar-nav font-size" style="font-size:1em;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php"><i class="fas fa-compact-disc"></i> DVDs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="checkout.php"><i class="fas fa-money-check"></i> Checkout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div id="wrapper" style="margin:50px;">
            <div id="gridconatiner">
                <div class="py-5 text-center">
                    <h2>Checkout form</h2>
                    <p class="lead">Add your shipping address</p>
                </div>
            
                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                        <span class="badge bg-primary rounded-pill">1</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <img id="pimage" src="" alt="product image">
                            <h6 class="my-1"></h6>
                            <small class="size text-body-secondary"></small>
                            <span id="size"></span>
                            <small class="quantity text-body-secondary">Quantity: <span id="quantity"></span></small>
                            
                        </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Total ($)</span>
                        <strong id="total"></strong>
                        </li>
                    </ul>
                    </div>
                    <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="checkout" action="response.html">
                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>   <span id="error">*</span>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                        </div>
            
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>   <span id="error">*</span>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                        </div>
            
            
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label> <span id="error"> *</span>
                            <input type="text" class="form-control" id="email" placeholder="you@example.com">
                        
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label">Phone</label> <span id="error"> *</span>
                            <input type="text" class="form-control" id="phone" placeholder="+91 99999-99999">
                        
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>   <span id="error"> *</span>
                            <input type="text" class="form-control" id="address" placeholder="25-7-328, Gardens" required>
                        
                        </div>
            
                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>  <span id="error"> *</span>
                            <select class="form-select" id="country" required>
                                <option value="">Choose...</option>
                                <option>India</option>
                            </select>
                        </div>
            
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>  <span id="error"> *</span>
                            <select class="form-select" id="state" required>
                            <option value="">Choose...</option>
                            <option>Amritsar</option>
                            <option>Andhra Pradesh</option>
                            <option>Telangana</option>
                            <option>Maharashtra</option>
                            </select>
                            
                        </div>
            
                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label><span id="error"> *</span>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            
                        </div>
                        </div>
            
                        <hr class="my-4">
            
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="same-address">
                            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                        </div>
            
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="save-info">
                            <label class="form-check-label" for="save-info">Save this information for next time</label>
                        </div>
            
                        <hr class="my-4">
            
                        <h4 class="mb-3">Payment</h4>
                        <p>Sorry currently we don't have any online payment methods available for you</p>
                        <div class="my-3">
                        <div class="form-check">
                            <input id="cod" name="paymentMethod" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">Cash On Delivery</label>
                            
                        </div>
                        <div class="form-check">
                            <input id="debit" name="paymentMethod" type="radio" disabled class="form-check-input" required>
                            <label class="form-check-label" for="debit">Debit card</label>
                        </div>
                        <div class="form-check">
                            <input id="phonepe" name="paymentMethod" type="radio" disabled class="form-check-input" required>
                            <label class="form-check-label" for="paypal">Google Pay</label>
                        </div>
                        </div>

                        <hr class="my-4">
            
                        <button class="btn  btn-primary btn-lg" type="submit"><a id="response" href="response.html" style="text-decoration:none;color:white;">Order</a> </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-5">
      <div class="row">
        <div class="col mb-3" style="margin-left:30px;">
          <a href="index.php" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
            <h3><i class="fas fa-compact-disc"></i> DVD</h3>
          </a>
          <p class="text-body-secondary">© DVD Fellas - <script> document.write(new Date().getFullYear());</script></p>
        </div>

        <div class="col mb-3">

        </div>

        <div class="col mb-3">
          <h5>Buy</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="index.php" class="nav-link p-0 text-body-secondary">Home</a></li>
            <li class="nav-item mb-2"><a href="product.php" class="nav-link p-0 text-body-secondary">DVDs</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
            <li class="nav-item mb-2"><a class="nav-link p-0 text-body-secondary" href="cart.php">Cart</a></li>
          </ul>
        </div>

        <div class="col mb-3">
          <h5>Company</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
          </ul>
        </div>
      </div>
    </footer>
    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>