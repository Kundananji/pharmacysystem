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
include_once("../classes/invoice-detail.php");
include_once("../daos/invoice-detail-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$invoiceDetailEdit = new InvoiceDetail();
$invoiceDetailEditDao = new InvoiceDetailDao();
if(isset($id)){
  $tempObject = $invoiceDetailEditDao->select($id);
  if($tempObject !=null){
    $invoiceDetailEdit = $tempObject;
  }
}
?>
<form onsubmit = "InvoiceDetail.submitFormInvoiceDetail(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-invoice-detail">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-invoice-detail-id" value="<?php echo null!==($invoiceDetailEdit->getId())?($invoiceDetailEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-invoice-detail-invoice-id">

                 <?php
                  $readonly = in_array('invoiceId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceDetailEdit->getId()!=null){ $defaultValues['invoiceId']=$invoiceDetailEdit->getInvoiceId();};
                  ?>
                  <label for="input-invoice-detail-invoice-id">Invoice*</label>
  <?php 
    include_once("../classes/invoice.php");
    include_once("../daos/invoice-dao.php");

    $invoiceDao = new InvoiceDao(); 
    $objects = $invoiceDao->selectAll(); 
    ?>
    <select name="invoiceId" id="input-invoice-detail-invoice-id" class=" form-control" required <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Invoice--</option>
      <?php
        foreach($objects as $invoice){
          $optionValue  = $invoice->getInvoiceId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['invoiceId']) && $defaultValues['invoiceId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['invoiceId']) && $defaultValues['invoiceId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['invoiceId']) && $defaultValues['invoiceId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$invoice->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-detail-fee-id">

                 <?php
                  $readonly = in_array('feeId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceDetailEdit->getId()!=null){ $defaultValues['feeId']=$invoiceDetailEdit->getFeeId();};
                  ?>
                  <label for="input-invoice-detail-fee-id">Fee</label>
  <?php 
    include_once("../classes/fee.php");
    include_once("../daos/fee-dao.php");

    $feeDao = new FeeDao(); 
    $objects = $feeDao->selectAll(); 
    ?>
    <select name="feeId" id="input-invoice-detail-fee-id" class=" form-control"  <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Fee--</option>
      <?php
        foreach($objects as $fee){
          $optionValue  = $fee->getFeeId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['feeId']) && $defaultValues['feeId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['feeId']) && $defaultValues['feeId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['feeId']) && $defaultValues['feeId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$fee->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-detail-medicine-id">

                 <?php
                  $readonly = in_array('medicineId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceDetailEdit->getId()!=null){ $defaultValues['medicineId']=$invoiceDetailEdit->getMedicineId();};
                  ?>
                  <label for="input-invoice-detail-medicine-id">Medicine</label>
  <?php 
    include_once("../classes/medicines.php");
    include_once("../daos/medicines-dao.php");

    $medicinesDao = new MedicinesDao(); 
    $objects = $medicinesDao->selectAll(); 
    ?>
    <select name="medicineId" id="input-invoice-detail-medicine-id" class=" form-control"  <?php echo $readonly;?>  >
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
<div class="form-group input-invoice-detail-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceDetailEdit->getId()!=null){ $defaultValues['description']=$invoiceDetailEdit->getDescription();};
                  ?>
                  <label for="input-invoice-detail-description">Description</label>
  <textarea rows="5" name="description" id="input-invoice-detail-description" class="form-control " placeholder="Enter Description " <?php echo $readonly;?>   ><?php echo null!==($invoiceDetailEdit->getDescription())?($invoiceDetailEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-detail-unit-price">

                 <?php
                  $readonly = in_array('unitPrice',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceDetailEdit->getId()!=null){ $defaultValues['unitPrice']=$invoiceDetailEdit->getUnitPrice();};
                  ?>
                  <label for="input-invoice-detail-unit-price">Unit&nbsp;Price</label>
  <input type="number" step="any" name="unitPrice" id="input-invoice-detail-unit-price" class="form-control " placeholder="Enter Unit&nbsp;Price " value="<?php echo null!==($invoiceDetailEdit->getUnitPrice())?($invoiceDetailEdit->getUnitPrice()):(isset($defaultValues['unitPrice'])?($defaultValues['unitPrice']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-detail-quantity">

                 <?php
                  $readonly = in_array('quantity',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceDetailEdit->getId()!=null){ $defaultValues['quantity']=$invoiceDetailEdit->getQuantity();};
                  ?>
                  <label for="input-invoice-detail-quantity">Quantity*</label>
  <input type="number" name="quantity" id="input-invoice-detail-quantity" class="form-control " placeholder="Enter Quantity " value="<?php echo null!==($invoiceDetailEdit->getQuantity())?($invoiceDetailEdit->getQuantity()):(isset($defaultValues['quantity'])?($defaultValues['quantity']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-detail-discount">

                 <?php
                  $readonly = in_array('discount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceDetailEdit->getId()!=null){ $defaultValues['discount']=$invoiceDetailEdit->getDiscount();};
                  ?>
                  <label for="input-invoice-detail-discount">Discount</label>
  <input type="number" step="any" name="discount" id="input-invoice-detail-discount" class="form-control " placeholder="Enter Discount " value="<?php echo null!==($invoiceDetailEdit->getDiscount())?($invoiceDetailEdit->getDiscount()):(isset($defaultValues['discount'])?($defaultValues['discount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-detail-total-amount">

                 <?php
                  $readonly = in_array('totalAmount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceDetailEdit->getId()!=null){ $defaultValues['totalAmount']=$invoiceDetailEdit->getTotalAmount();};
                  ?>
                  <label for="input-invoice-detail-total-amount">Total&nbsp;Amount</label>
  <input type="text" name="totalAmount" id="input-invoice-detail-total-amount" class="form-control " placeholder="Enter Total&nbsp;Amount " value="<?php echo null!==($invoiceDetailEdit->getTotalAmount())?($invoiceDetailEdit->getTotalAmount()):(isset($defaultValues['totalAmount'])?($defaultValues['totalAmount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
