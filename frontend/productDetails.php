<?php
  include('headers.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-3">
            <img src="./Images/p6.jpg" alt="Product Image" class="img-fluid" style="max-width: 90%; max-height: 300px; object-fit:contain;">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Product Title</h2>
            <p class="mb-3">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p class="mb-3">Price: $19.99</p>
            <form method="post" class="mb-3">
                <input type="hidden" name="product_id" value="1">
                <button type="submit" name="action" value="add_to_cart" class="btn btn-primary">Add to Cart</button>
            </form>
            <a href="product.php" class="btn btn-secondary">Shop More</a>
        </div>
    </div>
</div>

<?php
  include('footers.php');
?>
