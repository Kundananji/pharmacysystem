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
include("../daos/patients-details-dao.php");
include("../classes/patients-details.php");
include("../config/database.php");
$dao = new PatientsDetailsdao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Patients&nbsp;details</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="PatientsDetails.addNewPatientsDetails({})" id="add-new-patients-details"><em class="fa fa-plus"></em> Add New PatientsDetails </button></div>
<table class="table table-striped" id="table-patients-details">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        File
      </th>
      <th>
        First&nbsp;Name
      </th>
      <th>
        Last&nbsp;Name
      </th>
      <th>
        Address
      </th>
      <th>
        Contact&nbsp;Number
      </th>
      <th>
        Date&nbsp;Of&nbsp;Birth
      </th>
      <th>
        Nationality
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
    foreach($objects as $patientsDetails){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $patientsDetails->getId();
        ?>
        </td>
        <td>
        <?php
          echo $patientsDetails->getFileId();
        ?>
        </td>
        <td>
        <?php
          echo $patientsDetails->getFirstName();
        ?>
        </td>
        <td>
        <?php
          echo $patientsDetails->getLastName();
        ?>
        </td>
        <td>
        <?php
          echo $patientsDetails->getAddress();
        ?>
        </td>
        <td>
        <?php
          echo $patientsDetails->getContactNumber();
        ?>
        </td>
        <td>
        <?php
          echo $patientsDetails->getDateOfBirth();
        ?>
        </td>
        <td>
        <?php
          echo $patientsDetails->getNationality();
        ?>
        </td>
        <td>
        <?php
          echo $patientsDetails->getStatus();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="PatientsDetails.addNewPatientsDetails({id : \''.$patientsDetails->getId.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="PatientsDetails.deletePatientsDetails('.$patientsDetails->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
