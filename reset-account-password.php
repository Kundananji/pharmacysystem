
 <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Reset Your Password for HMS</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2-hms.css" rel="stylesheet">
  <!-- customized styles for reset page -->
  <style type="text/css">
  .bg-login-image {
    background: url("img/hms-login.jpg");
    background-position: center;
    background-size: cover;
  }
  </style>

  <!-- Styles for Sweet alert Pluggin-->
  <link href="css/sweetalert.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none  d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Reset your Password Below:</h1>
                  </div>
                  <form class="user" onsubmit="return false">
                  <input type="hidden" id="reset-id" value="<?php echo $_GET['reset_id'];?>">
                      <div class="form-group">
                          <label for="email">Email </label>
                          <input type="email" class="form-control" id="email" placeholder="Username or Email" value="<?php echo $_GET['email_id'];?>" readonly>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" id="password" placeholder="Password">
                      </div>

                      <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password">
                      </div>          
                  
                      <div class="text-center">
                          <button type="submit" class="btn default-btn-one" id="buttonResetPassword">Reset Password</button>
                      </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login">Login to Your Account</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="js/util.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!--Sweetalert for popup notifications -->
  <script src="js/sweetalert.min.js"></script>

  <!-- Custom scripts for login-->
  <script src="js/authentication/login.js"></script>

</body>
</html>

 
 