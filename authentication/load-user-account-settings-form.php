<?php
session_start();
include("../config/database.php");
include_once("../classes/users.php");
include_once("../daos/users-dao.php");

//get user id from session
$userId = $_SESSION["user_id"];
$usersDao = new UsersDao();
$users = $usersDao->select($userId);
?>
<form method="post" enctype="multipart/form-data" action="#" id="form-save-account-details">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>


 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getId()
?>
  <input type="hidden" name="id" id="input-users-id" value="<?php echo $value;?>"/>

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getUsername()
?>
  <label for="input-users-username">Username*</label>
  <input type="text" name="username" id="input-users-username" class="form-control" placeholder="Enter Username "  value="<?php echo $value; ?>" <?php echo $readonly;?>/>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getFirstName()
?>
  <label for="input-users-first-name">First&nbsp;Name*</label>
  <input type="text" name="firstName" id="input-users-first-name" class="form-control" placeholder="Enter First&nbsp;Name "  value="<?php echo $value; ?>" <?php echo $readonly;?>/>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getLastName()
?>
  <label for="input-users-last-name">Last&nbsp;Name*</label>
  <input type="text" name="lastName" id="input-users-last-name" class="form-control" placeholder="Enter Last&nbsp;Name "  value="<?php echo $value; ?>" <?php echo $readonly;?>/>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = ''
?>
  <h4 style="text-align:center">To Change your Password, Fill in this section</h4><hr/>
  <label for="input-users-password">Enter Current Password *</label>
  <input type="password" name="password" id="input-users-password" class="form-control" placeholder="Enter Password "  value="<?php echo $value; ?>" <?php echo $readonly;?>/>
</div> <!--end form-group-->
 <!--start of form group-->
<div class="form-group">
  <label for="input-new-password">Enter New Password*</label>
  <input type="password" name="newPassword" id="input-new-password" class="form-control" placeholder="Enter new Password"/>
</div> <!--end form-group-->
 <!--start of form group-->
<div class="form-group">
  <label for="input-confirm-password">Confirm Password*</label>
  <input type="password" name="confirmPassword" id="input-confirm-password" class="form-control" placeholder="Confirm Password"/>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getAddress()
?>
  <label for="input-users-address">Address</label>
  <textarea name="address" id="input-users-address" class="form-control" placeholder="Enter Address" <?php echo $readonly;?>><?php echo $value;?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getEmail()
?>
  <label for="input-users-email">Email</label>
  <input type="text" name="email" id="input-users-email" class="form-control" placeholder="Enter Email "  value="<?php echo $value; ?>" <?php echo $readonly;?>/>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getContactNumber()
?>
  <label for="input-users-contact-number">Contact&nbsp;Number</label>
  <input type="text" name="contactNumber" id="input-users-contact-number" class="form-control" placeholder="Enter Contact&nbsp;Number "  value="<?php echo $value; ?>" <?php echo $readonly;?>/>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getIsLoggedIn()
?>
  <input type="hidden" name="isLoggedIn" id="input-users-is-logged-in" value="<?php echo $value;?>"/>

 <!--start of form group-->
<div class="form-group">

   <?php
    $readonly = false;
    ?>
  <?php
$value = $users->getStatus()
?>
  <input type="hidden" name="status" id="input-users-status" value="<?php echo $value;?>"/>
<input type="submit" name="submit" value="Save Account Details" class="btn btn-primary"/>
</form> <!--  end of form -->
