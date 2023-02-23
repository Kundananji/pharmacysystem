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
include("../daos/invoice-detail-dao.php");
include("../classes/invoice-detail.php");
include("../config/database.php");
$dao = new InvoiceDetaildao();

$appendQuery='';
foreach($_POST as $key=>$value){
  $$key =filter_var($_POST[$key],FILTER_SANITIZE_STRING);
  if($key == "_term") continue;
    $appendQuery.=' AND '. $key.'='.$$key;
}
//make available variables of invoice available in scope for use:
if(isset($_POST['invoiceId']) && $_POST['invoiceId']!=''){
  include_once("../classes/invoice.php");
  include_once("../daos/invoice-dao.php");

  $invoiceDao = new InvoiceDao(); 
  $invoice =  $invoiceDao->select(filter_var($_POST['invoiceId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of fee available in scope for use:
if(isset($_POST['feeId']) && $_POST['feeId']!=''){
  include_once("../classes/fee.php");
  include_once("../daos/fee-dao.php");

  $feeDao = new FeeDao(); 
  $fee =  $feeDao->select(filter_var($_POST['feeId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of medicines available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/medicines.php");
  include_once("../daos/medicines-dao.php");

  $medicinesDao = new MedicinesDao(); 
  $medicines =  $medicinesDao->select(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT)); 
}

if($appendQuery!= ""){
$objects = $dao->selectByWhereClause('( 1 '.$appendQuery.' )  ');
}else{
$objects = $dao->selectAll();
}

?>
 <h1 class="h3 mb-4 text-gray-800">Add Invoice Details</h1>  
<table class="table table-striped" id="table-invoice-detail---pharamacy-user">
  <thead>
    <tr>
      <th>
        No.
      </th>
      <th>
        Invoice
      </th>
      <th>
        Fee
      </th>
      <th>
        Medicine
      </th>
      <th>
        Description
      </th>
      <th>
        Unit&nbsp;Price
      </th>
      <th>
        Quantity
      </th>
      <th>
        Discount
      </th>
      <th>
        Total&nbsp;Amount
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
    foreach($objects as $invoiceDetail){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          $invoiceId=$invoiceDetail->getInvoiceId();
          include_once("../classes/invoice.php");
          include_once("../daos/invoice-dao.php");

          $finvoiceDao = new InvoiceDao(); 
          $finvoice = $finvoiceDao->select($invoiceDetail->getInvoiceId()); 
          echo  $finvoice==null?"-": $finvoice->toString();
        ?>
        </td>
        <td>
        <?php
          $feeId=$invoiceDetail->getFeeId();
          include_once("../classes/fee.php");
          include_once("../daos/fee-dao.php");

          $ffeeDao = new FeeDao(); 
          $ffee = $ffeeDao->select($invoiceDetail->getFeeId()); 
          echo  $ffee==null?"-": $ffee->toString();
        ?>
        </td>
        <td>
        <?php
          $medicineId=$invoiceDetail->getMedicineId();
          include_once("../classes/medicines.php");
          include_once("../daos/medicines-dao.php");

          $fmedicinesDao = new MedicinesDao(); 
          $fmedicines = $fmedicinesDao->select($invoiceDetail->getMedicineId()); 
          echo  $fmedicines==null?"-": $fmedicines->toString();
        ?>
        </td>
        <td>
        <?php
          $description=$invoiceDetail->getDescription();
          echo str_ireplace("\n","<br/>",$invoiceDetail->getDescription());
        ?>
        </td>
        <td>
        <?php
          $unitPrice=$invoiceDetail->getUnitPrice();
          echo str_ireplace("\n","<br/>",$invoiceDetail->getUnitPrice());
        ?>
        </td>
        <td>
        <?php
          $quantity=$invoiceDetail->getQuantity();
          echo str_ireplace("\n","<br/>",$invoiceDetail->getQuantity());
        ?>
        </td>
        <td>
        <?php
          $discount=$invoiceDetail->getDiscount();
          echo str_ireplace("\n","<br/>",$invoiceDetail->getDiscount());
        ?>
        </td>
        <td>
        <?php
          $totalAmount=$invoiceDetail->getTotalAmount();
          echo str_ireplace("\n","<br/>",$invoiceDetail->getTotalAmount());
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="InvoiceDetail.addNewInvoiceDetail_pharamacyuser({ id:\''.$invoiceDetail->getId().'\',})"> <em class="fa fa-edit"></em> </a>';
          
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="InvoiceDetail.deleteInvoiceDetail_pharamacyuser('.$invoiceDetail->getId().' )">  <em class="fa fa-trash"></em> </a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
