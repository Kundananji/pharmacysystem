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
include("../daos/procedures-taken-dao.php");
include("../classes/procedures-taken.php");
include("../config/database.php");
$dao = new ProceduresTakendao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Procedures&nbsp;taken</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="ProceduresTaken.addNewProceduresTaken({})" id="add-new-procedures-taken"><em class="fa fa-plus"></em> Add New ProceduresTaken </button></div>
<table class="table table-striped" id="table-procedures-taken">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        Patient
      </th>
      <th>
        Department
      </th>
      <th>
        Procedure&nbsp;Conducted
      </th>
      <th>
        Results&nbsp;Details
      </th>
      <th>
        Doctors&nbsp;Name
      </th>
      <th>
        Lab&nbsp;Tech
      </th>
      <th>
        Fee
      </th>
      <th>
        Time&nbsp;Tested
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
    foreach($objects as $proceduresTaken){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $proceduresTaken->getId();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getPatientId();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getDepartment();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getProcedureConducted();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getResultsDetails();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getDoctorsName();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getLabTech();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getFee();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getTimeTested();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="ProceduresTaken.addNewProceduresTaken({id : \''.$proceduresTaken->getId.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="ProceduresTaken.deleteProceduresTaken('.$proceduresTaken->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
