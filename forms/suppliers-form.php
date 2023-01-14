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
include_once("../classes/suppliers.php");
include_once("../daos/suppliers-dao.php");
$ID = isset($_GET['ID'])?filter_var($_GET['ID'], FILTER_VALIDATE_INT):null;
$suppliersEdit = new Suppliers();
$suppliersEditDao = new SuppliersDao();
if(isset($ID)){
  $tempObject = $suppliersEditDao->select($ID);
  if($tempObject !=null){
    $suppliersEdit = $tempObject;
  }
}
?>
<form onsubmit = "Suppliers.submitFormSuppliers(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-suppliers">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="iD" id="input-suppliers--i-d" value="<?php echo null!==($suppliersEdit->getID())?($suppliersEdit->getID()):(isset($defaultValues['ID'])?($defaultValues['ID']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-suppliers--n-a-m-e">

                 <?php
                  $readonly = in_array('NAME',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($suppliersEdit->getID()!=null){ $defaultValues['NAME']=$suppliersEdit->getNAME();};
                  ?>
                  <label for="input-suppliers--n-a-m-e">&nbsp;N&nbsp;A&nbsp;M&nbsp;E*</label>
  <input type="text" name="nAME" id="input-suppliers--n-a-m-e" class="form-control " placeholder="Enter &nbsp;N&nbsp;A&nbsp;M&nbsp;E " value="<?php echo null!==($suppliersEdit->getNAME())?($suppliersEdit->getNAME()):(isset($defaultValues['NAME'])?($defaultValues['NAME']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-suppliers--e-m-a-i-l">

                 <?php
                  $readonly = in_array('EMAIL',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($suppliersEdit->getID()!=null){ $defaultValues['EMAIL']=$suppliersEdit->getEMAIL();};
                  ?>
                  <label for="input-suppliers--e-m-a-i-l">&nbsp;E&nbsp;M&nbsp;A&nbsp;I&nbsp;L*</label>
  <input type="text" name="eMAIL" id="input-suppliers--e-m-a-i-l" class="form-control " placeholder="Enter &nbsp;E&nbsp;M&nbsp;A&nbsp;I&nbsp;L " value="<?php echo null!==($suppliersEdit->getEMAIL())?($suppliersEdit->getEMAIL()):(isset($defaultValues['EMAIL'])?($defaultValues['EMAIL']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-suppliers--c-o-n-t-a-c-t--n-u-m-b-e-r">

                 <?php
                  $readonly = in_array('CONTACT_NUMBER',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($suppliersEdit->getID()!=null){ $defaultValues['CONTACT_NUMBER']=$suppliersEdit->getContactNumber();};
                  ?>
                  <label for="input-suppliers--c-o-n-t-a-c-t--n-u-m-b-e-r">Contact&nbsp;Number*</label>
  <input type="text" name="contactNumber" id="input-suppliers--c-o-n-t-a-c-t--n-u-m-b-e-r" class="form-control " placeholder="Enter Contact&nbsp;Number " value="<?php echo null!==($suppliersEdit->getContactNumber())?($suppliersEdit->getContactNumber()):(isset($defaultValues['CONTACT_NUMBER'])?($defaultValues['CONTACT_NUMBER']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-suppliers--a-d-d-r-e-s-s">

                 <?php
                  $readonly = in_array('ADDRESS',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($suppliersEdit->getID()!=null){ $defaultValues['ADDRESS']=$suppliersEdit->getADDRESS();};
                  ?>
                  <label for="input-suppliers--a-d-d-r-e-s-s">&nbsp;A&nbsp;D&nbsp;D&nbsp;R&nbsp;E&nbsp;S&nbsp;S*</label>
  <input type="text" name="aDDRESS" id="input-suppliers--a-d-d-r-e-s-s" class="form-control " placeholder="Enter &nbsp;A&nbsp;D&nbsp;D&nbsp;R&nbsp;E&nbsp;S&nbsp;S " value="<?php echo null!==($suppliersEdit->getADDRESS())?($suppliersEdit->getADDRESS()):(isset($defaultValues['ADDRESS'])?($defaultValues['ADDRESS']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
