<?php 
session_start(); //start session since security is involved
$session_userId = isset($_SESSION['user_id'])?$_SESSION['user_id']:null; //read userId from session
$session_profile = isset($_SESSION['user_profile'])?$_SESSION['user_profile']:null; //read userId from session

//declare env variables for use
$env_dateNow = date("d/m/Y");
$env_timeNow = date("H:i:s");
$env_YearNow = date("Y");
$env_MonthNow = date("m");
$env_MonthFullNow = date("F");
$env_dayNow = date("d");

//variables for holding fields that should not be edited, as well as default values for fields
$uneditableFields = array();
$defaultValues = array();
//Get database connection
include("../config/database.php");
?>
<?php
$arguments = array(); //store arguments for later use
foreach($_GET as $key=>$value){
  $arguments[]="$key:'".$value."'";
  //put arguments in scope
  $$key = $value;
}

//make available variables of _profile available in scope for use:
if(isset($_GET['id']) && $_GET['id']!=''){
  include_once("../classes/_profile.php");
  include_once("../daos/_profile-dao.php");

  $profileDao = new ProfileDao(); 
  $profile =  $profileDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of status available in scope for use:
if(isset($_GET['id']) && $_GET['id']!=''){
  include_once("../classes/status.php");
  include_once("../daos/status-dao.php");

  $statusDao = new StatusDao(); 
  $status =  $statusDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of yesno available in scope for use:
if(isset($_GET['id']) && $_GET['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}


 if($_SESSION['user_profile'] == 'Admin'){
  $uneditableFields=array();
  $defaultValues['isLoggedIn']="0";
}
?> 
<?php
//include scripts
include_once("../classes/users.php");
include_once("../daos/users-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$usersEdit = new Users();
$usersEditDao = new UsersDao();
if(isset($id)){
  $tempObject = $usersEditDao->select($id);
  if($tempObject !=null){
    $usersEdit = $tempObject;
  }
}
?>
<form onsubmit = "Users.submitFormUsersUsers_admin(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-users">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

<?php
  $readonly = in_array('id',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['id']=$usersEdit->getId();};
?>
  <input type="hidden" name="id" id="input-users-id" value="<?php echo (isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>
<?php
  $readonly = in_array('username',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['username']=$usersEdit->getUsername();};
?>

 <!--start of form group-->
<div class="form-group input-users-username">
  <label for="input-users-username">Username*</label>
  <input type="text" name="username" id="input-users-username" class="form-control " placeholder="Enter Username* " value="<?php echo (isset($defaultValues['username'])?($defaultValues['username']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('firstName',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['firstName']=$usersEdit->getFirstName();};
?>

 <!--start of form group-->
<div class="form-group input-users-first-name">
  <label for="input-users-first-name">First&nbsp;Name*</label>
  <input type="text" name="firstName" id="input-users-first-name" class="form-control " placeholder="Enter First&nbsp;Name* " value="<?php echo (isset($defaultValues['firstName'])?($defaultValues['firstName']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('lastName',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['lastName']=$usersEdit->getLastName();};
?>

 <!--start of form group-->
<div class="form-group input-users-last-name">
  <label for="input-users-last-name">Last&nbsp;Name*</label>
  <input type="text" name="lastName" id="input-users-last-name" class="form-control " placeholder="Enter Last&nbsp;Name* " value="<?php echo (isset($defaultValues['lastName'])?($defaultValues['lastName']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('password',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['password']=$usersEdit->getPassword();};
?>

 <!--start of form group-->
<div class="form-group d-none input-users-password">
  <label for="input-users-password">Password</label>
  <input type="text" name="password" id="input-users-password" class="form-control " placeholder="Enter Password " value="<?php echo (isset($defaultValues['password'])?($defaultValues['password']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('address',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['address']=$usersEdit->getAddress();};
?>

 <!--start of form group-->
<div class="form-group input-users-address">
  <label for="input-users-address">Address</label>
  <textarea rows="5" name="address" id="input-users-address" class="form-control " placeholder="Enter Address " <?php echo $readonly;?>   ><?php echo (isset($defaultValues['address'])?($defaultValues['address']): "");?></textarea>
</div> <!--end form-group-->
<?php
  $readonly = in_array('email',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['email']=$usersEdit->getEmail();};
?>

 <!--start of form group-->
<div class="form-group input-users-email">
  <label for="input-users-email">Email</label>
  <input type="text" name="email" id="input-users-email" class="form-control " placeholder="Enter Email " value="<?php echo (isset($defaultValues['email'])?($defaultValues['email']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('contactNumber',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['contactNumber']=$usersEdit->getContactNumber();};
?>

 <!--start of form group-->
<div class="form-group input-users-contact-number">
  <label for="input-users-contact-number">Contact&nbsp;Number</label>
  <input type="text" name="contactNumber" id="input-users-contact-number" class="form-control " placeholder="Enter Contact&nbsp;Number " value="<?php echo (isset($defaultValues['contactNumber'])?($defaultValues['contactNumber']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('isLoggedIn',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['isLoggedIn']=$usersEdit->getIsLoggedIn();};
?>

 <!--start of form group-->
<div class="form-group d-none input-users-is-logged-in">
  <label for="input-users-is-logged-in">Is&nbsp;Logged&nbsp;In</label>
  <?php 
    include_once("../classes/yesno.php");
    include_once("../daos/yesno-dao.php");

    $yesnoDao = new YesnoDao(); 
    $objects = $yesnoDao->selectAll(); 
    ?>
    <select name="isLoggedIn" id="input-users-is-logged-in" class="form-control "  <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Is&nbsp;Logged&nbsp;In--</option>
      <?php
        foreach($objects as $yesno){
          $optionValue  = $yesno->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['isLoggedIn']) && $defaultValues['isLoggedIn']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['isLoggedIn']) && $defaultValues['isLoggedIn']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['isLoggedIn']) && $defaultValues['isLoggedIn']==$optionValue || $usersEdit->getIsLoggedIn()==$yesno->getId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$yesno->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<?php
  $readonly = in_array('status',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['status']=$usersEdit->getStatus();};
?>

 <!--start of form group-->
<div class="form-group input-users-status">
  <label for="input-users-status">Status*</label>
  <?php 
    include_once("../classes/status.php");
    include_once("../daos/status-dao.php");

    $statusDao = new StatusDao(); 
    $objects = $statusDao->selectAll(); 
    ?>
    <select name="status" id="input-users-status" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Status*--</option>
      <?php
        foreach($objects as $status){
          $optionValue  = $status->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['status']) && $defaultValues['status']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['status']) && $defaultValues['status']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['status']) && $defaultValues['status']==$optionValue || $usersEdit->getStatus()==$status->getId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$status->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<?php
  $readonly = in_array('profile',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($usersEdit->getId()!=null){ $defaultValues['profile']=$usersEdit->getProfile();};
?>

 <!--start of form group-->
<div class="form-group input-users-profile">
  <label for="input-users-profile">Profile</label>
  <?php 
    include_once("../classes/_profile.php");
    include_once("../daos/_profile-dao.php");

    $profileDao = new ProfileDao(); 
    $objects = $profileDao->selectAll(); 
    ?>
    <select name="profile" id="input-users-profile" class="form-control "  <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Profile--</option>
      <?php
        foreach($objects as $profile){
          $optionValue  = $profile->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['profile']) && $defaultValues['profile']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['profile']) && $defaultValues['profile']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['profile']) && $defaultValues['profile']==$optionValue || $usersEdit->getProfile()==$profile->getId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$profile->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
