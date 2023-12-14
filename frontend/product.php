<?php
include('headers.php');
?>
<div class="banner" style="color: black;text-align:center;">
    <h1>Welcome to DVD</h1>
    <p style="font-size:1.2em">Explore amazing content and discover new experiences with DVD Fellas.</p>
</div>
<div class="container-fluid">
    <div class="row">
        <div id="dvdContainer" class="scrollproducts">
        </div>
    </div>
</div>

<?php
include('footers.php');
?>

<script>
    (() => {
        const xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);

                    if (response.hasOwnProperty('items')) {
                        const dvds = response.items;
                        const dvdContainer = document.getElementById('dvdContainer');

                        dvdContainer.innerHTML = '';

                        dvds.forEach(function(dvd) {
                            const cardHtml = `
                                <div class="product">
                                    <img class="product-img" src="${dvd.imageURL}" alt="${dvd.Title}">
                                    <div class="product-block">
                                        <h4 class="product-title">${dvd.Title}</h4>
                                        <p class="product-genre">${dvd.genreName}</p>
                                        <p class="product-price">$${dvd.Price}</p>
                                    </div>
                                    <button class="btn cart" type="button">Add to Cart</button>
                                </div>
                            `;

                            dvdContainer.insertAdjacentHTML('beforeend', cardHtml);
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
    })()
</script>
