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
include_once("../classes/sales.php");
include_once("../daos/sales-dao.php");
$ = isset($_GET[''])?filter_var($_GET[''], FILTER_VALIDATE_INT):null;
$salesEdit = new Sales();
$salesEditDao = new SalesDao();
if(isset($)){
  $tempObject = $salesEditDao->select($);
  if($tempObject !=null){
    $salesEdit = $tempObject;
  }
}
?>
<form onsubmit = "Sales.submitFormSales(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-sales">


 <!--start of form group-->
<div class="form-group input-sales-customer-id">

                 <?php
                  $readonly = in_array('customer_id',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['customer_id']=$salesEdit->getCustomerId();};
                  ?>
                  <label for="input-sales-customer-id">Customer&nbsp;*</label>
  <input type="number" name="customerId" id="input-sales-customer-id" class="form-control " placeholder="Enter Customer&nbsp; " value="<?php echo null!==($salesEdit->getCustomerId())?($salesEdit->getCustomerId()):(isset($defaultValues['customer_id'])?($defaultValues['customer_id']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales-invoice-number">

                 <?php
                  $readonly = in_array('invoice_number',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['invoice_number']=$salesEdit->getInvoiceNumber();};
                  ?>
                  <label for="input-sales-invoice-number">Invoice&nbsp;Number</label>
  <input type="text" name="invoiceNumber" id="input-sales-invoice-number" class="form-control " placeholder="Enter Invoice&nbsp;Number " value="<?php echo null!==($salesEdit->getInvoiceNumber())?($salesEdit->getInvoiceNumber()):(isset($defaultValues['invoice_number'])?($defaultValues['invoice_number']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales-medicine-name">

                 <?php
                  $readonly = in_array('medicine_name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['medicine_name']=$salesEdit->getMedicineName();};
                  ?>
                  <label for="input-sales-medicine-name">Medicine&nbsp;Name</label>
  <input type="text" name="medicineName" id="input-sales-medicine-name" class="form-control " placeholder="Enter Medicine&nbsp;Name " value="<?php echo null!==($salesEdit->getMedicineName())?($salesEdit->getMedicineName()):(isset($defaultValues['medicine_name'])?($defaultValues['medicine_name']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales-batch-id">

                 <?php
                  $readonly = in_array('batch_id',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['batch_id']=$salesEdit->getBatchId();};
                  ?>
                  <label for="input-sales-batch-id">Batch&nbsp;</label>
  <input type="text" name="batchId" id="input-sales-batch-id" class="form-control " placeholder="Enter Batch&nbsp; " value="<?php echo null!==($salesEdit->getBatchId())?($salesEdit->getBatchId()):(isset($defaultValues['batch_id'])?($defaultValues['batch_id']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales-expiry-date">

                 <?php
                  $readonly = in_array('expiry_date',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['expiry_date']=$salesEdit->getExpiryDate();};
                  ?>
                  <label for="input-sales-expiry-date">Expiry&nbsp;Date</label>
  <input type="text" name="expiryDate" id="input-sales-expiry-date" class="form-control " placeholder="Enter Expiry&nbsp;Date " value="<?php echo null!==($salesEdit->getExpiryDate())?($salesEdit->getExpiryDate()):(isset($defaultValues['expiry_date'])?($defaultValues['expiry_date']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales-quantity">

                 <?php
                  $readonly = in_array('quantity',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['quantity']=$salesEdit->getQuantity();};
                  ?>
                  <label for="input-sales-quantity">Quantity</label>
  <input type="number" name="quantity" id="input-sales-quantity" class="form-control " placeholder="Enter Quantity " value="<?php echo null!==($salesEdit->getQuantity())?($salesEdit->getQuantity()):(isset($defaultValues['quantity'])?($defaultValues['quantity']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales-mrp">

                 <?php
                  $readonly = in_array('mrp',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['mrp']=$salesEdit->getMrp();};
                  ?>
                  <label for="input-sales-mrp">Mrp</label>
  <input type="text" name="mrp" id="input-sales-mrp" class="form-control " placeholder="Enter Mrp " value="<?php echo null!==($salesEdit->getMrp())?($salesEdit->getMrp()):(isset($defaultValues['mrp'])?($defaultValues['mrp']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales-discount">

                 <?php
                  $readonly = in_array('discount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['discount']=$salesEdit->getDiscount();};
                  ?>
                  <label for="input-sales-discount">Discount</label>
  <input type="number" step="any" name="discount" id="input-sales-discount" class="form-control " placeholder="Enter Discount " value="<?php echo null!==($salesEdit->getDiscount())?($salesEdit->getDiscount()):(isset($defaultValues['discount'])?($defaultValues['discount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales-total">

                 <?php
                  $readonly = in_array('total',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['total']=$salesEdit->getTotal();};
                  ?>
                  <label for="input-sales-total">Total</label>
  <input type="number" step="any" name="total" id="input-sales-total" class="form-control " placeholder="Enter Total " value="<?php echo null!==($salesEdit->getTotal())?($salesEdit->getTotal()):(isset($defaultValues['total'])?($defaultValues['total']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
