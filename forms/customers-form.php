<?php
session_start(); //start session since security is involved
$session_userId = isset($_SESSION['user_id'])?$_SESSION['user_id']:null; //read userId from session
$session_profile = isset($_SESSION['user_profile'])?$_SESSION['user_profile']:null; //read userId from session

//declare env variables for use
$env_dateNowHuman = date("d/m/Y");
$env_dateNow = date("Y-m-d");
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
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$customersEdit = new Customers();
$customersEditDao = new CustomersDao();
if(isset($id)){
  $tempObject = $customersEditDao->select($id);
  if($tempObject !=null){
    $customersEdit = $tempObject;
  }
}
?>
<form onsubmit = "Customers.submitFormCustomers(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-customers">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-customers-id" value="<?php echo null!==($customersEdit->getId())?($customersEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-customers-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getId()!=null){ $defaultValues['name']=$customersEdit->getName();};
                  ?>
                  <label for="input-customers-name">Name*</label>
  <input type="text" name="name" id="input-customers-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($customersEdit->getName())?($customersEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-customers-contact-number">

                 <?php
                  $readonly = in_array('contact_number',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getId()!=null){ $defaultValues['contact_number']=$customersEdit->getContactNumber();};
                  ?>
                  <label for="input-customers-contact-number">Contact&nbsp;Number*</label>
  <input type="text" name="contactNumber" id="input-customers-contact-number" class="form-control " placeholder="Enter Contact&nbsp;Number " value="<?php echo null!==($customersEdit->getContactNumber())?($customersEdit->getContactNumber()):(isset($defaultValues['contact_number'])?($defaultValues['contact_number']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-customers-address">

                 <?php
                  $readonly = in_array('address',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getId()!=null){ $defaultValues['address']=$customersEdit->getAddress();};
                  ?>
                  <label for="input-customers-address">Address*</label>
  <input type="text" name="address" id="input-customers-address" class="form-control " placeholder="Enter Address " value="<?php echo null!==($customersEdit->getAddress())?($customersEdit->getAddress()):(isset($defaultValues['address'])?($defaultValues['address']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-customers-doctor-id">

                 <?php
                  $readonly = in_array('doctorId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($customersEdit->getId()!=null){ $defaultValues['doctorId']=$customersEdit->getDoctorId();};
                  ?>
                  <label for="input-customers-doctor-id">Doctor</label>
  <?php 
    include_once("../classes/staff.php");
    include_once("../daos/staff-dao.php");

    $staffDao = new StaffDao(); 
    $objects = $staffDao->selectAll(); 
    ?>
    <select name="doctorId" id="input-customers-doctor-id" class=" form-control"  <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Staff--</option>
      <?php
        foreach($objects as $staff){
          $optionValue  = $staff->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['doctorId']) && $defaultValues['doctorId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['doctorId']) && $defaultValues['doctorId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['doctorId']) && $defaultValues['doctorId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$staff->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
