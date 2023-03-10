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
//make available variables of yesno available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of patients available in scope for use:
if(isset($_POST['patientId']) && $_POST['patientId']!=''){
  include_once("../classes/patients.php");
  include_once("../daos/patients-dao.php");

  $patientsDao = new PatientsDao(); 
  $patients =  $patientsDao->select(filter_var($_GET['patientId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of invoice_status available in scope for use:
if(isset($_POST['invoiceStatusId']) && $_POST['invoiceStatusId']!=''){
  include_once("../classes/invoice-status.php");
  include_once("../daos/invoice-status-dao.php");

  $invoiceStatusDao = new InvoiceStatusDao(); 
  $invoiceStatus =  $invoiceStatusDao->select(filter_var($_GET['invoiceStatusId'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/invoice-dao.php");
include("../classes/invoice.php");
include("../config/database.php");
$dao = new InvoiceDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Invoice</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Invoice.addNewInvoice({})" id="add-new-invoice"><em class="fa fa-plus"></em> Add New Invoice </button></div>
<table class="table table-striped" id="table-invoice">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Invoice
      </th>
      <th>
        Invoice&nbsp;No
      </th>
      <th>
        Description
      </th>
      <th>
        Invoice&nbsp;Date
      </th>
      <th>
        Patient
      </th>
      <th>
        Tax&nbsp;Amount
      </th>
      <th>
        Amount
      </th>
      <th>
        Is&nbsp;Paid&nbsp;For
      </th>
      <th>
        Status
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
    foreach($objects as $invoice){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $invoice->getInvoiceId();
        ?>
        </td>
        <td>
        <?php
          echo $invoice->getInvoiceNo();
        ?>
        </td>
        <td>
        <?php
          echo $invoice->getDescription();
        ?>
        </td>
        <td>
        <?php
          echo $invoice->getInvoiceDate();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/patients.php");
          include_once("../daos/patients-dao.php");

          $fpatientsDao = new PatientsDao(); 
          $fpatients = $fpatientsDao->select($invoice->getPatientId()); 
          echo  $fpatients==null?"-": $fpatients->toString();
        ?>
        </td>
        <td>
        <?php
          echo $invoice->getTaxAmount();
        ?>
        </td>
        <td>
        <?php
          echo $invoice->getAmount();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/yesno.php");
          include_once("../daos/yesno-dao.php");

          $fyesnoDao = new YesnoDao(); 
          $fyesno = $fyesnoDao->select($invoice->getIsPaidFor()); 
          echo  $fyesno==null?"-": $fyesno->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/invoice-status.php");
          include_once("../daos/invoice-status-dao.php");

          $finvoiceStatusDao = new InvoiceStatusDao(); 
          $finvoiceStatus = $finvoiceStatusDao->select($invoice->getStatus()); 
          echo  $finvoiceStatus==null?"-": $finvoiceStatus->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Invoice.addNewInvoice({invoiceId : \''.$invoice->getInvoiceId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Invoice.deleteInvoice('.$invoice->getInvoiceId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
