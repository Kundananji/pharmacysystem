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
include("../daos/invoice-status-dao.php");
include("../classes/invoice-status.php");
include("../config/database.php");
$dao = new InvoiceStatusdao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Invoice&nbsp;status</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="InvoiceStatus.addNewInvoiceStatus({})" id="add-new-invoice-status"><em class="fa fa-plus"></em> Add New InvoiceStatus </button></div>
<table class="table table-striped" id="table-invoice-status">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Invoice&nbsp;Status
      </th>
      <th>
        Name
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
    foreach($objects as $invoiceStatus){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $invoiceStatus->getInvoiceStatusId();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceStatus->getName();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="InvoiceStatus.addNewInvoiceStatus({invoiceStatusId : \''.$invoiceStatus->getInvoiceStatusId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="InvoiceStatus.deleteInvoiceStatus('.$invoiceStatus->getInvoiceStatusId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
