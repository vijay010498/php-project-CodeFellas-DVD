<?php
    include('headers.php');
?>
<div id="wrapper" style="margin:10px 50px;">
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

                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                        <label class="form-check-label" for="credit">Credit card</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                        <label class="form-check-label" for="debit">Debit card</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                        <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <small class="text-body-secondary">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>

                    <div class="col-md-6">
                    <label for="cc-number" class="form-label">Credit card number</label>
                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                    <div class="invalid-feedback">
                        Credit card number is required
                    </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
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
<?php
    include('footers.php');
?>
