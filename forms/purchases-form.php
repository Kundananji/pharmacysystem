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
include_once("../classes/purchases.php");
include_once("../daos/purchases-dao.php");
$VOUCHER_NUMBER = isset($_GET['VOUCHER_NUMBER'])?filter_var($_GET['VOUCHER_NUMBER'], FILTER_VALIDATE_INT):null;
$purchasesEdit = new Purchases();
$purchasesEditDao = new PurchasesDao();
if(isset($VOUCHER_NUMBER)){
  $tempObject = $purchasesEditDao->select($VOUCHER_NUMBER);
  if($tempObject !=null){
    $purchasesEdit = $tempObject;
  }
}
?>
<form onsubmit = "Purchases.submitFormPurchases(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-purchases">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>


 <!--start of form group-->
<div class="form-group input-purchases--s-u-p-p-l-i-e-r--n-a-m-e">

                 <?php
                  $readonly = in_array('SUPPLIER_NAME',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['SUPPLIER_NAME']=$purchasesEdit->getSupplierName();};
                  ?>
                  <label for="input-purchases--s-u-p-p-l-i-e-r--n-a-m-e">Supplier&nbsp;Name*</label>
  <input type="text" name="supplierName" id="input-purchases--s-u-p-p-l-i-e-r--n-a-m-e" class="form-control " placeholder="Enter Supplier&nbsp;Name " value="<?php echo null!==($purchasesEdit->getSupplierName())?($purchasesEdit->getSupplierName()):(isset($defaultValues['SUPPLIER_NAME'])?($defaultValues['SUPPLIER_NAME']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-purchases--i-n-v-o-i-c-e--n-u-m-b-e-r">

                 <?php
                  $readonly = in_array('INVOICE_NUMBER',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['INVOICE_NUMBER']=$purchasesEdit->getInvoiceNumber();};
                  ?>
                  <label for="input-purchases--i-n-v-o-i-c-e--n-u-m-b-e-r">Invoice&nbsp;Number*</label>
  <input type="number" name="invoiceNumber" id="input-purchases--i-n-v-o-i-c-e--n-u-m-b-e-r" class="form-control " placeholder="Enter Invoice&nbsp;Number " value="<?php echo null!==($purchasesEdit->getInvoiceNumber())?($purchasesEdit->getInvoiceNumber()):(isset($defaultValues['INVOICE_NUMBER'])?($defaultValues['INVOICE_NUMBER']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
  <input type="hidden" name="voucherNumber" id="input-purchases--v-o-u-c-h-e-r--n-u-m-b-e-r" value="<?php echo null!==($purchasesEdit->getVoucherNumber())?($purchasesEdit->getVoucherNumber()):(isset($defaultValues['VOUCHER_NUMBER'])?($defaultValues['VOUCHER_NUMBER']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-purchases--p-u-r-c-h-a-s-e--d-a-t-e">

                 <?php
                  $readonly = in_array('PURCHASE_DATE',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['PURCHASE_DATE']=$purchasesEdit->getPurchaseDate();};
                  ?>
                  <label for="input-purchases--p-u-r-c-h-a-s-e--d-a-t-e">Purchase&nbsp;Date*</label>
  <input type="text" name="purchaseDate" id="input-purchases--p-u-r-c-h-a-s-e--d-a-t-e" class="form-control " placeholder="Enter Purchase&nbsp;Date " value="<?php echo null!==($purchasesEdit->getPurchaseDate())?($purchasesEdit->getPurchaseDate()):(isset($defaultValues['PURCHASE_DATE'])?($defaultValues['PURCHASE_DATE']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-purchases--t-o-t-a-l--a-m-o-u-n-t">

                 <?php
                  $readonly = in_array('TOTAL_AMOUNT',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['TOTAL_AMOUNT']=$purchasesEdit->getTotalAmount();};
                  ?>
                  <label for="input-purchases--t-o-t-a-l--a-m-o-u-n-t">Total&nbsp;Amount*</label>
  <input type="text" name="totalAmount" id="input-purchases--t-o-t-a-l--a-m-o-u-n-t" class="form-control " placeholder="Enter Total&nbsp;Amount " value="<?php echo null!==($purchasesEdit->getTotalAmount())?($purchasesEdit->getTotalAmount()):(isset($defaultValues['TOTAL_AMOUNT'])?($defaultValues['TOTAL_AMOUNT']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-purchases--p-a-y-m-e-n-t--s-t-a-t-u-s">

                 <?php
                  $readonly = in_array('PAYMENT_STATUS',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($purchasesEdit->getVoucherNumber()!=null){ $defaultValues['PAYMENT_STATUS']=$purchasesEdit->getPaymentStatus();};
                  ?>
                  <label for="input-purchases--p-a-y-m-e-n-t--s-t-a-t-u-s">Payment&nbsp;Status*</label>
  <input type="text" name="paymentStatus" id="input-purchases--p-a-y-m-e-n-t--s-t-a-t-u-s" class="form-control " placeholder="Enter Payment&nbsp;Status " value="<?php echo null!==($purchasesEdit->getPaymentStatus())?($purchasesEdit->getPaymentStatus()):(isset($defaultValues['PAYMENT_STATUS'])?($defaultValues['PAYMENT_STATUS']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
