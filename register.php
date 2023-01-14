
 <?php
  include("config/database.php"); 
 
 //create some default global variables
 $dateNow = date("d/m/Y");
 $timeNow = date("H:i:s");


  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Create a user account to access HMS">
  <meta name="author" content="">
  <title>Sign up to HMS</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2-hms.css" rel="stylesheet">

  <!-- Styles for Sweet alert Pluggin-->
  <link href="css/sweetalert.css" rel="stylesheet">
  <style type="text/css">
  .bg-login-image {
    background: url("img/hms-create-account.jpg");
    background-position: center;
    background-size: cover;
  }
  </style>

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
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register For An Account</h1>
                  </div><form method="post" enctype="multipart/form-data" action="#" id="form-registration">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

<?php $defaultValue=null;?>  <input type="hidden" name="id" id="input-users-id"/>
<?php $defaultValue=null;?>
 <!--start of form group-->
<div class="form-group">

                  <?php
                    $readonly = false;
                  ?>
                    <label for="input-users-username">Username*</label>
  <input type="text" name="username" id="input-users-username" class="form-control" placeholder="Enter Username " <?php echo $readonly;?> value="<?php echo $defaultValue;?>"/>
</div> <!--end form-group-->
<?php $defaultValue=null;?>
 <!--start of form group-->
<div class="form-group">

                  <?php
                    $readonly = false;
                  ?>
                    <label for="input-users-first-name">First&nbsp;Name*</label>
  <input type="text" name="firstName" id="input-users-first-name" class="form-control" placeholder="Enter First&nbsp;Name " <?php echo $readonly;?> value="<?php echo $defaultValue;?>"/>
</div> <!--end form-group-->
<?php $defaultValue=null;?>
 <!--start of form group-->
<div class="form-group">

                  <?php
                    $readonly = false;
                  ?>
                    <label for="input-users-last-name">Last&nbsp;Name*</label>
  <input type="text" name="lastName" id="input-users-last-name" class="form-control" placeholder="Enter Last&nbsp;Name " <?php echo $readonly;?> value="<?php echo $defaultValue;?>"/>
</div> <!--end form-group-->
<?php $defaultValue=null;?>
 <!--start of form group-->
<div class="form-group">

                  <?php
                    $readonly = false;
                  ?>
                    <label for="input-users-password">Password</label>
  <input type="password" name="password" id="input-users-password" class="form-control" placeholder="Enter Password " <?php echo $readonly;?> value="<?php echo $defaultValue;?>"/>
</div> <!--end form-group-->
 <!--start of form group-->
<div class="form-group">
  <label for="input-confirm-password">Confirm Password*</label>
  <input type="password" name="confirmPassword" id="input-confirm-password" class="form-control" placeholder="Confirm Password"/>
</div> <!--end form-group-->
<?php $defaultValue=null;?>
 <!--start of form group-->
<div class="form-group">

                  <?php
                    $readonly = false;
                  ?>
                    <label for="input-users-address">Address</label>
  <textarea name="address" id="input-users-address" class="form-control" placeholder="Enter Address " <?php echo $readonly;?>><?php echo $defaultValue;?></textarea>
</div> <!--end form-group-->
<?php $defaultValue=null;?>
 <!--start of form group-->
<div class="form-group">

                  <?php
                    $readonly = false;
                  ?>
                    <label for="input-users-email">Email</label>
  <input type="text" name="email" id="input-users-email" class="form-control" placeholder="Enter Email " <?php echo $readonly;?> value="<?php echo $defaultValue;?>"/>
</div> <!--end form-group-->
<?php $defaultValue=null;?>
 <!--start of form group-->
<div class="form-group">

                  <?php
                    $readonly = false;
                  ?>
                    <label for="input-users-contact-number">Contact&nbsp;Number</label>
  <input type="text" name="contactNumber" id="input-users-contact-number" class="form-control" placeholder="Enter Contact&nbsp;Number " <?php echo $readonly;?> value="<?php echo $defaultValue;?>"/>
</div> <!--end form-group-->
<?php $defaultValue=null;?><?php $defaultValue=0;?>  <input type="hidden" name="isLoggedIn" id="input-users-is-logged-in" value="<?php echo $defaultValue; ?>"/>
<?php $defaultValue=null;?><?php $defaultValue=1;?>  <input type="hidden" name="status" id="input-users-status" value="<?php echo $defaultValue; ?>"/>
<?php $defaultValue=null;?><input type="submit" name="submit" value="Create Account" class="btn btn-primary"/>
</form> <!--  end of form -->
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login" >Already have an account? Login</a>
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

  <!-- Custom scripts for registration-->
  <script src="js/authentication/login.js"></script>

</body>
</html>

 
 