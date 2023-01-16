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
include_once("../classes/payment-methods.php");
include_once("../daos/payment-methods-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$paymentMethodsEdit = new PaymentMethods();
$paymentMethodsEditDao = new PaymentMethodsDao();
if(isset($id)){
  $tempObject = $paymentMethodsEditDao->select($id);
  if($tempObject !=null){
    $paymentMethodsEdit = $tempObject;
  }
}
?>
<form onsubmit = "PaymentMethods.submitFormPaymentMethods(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-payment-methods">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-payment-methods-id" value="<?php echo null!==($paymentMethodsEdit->getId())?($paymentMethodsEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-payment-methods-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($paymentMethodsEdit->getId()!=null){ $defaultValues['name']=$paymentMethodsEdit->getName();};
                  ?>
                  <label for="input-payment-methods-name">Name*</label>
  <input type="text" name="name" id="input-payment-methods-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($paymentMethodsEdit->getName())?($paymentMethodsEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-payment-methods-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($paymentMethodsEdit->getId()!=null){ $defaultValues['description']=$paymentMethodsEdit->getDescription();};
                  ?>
                  <label for="input-payment-methods-description">Description*</label>
  <textarea rows="5" name="description" id="input-payment-methods-description" class="form-control " placeholder="Enter Description " required<?php echo $readonly;?>   ><?php echo null!==($paymentMethodsEdit->getDescription())?($paymentMethodsEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-payment-methods-status">

                 <?php
                  $readonly = in_array('status',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($paymentMethodsEdit->getId()!=null){ $defaultValues['status']=$paymentMethodsEdit->getStatus();};
                  ?>
                  <label for="input-payment-methods-status">Status*</label>
  <?php 
    include_once("../classes/status.php");
    include_once("../daos/status-dao.php");

    $statusDao = new StatusDao(); 
    $objects = $statusDao->selectAll(); 
    ?>
    <select name="status" id="input-payment-methods-status" class="form-control " required <?php echo $readonly;?> >
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
