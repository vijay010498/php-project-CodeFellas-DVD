<?php
  include('headers.php');
?>
<style>
  .card {
    height: 100%;
  }

  .card-img-top {
    max-height: 350px; 
    object-fit: contain;
  }
</style>
<section class="filterSort fsFlex">
  <div class="filters" style=" padding: 20px;">
    <h4 id="dialog">Filter DVDs    <i class="fa fa-filter"></i></h4>
    <div class="filter">
        <div class="dvd">DVD Type  <i class="fa fa-angle-down"></i></div>
        <div class="filteroptions">
            <ul>
                <li><input type="checkbox" id="movies"><label for="movies">Movies</label></li>
                <li><input type="checkbox" id="games"><label for="games">Games</label></li>
                <li><input type="checkbox" id="documenteries"><label for="documenteries">Documenteries</label></li>
                <li><input type="checkbox" id="education"><label for="education">Education</label></li>
            </ul>
            <button value="apply">Apply</button>
        </div>
        <hr>
    </div>
    <div class="filter">
        <div class="dvd">Movies  <i class="fa fa-angle-down"></i></div>
        <div class="filteroptions">
            <ul>
                <li><input type="checkbox" id="trending"><label for="trending">Trending</label></li></li>
                <li><input type="checkbox" id="newarrivals"><label for="newarrivals">New Arrivals</label></li></li>
                <li><input type="checkbox" id="english"><label for="english">English</label></li></li>
                <li><input type="checkbox" id="indian"><label for="indian">Indian</label></li></li>
            </ul>
            <button value="apply">Apply</button>
        </div>
        <hr>
    </div>
    <div class="filter">
        <div class="dvd">Games  <i class="fa fa-angle-down"></i></div>
        <div class="filteroptions">
            <ul>
                <li><input type="checkbox" id="pcgames"><label for="pcgames">PC Games</label></li>
                <li><input type="checkbox" id="adventure"><label for="adventure">Adventure</label></li>
                <li><input type="checkbox" id="trending"><label for="trending">Trending</label></li></li>
                <li><input type="checkbox" id="newarrivals"><label for="newarrivals">New Arrivals</label></li></li>
            </ul>
            <button value="apply">Apply</button>
        </div>
        <hr>
    </div>
    
    <div class="filter">
        <div class="dvd">Education  <i class="fa fa-angle-down"></i></div>
          <div class="filteroptions">
            <ul>
                <li><input type="checkbox" id="trending"><label for="trending">Trending</label></li></li>
                <li><input type="checkbox" id="newarrivals"><label for="newarrivals">New Arrivals</label></li></li>
            </ul>
            <button value="apply">Apply</button>
        </div>
        <hr>
    </div>
  </div>
</section>
<div class="container mt-5">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <!-- Product 1 -->
    <div class="col mb-3">
      <div class="card">
        <img src="./Images/p1.jpg" class="card-img-top mt-3" alt="Product Image">
        <div class="card-body">
          <h5 class="card-title font-weight-bold">Series 1-8 DVD</h5>
          <p class="card-text"><strong>DVD Name:</strong> Game of Thrones</p>
          <p class="card-text"><strong>Category:</strong> Series</p>
          <p class="card-text"><strong>Price:</strong> $99.99</p>
          <p class="card-text"><strong>Rating:</strong> ★★★★☆</p>
          <p class="card-text text-muted">Free Shipping</p>
          <button class="btn btn-primary">Add to Cart</button>
        </div>
      </div>
    </div>

    <!-- Product 2 -->
    <div class="col mb-3">
      <div class="card">
        <img src="./Images/p2.jpg" class="card-img-top mt-3" alt="Product Image">
        <div class="card-body">
          <h5 class="card-title font-weight-bold">Mystery & Thrillers</h5>
          <p class="card-text"><strong>DVD Name:</strong> The Hanged Man</p>
          <p class="card-text"><strong>Category:</strong> Film</p>
          <p class="card-text"><strong>Price:</strong> $78.99</p>
          <p class="card-text"><strong>Rating:</strong> ★★★☆☆</p>
          <p class="card-text text-muted">Free Shipping</p>
          <button class="btn btn-primary">Add to Cart</button>
        </div>
      </div>
    </div>

    <!-- Repeat the above card structure for other products -->
    
    <!-- Product 3 -->
    <div class="col mb-3">
      <div class="card">
        <img src="./Images/p3.jpg" class="card-img-top mt-3" alt="Product Image">
        <div class="card-body">
          <h5 class="card-title font-weight-bold">The Complete 8-Film Collection</h5>
          <p class="card-text"><strong>DVD Name:</strong> Harry Potter</p>
          <p class="card-text"><strong>Category:</strong> Science Fiction & Fantasy</p>
          <p class="card-text"><strong>Price:</strong> $97.99</p>
          <p class="card-text"><strong>Rating:</strong> ★★★★☆</p>
          <p class="card-text text-muted">Free Shipping</p>
          <button class="btn btn-primary">Add to Cart</button>
        </div>
      </div>
    </div>

    <!-- Product 4 -->
    <div class="col mb-3">
      <div class="card">
        <img src="./Images/p4.jpg" class="card-img-top mt-3" alt="Product Image">
        <div class="card-body">
          <h5 class="card-title font-weight-bold">Western Collection</h5>
          <p class="card-text"><strong>DVD Name:</strong> The Tom Selleck</p>
          <p class="card-text"><strong>Category:</strong> Westerns</p>
          <p class="card-text"><strong>Price:</strong> $94.99</p>
          <p class="card-text"><strong>Rating:</strong> ★★★★☆</p>
          <p class="card-text text-muted">Free Shipping</p>
          <button class="btn btn-primary">Add to Cart</button>
        </div>
      </div>
    </div>
    <!-- Product 5 -->
    <div class="col mb-3">
      <div class="card">
        <img src="./Images/p5.jpg" class="card-img-top mt-3" alt="Product Image">
        <div class="card-body">
          <h5 class="card-title font-weight-bold">(Bilingual)</h5>
          <p class="card-text"><strong>DVD Name:</strong> Little Mermaid</p>
          <p class="card-text"><strong>Category:</strong> Action</p>
          <p class="card-text"><strong>Price:</strong> $93.99</p>
          <p class="card-text"><strong>Rating:</strong> ★★★★☆</p>
          <p class="card-text text-muted">Free Shipping</p>
          <button class="btn btn-primary">Add to Cart</button>
        </div>
      </div>
    </div>

    <!-- Product 6 -->
    <div class="col mb-3">
      <div class="card">
        <img src="./Images/p6.jpg" class="card-img-top mt-3" alt="Product Image">
        <div class="card-body">
          <h5 class="card-title font-weight-bold">Product Title</h5>
          <p class="card-text"><strong>DVD Name:</strong> The Equalizer 3</p>
          <p class="card-text"><strong>Category:</strong> Action; Crime; Thriller</p>
          <p class="card-text"><strong>Price:</strong> $99.99</p>
          <p class="card-text"><strong>Rating:</strong> ★★★★☆</p>
          <p class="card-text text-muted">Free Shipping</p>
          <button class="btn btn-primary">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $(".dvd").click(function(event) {
            var targetDiv = $(event.currentTarget).next("div");
            var arrowIcon = $(event.currentTarget).find(".fa");
            targetDiv.slideToggle(1000);
            targetDiv.toggleClass("display", "filteroptions");
            arrowIcon.toggleClass("fa-angle-up" , "fa-angle-down");
            event.stopPropagation(); 
        });

        $(document).click(function(event) {
            if (!$(event.target).closest(".filter").length) {
                $(".dvd").next("div").slideUp(1000).removeClass("display").addClass("filteroptions");
                $(".dvd").find(".fa").removeClass("fa-angle-up").addClass("fa-angle-down");
            }
        });
    });
</script>
</main>
<?php
  include('footers.php');
?>
