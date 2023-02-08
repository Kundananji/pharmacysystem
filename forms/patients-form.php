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
include_once("../classes/patients.php");
include_once("../daos/patients-dao.php");
$arguments=array();$patientId = isset($_GET['patientId'])?filter_var($_GET['patientId'], FILTER_VALIDATE_INT):null;
$patientsEdit = new Patients();
$patientsEditDao = new PatientsDao();
if(isset($patientId)){
  $tempObject = $patientsEditDao->select($patientId);
  if($tempObject !=null){
    $patientsEdit = $tempObject;
  }
}
?>
<form onsubmit = "Patients.submitFormPatients(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-patients">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="patientId" id="input-patients-patient-id" value="<?php echo null!==($patientsEdit->getPatientId())?($patientsEdit->getPatientId()):(isset($defaultValues['patientId'])?($defaultValues['patientId']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-patients-file-id">

                 <?php
                  $readonly = in_array('fileId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['fileId']=$patientsEdit->getFileId();};
                  ?>
                  <label for="input-patients-file-id">File*</label>
  <input type="text" name="fileId" id="input-patients-file-id" class="form-control " placeholder="Enter File " value="<?php echo null!==($patientsEdit->getFileId())?($patientsEdit->getFileId()):(isset($defaultValues['fileId'])?($defaultValues['fileId']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-first-name">

                 <?php
                  $readonly = in_array('firstName',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['firstName']=$patientsEdit->getFirstName();};
                  ?>
                  <label for="input-patients-first-name">First&nbsp;Name*</label>
  <input type="text" name="firstName" id="input-patients-first-name" class="form-control " placeholder="Enter First&nbsp;Name " value="<?php echo null!==($patientsEdit->getFirstName())?($patientsEdit->getFirstName()):(isset($defaultValues['firstName'])?($defaultValues['firstName']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-other-names">

                 <?php
                  $readonly = in_array('otherNames',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['otherNames']=$patientsEdit->getOtherNames();};
                  ?>
                  <label for="input-patients-other-names">Other&nbsp;Names</label>
  <input type="text" name="otherNames" id="input-patients-other-names" class="form-control " placeholder="Enter Other&nbsp;Names " value="<?php echo null!==($patientsEdit->getOtherNames())?($patientsEdit->getOtherNames()):(isset($defaultValues['otherNames'])?($defaultValues['otherNames']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-last-name">

                 <?php
                  $readonly = in_array('lastName',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['lastName']=$patientsEdit->getLastName();};
                  ?>
                  <label for="input-patients-last-name">Last&nbsp;Name*</label>
  <input type="text" name="lastName" id="input-patients-last-name" class="form-control " placeholder="Enter Last&nbsp;Name " value="<?php echo null!==($patientsEdit->getLastName())?($patientsEdit->getLastName()):(isset($defaultValues['lastName'])?($defaultValues['lastName']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-address">

                 <?php
                  $readonly = in_array('address',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['address']=$patientsEdit->getAddress();};
                  ?>
                  <label for="input-patients-address">Address</label>
  <textarea rows="5" name="address" id="input-patients-address" class="form-control " placeholder="Enter Address " <?php echo $readonly;?>   ><?php echo null!==($patientsEdit->getAddress())?($patientsEdit->getAddress()):(isset($defaultValues['address'])?($defaultValues['address']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-contact-number">

                 <?php
                  $readonly = in_array('contactNumber',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['contactNumber']=$patientsEdit->getContactNumber();};
                  ?>
                  <label for="input-patients-contact-number">Contact&nbsp;Number</label>
  <input type="text" name="contactNumber" id="input-patients-contact-number" class="form-control " placeholder="Enter Contact&nbsp;Number " value="<?php echo null!==($patientsEdit->getContactNumber())?($patientsEdit->getContactNumber()):(isset($defaultValues['contactNumber'])?($defaultValues['contactNumber']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-date-of-birth">

                 <?php
                  $readonly = in_array('dateOfBirth',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['dateOfBirth']=$patientsEdit->getDateOfBirth();};
                  ?>
                  <label for="input-patients-date-of-birth">Date&nbsp;Of&nbsp;Birth*</label>
  <input type="text" name="dateOfBirth" id="input-patients-date-of-birth" class="form-control datepicker " placeholder="Enter Date&nbsp;Of&nbsp;Birth " value="<?php echo null!==($patientsEdit->getDateOfBirth())?(date("d/m/Y",strtotime($patientsEdit->getDateOfBirth()))):(isset($defaultValues['dateOfBirth'])?($defaultValues['dateOfBirth']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-nationality">

                 <?php
                  $readonly = in_array('nationality',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['nationality']=$patientsEdit->getNationality();};
                  ?>
                  <label for="input-patients-nationality">Nationality*</label>
  <input type="text" name="nationality" id="input-patients-nationality" class="form-control " placeholder="Enter Nationality " value="<?php echo null!==($patientsEdit->getNationality())?($patientsEdit->getNationality()):(isset($defaultValues['nationality'])?($defaultValues['nationality']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patients-status">

                 <?php
                  $readonly = in_array('status',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientsEdit->getPatientId()!=null){ $defaultValues['status']=$patientsEdit->getStatus();};
                  ?>
                  <label for="input-patients-status">Status*</label>
  <?php 
    include_once("../classes/status.php");
    include_once("../daos/status-dao.php");

    $statusDao = new StatusDao(); 
    $objects = $statusDao->selectAll(); 
    ?>
    <select name="status" id="input-patients-status" class=" form-control" required <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Status--</option>
      <?php
        foreach($objects as $status){
          $optionValue  = $status->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['status']) && $defaultValues['status']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['status']) && $defaultValues['status']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['status']) && $defaultValues['status']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$status->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
