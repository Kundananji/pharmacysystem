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
$ID = isset($_GET['ID'])?filter_var($_GET['ID'], FILTER_VALIDATE_INT):null;
$medicinesStockEdit = new MedicinesStock();
$medicinesStockEditDao = new MedicinesStockDao();
if(isset($ID)){
  $tempObject = $medicinesStockEditDao->select($ID);
  if($tempObject !=null){
    $medicinesStockEdit = $tempObject;
  }
}
?>
<form onsubmit = "MedicinesStock.submitFormMedicinesStock(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-medicines-stock">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="iD" id="input-medicines-stock--i-d" value="<?php echo null!==($medicinesStockEdit->getID())?($medicinesStockEdit->getID()):(isset($defaultValues['ID'])?($defaultValues['ID']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-medicines-stock--n-a-m-e">

                 <?php
                  $readonly = in_array('NAME',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getID()!=null){ $defaultValues['NAME']=$medicinesStockEdit->getNAME();};
                  ?>
                  <label for="input-medicines-stock--n-a-m-e">&nbsp;N&nbsp;A&nbsp;M&nbsp;E*</label>
  <input type="text" name="nAME" id="input-medicines-stock--n-a-m-e" class="form-control " placeholder="Enter &nbsp;N&nbsp;A&nbsp;M&nbsp;E " value="<?php echo null!==($medicinesStockEdit->getNAME())?($medicinesStockEdit->getNAME()):(isset($defaultValues['NAME'])?($defaultValues['NAME']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock--b-a-t-c-h--i-d">

                 <?php
                  $readonly = in_array('BATCH_ID',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getID()!=null){ $defaultValues['BATCH_ID']=$medicinesStockEdit->getBatchId();};
                  ?>
                  <label for="input-medicines-stock--b-a-t-c-h--i-d">Batch&nbsp;*</label>
  <input type="text" name="batchId" id="input-medicines-stock--b-a-t-c-h--i-d" class="form-control " placeholder="Enter Batch&nbsp; " value="<?php echo null!==($medicinesStockEdit->getBatchId())?($medicinesStockEdit->getBatchId()):(isset($defaultValues['BATCH_ID'])?($defaultValues['BATCH_ID']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock--e-x-p-i-r-y--d-a-t-e">

                 <?php
                  $readonly = in_array('expiry_date',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getID()!=null){ $defaultValues['expiry_date']=$medicinesStockEdit->getExpiryDate();};
                  ?>
                  <label for="input-medicines-stock--e-x-p-i-r-y--d-a-t-e">Expiry&nbsp;Date*</label>
  <input type="text" name="expiryDate" id="input-medicines-stock--e-x-p-i-r-y--d-a-t-e" class="form-control " placeholder="Enter Expiry&nbsp;Date " value="<?php echo null!==($medicinesStockEdit->getExpiryDate())?($medicinesStockEdit->getExpiryDate()):(isset($defaultValues['expiry_date'])?($defaultValues['expiry_date']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock--q-u-a-n-t-i-t-y">

                 <?php
                  $readonly = in_array('quantity',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getID()!=null){ $defaultValues['quantity']=$medicinesStockEdit->getquantity();};
                  ?>
                  <label for="input-medicines-stock--q-u-a-n-t-i-t-y">&nbsp;Q&nbsp;U&nbsp;A&nbsp;N&nbsp;T&nbsp;I&nbsp;T&nbsp;Y*</label>
  <input type="number" name="quantity" id="input-medicines-stock--q-u-a-n-t-i-t-y" class="form-control " placeholder="Enter &nbsp;Q&nbsp;U&nbsp;A&nbsp;N&nbsp;T&nbsp;I&nbsp;T&nbsp;Y " value="<?php echo null!==($medicinesStockEdit->getquantity())?($medicinesStockEdit->getquantity()):(isset($defaultValues['quantity'])?($defaultValues['quantity']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock--m-r-p">

                 <?php
                  $readonly = in_array('MRP',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getID()!=null){ $defaultValues['MRP']=$medicinesStockEdit->getMRP();};
                  ?>
                  <label for="input-medicines-stock--m-r-p">&nbsp;M&nbsp;R&nbsp;P*</label>
  <input type="text" name="mRP" id="input-medicines-stock--m-r-p" class="form-control " placeholder="Enter &nbsp;M&nbsp;R&nbsp;P " value="<?php echo null!==($medicinesStockEdit->getMRP())?($medicinesStockEdit->getMRP()):(isset($defaultValues['MRP'])?($defaultValues['MRP']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-medicines-stock--r-a-t-e">

                 <?php
                  $readonly = in_array('RATE',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($medicinesStockEdit->getID()!=null){ $defaultValues['RATE']=$medicinesStockEdit->getRATE();};
                  ?>
                  <label for="input-medicines-stock--r-a-t-e">&nbsp;R&nbsp;A&nbsp;T&nbsp;E*</label>
  <input type="text" name="rATE" id="input-medicines-stock--r-a-t-e" class="form-control " placeholder="Enter &nbsp;R&nbsp;A&nbsp;T&nbsp;E " value="<?php echo null!==($medicinesStockEdit->getRATE())?($medicinesStockEdit->getRATE()):(isset($defaultValues['RATE'])?($defaultValues['RATE']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
