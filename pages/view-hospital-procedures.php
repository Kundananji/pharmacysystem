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
include("../daos/hospital-procedures-dao.php");
include("../classes/hospital-procedures.php");
include("../config/database.php");
$dao = new HospitalProceduresdao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Hospital&nbsp;procedures</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="HospitalProcedures.addNewHospitalProcedures({})" id="add-new-hospital-procedures"><em class="fa fa-plus"></em> Add New HospitalProcedures </button></div>
<table class="table table-striped" id="table-hospital-procedures">
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
        Description
      </th>
      <th>
        Fee
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
    foreach($objects as $hospitalProcedures){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $hospitalProcedures->getId();
        ?>
        </td>
        <td>
        <?php
          echo $hospitalProcedures->getName();
        ?>
        </td>
        <td>
        <?php
          echo $hospitalProcedures->getDescription();
        ?>
        </td>
        <td>
        <?php
          echo $hospitalProcedures->getFee();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="HospitalProcedures.addNewHospitalProcedures({id : \''.$hospitalProcedures->getId.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="HospitalProcedures.deleteHospitalProcedures('.$hospitalProcedures->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
