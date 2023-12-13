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
                        <a class="nav-link" href="admin.php"><i class="fas fa-user-tie"></i> Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
      <div id="wrapper">
        <div class="bannerSlide">
            <div class="slide fade" style="opacity: 1;">
                <img src="./Images/avatarBanner.jpg" alt="Avatar Banner Image">
            </div>
            <div class="slide fade">
                <img src="./Images/avengersBanner.jpg" alt="Avengers Banner Image">
            </div>
            <div class="slide fade">
                <img src="./Images/thumbbig-76146.webp" alt="Closeup on Avatar Eyes">
            </div>
            <div class="slide fade">
                <img src="./Images/spidermanBanner.jpg" alt="Spiderman Image">
            </div>
        </div>

        <div class="controls">
            <div class="dots"></div>
        </div>
      </div>