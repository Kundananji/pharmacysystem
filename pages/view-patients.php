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
//make available variables of gender available in scope for use:
if(isset($_POST['genderId']) && $_POST['genderId']!=''){
  include_once("../classes/gender.php");
  include_once("../daos/gender-dao.php");

  $genderDao = new GenderDao(); 
  $gender =  $genderDao->select(filter_var($_GET['genderId'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/patients-dao.php");
include("../classes/patients.php");
include("../config/database.php");
$dao = new PatientsDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Patients</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Patients.addNewPatients({})" id="add-new-patients"><em class="fa fa-plus"></em> Add New Patients </button></div>
<table class="table table-striped" id="table-patients">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Patient
      </th>
      <th>
        File
      </th>
      <th>
        First&nbsp;Name
      </th>
      <th>
        Other&nbsp;Names
      </th>
      <th>
        Last&nbsp;Name
      </th>
      <th>
        Gender
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
    foreach($objects as $patients){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $patients->getPatientId();
        ?>
        </td>
        <td>
        <?php
          echo $patients->getFileId();
        ?>
        </td>
        <td>
        <?php
          echo $patients->getFirstName();
        ?>
        </td>
        <td>
        <?php
          echo $patients->getOtherNames();
        ?>
        </td>
        <td>
        <?php
          echo $patients->getLastName();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/gender.php");
          include_once("../daos/gender-dao.php");

          $fgenderDao = new GenderDao(); 
          $fgender = $fgenderDao->select($patients->getGender()); 
          echo  $fgender==null?"-": $fgender->toString();
        ?>
        </td>
        <td>
        <?php
          echo $patients->getAddress();
        ?>
        </td>
        <td>
        <?php
          echo $patients->getContactNumber();
        ?>
        </td>
        <td>
        <?php
          echo $patients->getDateOfBirth();
        ?>
        </td>
        <td>
        <?php
          echo $patients->getNationality();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/status.php");
          include_once("../daos/status-dao.php");

          $fstatusDao = new StatusDao(); 
          $fstatus = $fstatusDao->select($patients->getStatus()); 
          echo  $fstatus==null?"-": $fstatus->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Patients.addNewPatients({patientId : \''.$patients->getPatientId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Patients.deletePatients('.$patients->getPatientId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
