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
$INVOICE_ID = isset($_GET['INVOICE_ID'])?filter_var($_GET['INVOICE_ID'], FILTER_VALIDATE_INT):null;
$invoicesEdit = new Invoices();
$invoicesEditDao = new InvoicesDao();
if(isset($INVOICE_ID)){
  $tempObject = $invoicesEditDao->select($INVOICE_ID);
  if($tempObject !=null){
    $invoicesEdit = $tempObject;
  }
}
?>
<form onsubmit = "Invoices.submitFormInvoices(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-invoices">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="invoiceId" id="input-invoices--i-n-v-o-i-c-e--i-d" value="<?php echo null!==($invoicesEdit->getInvoiceId())?($invoicesEdit->getInvoiceId()):(isset($defaultValues['INVOICE_ID'])?($defaultValues['INVOICE_ID']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-invoices--n-e-t--t-o-t-a-l">

                 <?php
                  $readonly = in_array('NET_TOTAL',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['NET_TOTAL']=$invoicesEdit->getNetTotal();};
                  ?>
                  <label for="input-invoices--n-e-t--t-o-t-a-l">Net&nbsp;Total*</label>
  <input type="text" name="netTotal" id="input-invoices--n-e-t--t-o-t-a-l" class="form-control " placeholder="Enter Net&nbsp;Total " value="<?php echo null!==($invoicesEdit->getNetTotal())?($invoicesEdit->getNetTotal()):(isset($defaultValues['NET_TOTAL'])?($defaultValues['NET_TOTAL']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoices--i-n-v-o-i-c-e--d-a-t-e">

                 <?php
                  $readonly = in_array('INVOICE_DATE',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['INVOICE_DATE']=$invoicesEdit->getInvoiceDate();};
                  ?>
                  <label for="input-invoices--i-n-v-o-i-c-e--d-a-t-e">Invoice&nbsp;Date*</label>
  <input type="text" name="invoiceDate" id="input-invoices--i-n-v-o-i-c-e--d-a-t-e" class="form-control datepicker " placeholder="Enter Invoice&nbsp;Date " value="<?php echo null!==($invoicesEdit->getInvoiceDate()))?(date("d/m/Y",strtotime($invoicesEdit->getInvoiceDate()))):(isset($defaultValues['INVOICE_DATE'])?($defaultValues['INVOICE_DATE']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoices--c-u-s-t-o-m-e-r--i-d">

                 <?php
                  $readonly = in_array('CUSTOMER_ID',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['CUSTOMER_ID']=$invoicesEdit->getCustomerId();};
                  ?>
                  <label for="input-invoices--c-u-s-t-o-m-e-r--i-d">Customer&nbsp;*</label>
  <input type="number" name="customerId" id="input-invoices--c-u-s-t-o-m-e-r--i-d" class="form-control " placeholder="Enter Customer&nbsp; " value="<?php echo null!==($invoicesEdit->getCustomerId())?($invoicesEdit->getCustomerId()):(isset($defaultValues['CUSTOMER_ID'])?($defaultValues['CUSTOMER_ID']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoices--t-o-t-a-l--a-m-o-u-n-t">

                 <?php
                  $readonly = in_array('TOTAL_AMOUNT',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['TOTAL_AMOUNT']=$invoicesEdit->getTotalAmount();};
                  ?>
                  <label for="input-invoices--t-o-t-a-l--a-m-o-u-n-t">Total&nbsp;Amount*</label>
  <input type="text" name="totalAmount" id="input-invoices--t-o-t-a-l--a-m-o-u-n-t" class="form-control " placeholder="Enter Total&nbsp;Amount " value="<?php echo null!==($invoicesEdit->getTotalAmount())?($invoicesEdit->getTotalAmount()):(isset($defaultValues['TOTAL_AMOUNT'])?($defaultValues['TOTAL_AMOUNT']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoices--t-o-t-a-l--d-i-s-c-o-u-n-t">

                 <?php
                  $readonly = in_array('TOTAL_DISCOUNT',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoicesEdit->getInvoiceId()!=null){ $defaultValues['TOTAL_DISCOUNT']=$invoicesEdit->getTotalDiscount();};
                  ?>
                  <label for="input-invoices--t-o-t-a-l--d-i-s-c-o-u-n-t">Total&nbsp;Discount*</label>
  <input type="text" name="totalDiscount" id="input-invoices--t-o-t-a-l--d-i-s-c-o-u-n-t" class="form-control " placeholder="Enter Total&nbsp;Discount " value="<?php echo null!==($invoicesEdit->getTotalDiscount())?($invoicesEdit->getTotalDiscount()):(isset($defaultValues['TOTAL_DISCOUNT'])?($defaultValues['TOTAL_DISCOUNT']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
