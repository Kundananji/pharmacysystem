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
        N&nbsp;A&nbsp;M&nbsp;E
      </th>
      <th>
        Batch
      </th>
      <th>
        Expiry&nbsp;Date
      </th>
      <th>
        Q&nbsp;U&nbsp;A&nbsp;N&nbsp;T&nbsp;I&nbsp;T&nbsp;Y
      </th>
      <th>
        M&nbsp;R&nbsp;P
      </th>
      <th>
        R&nbsp;A&nbsp;T&nbsp;E
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
          echo $medicinesStock->getID();
        ?>
        </td>
        <td>
        <?php
          echo $medicinesStock->getNAME();
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
          echo $medicinesStock->getQUANTITY();
        ?>
        </td>
        <td>
        <?php
          echo $medicinesStock->getMRP();
        ?>
        </td>
        <td>
        <?php
          echo $medicinesStock->getRATE();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="MedicinesStock.addNewMedicinesStock({ID : \''.$medicinesStock->getID.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="MedicinesStock.deleteMedicinesStock('.$medicinesStock->getID().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
