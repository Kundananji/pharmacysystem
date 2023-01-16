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
include_once("../classes/regular-checkups.php");
include_once("../daos/regular-checkups-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$regularCheckupsEdit = new RegularCheckups();
$regularCheckupsEditDao = new RegularCheckupsDao();
if(isset($id)){
  $tempObject = $regularCheckupsEditDao->select($id);
  if($tempObject !=null){
    $regularCheckupsEdit = $tempObject;
  }
}
?>
<form onsubmit = "RegularCheckups.submitFormRegularCheckups(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-regular-checkups">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-regular-checkups-id" value="<?php echo null!==($regularCheckupsEdit->getId())?($regularCheckupsEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-regular-checkups-patient-id">

                 <?php
                  $readonly = in_array('patient_id',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['patient_id']=$regularCheckupsEdit->getPatientId();};
                  ?>
                  <label for="input-regular-checkups-patient-id">Patient&nbsp;*</label>
  <input type="text" name="patientId" id="input-regular-checkups-patient-id" class="form-control " placeholder="Enter Patient&nbsp; " value="<?php echo null!==($regularCheckupsEdit->getPatientId())?($regularCheckupsEdit->getPatientId()):(isset($defaultValues['patient_id'])?($defaultValues['patient_id']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-regular-checkups-temperature">

                 <?php
                  $readonly = in_array('temperature',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['temperature']=$regularCheckupsEdit->getTemperature();};
                  ?>
                  <label for="input-regular-checkups-temperature">Temperature*</label>
  <input type="text" name="temperature" id="input-regular-checkups-temperature" class="form-control " placeholder="Enter Temperature " value="<?php echo null!==($regularCheckupsEdit->getTemperature())?($regularCheckupsEdit->getTemperature()):(isset($defaultValues['temperature'])?($defaultValues['temperature']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-regular-checkups-blood-pressure">

                 <?php
                  $readonly = in_array('bloodPressure',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['bloodPressure']=$regularCheckupsEdit->getBloodPressure();};
                  ?>
                  <label for="input-regular-checkups-blood-pressure">Blood&nbsp;Pressure*</label>
  <input type="text" name="bloodPressure" id="input-regular-checkups-blood-pressure" class="form-control " placeholder="Enter Blood&nbsp;Pressure " value="<?php echo null!==($regularCheckupsEdit->getBloodPressure())?($regularCheckupsEdit->getBloodPressure()):(isset($defaultValues['bloodPressure'])?($defaultValues['bloodPressure']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-regular-checkups-weight">

                 <?php
                  $readonly = in_array('weight',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['weight']=$regularCheckupsEdit->getWeight();};
                  ?>
                  <label for="input-regular-checkups-weight">Weight*</label>
  <input type="text" name="weight" id="input-regular-checkups-weight" class="form-control " placeholder="Enter Weight " value="<?php echo null!==($regularCheckupsEdit->getWeight())?($regularCheckupsEdit->getWeight()):(isset($defaultValues['weight'])?($defaultValues['weight']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-regular-checkups-other">

                 <?php
                  $readonly = in_array('other',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['other']=$regularCheckupsEdit->getOther();};
                  ?>
                  <label for="input-regular-checkups-other">Other</label>
  <textarea rows="5" name="other" id="input-regular-checkups-other" class="form-control " placeholder="Enter Other " <?php echo $readonly;?>   ><?php echo null!==($regularCheckupsEdit->getOther())?($regularCheckupsEdit->getOther()):(isset($defaultValues['other'])?($defaultValues['other']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-regular-checkups-status">

                 <?php
                  $readonly = in_array('status',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['status']=$regularCheckupsEdit->getStatus();};
                  ?>
                  <label for="input-regular-checkups-status">Status*</label>
  <input type="number" name="status" id="input-regular-checkups-status" class="form-control " placeholder="Enter Status " value="<?php echo null!==($regularCheckupsEdit->getStatus())?($regularCheckupsEdit->getStatus()):(isset($defaultValues['status'])?($defaultValues['status']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-regular-checkups-time-tested">

                 <?php
                  $readonly = in_array('timeTested',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['timeTested']=$regularCheckupsEdit->getTimeTested();};
                  ?>
                  <label for="input-regular-checkups-time-tested">Time&nbsp;Tested*</label>
  <input type="text" name="timeTested" id="input-regular-checkups-time-tested" class="form-control datepicker " placeholder="Enter Time&nbsp;Tested " value="<?php echo null!==($regularCheckupsEdit->getTimeTested()))?(date("d/m/Y",strtotime($regularCheckupsEdit->getTimeTested()))):(isset($defaultValues['timeTested'])?($defaultValues['timeTested']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
