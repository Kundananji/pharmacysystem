<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pharmacy Management - Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>

  <!-- Styles for Sweet alert Pluggin-->
  <link href="css/sweetalert.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    


      <div id="login-form" class="card m-auto p-2">
        <div class="card-body">

          <form class="user login-form">
          <div class="logo">
        			<img src="images/prof.jpg" class="profile"/>
        			<h1 class="logo-caption"><span class="tweak">L</span>ogin</h1>
    </div> <!-- logo class -->
                    <div class="input-group form-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
                    </div>
                      <input type="email" class="form-control form-control-user" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter Email or Username">
                    </div>
                    <div class="input-group form-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                  </div>
                      <input type="password" class="form-control form-control-user" id="inputPassword" placeholder="Password">
                    </div>
                      <div class="form-group">
                        <div class="">
                          <input type="checkbox" class="" id="checkbox-remember-me">
                          <label class="" style="color:white" for="customCheck">Remember Me</label>
                        </div>
                      </div>  
                      <a href="javascript:void(0)" id="link-login" class="btn btn-primary btn-user btn-block btn-custom">
                        Login
                      </a> 
                  </form>

        </div> <!-- cord-body class -->
        <div class="card-footer">
          <div class="text-center">
            <a class="text-light" onclick="displayForgotPasswordForm();" style="cursor: pointer;">Forgot password?</a>
          </div>
        </div> <!-- cord-footer class -->
      </div> <!-- card class -->

      <div id="forgot-password-form" class="card m-auto p-2" style="display: none;">
        <div class="card-body">
          <div name="login-form" class="login-form">
            <div class="logo">
              <img src="images/prof.jpg" class="profile"/>
              <h1 class="logo-caption"><span class="tweak">F</span>orget <span class="tweak">P</span>assword</h1>
            </div> <!-- logo class -->

            <div id="email-number-fields">
              <p class="h6 text-center text-light">Enter email and contact number below to reset username and password<p>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope text-white"></i></span>
                </div>
                <input id="email" type="email" class="form-control" placeholder="enter email" required>
              </div> <!--input-group class -->

              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                </div>
                <input id="contact_number" type="number" class="form-control" placeholder="enter contact number" onkeyup="validate();" required>
              </div> <!-- input-group class -->

              <div class="form-group">
                <button class="btn btn-default btn-block btn-custom" onclick="verifyEmailNumber();">Verify</button>
              </div>
            </div>


            <div id="username-password-fields" style="display: none;">
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
                </div>
                <input id="username" type="text" class="form-control" placeholder="enter username" onblur="notNull(this.value, 'username_error');" >
              </div> <!--input-group class -->
              <code class="text-light small font-weight-bold float-right mb-2" id="username_error" style="display: none;"></code>

              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock text-white"></i></span>
                </div>
                <input id="password" type="text" class="form-control" placeholder="enter password" onkeyup="validatePassword();" >
              </div> <!-- input-group class -->
              <code class="text-light small font-weight-bold float-right mb-2" id="password_error" style="display: none;"></code>

              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                </div>
                <input id="confirm_password" type="password" class="form-control" placeholder="confirm password" onkeyup="validatePassword();" >
              </div> <!-- input-group class -->
              <code class="text-light small font-weight-bold float-right mb-2" id="confirm_password_error" style="display: none;"></code>
              <div class="form-group">
                <button class="btn btn-default btn-block btn-custom" onclick="updateUsernamePassword();">Reset Password</button>
              </div>
            </div>
          </div><!-- form close -->

        </div> <!-- cord-body class -->
        <div class="card-footer">
          <div class="text-center">
            <a class="text-light" onclick="displayLoginForm();" style="cursor: pointer;">Login here</a>
          </div>
        </div> <!-- cord-footer class -->
      </div> <!-- card class -->

    </div> <!-- container class -->
  
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="js/util.js"></script>
  <!--Sweetalert for popup notifications -->
  <script src="js/sweetalert.min.js"></script>

<!-- Custom scripts for login-->
<script src="js/authentication/login.js"></script>
  </body>
</html>
