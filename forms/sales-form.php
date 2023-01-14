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
<div class="form-group input-sales--c-u-s-t-o-m-e-r--i-d">

                 <?php
                  $readonly = in_array('CUSTOMER_ID',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['CUSTOMER_ID']=$salesEdit->getCustomerId();};
                  ?>
                  <label for="input-sales--c-u-s-t-o-m-e-r--i-d">Customer&nbsp;*</label>
  <input type="number" name="customerId" id="input-sales--c-u-s-t-o-m-e-r--i-d" class="form-control " placeholder="Enter Customer&nbsp; " value="<?php echo null!==($salesEdit->getCustomerId())?($salesEdit->getCustomerId()):(isset($defaultValues['CUSTOMER_ID'])?($defaultValues['CUSTOMER_ID']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales--i-n-v-o-i-c-e--n-u-m-b-e-r">

                 <?php
                  $readonly = in_array('INVOICE_NUMBER',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['INVOICE_NUMBER']=$salesEdit->getInvoiceNumber();};
                  ?>
                  <label for="input-sales--i-n-v-o-i-c-e--n-u-m-b-e-r">Invoice&nbsp;Number</label>
  <input type="text" name="invoiceNumber" id="input-sales--i-n-v-o-i-c-e--n-u-m-b-e-r" class="form-control " placeholder="Enter Invoice&nbsp;Number " value="<?php echo null!==($salesEdit->getInvoiceNumber())?($salesEdit->getInvoiceNumber()):(isset($defaultValues['INVOICE_NUMBER'])?($defaultValues['INVOICE_NUMBER']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales--m-e-d-i-c-i-n-e--n-a-m-e">

                 <?php
                  $readonly = in_array('MEDICINE_NAME',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['MEDICINE_NAME']=$salesEdit->getMedicineName();};
                  ?>
                  <label for="input-sales--m-e-d-i-c-i-n-e--n-a-m-e">Medicine&nbsp;Name</label>
  <input type="text" name="medicineName" id="input-sales--m-e-d-i-c-i-n-e--n-a-m-e" class="form-control " placeholder="Enter Medicine&nbsp;Name " value="<?php echo null!==($salesEdit->getMedicineName())?($salesEdit->getMedicineName()):(isset($defaultValues['MEDICINE_NAME'])?($defaultValues['MEDICINE_NAME']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales--b-a-t-c-h--i-d">

                 <?php
                  $readonly = in_array('BATCH_ID',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['BATCH_ID']=$salesEdit->getBatchId();};
                  ?>
                  <label for="input-sales--b-a-t-c-h--i-d">Batch&nbsp;</label>
  <input type="text" name="batchId" id="input-sales--b-a-t-c-h--i-d" class="form-control " placeholder="Enter Batch&nbsp; " value="<?php echo null!==($salesEdit->getBatchId())?($salesEdit->getBatchId()):(isset($defaultValues['BATCH_ID'])?($defaultValues['BATCH_ID']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales--e-x-p-i-r-y--d-a-t-e">

                 <?php
                  $readonly = in_array('EXPIRY_DATE',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['EXPIRY_DATE']=$salesEdit->getExpiryDate();};
                  ?>
                  <label for="input-sales--e-x-p-i-r-y--d-a-t-e">Expiry&nbsp;Date</label>
  <input type="text" name="expiryDate" id="input-sales--e-x-p-i-r-y--d-a-t-e" class="form-control " placeholder="Enter Expiry&nbsp;Date " value="<?php echo null!==($salesEdit->getExpiryDate())?($salesEdit->getExpiryDate()):(isset($defaultValues['EXPIRY_DATE'])?($defaultValues['EXPIRY_DATE']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales--q-u-a-n-t-i-t-y">

                 <?php
                  $readonly = in_array('QUANTITY',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['QUANTITY']=$salesEdit->getQUANTITY();};
                  ?>
                  <label for="input-sales--q-u-a-n-t-i-t-y">&nbsp;Q&nbsp;U&nbsp;A&nbsp;N&nbsp;T&nbsp;I&nbsp;T&nbsp;Y</label>
  <input type="number" name="qUANTITY" id="input-sales--q-u-a-n-t-i-t-y" class="form-control " placeholder="Enter &nbsp;Q&nbsp;U&nbsp;A&nbsp;N&nbsp;T&nbsp;I&nbsp;T&nbsp;Y " value="<?php echo null!==($salesEdit->getQUANTITY())?($salesEdit->getQUANTITY()):(isset($defaultValues['QUANTITY'])?($defaultValues['QUANTITY']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales--m-r-p">

                 <?php
                  $readonly = in_array('MRP',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['MRP']=$salesEdit->getMRP();};
                  ?>
                  <label for="input-sales--m-r-p">&nbsp;M&nbsp;R&nbsp;P</label>
  <input type="text" name="mRP" id="input-sales--m-r-p" class="form-control " placeholder="Enter &nbsp;M&nbsp;R&nbsp;P " value="<?php echo null!==($salesEdit->getMRP())?($salesEdit->getMRP()):(isset($defaultValues['MRP'])?($defaultValues['MRP']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales--d-i-s-c-o-u-n-t">

                 <?php
                  $readonly = in_array('DISCOUNT',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['DISCOUNT']=$salesEdit->getDISCOUNT();};
                  ?>
                  <label for="input-sales--d-i-s-c-o-u-n-t">&nbsp;D&nbsp;I&nbsp;S&nbsp;C&nbsp;O&nbsp;U&nbsp;N&nbsp;T</label>
  <input type="number" step="any" name="dISCOUNT" id="input-sales--d-i-s-c-o-u-n-t" class="form-control " placeholder="Enter &nbsp;D&nbsp;I&nbsp;S&nbsp;C&nbsp;O&nbsp;U&nbsp;N&nbsp;T " value="<?php echo null!==($salesEdit->getDISCOUNT())?($salesEdit->getDISCOUNT()):(isset($defaultValues['DISCOUNT'])?($defaultValues['DISCOUNT']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-sales--t-o-t-a-l">

                 <?php
                  $readonly = in_array('TOTAL',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($salesEdit->get()!=null){ $defaultValues['TOTAL']=$salesEdit->getTOTAL();};
                  ?>
                  <label for="input-sales--t-o-t-a-l">&nbsp;T&nbsp;O&nbsp;T&nbsp;A&nbsp;L</label>
  <input type="number" step="any" name="tOTAL" id="input-sales--t-o-t-a-l" class="form-control " placeholder="Enter &nbsp;T&nbsp;O&nbsp;T&nbsp;A&nbsp;L " value="<?php echo null!==($salesEdit->getTOTAL())?($salesEdit->getTOTAL()):(isset($defaultValues['TOTAL'])?($defaultValues['TOTAL']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
