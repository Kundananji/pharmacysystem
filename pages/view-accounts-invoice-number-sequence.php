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
include("../daos/accounts-invoice-number-sequence-dao.php");
include("../classes/accounts-invoice-number-sequence.php");
include("../config/database.php");
$dao = new AccountsInvoiceNumberSequencedao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Accounts&nbsp;invoice&nbsp;number&nbsp;sequence</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="AccountsInvoiceNumberSequence.addNewAccountsInvoiceNumberSequence({})" id="add-new-accounts-invoice-number-sequence"><em class="fa fa-plus"></em> Add New AccountsInvoiceNumberSequence </button></div>
<table class="table table-striped" id="table-accounts-invoice-number-sequence">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Sequence
      </th>
      <th>
        Year
      </th>
      <th>
        Invoice&nbsp;Number
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
    foreach($objects as $accountsInvoiceNumberSequence){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $accountsInvoiceNumberSequence->getSequenceId();
        ?>
        </td>
        <td>
        <?php
          echo $accountsInvoiceNumberSequence->getYear();
        ?>
        </td>
        <td>
        <?php
          echo $accountsInvoiceNumberSequence->getInvoiceNumber();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="AccountsInvoiceNumberSequence.addNewAccountsInvoiceNumberSequence({sequenceId : \''.$accountsInvoiceNumberSequence->getSequenceId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="AccountsInvoiceNumberSequence.deleteAccountsInvoiceNumberSequence('.$accountsInvoiceNumberSequence->getSequenceId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
