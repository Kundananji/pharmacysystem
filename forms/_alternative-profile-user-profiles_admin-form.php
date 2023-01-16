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
//make available variables of users available in scope for use:
if(isset($_GET['id']) && $_GET['id']!=''){
  include_once("../classes/users.php");
  include_once("../daos/users-dao.php");

  $usersDao = new UsersDao(); 
  $users =  $usersDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}


 if($_SESSION['user_profile'] == 'Admin'){
  $uneditableFields=array();
}
?> 
<?php
//include scripts
include_once("../classes/_alternative-profile.php");
include_once("../daos/_alternative-profile-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$alternativeProfileEdit = new AlternativeProfile();
$alternativeProfileEditDao = new AlternativeProfileDao();
if(isset($id)){
  $tempObject = $alternativeProfileEditDao->select($id);
  if($tempObject !=null){
    $alternativeProfileEdit = $tempObject;
  }
}
?>
<form onsubmit = "AlternativeProfile.submitFormAlternativeProfileUserprofiles_admin(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-_alternative-profile">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

<?php
  $readonly = in_array('id',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($alternativeProfileEdit->getId()!=null){ $defaultValues['id']=$alternativeProfileEdit->getId();};
?>
  <input type="hidden" name="id" id="input-_alternative-profile-id" value="<?php echo (isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>
<?php
  $readonly = in_array('userId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($alternativeProfileEdit->getId()!=null){ $defaultValues['userId']=$alternativeProfileEdit->getUserId();};
?>

 <!--start of form group-->
<div class="form-group input-_alternative-profile-user-id">
  <label for="input-_alternative-profile-user-id">User*</label>
  <?php 
    include_once("../classes/users.php");
    include_once("../daos/users-dao.php");

    $usersDao = new UsersDao(); 
    $objects = $usersDao->selectAll(); 
    ?>
    <select name="userId" id="input-_alternative-profile-user-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select User*--</option>
      <?php
        foreach($objects as $users){
          $optionValue  = $users->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['userId']) && $defaultValues['userId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['userId']) && $defaultValues['userId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['userId']) && $defaultValues['userId']==$optionValue || $alternativeProfileEdit->getUserId()==$users->getId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$users->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<?php
  $readonly = in_array('profileId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($alternativeProfileEdit->getId()!=null){ $defaultValues['profileId']=$alternativeProfileEdit->getProfileId();};
?>

 <!--start of form group-->
<div class="form-group input-_alternative-profile-profile-id">
  <label for="input-_alternative-profile-profile-id">Profile*</label>
  <?php 
    include_once("../classes/_profile.php");
    include_once("../daos/_profile-dao.php");

    $profileDao = new ProfileDao(); 
    $objects = $profileDao->selectAll(); 
    ?>
    <select name="profileId" id="input-_alternative-profile-profile-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Profile*--</option>
      <?php
        foreach($objects as $profile){
          $optionValue  = $profile->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['profileId']) && $defaultValues['profileId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['profileId']) && $defaultValues['profileId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['profileId']) && $defaultValues['profileId']==$optionValue || $alternativeProfileEdit->getProfileId()==$profile->getId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$profile->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
