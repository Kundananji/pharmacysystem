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
include("../daos/department-dao.php");
include("../classes/department.php");
include("../config/database.php");
$dao = new DepartmentDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Department</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Department.addNewDepartment({})" id="add-new-department"><em class="fa fa-plus"></em> Add New Department </button></div>
<table class="table table-striped" id="table-department">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Id
      </th>
      <th>
        Name
      </th>
      <th>
        Description
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
    foreach($objects as $department){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $department->getId();
        ?>
        </td>
        <td>
        <?php
          echo $department->getName();
        ?>
        </td>
        <td>
        <?php
          echo $department->getDescription();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Department.addNewDepartment({id : \''.$department->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Department.deleteDepartment('.$department->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
