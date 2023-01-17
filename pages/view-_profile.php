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
//make available variables of yesno available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/_profile-dao.php");
include("../classes/_profile.php");
include("../config/database.php");
$dao = new Profiledao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">&nbsp;profile</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Profile.addNewProfile({})" id="add-new-_profile"><em class="fa fa-plus"></em> Add New Profile </button></div>
<table class="table table-striped" id="table-_profile">
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
        Is&nbsp;Active
      </th>
      <th>
        Is&nbsp;Default
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
    foreach($objects as $profile){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $profile->getId();
        ?>
        </td>
        <td>
        <?php
          echo $profile->getName();
        ?>
        </td>
        <td>
        <?php
          echo $profile->getDescription();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/yesno.php");
          include_once("../daos/yesno-dao.php");

          $fyesnoDao = new YesnoDao(); 
          $fyesno = $fyesnoDao->select($profile->getIsActive()); 
          echo  $fyesno==null?"-": $fyesno->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/yesno.php");
          include_once("../daos/yesno-dao.php");

          $fyesnoDao = new YesnoDao(); 
          $fyesno = $fyesnoDao->select($profile->getIsDefault()); 
          echo  $fyesno==null?"-": $fyesno->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Profile.addNewProfile({id : \''.$profile->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Profile.deleteProfile('.$profile->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
