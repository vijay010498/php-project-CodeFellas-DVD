<?php
  include('headers.php');
?>
<div class="d-flex align-items-center justify-content-center login">
  <?php
    // Check if the changeForm session variable is set
    $changeForm = isset($_SESSION['changeForm']) ? $_SESSION['changeForm'] : 'login';
  ?>
  <form id="loginForm" <?php if ($changeForm === 'login') echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
    <h1 class="h3 mb-3 fw-normal">Login</h1>
    <!-- <div class="row"> -->
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
    <!-- </div> -->

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="btn w-100" type="submit">Login</button>
    <button class="btn w-100 mt-2" style="background-color:rgb(227, 227, 227);color:black;" type="button" onclick="changeForms('signup')">Sign Up</button>
  </form>

  <!-- Signup form -->
  <form id="signupForm" <?php if ($changeForm === 'signup') echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
    <h1 class="h3 mb-3 fw-normal mt-4">Sign Up</h1>
    <div class="row">
      <div class="col-md-6 mb-2">
        <div class="form-floating">
          <input type="text" class="form-control" id="firstName" placeholder="First Name">
          <label for="firstName">First Name</label>
        </div>
      </div>
      <div class="col-md-6 mb-2">
        <div class="form-floating">
          <input type="text" class="form-control" id="lastName" placeholder="Last Name">
          <label for="lastName">Last Name</label>
        </div>
      </div>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control" id="email" placeholder="name@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="form-floating mb-2">
      <input type="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control" id="address" placeholder="Address">
      <label for="address">Address</label>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control" id="phoneNumber" placeholder="Phone Number">
      <label for="phoneNumber">Phone Number</label>
    </div>
    <button class="btn w-100 mt-2" type="submit">Sign Up</button>
    <button class="btn w-100 mt-2" style="background-color:rgb(227, 227, 227);color:black;" type="button" onclick="changeForms('login')">Login</button>
  </form>

</div>
</main>
<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/script.js"></script>
<script>
  // JavaScript function to toggle forms and update PHP session variable
  function changeForms(form) {
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    if (form === 'signup') {
      loginForm.style.display = 'none';
      signupForm.style.display = 'block';
      <?php $_SESSION['changeForm'] = 'signup'; ?>
    } else {
      loginForm.style.display = 'block';
      signupForm.style.display = 'none';
      <?php $_SESSION['changeForm'] = 'login'; ?>
    }
  }
</script>
<?php
  include('footers.php');
?>
