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
//make available variables of status available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/status.php");
  include_once("../daos/status-dao.php");

  $statusDao = new StatusDao(); 
  $status =  $statusDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/payment-methods-dao.php");
include("../classes/payment-methods.php");
include("../config/database.php");
$dao = new PaymentMethodsdao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Payment&nbsp;methods</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="PaymentMethods.addNewPaymentMethods({})" id="add-new-payment-methods"><em class="fa fa-plus"></em> Add New PaymentMethods </button></div>
<table class="table table-striped" id="table-payment-methods">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Payment&nbsp;Method
      </th>
      <th>
        Name
      </th>
      <th>
        Description
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
    foreach($objects as $paymentMethods){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $paymentMethods->getPaymentMethodId();
        ?>
        </td>
        <td>
        <?php
          echo $paymentMethods->getName();
        ?>
        </td>
        <td>
        <?php
          echo $paymentMethods->getDescription();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/status.php");
          include_once("../daos/status-dao.php");

          $fstatusDao = new StatusDao(); 
          $fstatus = $fstatusDao->select($paymentMethods->getStatus()); 
          echo  $fstatus==null?"-": $fstatus->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="PaymentMethods.addNewPaymentMethods({paymentMethodId : \''.$paymentMethods->getPaymentMethodId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="PaymentMethods.deletePaymentMethods('.$paymentMethods->getPaymentMethodId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
