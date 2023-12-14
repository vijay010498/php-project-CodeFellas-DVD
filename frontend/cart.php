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

                        <hr class="my-4">
      
                        <div class="d-flex justify-content-between mb-5">
                          <h5 class="text-uppercase">Total price</h5>
                          <h5 id="totalprice">$ </h5>
                        </div>

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



<script>
    fetchCartItems();

    function fetchCartItems() {
        const cartItemsXhr = new XMLHttpRequest();
        cartItemsXhr.onreadystatechange = function () {
            if (cartItemsXhr.readyState === XMLHttpRequest.DONE) {
                if (cartItemsXhr.status === 200) {
                    const cartResponse = JSON.parse(cartItemsXhr.responseText);
                    displayCartItems(cartResponse.cartItems);
                } else {
                    console.error('Error:', cartItemsXhr.status);
                }
            }
        };

        cartItemsXhr.open('GET', '/group-project-DVD-store/API.php/cart', true);
        cartItemsXhr.send();
    }

    function removeFromCart(DVDId) {
        console.log("removeFromCart",DVDId);
        const removeFromCartXhr = new XMLHttpRequest();
        removeFromCartXhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    console.log(response.message);
                    window.location.reload();
                } else {
                    console.error('Error:', this.status);
                }
            }
        };

        removeFromCartXhr.open('POST', '/group-project-DVD-store/API.php', true);
        removeFromCartXhr.setRequestHeader('Content-Type', 'application/json');

        const data = {
            action: 'deleteFromCart',
            DVDId: DVDId,
        };

        removeFromCartXhr.send(JSON.stringify(data));
    }

    function displayCartItems(cartItems) {
        const cartContainer = document.getElementById('cartContainer');
        let totalPrice = 0;

        document.getElementById("itemcount").textContent = cartItems.length.toString();

        cartItems.forEach(function (item) {
            const cartItemHtml = `
                <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <img src="${item.imageURL}" class="img-fluid rounded-3 cartimg" alt="${item.Title}">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <h6 class="text-black mb-0 product-name">${item.Title}</h6>
                        <h6 class="text-muted size">Price: $${item.DVDPrice}</h6>
                        <h6 class="text-muted quantity">Quantity: ${item.Quantity}</h6>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h6 class="mb-0 price">$${item.TotalPrice}</h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a  class="text-muted" onclick="removeFromCart(${item.DVDId})"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                <hr class="my-4">
            `;
            cartContainer.insertAdjacentHTML('beforeend', cartItemHtml);
            totalPrice += item.DVDPrice * item.Quantity;
        });
        const totalPriceElement = document.getElementById('totalprice');
        totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
    }
</script>


