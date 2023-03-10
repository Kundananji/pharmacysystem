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
  $arguments[]="'".$value."'";
}
//make available variables of patients available in scope for use:
if(isset($_POST['patientId']) && $_POST['patientId']!=''){
  include_once("../classes/patients.php");
  include_once("../daos/patients-dao.php");

  $patientsDao = new PatientsDao(); 
  $patients =  $patientsDao->select(filter_var($_GET['patientId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of payment_methods available in scope for use:
if(isset($_POST['paymentMethodId']) && $_POST['paymentMethodId']!=''){
  include_once("../classes/payment-methods.php");
  include_once("../daos/payment-methods-dao.php");

  $paymentMethodsDao = new PaymentMethodsDao(); 
  $paymentMethods =  $paymentMethodsDao->select(filter_var($_GET['paymentMethodId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of invoice available in scope for use:
if(isset($_POST['invoiceId']) && $_POST['invoiceId']!=''){
  include_once("../classes/invoice.php");
  include_once("../daos/invoice-dao.php");

  $invoiceDao = new InvoiceDao(); 
  $invoice =  $invoiceDao->select(filter_var($_GET['invoiceId'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/receipt-dao.php");
include("../classes/receipt.php");
include("../config/database.php");
$dao = new ReceiptDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Receipt</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Receipt.addNewReceipt({})" id="add-new-receipt"><em class="fa fa-plus"></em> Add New Receipt </button></div>
<table class="table table-striped" id="table-receipt">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Receipt
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
          echo $receipt->getReceiptId();
        ?>
        </td>
        <td>
        <?php
          echo $receipt->getDescription();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/patients.php");
          include_once("../daos/patients-dao.php");

          $fpatientsDao = new PatientsDao(); 
          $fpatients = $fpatientsDao->select($receipt->getPatientId()); 
          echo  $fpatients==null?"-": $fpatients->toString();
        ?>
        </td>
        <td>
        <?php
          echo $receipt->getReceiptNo();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/invoice.php");
          include_once("../daos/invoice-dao.php");

          $finvoiceDao = new InvoiceDao(); 
          $finvoice = $finvoiceDao->select($receipt->getInvoiceId()); 
          echo  $finvoice==null?"-": $finvoice->toString();
        ?>
        </td>
        <td>
        <?php
          echo $receipt->getReceiptDate();
        ?>
        </td>
        <td>
        <?php
          echo $receipt->getInvoiceAmount();
        ?>
        </td>
        <td>
        <?php
          echo $receipt->getAmountPaid();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/payment-methods.php");
          include_once("../daos/payment-methods-dao.php");

          $fpaymentMethodsDao = new PaymentMethodsDao(); 
          $fpaymentMethods = $fpaymentMethodsDao->select($receipt->getPaymentMethodId()); 
          echo  $fpaymentMethods==null?"-": $fpaymentMethods->toString();
        ?>
        </td>
        <td>
        <?php
          echo $receipt->getChangeAmount();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Receipt.addNewReceipt({receiptId : \''.$receipt->getReceiptId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Receipt.deleteReceipt('.$receipt->getReceiptId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
