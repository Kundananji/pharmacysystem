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
include("../daos/medicines-dao.php");
include("../classes/medicines.php");
include("../config/database.php");
$dao = new MedicinesDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Medicines</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Medicines.addNewMedicines({})" id="add-new-medicines"><em class="fa fa-plus"></em> Add New Medicines </button></div>
<table class="table table-striped" id="table-medicines">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        N&nbsp;A&nbsp;M&nbsp;E
      </th>
      <th>
        P&nbsp;A&nbsp;C&nbsp;K&nbsp;I&nbsp;N&nbsp;G
      </th>
      <th>
        Generic&nbsp;Name
      </th>
      <th>
        Supplier&nbsp;Name
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
    foreach($objects as $medicines){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $medicines->getID();
        ?>
        </td>
        <td>
        <?php
          echo $medicines->getNAME();
        ?>
        </td>
        <td>
        <?php
          echo $medicines->getPACKING();
        ?>
        </td>
        <td>
        <?php
          echo $medicines->getGenericName();
        ?>
        </td>
        <td>
        <?php
          echo $medicines->getSupplierName();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Medicines.addNewMedicines({ID : \''.$medicines->getID.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Medicines.deleteMedicines('.$medicines->getID().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
