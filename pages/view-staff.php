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
//make available variables of job_position available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/job-position.php");
  include_once("../daos/job-position-dao.php");

  $jobPositionDao = new JobPositionDao(); 
  $jobPosition =  $jobPositionDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of status available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/status.php");
  include_once("../daos/status-dao.php");

  $statusDao = new StatusDao(); 
  $status =  $statusDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/staff-dao.php");
include("../classes/staff.php");
include("../config/database.php");
$dao = new StaffDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Staff</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Staff.addNewStaff({})" id="add-new-staff"><em class="fa fa-plus"></em> Add New Staff </button></div>
<table class="table table-striped" id="table-staff">
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
        Title
      </th>
      <th>
        Position
      </th>
      <th>
        Phone&nbsp;Number
      </th>
      <th>
        Address
      </th>
      <th>
        Nationaility
      </th>
      <th>
        Status
      </th>
      <th>
        Man&nbsp;No
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
    foreach($objects as $staff){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $staff->getId();
        ?>
        </td>
        <td>
        <?php
          echo $staff->getName();
        ?>
        </td>
        <td>
        <?php
          echo $staff->getTitle();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/job-position.php");
          include_once("../daos/job-position-dao.php");

          $fjobPositionDao = new JobPositionDao(); 
          $fjobPosition = $fjobPositionDao->select($staff->getPosition()); 
          echo  $fjobPosition==null?"-": $fjobPosition->toString();
        ?>
        </td>
        <td>
        <?php
          echo $staff->getPhoneNumber();
        ?>
        </td>
        <td>
        <?php
          echo $staff->getAddress();
        ?>
        </td>
        <td>
        <?php
          echo $staff->getNationaility();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/status.php");
          include_once("../daos/status-dao.php");

          $fstatusDao = new StatusDao(); 
          $fstatus = $fstatusDao->select($staff->getStatus()); 
          echo  $fstatus==null?"-": $fstatus->toString();
        ?>
        </td>
        <td>
        <?php
          echo $staff->getManNo();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Staff.addNewStaff({id : \''.$staff->getId.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Staff.deleteStaff('.$staff->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
