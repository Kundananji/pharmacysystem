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
include("../daos/invoice-settings-dao.php");
include("../classes/invoice-settings.php");
include("../config/database.php");
$dao = new InvoiceSettingsdao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Invoice&nbsp;settings</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="InvoiceSettings.addNewInvoiceSettings({})" id="add-new-invoice-settings"><em class="fa fa-plus"></em> Add New InvoiceSettings </button></div>
<table class="table table-striped" id="table-invoice-settings">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Id
      </th>
      <th>
        Terms
      </th>
      <th>
        Tax&nbsp;Rate
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
    foreach($objects as $invoiceSettings){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $invoiceSettings->getId();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceSettings->getTerms();
        ?>
        </td>
        <td>
        <?php
          echo $invoiceSettings->getTaxRate();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="InvoiceSettings.addNewInvoiceSettings({id : \''.$invoiceSettings->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="InvoiceSettings.deleteInvoiceSettings('.$invoiceSettings->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
