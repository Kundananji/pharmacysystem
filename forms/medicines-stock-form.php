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
include_once("../classes/medicines-stock.php");
include_once("../daos/medicines-stock-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
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
<div class="form-group input-medicines-stock-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['name']=$medicinesStockEdit->getName();};
                  ?>
                  <label for="input-medicines-stock-name">Name*</label>
  <input type="text" name="name" id="input-medicines-stock-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($medicinesStockEdit->getName())?($medicinesStockEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock-batch-id">

                 <?php
                  $readonly = in_array('batch_id',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['batch_id']=$medicinesStockEdit->getBatchId();};
                  ?>
                  <label for="input-medicines-stock-batch-id">Batch&nbsp;*</label>
  <input type="text" name="batchId" id="input-medicines-stock-batch-id" class="form-control " placeholder="Enter Batch&nbsp; " value="<?php echo null!==($medicinesStockEdit->getBatchId())?($medicinesStockEdit->getBatchId()):(isset($defaultValues['batch_id'])?($defaultValues['batch_id']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock-expiry-date">

                 <?php
                  $readonly = in_array('expiry_date',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['expiry_date']=$medicinesStockEdit->getExpiryDate();};
                  ?>
                  <label for="input-medicines-stock-expiry-date">Expiry&nbsp;Date*</label>
  <input type="text" name="expiryDate" id="input-medicines-stock-expiry-date" class="form-control " placeholder="Enter Expiry&nbsp;Date " value="<?php echo null!==($medicinesStockEdit->getExpiryDate())?($medicinesStockEdit->getExpiryDate()):(isset($defaultValues['expiry_date'])?($defaultValues['expiry_date']): "");?>" required <?php echo $readonly;?>   />
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
<div class="form-group input-medicines-stock-mrp">

                 <?php
                  $readonly = in_array('mrp',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['mrp']=$medicinesStockEdit->getMrp();};
                  ?>
                  <label for="input-medicines-stock-mrp">Mrp*</label>
  <input type="text" name="mrp" id="input-medicines-stock-mrp" class="form-control " placeholder="Enter Mrp " value="<?php echo null!==($medicinesStockEdit->getMrp())?($medicinesStockEdit->getMrp()):(isset($defaultValues['mrp'])?($defaultValues['mrp']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock-rate">

                 <?php
                  $readonly = in_array('rate',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getId()!=null){ $defaultValues['rate']=$medicinesStockEdit->getRate();};
                  ?>
                  <label for="input-medicines-stock-rate">Rate*</label>
  <input type="text" name="rate" id="input-medicines-stock-rate" class="form-control " placeholder="Enter Rate " value="<?php echo null!==($medicinesStockEdit->getRate())?($medicinesStockEdit->getRate()):(isset($defaultValues['rate'])?($defaultValues['rate']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
