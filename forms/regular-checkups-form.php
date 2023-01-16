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
                  $readonly = in_array('patientId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['patientId']=$regularCheckupsEdit->getPatientId();};
                  ?>
                  <label for="input-regular-checkups-patient-id">Patient*</label>
  <?php 
    include_once("../classes/patients.php");
    include_once("../daos/patients-dao.php");

    $patientsDao = new PatientsDao(); 
    $objects = $patientsDao->selectAll(); 
    ?>
    <select name="patientId" id="input-regular-checkups-patient-id" class="form-control " required <?php echo $readonly;?> >
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
<div class="form-group input-regular-checkups-conducted-by">

                 <?php
                  $readonly = in_array('conductedBy',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['conductedBy']=$regularCheckupsEdit->getConductedBy();};
                  ?>
                  <label for="input-regular-checkups-conducted-by">Conducted&nbsp;By*</label>
  <?php 
    include_once("../classes/staff.php");
    include_once("../daos/staff-dao.php");

    $staffDao = new StaffDao(); 
    $objects = $staffDao->selectAll(); 
    ?>
    <select name="conductedBy" id="input-regular-checkups-conducted-by" class="form-control " required <?php echo $readonly;?> >
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
<div class="form-group input-regular-checkups-date-taken">

                 <?php
                  $readonly = in_array('dateTaken',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['dateTaken']=$regularCheckupsEdit->getDateTaken();};
                  ?>
                  <label for="input-regular-checkups-date-taken">Date&nbsp;Taken*</label>
  <input type="text" name="dateTaken" id="input-regular-checkups-date-taken" class="form-control datepicker " placeholder="Enter Date&nbsp;Taken " value="<?php echo null!==($regularCheckupsEdit->getDateTaken()))?(date("d/m/Y",strtotime($regularCheckupsEdit->getDateTaken()))):(isset($defaultValues['dateTaken'])?($defaultValues['dateTaken']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-regular-checkups-time-taken">

                 <?php
                  $readonly = in_array('timeTaken',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($regularCheckupsEdit->getId()!=null){ $defaultValues['timeTaken']=$regularCheckupsEdit->getTimeTaken();};
                  ?>
                  <label for="input-regular-checkups-time-taken">Time&nbsp;Taken*</label>
  <input type="time" name="timeTaken" id="input-regular-checkups-time-taken" class="form-control " placeholder="Enter Time&nbsp;Taken " value="<?php echo null!==($regularCheckupsEdit->getTimeTaken())?($regularCheckupsEdit->getTimeTaken()):(isset($defaultValues['timeTaken'])?($defaultValues['timeTaken']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
