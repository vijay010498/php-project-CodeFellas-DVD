<?php
include('headers.php');
?>

<div class="d-flex align-items-center justify-content-center login">
    <?php
    $changeForm = isset($_SESSION['changeForm']) ? $_SESSION['changeForm'] : 'login';
    ?>
    <form id="loginForm" <?php if ($changeForm === 'login') echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
        <h1 class="h3 mb-3 fw-normal">Login</h1>
        <div class="form-floating mb-2">
            <input type="text" class="form-control" id="loginEmail" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control" id="loginPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <button id="loginBtn" class="btn w-100" type="submit">Login</button>
        <button class="btn w-100 mt-2" style="background-color:rgb(227, 227, 227);color:black;" type="button" onclick="changeForms('signup')">Sign Up</button>
    </form>

    <!-- Signup form -->
    <form id="signupForm" <?php if ($changeForm === 'signup') echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
        <h1 class="h3 mb-3 fw-normal mt-4">Sign Up</h1>
        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-floating">
                    <input  type="text" class="form-control" id="signupFirstName" placeholder="First Name">
                    <label for="firstName">First Name</label>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="form-floating">
                    <input type="text" class="form-control" id="signupLastName" placeholder="Last Name">
                    <label for="lastName">Last Name</label>
                </div>
            </div>
        </div>
        <div class="form-floating mb-2">
            <input type="text" class="form-control" id="signupEmail" placeholder="name@example.com">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control" id="signupPassword" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-2">
            <input type="text" class="form-control" id="signupAddress" placeholder="Address">
            <label for="address">Address</label>
        </div>
        <div class="form-floating mb-2">
            <input type="text" class="form-control" id="signupPhoneNumber" placeholder="Phone Number">
            <label for="phoneNumber">Phone Number</label>
        </div>
        <button id="signupBtn" class="btn w-100 mt-2" type="submit">Sign Up</button>
        <button class="btn w-100 mt-2" style="background-color:rgb(227, 227, 227);color:black;" type="button" onclick="changeForms('login')">Login</button>
    </form>
</div>


<script>
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

    document.addEventListener('DOMContentLoaded', function () {
        const loginBtn = document.getElementById('loginBtn');
        const signupBtn = document.getElementById('signupBtn');

        loginBtn.addEventListener('click', function (event) {
            event.preventDefault();

            const loginEmail = document.getElementById('loginEmail').value;
            const loginPassword = document.getElementById('loginPassword').value;

            const loginXhr = new XMLHttpRequest();
            loginXhr.open('POST', '/group-project-DVD-store/API.php', true);
            loginXhr.setRequestHeader('Content-Type', 'application/json');

            loginXhr.onreadystatechange = function () {
                if (loginXhr.readyState === XMLHttpRequest.DONE) {
                    if (loginXhr.status === 200) {
                        window.location.replace("index.php");
                    } else {
                        console.error('Error:', loginXhr.status);
                    }
                }
            };

            const loginRequestBody = JSON.stringify({
                action: 'signInUsr',
                email: loginEmail,
                password: loginPassword
            });

            loginXhr.send(loginRequestBody);
        });

        signupBtn.addEventListener('click', function (event) {
            console.log("signup-clicked");
            event.preventDefault();

            const signupFirstName = document.getElementById('signupFirstName').value;
            const signupLastName = document.getElementById('signupLastName').value;
            const signupEmail = document.getElementById('signupEmail').value;
            const signupPassword = document.getElementById('signupPassword').value;
            const signupAddress = document.getElementById('signupAddress').value;
            const signupPhoneNumber = document.getElementById('signupPhoneNumber').value;

            const signupXhr = new XMLHttpRequest();
            signupXhr.open('POST', '/group-project-DVD-store/API.php', true);
            signupXhr.setRequestHeader('Content-Type', 'application/json');

            signupXhr.onreadystatechange = function () {
                if (signupXhr.readyState === XMLHttpRequest.DONE) {
                    if (signupXhr.status === 200) {
                        window.location.replace("login.php");
                    } else {
                        console.error('Error:', signupXhr.status);
                    }
                }
            };

            const signupRequestBody = JSON.stringify({
                action: 'signUpNewUser',
                firstName: signupFirstName,
                lastName: signupLastName,
                email: signupEmail,
                password: signupPassword,
                address: signupAddress,
                phoneNumber: signupPhoneNumber
            });

            signupXhr.send(signupRequestBody);
        });
    });
</script>

<?php
include('footers.php');
?>
