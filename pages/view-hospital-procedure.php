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
//make available variables of fee available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/fee.php");
  include_once("../daos/fee-dao.php");

  $feeDao = new FeeDao(); 
  $fee =  $feeDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of department available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/department.php");
  include_once("../daos/department-dao.php");

  $departmentDao = new DepartmentDao(); 
  $department =  $departmentDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/hospital-procedure-dao.php");
include("../classes/hospital-procedure.php");
include("../config/database.php");
$dao = new HospitalProceduredao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Hospital&nbsp;procedure</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="HospitalProcedure.addNewHospitalProcedure({})" id="add-new-hospital-procedure"><em class="fa fa-plus"></em> Add New HospitalProcedure </button></div>
<table class="table table-striped" id="table-hospital-procedure">
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
        Department
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
    foreach($objects as $hospitalProcedure){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $hospitalProcedure->getId();
        ?>
        </td>
        <td>
        <?php
          echo $hospitalProcedure->getName();
        ?>
        </td>
        <td>
        <?php
          echo $hospitalProcedure->getDescription();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/department.php");
          include_once("../daos/department-dao.php");

          $fdepartmentDao = new DepartmentDao(); 
          $fdepartment = $fdepartmentDao->select($hospitalProcedure->getDepartmentId()); 
          echo  $fdepartment==null?"-": $fdepartment->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/fee.php");
          include_once("../daos/fee-dao.php");

          $ffeeDao = new FeeDao(); 
          $ffee = $ffeeDao->select($hospitalProcedure->getFeeId()); 
          echo  $ffee==null?"-": $ffee->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="HospitalProcedure.addNewHospitalProcedure({id : \''.$hospitalProcedure->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="HospitalProcedure.deleteHospitalProcedure('.$hospitalProcedure->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
