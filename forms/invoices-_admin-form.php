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
//Get database connection
include("../config/database.php");
?>
<?php
$arguments = array(); //store arguments for later use
foreach($_GET as $key=>$value){
  $arguments[]="$key:'".$value."'";
  //put arguments in scope
  $$key = $value;
}



 if($_SESSION['user_profile'] == 'Admin'){
  $uneditableFields=array();
}
?> 
<?php
//include scripts
include_once("../classes/invoices.php");
include_once("../daos/invoices-dao.php");
$invoice_id = isset($_GET['invoice_id'])?filter_var($_GET['invoice_id'], FILTER_VALIDATE_INT):null;
$invoicesEdit = new Invoices();
$invoicesEditDao = new InvoicesDao();
if(isset($invoice_id)){
  $tempObject = $invoicesEditDao->select($invoice_id);
  if($tempObject !=null){
    $invoicesEdit = $tempObject;
  }
}
?>
<form onsubmit = "Invoices.submitFormInvoices_admin(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-invoices">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

<?php
  $readonly = in_array('invoice_id',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['invoice_id']=$invoicesEdit->getInvoiceId();};
?>
  <input type="hidden" name="invoiceId" id="input-invoices-invoice-id" value="<?php echo (isset($defaultValues['invoice_id'])?($defaultValues['invoice_id']): "0");?>"/>
<?php
  $readonly = in_array('feeId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['feeId']=$invoicesEdit->getFeeId();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-fee-id">
  <label for="input-invoices-fee-id">Fee</label>
  <input type="number" name="feeId" id="input-invoices-fee-id" class="form-control " placeholder="Enter Fee " value="<?php echo (isset($defaultValues['feeId'])?($defaultValues['feeId']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('medicineId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['medicineId']=$invoicesEdit->getMedicineId();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-medicine-id">
  <label for="input-invoices-medicine-id">Medicine</label>
  <input type="number" name="medicineId" id="input-invoices-medicine-id" class="form-control " placeholder="Enter Medicine " value="<?php echo (isset($defaultValues['medicineId'])?($defaultValues['medicineId']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('item',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['item']=$invoicesEdit->getItem();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-item">
  <label for="input-invoices-item">Item*</label>
  <input type="text" name="item" id="input-invoices-item" class="form-control " placeholder="Enter Item* " value="<?php echo (isset($defaultValues['item'])?($defaultValues['item']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('description',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['description']=$invoicesEdit->getDescription();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-description">
  <label for="input-invoices-description">Description*</label>
  <textarea rows="5" name="description" id="input-invoices-description" class="form-control " placeholder="Enter Description* " required<?php echo $readonly;?>   ><?php echo (isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->
<?php
  $readonly = in_array('unitPrice',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['unitPrice']=$invoicesEdit->getUnitPrice();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-unit-price">
  <label for="input-invoices-unit-price">Unit&nbsp;Price*</label>
  <input type="number" step="any" name="unitPrice" id="input-invoices-unit-price" class="form-control " placeholder="Enter Unit&nbsp;Price* " value="<?php echo (isset($defaultValues['unitPrice'])?($defaultValues['unitPrice']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('quantity',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['quantity']=$invoicesEdit->getQuantity();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-quantity">
  <label for="input-invoices-quantity">Quantity*</label>
  <input type="number" name="quantity" id="input-invoices-quantity" class="form-control " placeholder="Enter Quantity* " value="<?php echo (isset($defaultValues['quantity'])?($defaultValues['quantity']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('net_total',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['net_total']=$invoicesEdit->getNetTotal();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-net-total">
  <label for="input-invoices-net-total">Net&nbsp;Total*</label>
  <input type="text" name="netTotal" id="input-invoices-net-total" class="form-control " placeholder="Enter Net&nbsp;Total* " value="<?php echo (isset($defaultValues['net_total'])?($defaultValues['net_total']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('invoice_date',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['invoice_date']=$invoicesEdit->getInvoiceDate();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-invoice-date">
  <label for="input-invoices-invoice-date">Invoice&nbsp;Date*</label>
  <input type="text" name="invoiceDate" id="input-invoices-invoice-date" class="form-control  datepicker" placeholder="Enter Invoice&nbsp;Date* " value="<?php echo (isset($defaultValues['invoice_date'])?($defaultValues['invoice_date']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('customer_id',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['customer_id']=$invoicesEdit->getCustomerId();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-customer-id">
  <label for="input-invoices-customer-id">Customer&nbsp;</label>
  <input type="number" name="customerId" id="input-invoices-customer-id" class="form-control " placeholder="Enter Customer&nbsp; " value="<?php echo (isset($defaultValues['customer_id'])?($defaultValues['customer_id']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('total_amount',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['total_amount']=$invoicesEdit->getTotalAmount();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-total-amount">
  <label for="input-invoices-total-amount">Total&nbsp;Amount*</label>
  <input type="text" name="totalAmount" id="input-invoices-total-amount" class="form-control " placeholder="Enter Total&nbsp;Amount* " value="<?php echo (isset($defaultValues['total_amount'])?($defaultValues['total_amount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('total_discount',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['total_discount']=$invoicesEdit->getTotalDiscount();};
?>

 <!--start of form group-->
<div class="form-group input-invoices-total-discount">
  <label for="input-invoices-total-discount">Total&nbsp;Discount*</label>
  <input type="text" name="totalDiscount" id="input-invoices-total-discount" class="form-control " placeholder="Enter Total&nbsp;Discount* " value="<?php echo (isset($defaultValues['total_discount'])?($defaultValues['total_discount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
