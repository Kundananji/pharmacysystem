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
//make available variables of receipt available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/receipt.php");
  include_once("../daos/receipt-dao.php");

  $receiptDao = new ReceiptDao(); 
  $receipt =  $receiptDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of invoice_detail available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/invoice-detail.php");
  include_once("../daos/invoice-detail-dao.php");

  $invoiceDetailDao = new InvoiceDetailDao(); 
  $invoiceDetail =  $invoiceDetailDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of fee available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/fee.php");
  include_once("../daos/fee-dao.php");

  $feeDao = new FeeDao(); 
  $fee =  $feeDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of receipt available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/receipt.php");
  include_once("../daos/receipt-dao.php");

  $receiptDao = new ReceiptDao(); 
  $receipt =  $receiptDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of invoice_detail available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/invoice-detail.php");
  include_once("../daos/invoice-detail-dao.php");

  $invoiceDetailDao = new InvoiceDetailDao(); 
  $invoiceDetail =  $invoiceDetailDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
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
include("../daos/receipt-detail-dao.php");
include("../classes/receipt-detail.php");
include("../config/database.php");
$dao = new ReceiptDetaildao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Receipt&nbsp;detail</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="ReceiptDetail.addNewReceiptDetail({})" id="add-new-receipt-detail"><em class="fa fa-plus"></em> Add New ReceiptDetail </button></div>
<table class="table table-striped" id="table-receipt-detail">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        Receipt
      </th>
      <th>
        Item
      </th>
      <th>
        Description
      </th>
      <th>
        Quantity
      </th>
      <th>
        Unit&nbsp;Price
      </th>
      <th>
        Total&nbsp;Amount
      </th>
      <th>
        Invoice&nbsp;Detail
      </th>
      <th>
        Fee
      </th>
      <th>
        Medicine
      </th>
      <th>
        Discount
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
    foreach($objects as $receiptDetail){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $receiptDetail->getId();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/receipt.php");
          include_once("../daos/receipt-dao.php");

          $freceiptDao = new ReceiptDao(); 
          $freceipt = $freceiptDao->select($receiptDetail->getReceiptId()); 
          echo  $freceipt==null?"-": $freceipt->toString();
        ?>
        </td>
        <td>
        <?php
          echo $receiptDetail->getItem();
        ?>
        </td>
        <td>
        <?php
          echo $receiptDetail->getDescription();
        ?>
        </td>
        <td>
        <?php
          echo $receiptDetail->getQuantity();
        ?>
        </td>
        <td>
        <?php
          echo $receiptDetail->getUnitPrice();
        ?>
        </td>
        <td>
        <?php
          echo $receiptDetail->getTotalAmount();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/invoice-detail.php");
          include_once("../daos/invoice-detail-dao.php");

          $finvoiceDetailDao = new InvoiceDetailDao(); 
          $finvoiceDetail = $finvoiceDetailDao->select($receiptDetail->getInvoiceDetailId()); 
          echo  $finvoiceDetail==null?"-": $finvoiceDetail->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/fee.php");
          include_once("../daos/fee-dao.php");

          $ffeeDao = new FeeDao(); 
          $ffee = $ffeeDao->select($receiptDetail->getFeeId()); 
          echo  $ffee==null?"-": $ffee->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/medicines.php");
          include_once("../daos/medicines-dao.php");

          $fmedicinesDao = new MedicinesDao(); 
          $fmedicines = $fmedicinesDao->select($receiptDetail->getMedicineId()); 
          echo  $fmedicines==null?"-": $fmedicines->toString();
        ?>
        </td>
        <td>
        <?php
          echo $receiptDetail->getDiscount();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="ReceiptDetail.addNewReceiptDetail({id : \''.$receiptDetail->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="ReceiptDetail.deleteReceiptDetail('.$receiptDetail->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
