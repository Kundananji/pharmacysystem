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
$ID = isset($_GET['ID'])?filter_var($_GET['ID'], FILTER_VALIDATE_INT):null;
$medicinesEdit = new Medicines();
$medicinesEditDao = new MedicinesDao();
if(isset($ID)){
  $tempObject = $medicinesEditDao->select($ID);
  if($tempObject !=null){
    $medicinesEdit = $tempObject;
  }
}
?>
<form onsubmit = "Medicines.submitFormMedicines(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-medicines">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="iD" id="input-medicines--i-d" value="<?php echo null!==($medicinesEdit->getID())?($medicinesEdit->getID()):(isset($defaultValues['ID'])?($defaultValues['ID']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-medicines--n-a-m-e">

                 <?php
                  $readonly = in_array('NAME',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesEdit->getID()!=null){ $defaultValues['NAME']=$medicinesEdit->getNAME();};
                  ?>
                  <label for="input-medicines--n-a-m-e">&nbsp;N&nbsp;A&nbsp;M&nbsp;E*</label>
  <input type="text" name="nAME" id="input-medicines--n-a-m-e" class="form-control " placeholder="Enter &nbsp;N&nbsp;A&nbsp;M&nbsp;E " value="<?php echo null!==($medicinesEdit->getNAME())?($medicinesEdit->getNAME()):(isset($defaultValues['NAME'])?($defaultValues['NAME']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines--p-a-c-k-i-n-g">

                 <?php
                  $readonly = in_array('PACKING',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesEdit->getID()!=null){ $defaultValues['PACKING']=$medicinesEdit->getPACKING();};
                  ?>
                  <label for="input-medicines--p-a-c-k-i-n-g">&nbsp;P&nbsp;A&nbsp;C&nbsp;K&nbsp;I&nbsp;N&nbsp;G*</label>
  <input type="text" name="pACKING" id="input-medicines--p-a-c-k-i-n-g" class="form-control " placeholder="Enter &nbsp;P&nbsp;A&nbsp;C&nbsp;K&nbsp;I&nbsp;N&nbsp;G " value="<?php echo null!==($medicinesEdit->getPACKING())?($medicinesEdit->getPACKING()):(isset($defaultValues['PACKING'])?($defaultValues['PACKING']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines--g-e-n-e-r-i-c--n-a-m-e">

                 <?php
                  $readonly = in_array('GENERIC_NAME',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesEdit->getID()!=null){ $defaultValues['GENERIC_NAME']=$medicinesEdit->getGenericName();};
                  ?>
                  <label for="input-medicines--g-e-n-e-r-i-c--n-a-m-e">Generic&nbsp;Name*</label>
  <input type="text" name="genericName" id="input-medicines--g-e-n-e-r-i-c--n-a-m-e" class="form-control " placeholder="Enter Generic&nbsp;Name " value="<?php echo null!==($medicinesEdit->getGenericName())?($medicinesEdit->getGenericName()):(isset($defaultValues['GENERIC_NAME'])?($defaultValues['GENERIC_NAME']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines--s-u-p-p-l-i-e-r--n-a-m-e">

                 <?php
                  $readonly = in_array('SUPPLIER_NAME',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesEdit->getID()!=null){ $defaultValues['SUPPLIER_NAME']=$medicinesEdit->getSupplierName();};
                  ?>
                  <label for="input-medicines--s-u-p-p-l-i-e-r--n-a-m-e">Supplier&nbsp;Name*</label>
  <input type="text" name="supplierName" id="input-medicines--s-u-p-p-l-i-e-r--n-a-m-e" class="form-control " placeholder="Enter Supplier&nbsp;Name " value="<?php echo null!==($medicinesEdit->getSupplierName())?($medicinesEdit->getSupplierName()):(isset($defaultValues['SUPPLIER_NAME'])?($defaultValues['SUPPLIER_NAME']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
