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
 <html lang="en">
 
 <head>
 
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">
 
     <title>HMS</title>
   <?php
   if(!$userLoggedIn){
     echo'<meta http-equiv="refresh" content="0;url=login" />';
   }
   ?>
     <!-- Custom fonts for this template-->
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link
         href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
         rel="stylesheet">
 
     <!-- Custom styles for this template-->
     <link href="css/sb-admin-2-hms.css" rel="stylesheet">
 
      <!-- Styles for Sweet alert Pluggin-->
     <link href="css/sweetalert.css" rel="stylesheet">
 
      <!-- Datatables styles-->
     <link href="vendor/datatables/datatables.min.css" rel="stylesheet">

      <!-- Select 2 styles-->
     <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />

     <!-- Bootstrap date picker styles-->
     <link href="vendor/bootstrap-datepicker-1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />

     <!-- Tiny Mce Core Plugin-->
     <script src="vendor/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

     <!-- Video JS  CSS Plugin-->
     <link href="vendor/video-js-7.20.3/video-js.css" rel="stylesheet" />
     <!-- custom css -->
     <style type="text/css">
      .modal {
       overflow: scroll!important;
      }


       @media print {
        .pagebreak { 
          clear: both;
          page-break-before: always;
          min-height: 1px;
          break-after:always;
         }
         .print-table {
          width: 100%;
          height: 90vh;
          border: solid;
          table-layout: fixed;
         }
         /* page-break-after works, as well */
       }

      @media (min-width: 576px) {
        .modal-dialog-fullscreen { max-width: none; }
      }


      .modal-dialog-fullscreen {
        width: 98%;
        height: 92%;
        padding: 0;
      }
      
      .modal-content-fullscreen {
        height: 99%;
        overflow:scroll;
      }
     </style>
 
 </head>
 
 <body id="page-top">
 
     <!-- Page Wrapper -->
     <div id="wrapper">
 
         <!-- Sidebar -->
         <?php include('./menus/side-menu.php');?>
         <!-- End of Sidebar -->
 
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
 
             <!-- Main Content -->
             <div id="content">
 
                 <!-- Topbar -->
                 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
 
                     <!-- Sidebar Toggle (Topbar) -->
                     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                         <i class="fa fa-bars"></i>
                     </button>

 

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto"> 
      
 
                         <div class="topbar-divider d-none d-sm-block"></div>
 
                         <!-- Nav Item - User Information -->
                           <?php include('menus/top-menu.php');?>
 
                     </ul>
 
                 </nav>
                 <!-- End of Topbar -->
 
                 <!-- Begin Page Content -->
                 <div class="container-fluid">
 
                     <!-- Page Heading -->
                     
                     <div class="row">
                         <div class="col table-responsive" id="page-content">      <h3 style="text-align:center">Welcome to the Hospital Manangement System</h3>      The Hospital Management System allows you Manage all aspects of your hospital, including but not limited to: 
<ul>
      <li>Staff Management</li>
      <li>Out Patient Department</li>
</ul>


                       </div>
                     </div>
 
                 </div>
                 <!-- /.container-fluid -->
 
             </div>
             <!-- End of Main Content -->
 
             <!-- Footer -->
             <footer class="sticky-footer bg-white">
                 <div class="container my-auto">
                      <div class="copyright text-center my-auto">
                          <span>Copyright &copy; 2023</span>
                      </div>
                 </div>
             </footer>
             <!-- End of Footer -->
 
         </div>
         <!-- End of Content Wrapper -->
 
     </div>
     <!-- End of Page Wrapper -->
 
     <!-- Scroll to Top Button-->
     <a class="scroll-to-top rounded" href="#page-top">
         <i class="fas fa-angle-up"></i>
     </a>
 


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
     <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
     <!-- Core plugin JavaScript-->
     <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

     <!-- bootstrap date picker -->
     <script src="vendor/bootstrap-datepicker-1.9.0/js/bootstrap-datepicker.min.js"></script>

     <!-- Custom scripts for all pages-->
     <script src="js/sb-admin-2.min.js"></script>
 
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

 
 