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
include_once("../classes/insurance-provider.php");
include_once("../daos/insurance-provider-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$insuranceProviderEdit = new InsuranceProvider();
$insuranceProviderEditDao = new InsuranceProviderDao();
if(isset($id)){
  $tempObject = $insuranceProviderEditDao->select($id);
  if($tempObject !=null){
    $insuranceProviderEdit = $tempObject;
  }
}
?>
<form onsubmit = "InsuranceProvider.submitFormInsuranceProvider(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-insurance-provider">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-insurance-provider-id" value="<?php echo null!==($insuranceProviderEdit->getId())?($insuranceProviderEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-insurance-provider-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($insuranceProviderEdit->getId()!=null){ $defaultValues['name']=$insuranceProviderEdit->getName();};
                  ?>
                  <label for="input-insurance-provider-name">Name*</label>
  <input type="text" name="name" id="input-insurance-provider-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($insuranceProviderEdit->getName())?($insuranceProviderEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-insurance-provider-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($insuranceProviderEdit->getId()!=null){ $defaultValues['description']=$insuranceProviderEdit->getDescription();};
                  ?>
                  <label for="input-insurance-provider-description">Description</label>
  <textarea rows="5" name="description" id="input-insurance-provider-description" class="form-control " placeholder="Enter Description " <?php echo $readonly;?>   ><?php echo null!==($insuranceProviderEdit->getDescription())?($insuranceProviderEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-insurance-provider-address">

                 <?php
                  $readonly = in_array('address',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($insuranceProviderEdit->getId()!=null){ $defaultValues['address']=$insuranceProviderEdit->getAddress();};
                  ?>
                  <label for="input-insurance-provider-address">Address</label>
  <textarea rows="5" name="address" id="input-insurance-provider-address" class="form-control " placeholder="Enter Address " <?php echo $readonly;?>   ><?php echo null!==($insuranceProviderEdit->getAddress())?($insuranceProviderEdit->getAddress()):(isset($defaultValues['address'])?($defaultValues['address']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-insurance-provider-contact-number">

                 <?php
                  $readonly = in_array('contactNumber',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($insuranceProviderEdit->getId()!=null){ $defaultValues['contactNumber']=$insuranceProviderEdit->getContactNumber();};
                  ?>
                  <label for="input-insurance-provider-contact-number">Contact&nbsp;Number*</label>
  <input type="text" name="contactNumber" id="input-insurance-provider-contact-number" class="form-control " placeholder="Enter Contact&nbsp;Number " value="<?php echo null!==($insuranceProviderEdit->getContactNumber())?($insuranceProviderEdit->getContactNumber()):(isset($defaultValues['contactNumber'])?($defaultValues['contactNumber']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
