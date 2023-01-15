<?php
 session_start(); 
 if(!isset($_SESSION['user_id'])){
  header("location: login");
}
include("config/database.php");
include("config/authentication.php");
$authentication = new Authentication();
$userLoggedIn = $authentication->isUserLoggedIn();
if(!$userLoggedIn){
  header("location: login");
}
//otherwise, get user credentials
$user = $authentication->getUserById($_SESSION['user_id']);
//if still, user not found, logout, as this is an error:
if(!$user){
  header("location: login");
}

$userId = null;
$user_name = '';
$names = array();
$userId = null;
if(isset($_SESSION['user_id'])){
  $userId = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
  $user_name = '';
  $names = array();


  $names[] = $user['firstName'];
  $names[] = $user['lastName'];
  $user_name = implode(" ",$names);
  $currentYear = date("Y");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard - Home</title>
    <?php
    if(!$userLoggedIn){
      echo'<meta http-equiv="refresh" content="0;url=login" />';
    }
   ?>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Styles for Sweet alert Pluggin-->
    <link href="css/sweetalert.css" rel="stylesheet">
 
    <!-- Datatables styles-->
    <link href="vendor/datatables/datatables.min.css" rel="stylesheet">

    <!-- Select 2 styles-->
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Bootstrap date picker styles-->
    <link href="vendor/bootstrap-datepicker-1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
      
<link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <?php include "sections/sidenav.html"; ?>
    <div class="container-fluid">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('home', 'Dashboard', 'Home');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <div class="row col col-xs-8 col-sm-8 col-md-8 col-lg-8">

            <?php
              function createSection1($location, $title, $table) {
                require 'php/db_connection.php';

                $query = "SELECT * FROM $table";
                if($title == "Out of Stock")
                  $query = "SELECT * FROM $table WHERE quantity = 0";

                $result = mysqli_query($con, $query);
                $count = mysqli_num_rows($result);


                if($title == "Expired") {
                  // logic
                  $count = 0;
                  while($row = mysqli_fetch_array($result)) {
                    $expiry_date = $row['expiry_date'];
                    if(substr($expiry_date, 3) < date('y'))
                      $count++;
                    else if(substr($expiry_date, 3) == date('y')) {
                      if(substr($expiry_date, 0, 2) < date('m'))
                        $count++;
                    }
                  }
                }

                echo '
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                    <div class="dashboard-stats" onclick="location.href=\''.$location.'\'">
                      <a class="text-dark text-decoration-none" href="'.$location.'">
                        <span class="h4">'.$count.'</span>
                        <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                        <div class="small font-weight-bold">'.$title.'</div>
                      </a>
                    </div>
                  </div>
                ';
              }
              createSection1('manage_customer.php', 'Total Customer', 'customers');
              createSection1('manage_supplier.php', 'Total Supplier', 'suppliers');
              createSection1('manage_medicine.php', 'Total Medicine', 'medicines');
              createSection1('manage_medicine_stock.php?out_of_stock', 'Out of Stock', 'medicines_stock');
              createSection1('manage_medicine_stock.php?expired', 'Expired', 'medicines_stock');
              createSection1('manage_invoice.php', 'Total Invoice', 'invoices');
            ?>

          </div>

          <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 7px 0; margin-left: 15px;">
            <div class="todays-report">
              <div class="h5">Todays Report</div>
              <table class="table table-bordered table-striped table-hover">
                <tbody>
                  <?php
                    require 'php/db_connection.php';
                    if($con) {
                      $date = date('Y-m-d');
                  ?>
                  <tr>
                    <?php
                      $total = 0;
                      $query = "SELECT net_total FROM invoices WHERE invoice_date = '$date'";
                      $result = mysqli_query($con, $query);

                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['net_total'];
                    ?>
                    <th>Total Sales</th>
                    <th class="text-success">Rs. <?php echo $total; ?></th>
                  </tr>
                  <tr>
                    <?php
                      //echo $date;
                      $total = 0;
                      $query = "SELECT total_amount FROM purchases WHERE purchase_date = '$date'";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['total_amount'];
                    }
                    ?>
                    <th>Total Purchase</th>
                    <th class="text-danger">Rs. <?php echo $total; ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <hr style="border-top: 2px solid #ff5252;">

        <div class="row">

          <?php
            function createSection2($icon, $location, $title) {
              echo '
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 10px;">
              		<div class="dashboard-stats" style="padding: 30px 15px;" onclick="location.href=\''.$location.'\'">
              			<div class="text-center">
                      <span class="h1"><i class="fa fa-'.$icon.' p-2"></i></span>
              				<div class="h5">'.$title.'</div>
              			</div>
              		</div>
                </div>
              ';
            }
            createSection2('address-card', 'new_invoice.php', 'Create New Invoice');
            createSection2('handshake', 'add_customer.php', 'Add New Customer');
            createSection2('shopping-bag', 'add_medicine.php', 'Add New Medicine');
            createSection2('group', 'add_supplier.php', 'Add New Supplier');
            createSection2('group', 'add_user.php', 'Add New User');
            createSection2('bar-chart', 'add_purchase.php', 'Add New Purchase');
            createSection2('book', 'sales_report.php', 'Sales Report');
            createSection2('book', 'purchase_report.php', 'Purchase Report');
          ?>

        </div>
        <!-- form content end -->

        <hr style="border-top: 2px solid #ff5252;">

      </div>
    </div>

     <!--General Modal-->
     <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="generalModalLabel"
         aria-hidden="true">
         <div class="modal-dialog"  style="max-width: 800px" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="generalModalLabel"></h5>
                     <button class="close" type="button" data-dismiss="modal" onClick="closeModal('generalModal')" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <div class="modal-body table-responsive" id="generalModalBody">
                     
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" onClick="closeModal('generalModal')" data-dismiss="modal">Cancel</button>                  
                 </div>
             </div>
         </div>
     </div>

      
     <!-- Data Input Modal-->
     <div class="modal fade" id="dataInputModal" tabindex="-1" role="dialog" aria-labelledby="dataInputModalLabel"
         aria-hidden="true">
         <div class="modal-dialog"  style="max-width: 800px" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="dataInputModalLabel">Input Form</h5>
                     <button class="close" type="button" data-dismiss="modal" onClick="closeModal('dataInputModal')" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <div class="modal-body table-responsive" id="dataInputModalBody">
                     
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" onClick="closeModal('dataInputModal')" data-dismiss="modal">Cancel</button>                  
                 </div>
             </div>
         </div>
     </div>
 
           
     <!-- Data Input Modal Wide-->
     <div class="modal fade" id="dataInputModalWide" tabindex="-1" role="dialog" aria-labelledby="dataInputModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-fullscreen" role="document">
             <div class="modal-content modal-content-fullscreen">
                 <div class="modal-header">
                     <h5 class="modal-title" id="dataInputModalLabelWide"">Input Form</h5>
                     <button class="close" type="button" data-dismiss="modal" onClick="closeModal('dataInputModalWide"')" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <div class="modal-body table-responsive" id="dataInputModalBodyWide"">
                     
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" onClick="closeModal('dataInputModalWide"')" data-dismiss="modal">Cancel</button>                  
                 </div>
             </div>
         </div>
     </div>
 
 
     <!-- Logout Modal-->
     <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                     <button class="close" type="button" data-dismiss="modal" onClick="closeModal('logoutModal')" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal" onClick="closeModal('logoutModal')">Cancel</button>
                     <a class="btn btn-primary" href="javascript:void(0)"  id="link-logout">Logout</a>
                 </div>
             </div>
         </div>
     </div>



     <!-- Bootstrap core JavaScript-->
     <script src="vendor/jquery/jquery.min.js"></script>
     <script src="bootstrap/js/bootstrap.min.js"></script>

     <!-- Core plugin JavaScript-->
     <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

     <!-- bootstrap date picker -->
     <script src="vendor/bootstrap-datepicker-1.9.0/js/bootstrap-datepicker.min.js"></script>

     <!--Sweetalert for popup notifications -->
     <script src="js/sweetalert.min.js"></script>
  
     <!-- Data tables scripts -->
     <script src="vendor/datatables/datatables.min.js"></script>
 
     <!--Script for select 2 drop down pluggin-->
     <script src="vendor/select2/dist/js/select2.min.js"></script>

     <!-- input mask-->
     <script src="js/inputmask/dist/jquery.inputmask.min.js"></script>

     <!-- Allows data-input attribute -->
     <script src="js/inputmask/dist/bindings/inputmask.binding.js"></script>

     <!-- Jquery form pluggin -->
     <script src="js/jquery.form.js"></script>

     <!--Common utility functions for use across scripts-->
     <script src="js/util.js"></script>

     <!-- authentication script-->
     <script src="js/authentication/login.js"></script> 

     <!-- Video JS  CSS Plugin-->
     <script src="vendor/video-js-7.20.3/video.min.js" referrerpolicy="origin"></script>
     
    <!-- injection of dynamically generated scripts -->
     <?php
       include('custom-scripts.php');
     ?>
  </body>
</html>
