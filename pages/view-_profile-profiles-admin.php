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
  $arguments[]=" $key :'".$value."'";
  //put arguments in scope
  $$key = $value;
}
include("../daos/_profile-dao.php");
include("../classes/_profile.php");
include("../config/database.php");
$dao = new Profiledao();

$appendQuery='';
foreach($_POST as $key=>$value){
  $$key =filter_var($_POST[$key],FILTER_SANITIZE_STRING);
  if($key == "_term") continue;
  $appendQuery.=' AND '. $key.'='.$$key;
}
//make available variables of yesno available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of yesno available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT)); 
}

if($appendQuery!= ""){
$objects = $dao->selectByWhereClause('( 1 '.$appendQuery.' )  ');
}else{
$objects = $dao->selectAll();
}

?>
 <h1 class="h3 mb-4 text-gray-800">Manage Profiles</h1>  
<div class="mb-3">
  <button class="btn btn-primary" onclick="Profile.addNewProfileProfiles_admin({<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" id="add-new-_profile-profiles-admin"><em class="fa fa-plus"></em> Add New Profile </button>
</div>
<table class="table table-striped" id="table-_profile--profiles-admin">
  <thead>
    <tr>
      <th>
        No.
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
          $name=$profile->getName();
          echo str_ireplace("\n","<br/>",$profile->getName());
        ?>
        </td>
        <td>
        <?php
          $description=$profile->getDescription();
          echo str_ireplace("\n","<br/>",$profile->getDescription());
        ?>
        </td>
        <td>
        <?php
          $isActive=$profile->getIsActive();
          include_once("../classes/yesno.php");
          include_once("../daos/yesno-dao.php");

          $fyesnoDao = new YesnoDao(); 
          $fyesno = $fyesnoDao->select($profile->getIsActive()); 
          echo  $fyesno==null?"-": $fyesno->toString();
        ?>
        </td>
        <td>
        <?php
          $isDefault=$profile->getIsDefault();
          include_once("../classes/yesno.php");
          include_once("../daos/yesno-dao.php");

          $fyesnoDao = new YesnoDao(); 
          $fyesno = $fyesnoDao->select($profile->getIsDefault()); 
          echo  $fyesno==null?"-": $fyesno->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Profile.addNewProfileProfiles_admin({ id:\''.$profile->getId().'\',})"> <em class="fa fa-edit"></em> </a>';
          
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Profile.deleteProfileProfiles_admin('.$profile->getId().' )">  <em class="fa fa-trash"></em> </a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
