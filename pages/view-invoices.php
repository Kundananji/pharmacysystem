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
include("../daos/invoices-dao.php");
include("../classes/invoices.php");
include("../config/database.php");
$dao = new InvoicesDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Invoices</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Invoices.addNewInvoices({})" id="add-new-invoices"><em class="fa fa-plus"></em> Add New Invoices </button></div>
<table class="table table-striped" id="table-invoices">
  <thead>
    <tr>
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
        Net&nbsp;Total
      </th>
      <th>
        Invoice&nbsp;Date
      </th>
      <th>
        Customer
      </th>
      <th>
        Total&nbsp;Amount
      </th>
      <th>
        Total&nbsp;Discount
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
    foreach($objects as $invoices){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $invoices->getInvoiceId();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getFeeId();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getMedicineId();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getItem();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getDescription();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getUnitPrice();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getQuantity();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getNetTotal();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getInvoiceDate();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getCustomerId();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getTotalAmount();
        ?>
        </td>
        <td>
        <?php
          echo $invoices->getTotalDiscount();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Invoices.addNewInvoices({invoice_id : \''.$invoices->getInvoiceId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Invoices.deleteInvoices('.$invoices->getInvoiceId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
