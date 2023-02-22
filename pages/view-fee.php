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
//make available variables of fee_category available in scope for use:
if(isset($_POST['feeCategoryId']) && $_POST['feeCategoryId']!=''){
  include_once("../classes/fee-category.php");
  include_once("../daos/fee-category-dao.php");

  $feeCategoryDao = new FeeCategoryDao(); 
  $feeCategory =  $feeCategoryDao->select(filter_var($_GET['feeCategoryId'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/fee-dao.php");
include("../classes/fee.php");
include("../config/database.php");
$dao = new FeeDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Fee</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Fee.addNewFee({})" id="add-new-fee"><em class="fa fa-plus"></em> Add New Fee </button></div>
<table class="table table-striped" id="table-fee">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Fee
      </th>
      <th>
        Name
      </th>
      <th>
        Description
      </th>
      <th>
        Fee&nbsp;Category
      </th>
      <th>
        Amount
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
    foreach($objects as $fee){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $fee->getFeeId();
        ?>
        </td>
        <td>
        <?php
          echo $fee->getName();
        ?>
        </td>
        <td>
        <?php
          echo $fee->getDescription();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/fee-category.php");
          include_once("../daos/fee-category-dao.php");

          $ffeeCategoryDao = new FeeCategoryDao(); 
          $ffeeCategory = $ffeeCategoryDao->select($fee->getFeeCategoryId()); 
          echo  $ffeeCategory==null?"-": $ffeeCategory->toString();
        ?>
        </td>
        <td>
        <?php
          echo $fee->getAmount();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/status.php");
          include_once("../daos/status-dao.php");

          $fstatusDao = new StatusDao(); 
          $fstatus = $fstatusDao->select($fee->getStatus()); 
          echo  $fstatus==null?"-": $fstatus->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Fee.addNewFee({feeId : \''.$fee->getFeeId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Fee.deleteFee('.$fee->getFeeId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
