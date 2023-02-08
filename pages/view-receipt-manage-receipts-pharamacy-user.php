<?php
session_start();
$userId = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
//get any set params, pass them to add, delete buttons

//declare env variables for use
$env_dateNow = date("d/m/Y");
$env_timeNow = date("H:i:s");
$env_YearNow = date("Y");
$env_MonthNow = date("m");
$env_MonthFullNow = date("F");
$env_yearNow = date("Y");
$env_monthNow = date("m");
$env_monthFullNow = date("F");
$env_dayNow = date("d");

$arguments = array();
foreach($_POST as $key=>$value){
  $arguments[]=" $key :'".$value."'";
  //put arguments in scope
  $$key = $value;
}
include("../daos/receipt-dao.php");
include("../classes/receipt.php");
include("../config/database.php");
$dao = new ReceiptDao();

$appendQuery='';
foreach($_POST as $key=>$value){
  $$key =filter_var($_POST[$key],FILTER_SANITIZE_STRING);
  if($key == "_term") continue;
  $appendQuery.=' AND '. $key.'='.$$key;
}
//make available variables of patients available in scope for use:
if(isset($_POST['patientId']) && $_POST['patientId']!=''){
  include_once("../classes/patients.php");
  include_once("../daos/patients-dao.php");

  $patientsDao = new PatientsDao(); 
  $patients =  $patientsDao->select(filter_var($_POST['patientId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of payment_methods available in scope for use:
if(isset($_POST['paymentMethodId']) && $_POST['paymentMethodId']!=''){
  include_once("../classes/payment-methods.php");
  include_once("../daos/payment-methods-dao.php");

  $paymentMethodsDao = new PaymentMethodsDao(); 
  $paymentMethods =  $paymentMethodsDao->select(filter_var($_POST['paymentMethodId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of invoice available in scope for use:
if(isset($_POST['invoiceId']) && $_POST['invoiceId']!=''){
  include_once("../classes/invoice.php");
  include_once("../daos/invoice-dao.php");

  $invoiceDao = new InvoiceDao(); 
  $invoice =  $invoiceDao->select(filter_var($_POST['invoiceId'],FILTER_SANITIZE_NUMBER_INT)); 
}

if($appendQuery!= ""){
$objects = $dao->selectByWhereClause('( 1 '.$appendQuery.' )  ORDER BY receiptNo DESC ');
}else{
$objects = $dao->selectByWhereClause('1 ORDER BY receiptNo DESC ');
}

?>
 <h1 class="h3 mb-4 text-gray-800">Manage Receipts</h1>  
<table class="table table-striped" id="table-receipt--manage-receipts-pharamacy-user">
  <thead>
    <tr>
      <th>
        No.
      </th>
      <th>
        Description
      </th>
      <th>
        Patient
      </th>
      <th>
        Receipt&nbsp;No
      </th>
      <th>
        Invoice
      </th>
      <th>
        Receipt&nbsp;Date
      </th>
      <th>
        Invoice&nbsp;Amount
      </th>
      <th>
        Amount&nbsp;Paid
      </th>
      <th>
        Payment&nbsp;Method
      </th>
      <th>
        Change&nbsp;Amount
      </th>
      <th>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
    foreach($objects as $receipt){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          $description=$receipt->getDescription();
          echo str_ireplace("\n","<br/>",$receipt->getDescription());
        ?>
        </td>
        <td>
        <?php
          $patientId=$receipt->getPatientId();
          include_once("../classes/patients.php");
          include_once("../daos/patients-dao.php");

          $fpatientsDao = new PatientsDao(); 
          $fpatients = $fpatientsDao->select($receipt->getPatientId()); 
          echo  $fpatients==null?"-": $fpatients->toString();
        ?>
        </td>
        <td>
        <?php
          $receiptNo=$receipt->getReceiptNo();
          echo str_ireplace("\n","<br/>",$receipt->getReceiptNo());
        ?>
        </td>
        <td>
        <?php
          $invoiceId=$receipt->getInvoiceId();
          include_once("../classes/invoice.php");
          include_once("../daos/invoice-dao.php");

          $finvoiceDao = new InvoiceDao(); 
          $finvoice = $finvoiceDao->select($receipt->getInvoiceId()); 
          echo  $finvoice==null?"-": $finvoice->toString();
        ?>
        </td>
        <td>
        <?php
          $receiptDate=$receipt->getReceiptDate();
          echo str_ireplace("\n","<br/>",$receipt->getReceiptDate());
        ?>
        </td>
        <td>
        <?php
          $invoiceAmount=$receipt->getInvoiceAmount();
          echo str_ireplace("\n","<br/>",$receipt->getInvoiceAmount());
        ?>
        </td>
        <td>
        <?php
          $amountPaid=$receipt->getAmountPaid();
          echo str_ireplace("\n","<br/>",$receipt->getAmountPaid());
        ?>
        </td>
        <td>
        <?php
          $paymentMethodId=$receipt->getPaymentMethodId();
          include_once("../classes/payment-methods.php");
          include_once("../daos/payment-methods-dao.php");

          $fpaymentMethodsDao = new PaymentMethodsDao(); 
          $fpaymentMethods = $fpaymentMethodsDao->select($receipt->getPaymentMethodId()); 
          echo  $fpaymentMethods==null?"-": $fpaymentMethods->toString();
        ?>
        </td>
        <td>
        <?php
          $changeAmount=$receipt->getChangeAmount();
          echo str_ireplace("\n","<br/>",$receipt->getChangeAmount());
        ?>
        </td>
      <td>
        <a href="javascript:void(0)" onclick="Receipt.viewReceiptViewreceipt_pharamacyuser({receiptId:'<?php echo $receipt->getReceiptId() ?>',})" class="btn btn-primary"><em class="fa fa-eye"></em> View Receipt</a>
      </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
