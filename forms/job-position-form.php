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
include_once("../classes/job-position.php");
include_once("../daos/job-position-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$jobPositionEdit = new JobPosition();
$jobPositionEditDao = new JobPositionDao();
if(isset($id)){
  $tempObject = $jobPositionEditDao->select($id);
  if($tempObject !=null){
    $jobPositionEdit = $tempObject;
  }
}
?>
<form onsubmit = "JobPosition.submitFormJobPosition(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-job-position">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-job-position-id" value="<?php echo null!==($jobPositionEdit->getId())?($jobPositionEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-job-position-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($jobPositionEdit->getId()!=null){ $defaultValues['name']=$jobPositionEdit->getName();};
                  ?>
                  <label for="input-job-position-name">Name*</label>
  <input type="text" name="name" id="input-job-position-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($jobPositionEdit->getName())?($jobPositionEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-job-position-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($jobPositionEdit->getId()!=null){ $defaultValues['description']=$jobPositionEdit->getDescription();};
                  ?>
                  <label for="input-job-position-description">Description</label>
  <textarea rows="5" name="description" id="input-job-position-description" class="form-control " placeholder="Enter Description " <?php echo $readonly;?>   ><?php echo null!==($jobPositionEdit->getDescription())?($jobPositionEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
