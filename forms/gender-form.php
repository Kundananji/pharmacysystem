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
include_once("../classes/gender.php");
include_once("../daos/gender-dao.php");
$arguments=array();$genderId = isset($_GET['genderId'])?filter_var($_GET['genderId'], FILTER_VALIDATE_INT):null;
$genderEdit = new Gender();
$genderEditDao = new GenderDao();
if(isset($genderId)){
  $tempObject = $genderEditDao->select($genderId);
  if($tempObject !=null){
    $genderEdit = $tempObject;
  }
}
?>
<form onsubmit = "Gender.submitFormGender(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-gender">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="genderId" id="input-gender-gender-id" value="<?php echo null!==($genderEdit->getGenderId())?($genderEdit->getGenderId()):(isset($defaultValues['genderId'])?($defaultValues['genderId']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-gender-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($genderEdit->getGenderId()!=null){ $defaultValues['name']=$genderEdit->getName();};
                  ?>
                  <label for="input-gender-name">Name*</label>
  <input type="text" name="name" id="input-gender-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($genderEdit->getName())?($genderEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
