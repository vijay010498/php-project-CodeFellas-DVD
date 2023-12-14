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
                    <span class="badge bg-primary rounded-pill" id="itemcount">1</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                    </li>

                    <hr class="my-4">
                    <div id="cartContainer">
                    </div>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total ($)</span>
                        <strong id="totalprice"></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form class="checkout" onsubmit="validateForm(event)">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label> <span id="error">*</span>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label> <span id="error">*</span>
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
                            <label for="address" class="form-label">Address</label> <span id="error"> *</span>
                            <input type="text" class="form-control" id="address" placeholder="25-7-328, Gardens"
                                   required>

                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label> <span id="error"> *</span>
                            <select class="form-select" id="country" required>
                                <option value="">Choose...</option>
                                <option>India</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label> <span id="error"> *</span>
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


                    <h4 class="mb-3">Payment</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked
                                   required>
                            <label class="form-check-label" for="credit">Credit card</label>
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
                            <input type="text" class="form-control" id="cc-number" placeholder="" maxlength="16" required>
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

                    <button class="btn  btn-primary btn-lg" type="submit"> Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
<?php
include('footers.php');
?>

<script>

    checkLoginStatus();

    function checkLoginStatus() {
        const loginXhr = new XMLHttpRequest();
        loginXhr.open('GET', '/group-project-DVD-store/API.php/loginstatus', true);

        loginXhr.onreadystatechange = function () {
            if (loginXhr.readyState === XMLHttpRequest.DONE) {
                if (loginXhr.status === 200) {
                    const response = JSON.parse(loginXhr.responseText);
                    if (response.loginStatus) {
                        fetchCartItems()
                    } else {
                        window.location.replace("login.php");
                    }
                } else {
                    console.error('Error:', loginXhr.status);
                }
            }
        };

        loginXhr.send();

    }


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
        console.log("removeFromCart", DVDId);
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

    function validateForm(event) {
        event.preventDefault();

        const firstName = document.getElementById('firstName');
        const lastName = document.getElementById('lastName');
        const email = document.getElementById('email');
        const phone = document.getElementById('phone');
        const address = document.getElementById('address');
        const country = document.getElementById('country');
        const state = document.getElementById('state');
        const zip = document.getElementById('zip');
        const ccName = document.getElementById('cc-name');
        const ccNumber = document.getElementById('cc-number');
        const ccExpiration  = document.getElementById('cc-expiration');
        const ccCVV = document.getElementById('cc-cvv');

        if (firstName.value.trim() === '') {
            alert('Please enter your first name.');
            firstName.focus();
            return false;
        }

        if (lastName.value.trim() === '') {
            alert('Please enter your last name.');
            lastName.focus();
            return false;
        }

        if (email.value.trim() === '') {
            alert('Please enter your email.');
            email.focus();
            return false;
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                alert('Please enter a valid email address.');
                email.focus();
                return false;
            }
        }

        if (phone.value.trim() === '') {
            alert('Please enter your phone number.');
            phone.focus();
            return false;
        } else {
            const phoneRegex = /^\+?\d{1,3}?\s?\d{5,}$/;
            if (!phoneRegex.test(phone.value.trim())) {
                alert('Please enter a valid phone number.');
                phone.focus();
                return false;
            }
        }

        if (address.value.trim() === '') {
            alert('Please enter your address.');
            address.focus();
            return false;
        }

        if (country.value.trim() === '') {
            alert('Please select your country.');
            country.focus();
            return false;
        }

        if (state.value.trim() === '') {
            alert('Please select your state.');
            state.focus();
            return false;
        }

        if (zip.value.trim() === '') {
            alert('Please enter your zip code.');
            zip.focus();
            return false;
        } else {
            const zipRegex = /^\d{6}$/;
            if (!zipRegex.test(zip.value.trim())) {
                alert('Please enter a valid zip code.');
                zip.focus();
                return false;
            }
        }

        if (ccName.value.trim() === '') {
            alert('Please enter the name on your card.');
            ccName.focus();
            return false;
        }

        if (ccNumber.value.trim() === '') {
            alert('Please enter your credit card number.');
            ccNumber.focus();
            return false;
        } else {

            const ccNumberRegex = /^\d{16}$/;
            if (!ccNumberRegex.test(ccNumber.value.trim())) {
                alert('Please enter a valid credit card number.');
                ccNumber.focus();
                return false;
            }
        }

        if (ccExpiration.value.trim() === '') {
            alert('Please enter the expiration date.');
            ccExpiration.focus();
            return false;
        }

        if (ccCVV.value.trim() === '') {
            alert('Please enter the CVV.');
            ccCVV.focus();
            return false;
        } else {

            const ccCVVRegex = /^\d{3}$/;
            if (!ccCVVRegex.test(ccCVV.value.trim())) {
                alert('Please enter a valid CVV.');
                ccCVV.focus();
                return false;
            }
        }

        const checkoutAndPlaceOrderXhr = new XMLHttpRequest();
        checkoutAndPlaceOrderXhr.onreadystatechange = function () {
            if (checkoutAndPlaceOrderXhr.readyState === XMLHttpRequest.DONE) {
                if (checkoutAndPlaceOrderXhr.status === 200) {
                    const blob = new Blob([checkoutAndPlaceOrderXhr.response], { type: 'application/pdf' });
                    const url = window.URL.createObjectURL(blob);
                    window.open(url, '_blank');

                   setTimeout(() => {
                       window.location.replace("index.php");
                   },2000)

                } else {
                    console.error('Error:', checkoutAndPlaceOrderXhr.status);
                }
            }
        };

        checkoutAndPlaceOrderXhr.open('GET', '/group-project-DVD-store/API.php/checkoutAndPlaceOrder', true);
        checkoutAndPlaceOrderXhr.responseType = 'arraybuffer';
        checkoutAndPlaceOrderXhr.send();

    }
</script>
