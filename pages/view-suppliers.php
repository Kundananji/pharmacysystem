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
include("../daos/suppliers-dao.php");
include("../classes/suppliers.php");
include("../config/database.php");
$dao = new SuppliersDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Suppliers</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Suppliers.addNewSuppliers({})" id="add-new-suppliers"><em class="fa fa-plus"></em> Add New Suppliers </button></div>
<table class="table table-striped" id="table-suppliers">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        Name
      </th>
      <th>
        Email
      </th>
      <th>
        Contact&nbsp;Number
      </th>
      <th>
        Address
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
    foreach($objects as $suppliers){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $suppliers->getID();
        ?>
        </td>
        <td>
        <?php
          echo $suppliers->getName();
        ?>
        </td>
        <td>
        <?php
          echo $suppliers->getEmail();
        ?>
        </td>
        <td>
        <?php
          echo $suppliers->getContactNumber();
        ?>
        </td>
        <td>
        <?php
          echo $suppliers->getAddress();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Suppliers.addNewSuppliers({ID : \''.$suppliers->getID().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Suppliers.deleteSuppliers('.$suppliers->getID().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
