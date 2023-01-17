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
$arguments=array();$ID = isset($_GET['ID'])?filter_var($_GET['ID'], FILTER_VALIDATE_INT):null;
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
<div class="form-group input-suppliers-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($suppliersEdit->getID()!=null){ $defaultValues['name']=$suppliersEdit->getName();};
                  ?>
                  <label for="input-suppliers-name">Name*</label>
  <input type="text" name="name" id="input-suppliers-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($suppliersEdit->getName())?($suppliersEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-suppliers-email">

                 <?php
                  $readonly = in_array('email',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($suppliersEdit->getID()!=null){ $defaultValues['email']=$suppliersEdit->getEmail();};
                  ?>
                  <label for="input-suppliers-email">Email*</label>
  <input type="text" name="email" id="input-suppliers-email" class="form-control " placeholder="Enter Email " value="<?php echo null!==($suppliersEdit->getEmail())?($suppliersEdit->getEmail()):(isset($defaultValues['email'])?($defaultValues['email']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-suppliers-contact-number">

                 <?php
                  $readonly = in_array('contact_number',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($suppliersEdit->getID()!=null){ $defaultValues['contact_number']=$suppliersEdit->getContactNumber();};
                  ?>
                  <label for="input-suppliers-contact-number">Contact&nbsp;Number*</label>
  <input type="text" name="contactNumber" id="input-suppliers-contact-number" class="form-control " placeholder="Enter Contact&nbsp;Number " value="<?php echo null!==($suppliersEdit->getContactNumber())?($suppliersEdit->getContactNumber()):(isset($defaultValues['contact_number'])?($defaultValues['contact_number']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-suppliers-address">

                 <?php
                  $readonly = in_array('address',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($suppliersEdit->getID()!=null){ $defaultValues['address']=$suppliersEdit->getAddress();};
                  ?>
                  <label for="input-suppliers-address">Address*</label>
  <input type="text" name="address" id="input-suppliers-address" class="form-control " placeholder="Enter Address " value="<?php echo null!==($suppliersEdit->getAddress())?($suppliersEdit->getAddress()):(isset($defaultValues['address'])?($defaultValues['address']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
