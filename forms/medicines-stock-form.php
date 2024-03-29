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
include_once("../classes/medicines-stock.php");
include_once("../daos/medicines-stock-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$medicinesStockEdit = new MedicinesStock();
$medicinesStockEditDao = new MedicinesStockDao();
if(isset($id)){
  $tempObject = $medicinesStockEditDao->select($id);
  if($tempObject !=null){
    $medicinesStockEdit = $tempObject;
  }
}
?>
<form onsubmit = "MedicinesStock.submitFormMedicinesStock(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-medicines-stock">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-medicines-stock-id" value="<?php echo null!==($medicinesStockEdit->getId())?($medicinesStockEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-medicines-stock-medicine-id">

                 <?php
                  $readonly = in_array('medicineId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['medicineId']=$medicinesStockEdit->getMedicineId();};
                  ?>
                  <label for="input-medicines-stock-medicine-id">Medicine*</label>
  <?php 
    include_once("../classes/medicines.php");
    include_once("../daos/medicines-dao.php");

    $medicinesDao = new MedicinesDao(); 
    $objects = $medicinesDao->selectAll(); 
    ?>
    <select name="medicineId" id="input-medicines-stock-medicine-id" class="select-2-basic-single w-100 form-control" required <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Medicines--</option>
      <?php
        foreach($objects as $medicines){
          $optionValue  = $medicines->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['medicineId']) && $defaultValues['medicineId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['medicineId']) && $defaultValues['medicineId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['medicineId']) && $defaultValues['medicineId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$medicines->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock-batch-id">

                 <?php
                  $readonly = in_array('batch_id',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['batch_id']=$medicinesStockEdit->getBatchId();};
                  ?>
                  <label for="input-medicines-stock-batch-id">Batch&nbsp;Id*</label>
  <input type="text" name="batchId" id="input-medicines-stock-batch-id" class="form-control " placeholder="Enter Batch&nbsp;Id " value="<?php echo null!==($medicinesStockEdit->getBatchId())?($medicinesStockEdit->getBatchId()):(isset($defaultValues['batch_id'])?($defaultValues['batch_id']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock-expiry-date">

                 <?php
                  $readonly = in_array('expiry_date',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['expiry_date']=$medicinesStockEdit->getExpiryDate();};
                  ?>
                  <label for="input-medicines-stock-expiry-date">Expiry&nbsp;Date*</label>
  <input type="text" name="expiryDate" id="input-medicines-stock-expiry-date" class="form-control datepicker " placeholder="Enter Expiry&nbsp;Date " value="<?php echo null!==($medicinesStockEdit->getExpiryDate())?(date("d/m/Y",strtotime($medicinesStockEdit->getExpiryDate()))):(isset($defaultValues['expiry_date'])?($defaultValues['expiry_date']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock-quantity">

                 <?php
                  $readonly = in_array('quantity',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['quantity']=$medicinesStockEdit->getQuantity();};
                  ?>
                  <label for="input-medicines-stock-quantity">Quantity*</label>
  <input type="number" name="quantity" id="input-medicines-stock-quantity" class="form-control " placeholder="Enter Quantity " value="<?php echo null!==($medicinesStockEdit->getQuantity())?($medicinesStockEdit->getQuantity()):(isset($defaultValues['quantity'])?($defaultValues['quantity']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock-amount">

                 <?php
                  $readonly = in_array('amount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['amount']=$medicinesStockEdit->getAmount();};
                  ?>
                  <label for="input-medicines-stock-amount">Amount*</label>
  <input type="text" name="amount" id="input-medicines-stock-amount" class="form-control " placeholder="Enter Amount " value="<?php echo null!==($medicinesStockEdit->getAmount())?($medicinesStockEdit->getAmount()):(isset($defaultValues['amount'])?($defaultValues['amount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
