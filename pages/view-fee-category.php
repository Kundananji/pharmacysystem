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
include("../daos/fee-category-dao.php");
include("../classes/fee-category.php");
include("../config/database.php");
$dao = new FeeCategorydao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Fee&nbsp;category</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="FeeCategory.addNewFeeCategory({})" id="add-new-fee-category"><em class="fa fa-plus"></em> Add New FeeCategory </button></div>
<table class="table table-striped" id="table-fee-category">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Fee&nbsp;Category
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
    foreach($objects as $feeCategory){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $feeCategory->getFeeCategoryId();
        ?>
        </td>
        <td>
        <?php
          echo $feeCategory->getName();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="FeeCategory.addNewFeeCategory({feeCategoryId : \''.$feeCategory->getFeeCategoryId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="FeeCategory.deleteFeeCategory('.$feeCategory->getFeeCategoryId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
