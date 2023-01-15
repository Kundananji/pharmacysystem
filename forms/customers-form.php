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
include_once("../classes/customers.php");
include_once("../daos/customers-dao.php");
$ID = isset($_GET['ID'])?filter_var($_GET['ID'], FILTER_VALIDATE_INT):null;
$customersEdit = new Customers();
$customersEditDao = new CustomersDao();
if(isset($ID)){
  $tempObject = $customersEditDao->select($ID);
  if($tempObject !=null){
    $customersEdit = $tempObject;
  }
}
?>
<form onsubmit = "Customers.submitFormCustomers(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-customers">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="iD" id="input-customers--i-d" value="<?php echo null!==($customersEdit->getID())?($customersEdit->getID()):(isset($defaultValues['ID'])?($defaultValues['ID']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-customers--n-a-m-e">

                 <?php
                  $readonly = in_array('NAME',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getID()!=null){ $defaultValues['NAME']=$customersEdit->getNAME();};
                  ?>
                  <label for="input-customers--n-a-m-e">&nbsp;N&nbsp;A&nbsp;M&nbsp;E*</label>
  <input type="text" name="nAME" id="input-customers--n-a-m-e" class="form-control " placeholder="Enter &nbsp;N&nbsp;A&nbsp;M&nbsp;E " value="<?php echo null!==($customersEdit->getNAME())?($customersEdit->getNAME()):(isset($defaultValues['NAME'])?($defaultValues['NAME']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-customers--c-o-n-t-a-c-t--n-u-m-b-e-r">

                 <?php
                  $readonly = in_array('contact_number',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getID()!=null){ $defaultValues['contact_number']=$customersEdit->getContactNumber();};
                  ?>
                  <label for="input-customers--c-o-n-t-a-c-t--n-u-m-b-e-r">Contact&nbsp;Number*</label>
  <input type="text" name="contactNumber" id="input-customers--c-o-n-t-a-c-t--n-u-m-b-e-r" class="form-control " placeholder="Enter Contact&nbsp;Number " value="<?php echo null!==($customersEdit->getContactNumber())?($customersEdit->getContactNumber()):(isset($defaultValues['contact_number'])?($defaultValues['contact_number']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-customers--a-d-d-r-e-s-s">

                 <?php
                  $readonly = in_array('ADDRESS',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getID()!=null){ $defaultValues['ADDRESS']=$customersEdit->getADDRESS();};
                  ?>
                  <label for="input-customers--a-d-d-r-e-s-s">&nbsp;A&nbsp;D&nbsp;D&nbsp;R&nbsp;E&nbsp;S&nbsp;S*</label>
  <input type="text" name="aDDRESS" id="input-customers--a-d-d-r-e-s-s" class="form-control " placeholder="Enter &nbsp;A&nbsp;D&nbsp;D&nbsp;R&nbsp;E&nbsp;S&nbsp;S " value="<?php echo null!==($customersEdit->getADDRESS())?($customersEdit->getADDRESS()):(isset($defaultValues['ADDRESS'])?($defaultValues['ADDRESS']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-customers--d-o-c-t-o-r--n-a-m-e">

                 <?php
                  $readonly = in_array('doctor_name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getID()!=null){ $defaultValues['doctor_name']=$customersEdit->getDoctorName();};
                  ?>
                  <label for="input-customers--d-o-c-t-o-r--n-a-m-e">Doctor&nbsp;Name*</label>
  <input type="text" name="doctorName" id="input-customers--d-o-c-t-o-r--n-a-m-e" class="form-control " placeholder="Enter Doctor&nbsp;Name " value="<?php echo null!==($customersEdit->getDoctorName())?($customersEdit->getDoctorName()):(isset($defaultValues['doctor_name'])?($defaultValues['doctor_name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-customers--d-o-c-t-o-r--a-d-d-r-e-s-s">

                 <?php
                  $readonly = in_array('doctor_address',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getID()!=null){ $defaultValues['doctor_address']=$customersEdit->getDoctorAddress();};
                  ?>
                  <label for="input-customers--d-o-c-t-o-r--a-d-d-r-e-s-s">Doctor&nbsp;Address*</label>
  <input type="text" name="doctorAddress" id="input-customers--d-o-c-t-o-r--a-d-d-r-e-s-s" class="form-control " placeholder="Enter Doctor&nbsp;Address " value="<?php echo null!==($customersEdit->getDoctorAddress())?($customersEdit->getDoctorAddress()):(isset($defaultValues['doctor_address'])?($defaultValues['doctor_address']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
