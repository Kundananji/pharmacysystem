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
include_once("../classes/patient-scheme.php");
include_once("../daos/patient-scheme-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$patientSchemeEdit = new PatientScheme();
$patientSchemeEditDao = new PatientSchemeDao();
if(isset($id)){
  $tempObject = $patientSchemeEditDao->select($id);
  if($tempObject !=null){
    $patientSchemeEdit = $tempObject;
  }
}
?>
<form onsubmit = "PatientScheme.submitFormPatientScheme(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-patient-scheme">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-patient-scheme-id" value="<?php echo null!==($patientSchemeEdit->getId())?($patientSchemeEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-patient-scheme-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientSchemeEdit->getId()!=null){ $defaultValues['name']=$patientSchemeEdit->getName();};
                  ?>
                  <label for="input-patient-scheme-name">Name*</label>
  <input type="text" name="name" id="input-patient-scheme-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($patientSchemeEdit->getName())?($patientSchemeEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patient-scheme-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientSchemeEdit->getId()!=null){ $defaultValues['description']=$patientSchemeEdit->getDescription();};
                  ?>
                  <label for="input-patient-scheme-description">Description</label>
  <textarea rows="5" name="description" id="input-patient-scheme-description" class="form-control " placeholder="Enter Description " <?php echo $readonly;?>   ><?php echo null!==($patientSchemeEdit->getDescription())?($patientSchemeEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patient-scheme-patient-id">

                 <?php
                  $readonly = in_array('patientId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientSchemeEdit->getId()!=null){ $defaultValues['patientId']=$patientSchemeEdit->getPatientId();};
                  ?>
                  <label for="input-patient-scheme-patient-id">Patient*</label>
  <?php 
    include_once("../classes/patients.php");
    include_once("../daos/patients-dao.php");

    $patientsDao = new PatientsDao(); 
    $objects = $patientsDao->selectAll(); 
    ?>
    <select name="patientId" id="input-patient-scheme-patient-id" class="form-control " required <?php echo $readonly;?> >
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
<div class="form-group input-patient-scheme-insurance-provider-id">

                 <?php
                  $readonly = in_array('insuranceProviderId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientSchemeEdit->getId()!=null){ $defaultValues['insuranceProviderId']=$patientSchemeEdit->getInsuranceProviderId();};
                  ?>
                  <label for="input-patient-scheme-insurance-provider-id">Insurance&nbsp;Provider&nbsp;Id*</label>
  <?php 
    include_once("../classes/insurance-provider.php");
    include_once("../daos/insurance-provider-dao.php");

    $insuranceProviderDao = new InsuranceProviderDao(); 
    $objects = $insuranceProviderDao->selectAll(); 
    ?>
    <select name="insuranceProviderId" id="input-patient-scheme-insurance-provider-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Insurance&nbsp;provider--</option>
      <?php
        foreach($objects as $insuranceProvider){
          $optionValue  = $insuranceProvider->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['insuranceProviderId']) && $defaultValues['insuranceProviderId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['insuranceProviderId']) && $defaultValues['insuranceProviderId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['insuranceProviderId']) && $defaultValues['insuranceProviderId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$insuranceProvider->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-patient-scheme-status">

                 <?php
                  $readonly = in_array('status',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($patientSchemeEdit->getId()!=null){ $defaultValues['status']=$patientSchemeEdit->getStatus();};
                  ?>
                  <label for="input-patient-scheme-status">Status*</label>
  <?php 
    include_once("../classes/status.php");
    include_once("../daos/status-dao.php");

    $statusDao = new StatusDao(); 
    $objects = $statusDao->selectAll(); 
    ?>
    <select name="status" id="input-patient-scheme-status" class="form-control " required <?php echo $readonly;?> >
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
