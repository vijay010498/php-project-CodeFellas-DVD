<?php
include('headers.php');
?>
<div class="banner" style="color: black;text-align:center;">
    <h1>Welcome to DVD</h1>
    <p style="font-size:1.2em">Explore amazing content and discover new experiences with DVD Fellas.</p>
</div>

<div class="container">
    <div class="row">
        <label for="genreFilter">Filter by Genre:</label>
        <select id="genreFilter">
            <option value="">All Genres</option>
        </select>
    </div>
    <div id="dvdContainer" class="row"></div>
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


    const getCartItems = ()=> {
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
    }

    getCartItems();


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

    function addOrDeleteCartItem(DVDId, quantity = 1) {
        console.log("addOrDeleteCartItem",existingCartItemsMap);
        if (existingCartItemsMap.has(DVDId)) {
            // remove
            removeFromCart(DVDId);
        } else {
            addToCart(DVDId, quantity);
        }

    }


    function fetchDVDsByGenre(genre) {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);

                    if (response.hasOwnProperty('items')) {
                        let dvds = response.items;
                        const dvdContainer = document.getElementById('dvdContainer');

                        dvdContainer.innerHTML = '';

                        if (genre) {
                            dvds = dvds.filter(dvd => dvd.genreName === genre );
                        }
                        dvds.forEach(function (dvd) {
                            if (existingCartItemsMap.has(dvd.DVDId)) {
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

        let url = '/group-project-DVD-store/API.php/dvds';
        xmlHttp.open("GET", url, true);
        xmlHttp.send();
    }

    document.getElementById('genreFilter').addEventListener('change', function () {
        const selectedGenre = this.value;
        fetchDVDsByGenre(selectedGenre);
    });



    function fetchGenres() {
        const genreSelect = document.getElementById('genreFilter');

        const genresHTTP = new XMLHttpRequest();
        genresHTTP.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.hasOwnProperty('genres')) {
                        const genres = response.genres;
                        genres.forEach((genre) => {
                            const option = document.createElement('option');
                            option.value = genre.genreName;
                            option.textContent = genre.genreName;
                            genreSelect.appendChild(option);
                        });
                    }
                } else {
                    console.error("Error: " + this.status);
                }
            }
        };
        genresHTTP.open("GET", '/group-project-DVD-store/API.php/genres', true);
        genresHTTP.send();
    }


    fetchGenres();
    fetchDVDsByGenre('');
</script>

