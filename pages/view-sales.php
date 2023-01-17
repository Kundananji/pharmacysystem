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
include("../daos/sales-dao.php");
include("../classes/sales.php");
include("../config/database.php");
$dao = new SalesDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Sales</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Sales.addNewSales({})" id="add-new-sales"><em class="fa fa-plus"></em> Add New Sales </button></div>
<table class="table table-striped" id="table-sales">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Customer
      </th>
      <th>
        Invoice&nbsp;Number
      </th>
      <th>
        Medicine&nbsp;Name
      </th>
      <th>
        Batch
      </th>
      <th>
        Expiry&nbsp;Date
      </th>
      <th>
        Quantity
      </th>
      <th>
        Mrp
      </th>
      <th>
        Discount
      </th>
      <th>
        Total
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
    foreach($objects as $sales){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $sales->getCustomerId();
        ?>
        </td>
        <td>
        <?php
          echo $sales->getInvoiceNumber();
        ?>
        </td>
        <td>
        <?php
          echo $sales->getMedicineName();
        ?>
        </td>
        <td>
        <?php
          echo $sales->getBatchId();
        ?>
        </td>
        <td>
        <?php
          echo $sales->getExpiryDate();
        ?>
        </td>
        <td>
        <?php
          echo $sales->getQuantity();
        ?>
        </td>
        <td>
        <?php
          echo $sales->getMrp();
        ?>
        </td>
        <td>
        <?php
          echo $sales->getDiscount();
        ?>
        </td>
        <td>
        <?php
          echo $sales->getTotal();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Sales.addNewSales({ : \''.$sales->get().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Sales.deleteSales('.$sales->get().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
