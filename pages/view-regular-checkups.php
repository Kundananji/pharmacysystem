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
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/patients.php");
  include_once("../daos/patients-dao.php");

  $patientsDao = new PatientsDao(); 
  $patients =  $patientsDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of staff available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/staff.php");
  include_once("../daos/staff-dao.php");

  $staffDao = new StaffDao(); 
  $staff =  $staffDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/regular-checkups-dao.php");
include("../classes/regular-checkups.php");
include("../config/database.php");
$dao = new RegularCheckupsdao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Regular&nbsp;checkups</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="RegularCheckups.addNewRegularCheckups({})" id="add-new-regular-checkups"><em class="fa fa-plus"></em> Add New RegularCheckups </button></div>
<table class="table table-striped" id="table-regular-checkups">
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
        Conducted&nbsp;By
      </th>
      <th>
        Temperature
      </th>
      <th>
        Blood&nbsp;Pressure
      </th>
      <th>
        Weight
      </th>
      <th>
        Other
      </th>
      <th>
        Date&nbsp;Taken
      </th>
      <th>
        Time&nbsp;Taken
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
    foreach($objects as $regularCheckups){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $regularCheckups->getId();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/patients.php");
          include_once("../daos/patients-dao.php");

          $fpatientsDao = new PatientsDao(); 
          $fpatients = $fpatientsDao->select($regularCheckups->getPatientId()); 
          echo  $fpatients==null?"-": $fpatients->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/staff.php");
          include_once("../daos/staff-dao.php");

          $fstaffDao = new StaffDao(); 
          $fstaff = $fstaffDao->select($regularCheckups->getConductedBy()); 
          echo  $fstaff==null?"-": $fstaff->toString();
        ?>
        </td>
        <td>
        <?php
          echo $regularCheckups->getTemperature();
        ?>
        </td>
        <td>
        <?php
          echo $regularCheckups->getBloodPressure();
        ?>
        </td>
        <td>
        <?php
          echo $regularCheckups->getWeight();
        ?>
        </td>
        <td>
        <?php
          echo $regularCheckups->getOther();
        ?>
        </td>
        <td>
        <?php
          echo $regularCheckups->getDateTaken();
        ?>
        </td>
        <td>
        <?php
          echo $regularCheckups->getTimeTaken();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="RegularCheckups.addNewRegularCheckups({id : \''.$regularCheckups->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="RegularCheckups.deleteRegularCheckups('.$regularCheckups->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
