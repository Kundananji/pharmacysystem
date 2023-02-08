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
include_once("../classes/fee.php");
include_once("../daos/fee-dao.php");
$arguments=array();$feeId = isset($_GET['feeId'])?filter_var($_GET['feeId'], FILTER_VALIDATE_INT):null;
$feeEdit = new Fee();
$feeEditDao = new FeeDao();
if(isset($feeId)){
  $tempObject = $feeEditDao->select($feeId);
  if($tempObject !=null){
    $feeEdit = $tempObject;
  }
}
?>
<form onsubmit = "Fee.submitFormFee(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-fee">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="feeId" id="input-fee-fee-id" value="<?php echo null!==($feeEdit->getFeeId())?($feeEdit->getFeeId()):(isset($defaultValues['feeId'])?($defaultValues['feeId']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-fee-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($feeEdit->getFeeId()!=null){ $defaultValues['name']=$feeEdit->getName();};
                  ?>
                  <label for="input-fee-name">Name*</label>
  <input type="text" name="name" id="input-fee-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($feeEdit->getName())?($feeEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-fee-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($feeEdit->getFeeId()!=null){ $defaultValues['description']=$feeEdit->getDescription();};
                  ?>
                  <label for="input-fee-description">Description</label>
  <textarea rows="5" name="description" id="input-fee-description" class="form-control " placeholder="Enter Description " <?php echo $readonly;?>   ><?php echo null!==($feeEdit->getDescription())?($feeEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-fee-amount">

                 <?php
                  $readonly = in_array('amount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($feeEdit->getFeeId()!=null){ $defaultValues['amount']=$feeEdit->getAmount();};
                  ?>
                  <label for="input-fee-amount">Amount*</label>
  <input type="number" step="any" name="amount" id="input-fee-amount" class="form-control " placeholder="Enter Amount " value="<?php echo null!==($feeEdit->getAmount())?($feeEdit->getAmount()):(isset($defaultValues['amount'])?($defaultValues['amount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-fee-status">

                 <?php
                  $readonly = in_array('status',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($feeEdit->getFeeId()!=null){ $defaultValues['status']=$feeEdit->getStatus();};
                  ?>
                  <label for="input-fee-status">Status*</label>
  <?php 
    include_once("../classes/status.php");
    include_once("../daos/status-dao.php");

    $statusDao = new StatusDao(); 
    $objects = $statusDao->selectAll(); 
    ?>
    <select name="status" id="input-fee-status" class=" form-control" required <?php echo $readonly;?>  >
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
