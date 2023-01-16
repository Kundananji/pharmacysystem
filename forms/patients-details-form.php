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
include_once("../classes/patients-details.php");
include_once("../daos/patients-details-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$patientsDetailsEdit = new PatientsDetails();
$patientsDetailsEditDao = new PatientsDetailsDao();
if(isset($id)){
  $tempObject = $patientsDetailsEditDao->select($id);
  if($tempObject !=null){
    $patientsDetailsEdit = $tempObject;
  }
}
?>
<form onsubmit = "PatientsDetails.submitFormPatientsDetails(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-patients-details">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-patients-details-id" value="<?php echo null!==($patientsDetailsEdit->getId())?($patientsDetailsEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-patients-details-file-id">

                 <?php
                  $readonly = in_array('fileId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsDetailsEdit->getId()!=null){ $defaultValues['fileId']=$patientsDetailsEdit->getFileId();};
                  ?>
                  <label for="input-patients-details-file-id">File*</label>
  <input type="text" name="fileId" id="input-patients-details-file-id" class="form-control " placeholder="Enter File " value="<?php echo null!==($patientsDetailsEdit->getFileId())?($patientsDetailsEdit->getFileId()):(isset($defaultValues['fileId'])?($defaultValues['fileId']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-details-first-name">

                 <?php
                  $readonly = in_array('firstName',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsDetailsEdit->getId()!=null){ $defaultValues['firstName']=$patientsDetailsEdit->getFirstName();};
                  ?>
                  <label for="input-patients-details-first-name">First&nbsp;Name*</label>
  <input type="text" name="firstName" id="input-patients-details-first-name" class="form-control " placeholder="Enter First&nbsp;Name " value="<?php echo null!==($patientsDetailsEdit->getFirstName())?($patientsDetailsEdit->getFirstName()):(isset($defaultValues['firstName'])?($defaultValues['firstName']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-details-last-name">

                 <?php
                  $readonly = in_array('lastName',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsDetailsEdit->getId()!=null){ $defaultValues['lastName']=$patientsDetailsEdit->getLastName();};
                  ?>
                  <label for="input-patients-details-last-name">Last&nbsp;Name*</label>
  <input type="text" name="lastName" id="input-patients-details-last-name" class="form-control " placeholder="Enter Last&nbsp;Name " value="<?php echo null!==($patientsDetailsEdit->getLastName())?($patientsDetailsEdit->getLastName()):(isset($defaultValues['lastName'])?($defaultValues['lastName']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-details-address">

                 <?php
                  $readonly = in_array('address',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsDetailsEdit->getId()!=null){ $defaultValues['address']=$patientsDetailsEdit->getAddress();};
                  ?>
                  <label for="input-patients-details-address">Address</label>
  <textarea rows="5" name="address" id="input-patients-details-address" class="form-control " placeholder="Enter Address " <?php echo $readonly;?>   ><?php echo null!==($patientsDetailsEdit->getAddress())?($patientsDetailsEdit->getAddress()):(isset($defaultValues['address'])?($defaultValues['address']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-details-contact-number">

                 <?php
                  $readonly = in_array('contactNumber',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsDetailsEdit->getId()!=null){ $defaultValues['contactNumber']=$patientsDetailsEdit->getContactNumber();};
                  ?>
                  <label for="input-patients-details-contact-number">Contact&nbsp;Number</label>
  <input type="text" name="contactNumber" id="input-patients-details-contact-number" class="form-control " placeholder="Enter Contact&nbsp;Number " value="<?php echo null!==($patientsDetailsEdit->getContactNumber())?($patientsDetailsEdit->getContactNumber()):(isset($defaultValues['contactNumber'])?($defaultValues['contactNumber']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-details-date-of-birth">

                 <?php
                  $readonly = in_array('dateOfBirth',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsDetailsEdit->getId()!=null){ $defaultValues['dateOfBirth']=$patientsDetailsEdit->getDateOfBirth();};
                  ?>
                  <label for="input-patients-details-date-of-birth">Date&nbsp;Of&nbsp;Birth*</label>
  <input type="text" name="dateOfBirth" id="input-patients-details-date-of-birth" class="form-control datepicker " placeholder="Enter Date&nbsp;Of&nbsp;Birth " value="<?php echo null!==($patientsDetailsEdit->getDateOfBirth()))?(date("d/m/Y",strtotime($patientsDetailsEdit->getDateOfBirth()))):(isset($defaultValues['dateOfBirth'])?($defaultValues['dateOfBirth']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-details-nationality">

                 <?php
                  $readonly = in_array('nationality',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsDetailsEdit->getId()!=null){ $defaultValues['nationality']=$patientsDetailsEdit->getNationality();};
                  ?>
                  <label for="input-patients-details-nationality">Nationality*</label>
  <input type="text" name="nationality" id="input-patients-details-nationality" class="form-control " placeholder="Enter Nationality " value="<?php echo null!==($patientsDetailsEdit->getNationality())?($patientsDetailsEdit->getNationality()):(isset($defaultValues['nationality'])?($defaultValues['nationality']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-details-status">

                 <?php
                  $readonly = in_array('status',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsDetailsEdit->getId()!=null){ $defaultValues['status']=$patientsDetailsEdit->getStatus();};
                  ?>
                  <label for="input-patients-details-status">Status*</label>
  <input type="number" name="status" id="input-patients-details-status" class="form-control " placeholder="Enter Status " value="<?php echo null!==($patientsDetailsEdit->getStatus())?($patientsDetailsEdit->getStatus()):(isset($defaultValues['status'])?($defaultValues['status']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
