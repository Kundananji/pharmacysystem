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
//make available variables of yesno available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/doctor-dao.php");
include("../classes/doctor.php");
include("../config/database.php");
$dao = new DoctorDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Doctor</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Doctor.addNewDoctor({})" id="add-new-doctor"><em class="fa fa-plus"></em> Add New Doctor </button></div>
<table class="table table-striped" id="table-doctor">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Doctor
      </th>
      <th>
        Name
      </th>
      <th>
        Contact&nbsp;Number
      </th>
      <th>
        Address
      </th>
      <th>
        Is&nbsp;Active
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
    foreach($objects as $doctor){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $doctor->getDoctorId();
        ?>
        </td>
        <td>
        <?php
          echo $doctor->getName();
        ?>
        </td>
        <td>
        <?php
          echo $doctor->getContactNumber();
        ?>
        </td>
        <td>
        <?php
          echo $doctor->getAddress();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/yesno.php");
          include_once("../daos/yesno-dao.php");

          $fyesnoDao = new YesnoDao(); 
          $fyesno = $fyesnoDao->select($doctor->getIsActive()); 
          echo  $fyesno==null?"-": $fyesno->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Doctor.addNewDoctor({doctorId : \''.$doctor->getDoctorId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Doctor.deleteDoctor('.$doctor->getDoctorId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
