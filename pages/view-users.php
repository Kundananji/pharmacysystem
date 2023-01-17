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
//make available variables of _profile available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/_profile.php");
  include_once("../daos/_profile-dao.php");

  $profileDao = new ProfileDao(); 
  $profile =  $profileDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of status available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/status.php");
  include_once("../daos/status-dao.php");

  $statusDao = new StatusDao(); 
  $status =  $statusDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of yesno available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/users-dao.php");
include("../classes/users.php");
include("../config/database.php");
$dao = new UsersDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Users</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Users.addNewUsers({})" id="add-new-users"><em class="fa fa-plus"></em> Add New Users </button></div>
<table class="table table-striped" id="table-users">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        Username
      </th>
      <th>
        First&nbsp;Name
      </th>
      <th>
        Last&nbsp;Name
      </th>
      <th>
        Password
      </th>
      <th>
        Address
      </th>
      <th>
        Email
      </th>
      <th>
        Contact&nbsp;Number
      </th>
      <th>
        Is&nbsp;Logged&nbsp;In
      </th>
      <th>
        Status
      </th>
      <th>
        Profile
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
    foreach($objects as $users){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $users->getId();
        ?>
        </td>
        <td>
        <?php
          echo $users->getUsername();
        ?>
        </td>
        <td>
        <?php
          echo $users->getFirstName();
        ?>
        </td>
        <td>
        <?php
          echo $users->getLastName();
        ?>
        </td>
        <td>
        <?php
          echo $users->getPassword();
        ?>
        </td>
        <td>
        <?php
          echo $users->getAddress();
        ?>
        </td>
        <td>
        <?php
          echo $users->getEmail();
        ?>
        </td>
        <td>
        <?php
          echo $users->getContactNumber();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/yesno.php");
          include_once("../daos/yesno-dao.php");

          $fyesnoDao = new YesnoDao(); 
          $fyesno = $fyesnoDao->select($users->getIsLoggedIn()); 
          echo  $fyesno==null?"-": $fyesno->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/status.php");
          include_once("../daos/status-dao.php");

          $fstatusDao = new StatusDao(); 
          $fstatus = $fstatusDao->select($users->getStatus()); 
          echo  $fstatus==null?"-": $fstatus->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/_profile.php");
          include_once("../daos/_profile-dao.php");

          $fprofileDao = new ProfileDao(); 
          $fprofile = $fprofileDao->select($users->getProfile()); 
          echo  $fprofile==null?"-": $fprofile->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Users.addNewUsers({id : \''.$users->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Users.deleteUsers('.$users->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
