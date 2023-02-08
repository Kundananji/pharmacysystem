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
include("../classes/invoice.php");
include("../daos/invoice-dao.php");
include("../classes/patients.php");
include("../daos/patients-dao.php");
include("../daos/invoice-detail-dao.php");
include("../classes/invoice-detail.php");
include("../daos/invoice-settings-dao.php");
include("../classes/invoice-settings.php");

$invoiceSettingDao = new InvoiceSettingsdao();
$invoiceDetailDao = new InvoiceDetaildao();

$patientsDao = new PatientsDao(); 
$invoiceDao = new InvoiceDao(); 
$dao = new ReceiptDao();

$appendQuery='';
foreach($_POST as $key=>$value){
  $$key =filter_var($_POST[$key],FILTER_SANITIZE_STRING);
  if($key == "_term") continue;
  $appendQuery.=' AND '. $key.'='.$$key;
}
//make available variables of patients available in scope for use:
if(isset($_POST['patientId']) && $_POST['patientId']!=''){

  $patients =  $patientsDao->select(filter_var($_POST['patientId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of payment_methods available in scope for use:
if(isset($_POST['paymentMethodId']) && $_POST['paymentMethodId']!=''){
  include_once("../classes/payment-methods.php");
  include_once("../daos/payment-methods-dao.php");

  $paymentMethodsDao = new PaymentMethodsDao(); 
  $paymentMethods =  $paymentMethodsDao->select(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of invoice available in scope for use:
if(isset($_POST['invoiceId']) && $_POST['invoiceId']!=''){
  $invoice =  $invoiceDao->select(filter_var($_POST['invoiceId'],FILTER_SANITIZE_NUMBER_INT)); 
}


$objects = $dao->selectByWhereClause('( 1 '.$appendQuery.' )  ');

if(sizeof($objects)> 0){

  $receipt = $objects[0];
  $invoice = $invoiceDao->select($receipt->getInvoiceId());

  $patient = $patientsDao->select($invoice->getPatientId());

  $invoiceSettings = $invoiceSettingDao->selectAll();
  $invoiceSetting=sizeof($invoiceSettings)>0?$invoiceSettings[0]:Null;

    //get invoice details
    $invoiceDetails = $invoiceDetailDao->selectBy(array("invoiceId"),array($invoice->getInvoiceId()),array("i"));

echo'<div id="receipt-print-area">';

echo'<table border="1" cellpadding="10" cellspacing="0" style="margin:0px auto;width:100%" class="table">';

  echo'<tr>';
  echo'<td colspan="3">';
   echo'<table>';  
     echo'<tr>';
       echo'<td style="vertical-align:middle">';
       echo'<img src="img/hms.jpg" style="width:100px;border-radius:50px">';
       echo'</td>';

       echo'<td>';

       echo'<br/><b>MULTI CARE HOSPITAL</b>';
       echo'<br/>Plot No. 27196, Off Chilumbulu Road, Libala South';
       echo'<br/>Lusaka, ZAMBIA</p>';
       echo'<p><b>Tel:</b> 0211262718:<br/>';
       echo'<b>Email:</b> multicare@gmail.com<br/>';
       echo'<b>TPIN:</b> 1004307067</p>';
       echo'<hr>';
       echo'</td>';

     echo'</tr>';

   echo'</table>';

   echo'<b>Patient Details: </b>';
   echo'<hr>';
   echo  $patient->toString()."<br/>";	
   echo  str_ireplace("\n","<br/>",$patient->getAddress());			

 echo'</td>';
 echo'<td  colspan="2">';

 echo'<h2>Receipt</h2>';
 echo'<hr>';
 echo'<p><b>Receipt No:</b> '.$receipt->getReceiptNo().'<br/>';
 echo'<b>Receipt Date:</b> '.date("j F, Y",strtotime($receipt->getReceiptDate())).'<br/>';
 echo'</td>';
echo'</tr>';
echo'<tr>';
 echo'<td colspan="5">';

 echo'</td>';
echo'</tr>';

echo'<tr style="font-weight:bold">';
 echo'<td colspan="2">';
   echo'Description';
 echo'</td>';
 echo'<td colspan="1">';
   echo'Quantity';
 echo'</td>';
 echo'<td colspan="1">';
   echo'Unit Price';
 echo'</td>';
 echo'<td colspan="1">';
   echo'Amount';
 echo'</td>';
echo'</tr>';
$total=0;
foreach($invoiceDetails as $invoiceDetail){
$total+=(float)$invoiceDetail->getTotalAmount();
echo'<tr>';
 echo'<td colspan="2">';
 if($invoice->getIsPaidFor()==0){
   echo '<a href="javascript:InvoiceDetail.deleteInvoiceDetail_pharamacyuser('.$invoiceDetail->getId().')"><i class="fa fa-times"></i></a>&nbsp;';
 }
   echo $invoiceDetail->getDescription();
 echo'</td>';
 echo'<td colspan="1">';
     echo $invoiceDetail->getQuantity();
 echo'</td>';
 echo'<td colspan="1" style="text-align:right">';
   echo $invoiceDetail->getUnitPrice();
 echo'</td>';
 echo'<td colspan="1" style="text-align:right">';

   echo number_format($invoiceDetail->getTotalAmount(),'2','.',',');
 echo'</td>';
 echo'</tr>';

}
echo'<tfoot>';

echo'<tr>';
echo'<td colspan="4">';
 echo 'Sub Total';
echo'</td>';
echo'<td colspan="1" style="font-weight:bold;text-align:right">';
 echo number_format($total,'2','.',',');
echo'</td>';
echo'</tr>';



echo'<tr>';
echo'<td colspan="4">';
echo 'Tax Rate';
echo'</td>';
echo'<td colspan="1" style="font-weight:bold;text-align:right">';
if($invoiceSetting!=null){
$taxRate = $invoiceSetting->getTaxRate();
echo number_format($taxRate,'1','.',',');
}
else{
echo number_format(0,'1','.',',');
}
echo'%</td>';
echo'</tr>';


echo'<tr>';
echo'<td colspan="4">';
echo 'Total Tax';
echo'</td>';
echo'<td colspan="1" style="font-weight:bold;text-align:right">';
echo number_format($invoice->getTaxAmount(),'2','.',',');
echo'</td>';
echo'</tr>';


echo'<tr>';
echo'<td colspan="4">';
 echo '<b>Balance Due</b>';
echo'</td>';
echo'<td colspan="1" style="font-weight:bold;text-align:right">';
 echo number_format($invoice->getAmount(),'2','.',',');
echo'</td>';
echo'</tr>';

echo'<tr>';
echo'<td colspan="4">';
 echo 'Amount Paid';
echo'</td>';
echo'<td colspan="1" style="font-weight:bold;text-align:right">';
 echo number_format($receipt->getAmountPaid(),'2','.',',');
echo'</td>';
echo'</tr>';

echo'<tr>';
echo'<td colspan="4">';
 echo 'Change';
echo'</td>';
echo'<td colspan="1" style="font-weight:bold;text-align:right">';
 echo number_format($receipt->getChangeAmount(),'2','.',',');
echo'</td>';
echo'</tr>';


   echo'</tfoot>';


echo'</table>';

echo'</div>';
echo'<p class="m-4">';

echo'<a href="javascript:printDocument(\'receipt-print-area\')" class="btn btn-info"> <i class="fa fa-print"></i> Print Receipt</a>';

echo'</p>';
}