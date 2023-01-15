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
<form onsubmit = "Invoices.submitFormInvoices(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-invoices">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="invoiceId" id="input-invoices--i-n-v-o-i-c-e--i-d" value="<?php echo null!==($invoicesEdit->getInvoiceId())?($invoicesEdit->getInvoiceId()):(isset($defaultValues['invoice_id'])?($defaultValues['invoice_id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-invoices--n-e-t--t-o-t-a-l">

                 <?php
                  $readonly = in_array('net_total',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['net_total']=$invoicesEdit->getNetTotal();};
                  ?>
                  <label for="input-invoices--n-e-t--t-o-t-a-l">Net&nbsp;Total*</label>
  <input type="text" name="netTotal" id="input-invoices--n-e-t--t-o-t-a-l" class="form-control " placeholder="Enter Net&nbsp;Total " value="<?php echo null!==($invoicesEdit->getNetTotal())?($invoicesEdit->getNetTotal()):(isset($defaultValues['net_total'])?($defaultValues['net_total']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoices--i-n-v-o-i-c-e--d-a-t-e">

                 <?php
                  $readonly = in_array('invoice_date',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['invoice_date']=$invoicesEdit->getInvoiceDate();};
                  ?>
                  <label for="input-invoices--i-n-v-o-i-c-e--d-a-t-e">Invoice&nbsp;Date*</label>
  <input type="text" name="invoiceDate" id="input-invoices--i-n-v-o-i-c-e--d-a-t-e" class="form-control datepicker " placeholder="Enter Invoice&nbsp;Date " value="<?php echo null!==($invoicesEdit->getInvoiceDate()))?(date("d/m/Y",strtotime($invoicesEdit->getInvoiceDate()))):(isset($defaultValues['invoice_date'])?($defaultValues['invoice_date']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoices--c-u-s-t-o-m-e-r--i-d">

                 <?php
                  $readonly = in_array('customer_id',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['customer_id']=$invoicesEdit->getCustomerId();};
                  ?>
                  <label for="input-invoices--c-u-s-t-o-m-e-r--i-d">Customer&nbsp;*</label>
  <input type="number" name="customerId" id="input-invoices--c-u-s-t-o-m-e-r--i-d" class="form-control " placeholder="Enter Customer&nbsp; " value="<?php echo null!==($invoicesEdit->getCustomerId())?($invoicesEdit->getCustomerId()):(isset($defaultValues['customer_id'])?($defaultValues['customer_id']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoices--t-o-t-a-l--a-m-o-u-n-t">

                 <?php
                  $readonly = in_array('total_amount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['total_amount']=$invoicesEdit->getTotalAmount();};
                  ?>
                  <label for="input-invoices--t-o-t-a-l--a-m-o-u-n-t">Total&nbsp;Amount*</label>
  <input type="text" name="totalAmount" id="input-invoices--t-o-t-a-l--a-m-o-u-n-t" class="form-control " placeholder="Enter Total&nbsp;Amount " value="<?php echo null!==($invoicesEdit->getTotalAmount())?($invoicesEdit->getTotalAmount()):(isset($defaultValues['total_amount'])?($defaultValues['total_amount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoices--t-o-t-a-l--d-i-s-c-o-u-n-t">

                 <?php
                  $readonly = in_array('total_discount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['total_discount']=$invoicesEdit->getTotalDiscount();};
                  ?>
                  <label for="input-invoices--t-o-t-a-l--d-i-s-c-o-u-n-t">Total&nbsp;Discount*</label>
  <input type="text" name="totalDiscount" id="input-invoices--t-o-t-a-l--d-i-s-c-o-u-n-t" class="form-control " placeholder="Enter Total&nbsp;Discount " value="<?php echo null!==($invoicesEdit->getTotalDiscount())?($invoicesEdit->getTotalDiscount()):(isset($defaultValues['total_discount'])?($defaultValues['total_discount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
