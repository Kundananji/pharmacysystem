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
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
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
                  $readonly = in_array('patientId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['patientId']=$proceduresTakenEdit->getPatientId();};
                  ?>
                  <label for="input-procedures-taken-patient-id">Patient*</label>
  <?php 
    include_once("../classes/patients.php");
    include_once("../daos/patients-dao.php");

    $patientsDao = new PatientsDao(); 
    $objects = $patientsDao->selectAll(); 
    ?>
    <select name="patientId" id="input-procedures-taken-patient-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Patients--</option>
      <?php
        foreach($objects as $patients){
          $optionValue  = $patients->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['patientId']) && $defaultValues['patientId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['patientId']) && $defaultValues['patientId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['patientId']) && $defaultValues['patientId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$patients->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-procedure-id">

                 <?php
                  $readonly = in_array('procedureId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['procedureId']=$proceduresTakenEdit->getProcedureId();};
                  ?>
                  <label for="input-procedures-taken-procedure-id">Procedure*</label>
  <?php 
    include_once("../classes/hospital-procedure.php");
    include_once("../daos/hospital-procedure-dao.php");

    $hospitalProcedureDao = new HospitalProcedureDao(); 
    $objects = $hospitalProcedureDao->selectAll(); 
    ?>
    <select name="procedureId" id="input-procedures-taken-procedure-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Hospital&nbsp;procedure--</option>
      <?php
        foreach($objects as $hospitalProcedure){
          $optionValue  = $hospitalProcedure->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['procedureId']) && $defaultValues['procedureId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['procedureId']) && $defaultValues['procedureId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['procedureId']) && $defaultValues['procedureId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$hospitalProcedure->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-doctor-id">

                 <?php
                  $readonly = in_array('doctorId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['doctorId']=$proceduresTakenEdit->getDoctorId();};
                  ?>
                  <label for="input-procedures-taken-doctor-id">Doctor</label>
  <?php 
    include_once("../classes/staff.php");
    include_once("../daos/staff-dao.php");

    $staffDao = new StaffDao(); 
    $objects = $staffDao->selectAll(); 
    ?>
    <select name="doctorId" id="input-procedures-taken-doctor-id" class="form-control "  <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Staff--</option>
      <?php
        foreach($objects as $staff){
          $optionValue  = $staff->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['doctorId']) && $defaultValues['doctorId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['doctorId']) && $defaultValues['doctorId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['doctorId']) && $defaultValues['doctorId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$staff->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-conducted-by">

                 <?php
                  $readonly = in_array('conductedBy',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['conductedBy']=$proceduresTakenEdit->getConductedBy();};
                  ?>
                  <label for="input-procedures-taken-conducted-by">Conducted&nbsp;By*</label>
  <?php 
    include_once("../classes/staff.php");
    include_once("../daos/staff-dao.php");

    $staffDao = new StaffDao(); 
    $objects = $staffDao->selectAll(); 
    ?>
    <select name="conductedBy" id="input-procedures-taken-conducted-by" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Staff--</option>
      <?php
        foreach($objects as $staff){
          $optionValue  = $staff->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['conductedBy']) && $defaultValues['conductedBy']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['conductedBy']) && $defaultValues['conductedBy']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['conductedBy']) && $defaultValues['conductedBy']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$staff->toString().'</option>';
        }
      ?>
    </select>
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
<div class="form-group input-procedures-taken-remarks">

                 <?php
                  $readonly = in_array('remarks',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['remarks']=$proceduresTakenEdit->getRemarks();};
                  ?>
                  <label for="input-procedures-taken-remarks">Remarks</label>
  <textarea rows="5" name="remarks" id="input-procedures-taken-remarks" class="form-control " placeholder="Enter Remarks " <?php echo $readonly;?>   ><?php echo null!==($proceduresTakenEdit->getRemarks())?($proceduresTakenEdit->getRemarks()):(isset($defaultValues['remarks'])?($defaultValues['remarks']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-date-conducted">

                 <?php
                  $readonly = in_array('dateConducted',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['dateConducted']=$proceduresTakenEdit->getDateConducted();};
                  ?>
                  <label for="input-procedures-taken-date-conducted">Date&nbsp;Conducted*</label>
  <input type="text" name="dateConducted" id="input-procedures-taken-date-conducted" class="form-control datepicker " placeholder="Enter Date&nbsp;Conducted " value="<?php echo null!==($proceduresTakenEdit->getDateConducted())?(date("d/m/Y",strtotime($proceduresTakenEdit->getDateConducted()))):(isset($defaultValues['dateConducted'])?($defaultValues['dateConducted']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-procedures-taken-time-conducted">

                 <?php
                  $readonly = in_array('timeConducted',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($proceduresTakenEdit->getId()!=null){ $defaultValues['timeConducted']=$proceduresTakenEdit->getTimeConducted();};
                  ?>
                  <label for="input-procedures-taken-time-conducted">Time&nbsp;Conducted*</label>
  <input type="time" name="timeConducted" id="input-procedures-taken-time-conducted" class="form-control " placeholder="Enter Time&nbsp;Conducted " value="<?php echo null!==($proceduresTakenEdit->getTimeConducted())?($proceduresTakenEdit->getTimeConducted()):(isset($defaultValues['timeConducted'])?($defaultValues['timeConducted']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
