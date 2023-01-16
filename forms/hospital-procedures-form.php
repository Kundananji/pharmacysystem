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
?>
<?php
//include scripts
include("../config/database.php");
include_once("../classes/hospital-procedures.php");
include_once("../daos/hospital-procedures-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$hospitalProceduresEdit = new HospitalProcedures();
$hospitalProceduresEditDao = new HospitalProceduresDao();
if(isset($id)){
  $tempObject = $hospitalProceduresEditDao->select($id);
  if($tempObject !=null){
    $hospitalProceduresEdit = $tempObject;
  }
}
?>
<form onsubmit = "HospitalProcedures.submitFormHospitalProcedures(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-hospital-procedures">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-hospital-procedures-id" value="<?php echo null!==($hospitalProceduresEdit->getId())?($hospitalProceduresEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-hospital-procedures-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($hospitalProceduresEdit->getId()!=null){ $defaultValues['name']=$hospitalProceduresEdit->getName();};
                  ?>
                  <label for="input-hospital-procedures-name">Name*</label>
  <input type="text" name="name" id="input-hospital-procedures-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($hospitalProceduresEdit->getName())?($hospitalProceduresEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-hospital-procedures-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($hospitalProceduresEdit->getId()!=null){ $defaultValues['description']=$hospitalProceduresEdit->getDescription();};
                  ?>
                  <label for="input-hospital-procedures-description">Description*</label>
  <input type="text" name="description" id="input-hospital-procedures-description" class="form-control " placeholder="Enter Description " value="<?php echo null!==($hospitalProceduresEdit->getDescription())?($hospitalProceduresEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-hospital-procedures-fee">

                 <?php
                  $readonly = in_array('fee',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($hospitalProceduresEdit->getId()!=null){ $defaultValues['fee']=$hospitalProceduresEdit->getFee();};
                  ?>
                  <label for="input-hospital-procedures-fee">Fee*</label>
  <input type="text" name="fee" id="input-hospital-procedures-fee" class="form-control " placeholder="Enter Fee " value="<?php echo null!==($hospitalProceduresEdit->getFee())?($hospitalProceduresEdit->getFee()):(isset($defaultValues['fee'])?($defaultValues['fee']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
