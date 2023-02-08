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

//make available variables of patients available in scope for use:
if(isset($_GET['patientId']) && $_GET['patientId']!=''){
  include_once("../classes/patients.php");
  include_once("../daos/patients-dao.php");

  $patientsDao = new PatientsDao(); 
  $patients =  $patientsDao->select(filter_var($_GET['patientId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of payment_methods available in scope for use:
if(isset($_GET['paymentMethodId']) && $_GET['paymentMethodId']!=''){
  include_once("../classes/payment-methods.php");
  include_once("../daos/payment-methods-dao.php");

  $paymentMethodsDao = new PaymentMethodsDao(); 
  $paymentMethods =  $paymentMethodsDao->select(filter_var($_GET['paymentMethodId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of invoice available in scope for use:
if(isset($_GET['invoiceId']) && $_GET['invoiceId']!=''){
  include_once("../classes/invoice.php");
  include_once("../daos/invoice-dao.php");

  $invoiceDao = new InvoiceDao(); 
  $invoice =  $invoiceDao->select(filter_var($_GET['invoiceId'],FILTER_SANITIZE_NUMBER_INT)); 
}


 if($_SESSION['user_profile'] == 'Pharamacy User'){
  $uneditableFields=array('invoiceId','receiptDate');
  $defaultValues['receiptDate']=isset($env_dateNow)?$env_dateNow:null;
  $defaultValues['invoiceId']=isset($invoiceId)?$invoiceId:null;
}
?> 
<?php
//include scripts
include_once("../classes/receipt.php");
include_once("../daos/receipt-dao.php");
$arguments=array();$receiptId = isset($_GET['receiptId'])?filter_var($_GET['receiptId'], FILTER_VALIDATE_INT):null;
$receiptEdit = new Receipt();
$receiptEditDao = new ReceiptDao();
if(isset($receiptId)){
  $tempObject = $receiptEditDao->select($receiptId);
  if($tempObject !=null){
    $receiptEdit = $tempObject;
  }
}
?>
<form onsubmit = "Receipt.submitFormReceiptManagereceipts_pharamacyuser(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-receipt">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

<?php
  $readonly = in_array('receiptId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['receiptId']=$receiptEdit->getReceiptId();};
?>
  <input type="hidden" name="receiptId" id="input-receipt-receipt-id" value="<?php echo (isset($defaultValues['receiptId'])?($defaultValues['receiptId']): "0");?>"/>
<?php
  $readonly = in_array('description',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['description']=$receiptEdit->getDescription();};
?>

 <!--start of form group-->
<div class="form-group d-none input-receipt-description">
  <label for="input-receipt-description">Description</label>
  <input type="text" name="description" id="input-receipt-description" class="form-control " placeholder="Enter Description " value="<?php echo (isset($defaultValues['description'])?($defaultValues['description']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('patientId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['patientId']=$receiptEdit->getPatientId();};
?>

 <!--start of form group-->
<div class="form-group d-none input-receipt-patient-id">
  <label for="input-receipt-patient-id">Patient</label>
  <?php 
    include_once("../classes/patients.php");
    include_once("../daos/patients-dao.php");

    $patientsDao = new PatientsDao(); 
    $objects = $patientsDao->selectAll(); 
    ?>
    <select name="patientId" id="input-receipt-patient-id" class=" form-control"  <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Patient--</option>
      <?php
        foreach($objects as $patients){
          $optionValue  = $patients->getPatientId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['patientId']) && $defaultValues['patientId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['patientId']) && $defaultValues['patientId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['patientId']) && $defaultValues['patientId']==$optionValue || $receiptEdit->getPatientId()==$patients->getPatientId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$patients->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<?php
  $readonly = in_array('receiptNo',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['receiptNo']=$receiptEdit->getReceiptNo();};
?>

 <!--start of form group-->
<div class="form-group d-none input-receipt-receipt-no">
  <label for="input-receipt-receipt-no">Receipt&nbsp;No</label>
  <input type="text" name="receiptNo" id="input-receipt-receipt-no" class="form-control " placeholder="Enter Receipt&nbsp;No " value="<?php echo (isset($defaultValues['receiptNo'])?($defaultValues['receiptNo']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('invoiceId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['invoiceId']=$receiptEdit->getInvoiceId();};
?>

 <!--start of form group-->
<div class="form-group input-receipt-invoice-id">
  <label for="input-receipt-invoice-id">Invoice</label>
  <?php 
    include_once("../classes/invoice.php");
    include_once("../daos/invoice-dao.php");

    $invoiceDao = new InvoiceDao(); 
    $objects = $invoiceDao->selectAll(); 
    ?>
    <select name="invoiceId" id="input-receipt-invoice-id" class=" form-control"  <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Invoice--</option>
      <?php
        foreach($objects as $invoice){
          $optionValue  = $invoice->getInvoiceId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['invoiceId']) && $defaultValues['invoiceId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['invoiceId']) && $defaultValues['invoiceId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['invoiceId']) && $defaultValues['invoiceId']==$optionValue || $receiptEdit->getInvoiceId()==$invoice->getInvoiceId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$invoice->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<?php
  $readonly = in_array('receiptDate',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['receiptDate']=$receiptEdit->getReceiptDate();};
?>

 <!--start of form group-->
<div class="form-group input-receipt-receipt-date">
  <label for="input-receipt-receipt-date">Receipt&nbsp;Date</label>
  <input type="text" name="receiptDate" id="input-receipt-receipt-date" class="form-control  datepicker" placeholder="Enter Receipt&nbsp;Date " value="<?php echo (isset($defaultValues['receiptDate'])?($defaultValues['receiptDate']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('invoiceAmount',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['invoiceAmount']=$receiptEdit->getInvoiceAmount();};
?>

 <!--start of form group-->
<div class="form-group d-none input-receipt-invoice-amount">
  <label for="input-receipt-invoice-amount">Invoice&nbsp;Amount</label>
  <input type="number" step="any" name="invoiceAmount" id="input-receipt-invoice-amount" class="form-control " placeholder="Enter Invoice&nbsp;Amount " value="<?php echo (isset($defaultValues['invoiceAmount'])?($defaultValues['invoiceAmount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('amountPaid',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['amountPaid']=$receiptEdit->getAmountPaid();};
?>

 <!--start of form group-->
<div class="form-group input-receipt-amount-paid">
  <label for="input-receipt-amount-paid">Amount&nbsp;Paid*</label>
  <input type="number" step="any" name="amountPaid" id="input-receipt-amount-paid" class="form-control " placeholder="Enter Amount&nbsp;Paid* " value="<?php echo (isset($defaultValues['amountPaid'])?($defaultValues['amountPaid']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('paymentMethodId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['paymentMethodId']=$receiptEdit->getPaymentMethodId();};
?>

 <!--start of form group-->
<div class="form-group input-receipt-payment-method-id">
  <label for="input-receipt-payment-method-id">Payment&nbsp;Method*</label>
  <?php 
    include_once("../classes/payment-methods.php");
    include_once("../daos/payment-methods-dao.php");

    $paymentMethodsDao = new PaymentMethodsDao(); 
    $objects = $paymentMethodsDao->selectAll(); 
    ?>
    <select name="paymentMethodId" id="input-receipt-payment-method-id" class=" form-control" required <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Payment&nbsp;Method*--</option>
      <?php
        foreach($objects as $paymentMethods){
          $optionValue  = $paymentMethods->getPaymentMethodId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['paymentMethodId']) && $defaultValues['paymentMethodId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['paymentMethodId']) && $defaultValues['paymentMethodId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['paymentMethodId']) && $defaultValues['paymentMethodId']==$optionValue || $receiptEdit->getPaymentMethodId()==$paymentMethods->getPaymentMethodId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$paymentMethods->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<?php
  $readonly = in_array('changeAmount',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($receiptEdit->getReceiptId()!=null){ $defaultValues['changeAmount']=$receiptEdit->getChangeAmount();};
?>

 <!--start of form group-->
<div class="form-group d-none input-receipt-change-amount">
  <label for="input-receipt-change-amount">Change&nbsp;Amount</label>
  <input type="number" step="any" name="changeAmount" id="input-receipt-change-amount" class="form-control " placeholder="Enter Change&nbsp;Amount " value="<?php echo (isset($defaultValues['changeAmount'])?($defaultValues['changeAmount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
