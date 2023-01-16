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
include_once("../classes/receipt-detail.php");
include_once("../daos/receipt-detail-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$receiptDetailEdit = new ReceiptDetail();
$receiptDetailEditDao = new ReceiptDetailDao();
if(isset($id)){
  $tempObject = $receiptDetailEditDao->select($id);
  if($tempObject !=null){
    $receiptDetailEdit = $tempObject;
  }
}
?>
<form onsubmit = "ReceiptDetail.submitFormReceiptDetail(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-receipt-detail">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-receipt-detail-id" value="<?php echo null!==($receiptDetailEdit->getId())?($receiptDetailEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-receipt-detail-receipt-id">

                 <?php
                  $readonly = in_array('receiptId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['receiptId']=$receiptDetailEdit->getReceiptId();};
                  ?>
                  <label for="input-receipt-detail-receipt-id">Receipt*</label>
  <?php 
    include_once("../classes/receipt.php");
    include_once("../daos/receipt-dao.php");

    $receiptDao = new ReceiptDao(); 
    $objects = $receiptDao->selectAll(); 
    ?>
    <select name="receiptId" id="input-receipt-detail-receipt-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Receipt--</option>
      <?php
        foreach($objects as $receipt){
          $optionValue  = $receipt->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['receiptId']) && $defaultValues['receiptId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['receiptId']) && $defaultValues['receiptId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['receiptId']) && $defaultValues['receiptId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$receipt->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-detail-item">

                 <?php
                  $readonly = in_array('item',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['item']=$receiptDetailEdit->getItem();};
                  ?>
                  <label for="input-receipt-detail-item">Item*</label>
  <input type="number" name="item" id="input-receipt-detail-item" class="form-control " placeholder="Enter Item " value="<?php echo null!==($receiptDetailEdit->getItem())?($receiptDetailEdit->getItem()):(isset($defaultValues['item'])?($defaultValues['item']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-detail-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['description']=$receiptDetailEdit->getDescription();};
                  ?>
                  <label for="input-receipt-detail-description">Description*</label>
  <input type="number" name="description" id="input-receipt-detail-description" class="form-control " placeholder="Enter Description " value="<?php echo null!==($receiptDetailEdit->getDescription())?($receiptDetailEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-detail-quantity">

                 <?php
                  $readonly = in_array('quantity',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['quantity']=$receiptDetailEdit->getQuantity();};
                  ?>
                  <label for="input-receipt-detail-quantity">Quantity*</label>
  <input type="number" name="quantity" id="input-receipt-detail-quantity" class="form-control " placeholder="Enter Quantity " value="<?php echo null!==($receiptDetailEdit->getQuantity())?($receiptDetailEdit->getQuantity()):(isset($defaultValues['quantity'])?($defaultValues['quantity']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-detail-unit-price">

                 <?php
                  $readonly = in_array('unitPrice',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['unitPrice']=$receiptDetailEdit->getUnitPrice();};
                  ?>
                  <label for="input-receipt-detail-unit-price">Unit&nbsp;Price*</label>
  <input type="number" step="any" name="unitPrice" id="input-receipt-detail-unit-price" class="form-control " placeholder="Enter Unit&nbsp;Price " value="<?php echo null!==($receiptDetailEdit->getUnitPrice())?($receiptDetailEdit->getUnitPrice()):(isset($defaultValues['unitPrice'])?($defaultValues['unitPrice']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-detail-total-amount">

                 <?php
                  $readonly = in_array('totalAmount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['totalAmount']=$receiptDetailEdit->getTotalAmount();};
                  ?>
                  <label for="input-receipt-detail-total-amount">Total&nbsp;Amount*</label>
  <input type="number" step="any" name="totalAmount" id="input-receipt-detail-total-amount" class="form-control " placeholder="Enter Total&nbsp;Amount " value="<?php echo null!==($receiptDetailEdit->getTotalAmount())?($receiptDetailEdit->getTotalAmount()):(isset($defaultValues['totalAmount'])?($defaultValues['totalAmount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-detail-invoice-detail-id">

                 <?php
                  $readonly = in_array('invoiceDetailId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['invoiceDetailId']=$receiptDetailEdit->getInvoiceDetailId();};
                  ?>
                  <label for="input-receipt-detail-invoice-detail-id">Invoice&nbsp;Detail</label>
  <?php 
    include_once("../classes/invoice-detail.php");
    include_once("../daos/invoice-detail-dao.php");

    $invoiceDetailDao = new InvoiceDetailDao(); 
    $objects = $invoiceDetailDao->selectAll(); 
    ?>
    <select name="invoiceDetailId" id="input-receipt-detail-invoice-detail-id" class="form-control "  <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Invoice&nbsp;detail--</option>
      <?php
        foreach($objects as $invoiceDetail){
          $optionValue  = $invoiceDetail->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['invoiceDetailId']) && $defaultValues['invoiceDetailId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['invoiceDetailId']) && $defaultValues['invoiceDetailId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['invoiceDetailId']) && $defaultValues['invoiceDetailId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$invoiceDetail->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-detail-fee-id">

                 <?php
                  $readonly = in_array('feeId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['feeId']=$receiptDetailEdit->getFeeId();};
                  ?>
                  <label for="input-receipt-detail-fee-id">Fee</label>
  <?php 
    include_once("../classes/fee.php");
    include_once("../daos/fee-dao.php");

    $feeDao = new FeeDao(); 
    $objects = $feeDao->selectAll(); 
    ?>
    <select name="feeId" id="input-receipt-detail-fee-id" class="form-control "  <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Fee--</option>
      <?php
        foreach($objects as $fee){
          $optionValue  = $fee->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['feeId']) && $defaultValues['feeId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['feeId']) && $defaultValues['feeId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['feeId']) && $defaultValues['feeId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$fee->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-detail-medicine-id">

                 <?php
                  $readonly = in_array('medicineId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['medicineId']=$receiptDetailEdit->getMedicineId();};
                  ?>
                  <label for="input-receipt-detail-medicine-id">Medicine</label>
  <?php 
    include_once("../classes/medicines.php");
    include_once("../daos/medicines-dao.php");

    $medicinesDao = new MedicinesDao(); 
    $objects = $medicinesDao->selectAll(); 
    ?>
    <select name="medicineId" id="input-receipt-detail-medicine-id" class="form-control "  <?php echo $readonly;?> >
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
<div class="form-group input-receipt-detail-discount">

                 <?php
                  $readonly = in_array('discount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptDetailEdit->getId()!=null){ $defaultValues['discount']=$receiptDetailEdit->getDiscount();};
                  ?>
                  <label for="input-receipt-detail-discount">Discount</label>
  <input type="number" step="any" name="discount" id="input-receipt-detail-discount" class="form-control " placeholder="Enter Discount " value="<?php echo null!==($receiptDetailEdit->getDiscount())?($receiptDetailEdit->getDiscount()):(isset($defaultValues['discount'])?($defaultValues['discount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
