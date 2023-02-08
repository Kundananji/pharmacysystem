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
//make available variables of patients available in scope for use:
if(isset($_POST['patientId']) && $_POST['patientId']!=''){
  include_once("../classes/patients.php");
  include_once("../daos/patients-dao.php");

  $patientsDao = new PatientsDao(); 
  $patients =  $patientsDao->select(filter_var($_GET['patientId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of patients available in scope for use:
if(isset($_POST['patientId']) && $_POST['patientId']!=''){
  include_once("../classes/patients.php");
  include_once("../daos/patients-dao.php");

  $patientsDao = new PatientsDao(); 
  $patients =  $patientsDao->select(filter_var($_GET['patientId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of hospital_procedure available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/hospital-procedure.php");
  include_once("../daos/hospital-procedure-dao.php");

  $hospitalProcedureDao = new HospitalProcedureDao(); 
  $hospitalProcedure =  $hospitalProcedureDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of staff available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/staff.php");
  include_once("../daos/staff-dao.php");

  $staffDao = new StaffDao(); 
  $staff =  $staffDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of staff available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/staff.php");
  include_once("../daos/staff-dao.php");

  $staffDao = new StaffDao(); 
  $staff =  $staffDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
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
        Id
      </th>
      <th>
        Patient
      </th>
      <th>
        Procedure
      </th>
      <th>
        Doctor
      </th>
      <th>
        Conducted&nbsp;By
      </th>
      <th>
        Results&nbsp;Details
      </th>
      <th>
        Remarks
      </th>
      <th>
        Date&nbsp;Conducted
      </th>
      <th>
        Time&nbsp;Conducted
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
          include_once("../classes/patients.php");
          include_once("../daos/patients-dao.php");

          $fpatientsDao = new PatientsDao(); 
          $fpatients = $fpatientsDao->select($proceduresTaken->getPatientId()); 
          echo  $fpatients==null?"-": $fpatients->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/hospital-procedure.php");
          include_once("../daos/hospital-procedure-dao.php");

          $fhospitalProcedureDao = new HospitalProcedureDao(); 
          $fhospitalProcedure = $fhospitalProcedureDao->select($proceduresTaken->getProcedureId()); 
          echo  $fhospitalProcedure==null?"-": $fhospitalProcedure->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/staff.php");
          include_once("../daos/staff-dao.php");

          $fstaffDao = new StaffDao(); 
          $fstaff = $fstaffDao->select($proceduresTaken->getDoctorId()); 
          echo  $fstaff==null?"-": $fstaff->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/staff.php");
          include_once("../daos/staff-dao.php");

          $fstaffDao = new StaffDao(); 
          $fstaff = $fstaffDao->select($proceduresTaken->getConductedBy()); 
          echo  $fstaff==null?"-": $fstaff->toString();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getResultsDetails();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getRemarks();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getDateConducted();
        ?>
        </td>
        <td>
        <?php
          echo $proceduresTaken->getTimeConducted();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="ProceduresTaken.addNewProceduresTaken({id : \''.$proceduresTaken->getId().'\',})"> <em class="fa fa-edit"></em></a>';
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
