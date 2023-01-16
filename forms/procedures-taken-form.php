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
include_once("../classes/procedures-taken.php");
include_once("../daos/procedures-taken-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$proceduresTakenEdit = new ProceduresTaken();
$proceduresTakenEditDao = new ProceduresTakenDao();
if(isset($id)){
  $tempObject = $proceduresTakenEditDao->select($id);
  if($tempObject !=null){
    $proceduresTakenEdit = $tempObject;
  }
}
?>
<form onsubmit = "ProceduresTaken.submitFormProceduresTaken(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-procedures-taken">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-procedures-taken-id" value="<?php echo null!==($proceduresTakenEdit->getId())?($proceduresTakenEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-procedures-taken-patient-id">

                 <?php
                  $readonly = in_array('patient_id',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['patient_id']=$proceduresTakenEdit->getPatientId();};
                  ?>
                  <label for="input-procedures-taken-patient-id">Patient&nbsp;*</label>
  <input type="text" name="patientId" id="input-procedures-taken-patient-id" class="form-control " placeholder="Enter Patient&nbsp; " value="<?php echo null!==($proceduresTakenEdit->getPatientId())?($proceduresTakenEdit->getPatientId()):(isset($defaultValues['patient_id'])?($defaultValues['patient_id']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-department">

                 <?php
                  $readonly = in_array('department',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['department']=$proceduresTakenEdit->getDepartment();};
                  ?>
                  <label for="input-procedures-taken-department">Department*</label>
  <input type="text" name="department" id="input-procedures-taken-department" class="form-control " placeholder="Enter Department " value="<?php echo null!==($proceduresTakenEdit->getDepartment())?($proceduresTakenEdit->getDepartment()):(isset($defaultValues['department'])?($defaultValues['department']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-procedure-conducted">

                 <?php
                  $readonly = in_array('procedureConducted',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['procedureConducted']=$proceduresTakenEdit->getProcedureConducted();};
                  ?>
                  <label for="input-procedures-taken-procedure-conducted">Procedure&nbsp;Conducted*</label>
  <input type="text" name="procedureConducted" id="input-procedures-taken-procedure-conducted" class="form-control " placeholder="Enter Procedure&nbsp;Conducted " value="<?php echo null!==($proceduresTakenEdit->getProcedureConducted())?($proceduresTakenEdit->getProcedureConducted()):(isset($defaultValues['procedureConducted'])?($defaultValues['procedureConducted']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-results-details">

                 <?php
                  $readonly = in_array('resultsDetails',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['resultsDetails']=$proceduresTakenEdit->getResultsDetails();};
                  ?>
                  <label for="input-procedures-taken-results-details">Results&nbsp;Details</label>
  <textarea rows="5" name="resultsDetails" id="input-procedures-taken-results-details" class="form-control " placeholder="Enter Results&nbsp;Details " <?php echo $readonly;?>   ><?php echo null!==($proceduresTakenEdit->getResultsDetails())?($proceduresTakenEdit->getResultsDetails()):(isset($defaultValues['resultsDetails'])?($defaultValues['resultsDetails']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-doctors-name">

                 <?php
                  $readonly = in_array('doctorsName',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['doctorsName']=$proceduresTakenEdit->getDoctorsName();};
                  ?>
                  <label for="input-procedures-taken-doctors-name">Doctors&nbsp;Name*</label>
  <input type="text" name="doctorsName" id="input-procedures-taken-doctors-name" class="form-control " placeholder="Enter Doctors&nbsp;Name " value="<?php echo null!==($proceduresTakenEdit->getDoctorsName())?($proceduresTakenEdit->getDoctorsName()):(isset($defaultValues['doctorsName'])?($defaultValues['doctorsName']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-lab-tech">

                 <?php
                  $readonly = in_array('labTech',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['labTech']=$proceduresTakenEdit->getLabTech();};
                  ?>
                  <label for="input-procedures-taken-lab-tech">Lab&nbsp;Tech*</label>
  <input type="text" name="labTech" id="input-procedures-taken-lab-tech" class="form-control " placeholder="Enter Lab&nbsp;Tech " value="<?php echo null!==($proceduresTakenEdit->getLabTech())?($proceduresTakenEdit->getLabTech()):(isset($defaultValues['labTech'])?($defaultValues['labTech']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-fee">

                 <?php
                  $readonly = in_array('fee',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['fee']=$proceduresTakenEdit->getFee();};
                  ?>
                  <label for="input-procedures-taken-fee">Fee*</label>
  <input type="number" name="fee" id="input-procedures-taken-fee" class="form-control " placeholder="Enter Fee " value="<?php echo null!==($proceduresTakenEdit->getFee())?($proceduresTakenEdit->getFee()):(isset($defaultValues['fee'])?($defaultValues['fee']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-time-tested">

                 <?php
                  $readonly = in_array('timeTested',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['timeTested']=$proceduresTakenEdit->getTimeTested();};
                  ?>
                  <label for="input-procedures-taken-time-tested">Time&nbsp;Tested*</label>
  <input type="text" name="timeTested" id="input-procedures-taken-time-tested" class="form-control datepicker " placeholder="Enter Time&nbsp;Tested " value="<?php echo null!==($proceduresTakenEdit->getTimeTested()))?(date("d/m/Y",strtotime($proceduresTakenEdit->getTimeTested()))):(isset($defaultValues['timeTested'])?($defaultValues['timeTested']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
