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
//make available variables of medicines available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/medicines.php");
  include_once("../daos/medicines-dao.php");

  $medicinesDao = new MedicinesDao(); 
  $medicines =  $medicinesDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/medicines-stock-dao.php");
include("../classes/medicines-stock.php");
include("../config/database.php");
$dao = new MedicinesStockdao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Medicines&nbsp;stock</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="MedicinesStock.addNewMedicinesStock({})" id="add-new-medicines-stock"><em class="fa fa-plus"></em> Add New MedicinesStock </button></div>
<table class="table table-striped" id="table-medicines-stock">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        Medicine
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
        Rate
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
    foreach($objects as $medicinesStock){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $medicinesStock->getId();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/medicines.php");
          include_once("../daos/medicines-dao.php");

          $fmedicinesDao = new MedicinesDao(); 
          $fmedicines = $fmedicinesDao->select($medicinesStock->getMedicineId()); 
          echo  $fmedicines==null?"-": $fmedicines->toString();
        ?>
        </td>
        <td>
        <?php
          echo $medicinesStock->getBatchId();
        ?>
        </td>
        <td>
        <?php
          echo $medicinesStock->getExpiryDate();
        ?>
        </td>
        <td>
        <?php
          echo $medicinesStock->getQuantity();
        ?>
        </td>
        <td>
        <?php
          echo $medicinesStock->getMrp();
        ?>
        </td>
        <td>
        <?php
          echo $medicinesStock->getRate();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="MedicinesStock.addNewMedicinesStock({id : \''.$medicinesStock->getId.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="MedicinesStock.deleteMedicinesStock('.$medicinesStock->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
