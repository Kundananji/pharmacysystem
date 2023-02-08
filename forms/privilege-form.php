<?php
session_start(); //start session since security is involved
$session_userId = isset($_SESSION['user_id'])?$_SESSION['user_id']:null; //read userId from session
$session_profile = isset($_SESSION['user_profile'])?$_SESSION['user_profile']:null; //read userId from session

//declare env variables for use
$env_dateNowHuman = date("d/m/Y");
$env_dateNow = date("Y-m-d");
$env_timeNow = date("H:i:s");
$env_YearNow = date("Y");
$env_MonthNow = date("m");
$env_MonthFullNow = date("F");
$env_dayNow = date("d");

//variables for holding fields that should not be edited, as well as default values for fields
$uneditableFields = array();
$defaultValues = array();
?>
<?php
//include scripts
include("../config/database.php");
include_once("../classes/privilege.php");
include_once("../daos/privilege-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$privilegeEdit = new Privilege();
$privilegeEditDao = new PrivilegeDao();
if(isset($id)){
  $tempObject = $privilegeEditDao->select($id);
  if($tempObject !=null){
    $privilegeEdit = $tempObject;
  }
}
?>
<form onsubmit = "Privilege.submitFormPrivilege(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-privilege">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-privilege-id" value="<?php echo null!==($privilegeEdit->getId())?($privilegeEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-privilege-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($privilegeEdit->getId()!=null){ $defaultValues['name']=$privilegeEdit->getName();};
                  ?>
                  <label for="input-privilege-name">Name*</label>
  <input type="text" name="name" id="input-privilege-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($privilegeEdit->getName())?($privilegeEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-privilege-profile-id">

                 <?php
                  $readonly = in_array('profileId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($privilegeEdit->getId()!=null){ $defaultValues['profileId']=$privilegeEdit->getProfileId();};
                  ?>
                  <label for="input-privilege-profile-id">Profile*</label>
  <?php 
    include_once("../classes/_profile.php");
    include_once("../daos/_profile-dao.php");

    $profileDao = new ProfileDao(); 
    $objects = $profileDao->selectAll(); 
    ?>
    <select name="profileId" id="input-privilege-profile-id" class=" form-control" required <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select &nbsp;profile--</option>
      <?php
        foreach($objects as $profile){
          $optionValue  = $profile->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['profileId']) && $defaultValues['profileId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['profileId']) && $defaultValues['profileId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['profileId']) && $defaultValues['profileId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$profile->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
