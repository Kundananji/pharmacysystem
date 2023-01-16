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
include("../daos/purchases-dao.php");
include("../classes/purchases.php");
include("../config/database.php");
$dao = new PurchasesDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Purchases</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Purchases.addNewPurchases({})" id="add-new-purchases"><em class="fa fa-plus"></em> Add New Purchases </button></div>
<table class="table table-striped" id="table-purchases">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Supplier&nbsp;Name
      </th>
      <th>
        Invoice&nbsp;Number
      </th>
      <th>
        Voucher&nbsp;Number
      </th>
      <th>
        Purchase&nbsp;Date
      </th>
      <th>
        Total&nbsp;Amount
      </th>
      <th>
        Payment&nbsp;Status
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
    foreach($objects as $purchases){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $purchases->getSupplierName();
        ?>
        </td>
        <td>
        <?php
          echo $purchases->getInvoiceNumber();
        ?>
        </td>
        <td>
        <?php
          echo $purchases->getVoucherNumber();
        ?>
        </td>
        <td>
        <?php
          echo $purchases->getPurchaseDate();
        ?>
        </td>
        <td>
        <?php
          echo $purchases->getTotalAmount();
        ?>
        </td>
        <td>
        <?php
          echo $purchases->getPaymentStatus();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Purchases.addNewPurchases({voucher_number : \''.$purchases->getVoucherNumber.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Purchases.deletePurchases('.$purchases->getVoucherNumber().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
