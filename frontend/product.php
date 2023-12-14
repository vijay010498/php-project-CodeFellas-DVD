<?php
include('headers.php');
?>
<div class="banner" style="color: black;text-align:center;">
    <h1>Welcome to DVD</h1>
    <p style="font-size:1.2em">Explore amazing content and discover new experiences with DVD Fellas.</p>
</div>

<div class="container">
    <div class="row">
        <div id="dvdContainer" class="row">
        </div>
    </div>
</div>

<?php
include('footers.php');
?>

<style>
    .row {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .product {
        width: 300px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
    }

    .product img {
        max-width: 100%;
        height: auto;
    }

    .product-title {
        font-size: 1.2em;
        margin-bottom: 5px;
    }

    .product-genre {
        font-style: italic;
        margin-bottom: 10px;
    }

    .product-price {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .cart {
        background-color: #07508e;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .cart:hover {
        background-color: #06407c;
    }
</style>

<script>
    const existingCartItemsMap = new Map();
    (() => {
        const cartItemsHTTP = new XMLHttpRequest();
        cartItemsHTTP.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    const response = JSON.parse(this.response);
                    if (response.hasOwnProperty('cartItems')) {
                        const cartItems = response.cartItems;
                        cartItems.forEach((cartItem) => {
                            existingCartItemsMap.set(cartItem.DVDId, true);
                        })
                    }
                } else {
                    console.error("Error: " + this.status);
                }
            }
        };
        cartItemsHTTP.open("GET", '/group-project-DVD-store/API.php/cart', true);
        cartItemsHTTP.send();
    })();


    function addToCart(DVDId, quantity) {
        const addToCartXhr = new XMLHttpRequest();
        addToCartXhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    const button = document.getElementById(`cartButton${DVDId}`);
                    console.log(button);
                    button.innerHTML = "Remove from Cart";
                    existingCartItemsMap.set(DVDId, true);
                } else if (this.status === 401) {
                    window.location.replace("login.php");
                }

                else {
                    console.error('Error:', this.status);
                }
            }
        };

        addToCartXhr.open('POST', '/group-project-DVD-store/API.php', true);
        addToCartXhr.setRequestHeader('Content-Type', 'application/json');

        const data = {
            action: 'addIntoCart',
            DVDId: DVDId,
            quantity: quantity
        };

        addToCartXhr.send(JSON.stringify(data));
    }

    function removeFromCart(DVDId) {
        console.log("removeFromCart",DVDId);
        const removeFromCartXhr = new XMLHttpRequest();
        removeFromCartXhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    console.log(response.message);
                    const button = document.getElementById(`cartButton${DVDId}`);
                    button.innerHTML = "Add to Cart";
                    existingCartItemsMap.delete(DVDId);
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

    function addOrDeleteCartItem(DVDId, quantity) {
        if (existingCartItemsMap.has(DVDId)) {
            // remove
            removeFromCart(DVDId);
        } else {
            addToCart(DVDId, quantity);
        }

    }

    const xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                const response = JSON.parse(this.responseText);

                if (response.hasOwnProperty('items')) {
                    const dvds = response.items;
                    const dvdContainer = document.getElementById('dvdContainer');

                    dvdContainer.innerHTML = '';

                    dvds.forEach(function (dvd) {
                        if (existingCartItemsMap.has(dvd.DVDId)) {
                            console.log("exists");
                            // remove from cart
                            const cardHtml = `
                            <div class="product">
                                <img class="product-img" src="${dvd.imageURL}" alt="${dvd.Title}">
                                <div class="product-block">
                                    <h4 class="product-title">${dvd.Title}</h4>
                                    <p class="product-genre">${dvd.genreName}</p>
                                    <p class="product-price">$${dvd.Price}</p>
                                </div>
                                <button id="cartButton${dvd.DVDId}" class="btn cart" onclick="addOrDeleteCartItem(${dvd.DVDId})" type="button">Remove From Cart</button>
                            </div>
                        `;

                            dvdContainer.insertAdjacentHTML('beforeend', cardHtml);
                        } else {

                            const cardHtml = `
                            <div class="product">
                                <img class="product-img" src="${dvd.imageURL}" alt="${dvd.Title}">
                                <div class="product-block">
                                    <h4 class="product-title">${dvd.Title}</h4>
                                    <p class="product-genre">${dvd.genreName}</p>
                                    <p class="product-price">$${dvd.Price}</p>
                                </div>
                                <button id="cartButton${dvd.DVDId}" class="btn cart" onclick="addOrDeleteCartItem(${dvd.DVDId}, 1)" type="button">Add to Cart</button>
                            </div>
                        `;

                            dvdContainer.insertAdjacentHTML('beforeend', cardHtml);
                        }
                    });
                } else {
                    const errorMessage = '<p>Error: No DVD items found.</p>';
                    document.getElementById('dvdContainer').innerHTML = errorMessage;
                }
            } else {
                console.error("Error: " + this.status);
            }
        }
    };
    xmlHttp.open("GET", '/group-project-DVD-store/API.php/home', true);
    xmlHttp.send();
</script>

