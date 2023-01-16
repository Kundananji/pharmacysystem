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
//make available variables of invoice available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/invoice.php");
  include_once("../daos/invoice-dao.php");

  $invoiceDao = new InvoiceDao(); 
  $invoice =  $invoiceDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of fee available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/fee.php");
  include_once("../daos/fee-dao.php");

  $feeDao = new FeeDao(); 
  $fee =  $feeDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of medicines available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/medicines.php");
  include_once("../daos/medicines-dao.php");

  $medicinesDao = new MedicinesDao(); 
  $medicines =  $medicinesDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/invoice-detail-dao.php");
include("../classes/invoice-detail.php");
include("../config/database.php");
$dao = new InvoiceDetaildao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Invoice&nbsp;detail</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="InvoiceDetail.addNewInvoiceDetail({})" id="add-new-invoice-detail"><em class="fa fa-plus"></em> Add New InvoiceDetail </button></div>
<table class="table table-striped" id="table-invoice-detail">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
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
        Item
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
          echo $invoiceDetail->getId();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/invoice.php");
          include_once("../daos/invoice-dao.php");

          $finvoiceDao = new InvoiceDao(); 
          $finvoice = $finvoiceDao->select($invoiceDetail->getInvoiceId()); 
          echo  $finvoice==null?"-": $finvoice->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/fee.php");
          include_once("../daos/fee-dao.php");

          $ffeeDao = new FeeDao(); 
          $ffee = $ffeeDao->select($invoiceDetail->getFeeId()); 
          echo  $ffee==null?"-": $ffee->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/medicines.php");
          include_once("../daos/medicines-dao.php");

          $fmedicinesDao = new MedicinesDao(); 
          $fmedicines = $fmedicinesDao->select($invoiceDetail->getMedicineId()); 
          echo  $fmedicines==null?"-": $fmedicines->toString();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceDetail->getItem();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceDetail->getDescription();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceDetail->getUnitPrice();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceDetail->getQuantity();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceDetail->getDiscount();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceDetail->getTotalAmount();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="InvoiceDetail.addNewInvoiceDetail({id : \''.$invoiceDetail->getId.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="InvoiceDetail.deleteInvoiceDetail('.$invoiceDetail->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
