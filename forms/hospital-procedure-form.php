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
include_once("../classes/hospital-procedure.php");
include_once("../daos/hospital-procedure-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$hospitalProcedureEdit = new HospitalProcedure();
$hospitalProcedureEditDao = new HospitalProcedureDao();
if(isset($id)){
  $tempObject = $hospitalProcedureEditDao->select($id);
  if($tempObject !=null){
    $hospitalProcedureEdit = $tempObject;
  }
}
?>
<form onsubmit = "HospitalProcedure.submitFormHospitalProcedure(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-hospital-procedure">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-hospital-procedure-id" value="<?php echo null!==($hospitalProcedureEdit->getId())?($hospitalProcedureEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-hospital-procedure-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($hospitalProcedureEdit->getId()!=null){ $defaultValues['name']=$hospitalProcedureEdit->getName();};
                  ?>
                  <label for="input-hospital-procedure-name">Name*</label>
  <input type="text" name="name" id="input-hospital-procedure-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($hospitalProcedureEdit->getName())?($hospitalProcedureEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-hospital-procedure-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($hospitalProcedureEdit->getId()!=null){ $defaultValues['description']=$hospitalProcedureEdit->getDescription();};
                  ?>
                  <label for="input-hospital-procedure-description">Description*</label>
  <input type="text" name="description" id="input-hospital-procedure-description" class="form-control " placeholder="Enter Description " value="<?php echo null!==($hospitalProcedureEdit->getDescription())?($hospitalProcedureEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-hospital-procedure-department-id">

                 <?php
                  $readonly = in_array('departmentId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($hospitalProcedureEdit->getId()!=null){ $defaultValues['departmentId']=$hospitalProcedureEdit->getDepartmentId();};
                  ?>
                  <label for="input-hospital-procedure-department-id">Department*</label>
  <?php 
    include_once("../classes/department.php");
    include_once("../daos/department-dao.php");

    $departmentDao = new DepartmentDao(); 
    $objects = $departmentDao->selectAll(); 
    ?>
    <select name="departmentId" id="input-hospital-procedure-department-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Department--</option>
      <?php
        foreach($objects as $department){
          $optionValue  = $department->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['departmentId']) && $defaultValues['departmentId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['departmentId']) && $defaultValues['departmentId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['departmentId']) && $defaultValues['departmentId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$department->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-hospital-procedure-fee-id">

                 <?php
                  $readonly = in_array('feeId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($hospitalProcedureEdit->getId()!=null){ $defaultValues['feeId']=$hospitalProcedureEdit->getFeeId();};
                  ?>
                  <label for="input-hospital-procedure-fee-id">Fee*</label>
  <?php 
    include_once("../classes/fee.php");
    include_once("../daos/fee-dao.php");

    $feeDao = new FeeDao(); 
    $objects = $feeDao->selectAll(); 
    ?>
    <select name="feeId" id="input-hospital-procedure-fee-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Fee--</option>
      <?php
        foreach($objects as $fee){
          $optionValue  = $fee->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['feeId']) && $defaultValues['feeId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['feeId']) && $defaultValues['feeId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['feeId']) && $defaultValues['feeId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$fee->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
