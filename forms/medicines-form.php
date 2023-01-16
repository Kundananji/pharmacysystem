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
include_once("../classes/medicines.php");
include_once("../daos/medicines-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$medicinesEdit = new Medicines();
$medicinesEditDao = new MedicinesDao();
if(isset($id)){
  $tempObject = $medicinesEditDao->select($id);
  if($tempObject !=null){
    $medicinesEdit = $tempObject;
  }
}
?>
<form onsubmit = "Medicines.submitFormMedicines(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-medicines">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-medicines-id" value="<?php echo null!==($medicinesEdit->getId())?($medicinesEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-medicines-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesEdit->getId()!=null){ $defaultValues['name']=$medicinesEdit->getName();};
                  ?>
                  <label for="input-medicines-name">Name*</label>
  <input type="text" name="name" id="input-medicines-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($medicinesEdit->getName())?($medicinesEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-packing">

                 <?php
                  $readonly = in_array('packing',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesEdit->getId()!=null){ $defaultValues['packing']=$medicinesEdit->getPacking();};
                  ?>
                  <label for="input-medicines-packing">Packing*</label>
  <input type="text" name="packing" id="input-medicines-packing" class="form-control " placeholder="Enter Packing " value="<?php echo null!==($medicinesEdit->getPacking())?($medicinesEdit->getPacking()):(isset($defaultValues['packing'])?($defaultValues['packing']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-generic-name">

                 <?php
                  $readonly = in_array('generic_name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesEdit->getId()!=null){ $defaultValues['generic_name']=$medicinesEdit->getGenericName();};
                  ?>
                  <label for="input-medicines-generic-name">Generic&nbsp;Name*</label>
  <input type="text" name="genericName" id="input-medicines-generic-name" class="form-control " placeholder="Enter Generic&nbsp;Name " value="<?php echo null!==($medicinesEdit->getGenericName())?($medicinesEdit->getGenericName()):(isset($defaultValues['generic_name'])?($defaultValues['generic_name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-supplier-name">

                 <?php
                  $readonly = in_array('supplier_name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesEdit->getId()!=null){ $defaultValues['supplier_name']=$medicinesEdit->getSupplierName();};
                  ?>
                  <label for="input-medicines-supplier-name">Supplier&nbsp;Name*</label>
  <input type="text" name="supplierName" id="input-medicines-supplier-name" class="form-control " placeholder="Enter Supplier&nbsp;Name " value="<?php echo null!==($medicinesEdit->getSupplierName())?($medicinesEdit->getSupplierName()):(isset($defaultValues['supplier_name'])?($defaultValues['supplier_name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
