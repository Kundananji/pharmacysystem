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
include_once("../classes/purchases.php");
include_once("../daos/purchases-dao.php");
$arguments=array();$voucher_number = isset($_GET['voucher_number'])?filter_var($_GET['voucher_number'], FILTER_VALIDATE_INT):null;
$purchasesEdit = new Purchases();
$purchasesEditDao = new PurchasesDao();
if(isset($voucher_number)){
  $tempObject = $purchasesEditDao->select($voucher_number);
  if($tempObject !=null){
    $purchasesEdit = $tempObject;
  }
}
?>
<form onsubmit = "Purchases.submitFormPurchases(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-purchases">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>


 <!--start of form group-->
<div class="form-group input-purchases-supplier-name">

                 <?php
                  $readonly = in_array('supplier_name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['supplier_name']=$purchasesEdit->getSupplierName();};
                  ?>
                  <label for="input-purchases-supplier-name">Supplier&nbsp;Name*</label>
  <input type="text" name="supplierName" id="input-purchases-supplier-name" class="form-control " placeholder="Enter Supplier&nbsp;Name " value="<?php echo null!==($purchasesEdit->getSupplierName())?($purchasesEdit->getSupplierName()):(isset($defaultValues['supplier_name'])?($defaultValues['supplier_name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-purchases-invoice-number">

                 <?php
                  $readonly = in_array('invoice_number',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['invoice_number']=$purchasesEdit->getInvoiceNumber();};
                  ?>
                  <label for="input-purchases-invoice-number">Invoice&nbsp;Number*</label>
  <input type="number" name="invoiceNumber" id="input-purchases-invoice-number" class="form-control " placeholder="Enter Invoice&nbsp;Number " value="<?php echo null!==($purchasesEdit->getInvoiceNumber())?($purchasesEdit->getInvoiceNumber()):(isset($defaultValues['invoice_number'])?($defaultValues['invoice_number']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
  <input type="hidden" name="voucherNumber" id="input-purchases-voucher-number" value="<?php echo null!==($purchasesEdit->getVoucherNumber())?($purchasesEdit->getVoucherNumber()):(isset($defaultValues['voucher_number'])?($defaultValues['voucher_number']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-purchases-purchase-date">

                 <?php
                  $readonly = in_array('purchase_date',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['purchase_date']=$purchasesEdit->getPurchaseDate();};
                  ?>
                  <label for="input-purchases-purchase-date">Purchase&nbsp;Date*</label>
  <input type="text" name="purchaseDate" id="input-purchases-purchase-date" class="form-control " placeholder="Enter Purchase&nbsp;Date " value="<?php echo null!==($purchasesEdit->getPurchaseDate())?($purchasesEdit->getPurchaseDate()):(isset($defaultValues['purchase_date'])?($defaultValues['purchase_date']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-purchases-total-amount">

                 <?php
                  $readonly = in_array('total_amount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['total_amount']=$purchasesEdit->getTotalAmount();};
                  ?>
                  <label for="input-purchases-total-amount">Total&nbsp;Amount*</label>
  <input type="text" name="totalAmount" id="input-purchases-total-amount" class="form-control " placeholder="Enter Total&nbsp;Amount " value="<?php echo null!==($purchasesEdit->getTotalAmount())?($purchasesEdit->getTotalAmount()):(isset($defaultValues['total_amount'])?($defaultValues['total_amount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-purchases-payment-status">

                 <?php
                  $readonly = in_array('payment_status',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['payment_status']=$purchasesEdit->getPaymentStatus();};
                  ?>
                  <label for="input-purchases-payment-status">Payment&nbsp;Status*</label>
  <input type="text" name="paymentStatus" id="input-purchases-payment-status" class="form-control " placeholder="Enter Payment&nbsp;Status " value="<?php echo null!==($purchasesEdit->getPaymentStatus())?($purchasesEdit->getPaymentStatus()):(isset($defaultValues['payment_status'])?($defaultValues['payment_status']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
