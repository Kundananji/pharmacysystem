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
include("../daos/_alternative-profile-dao.php");
include("../classes/_alternative-profile.php");
include("../config/database.php");
$dao = new AlternativeProfiledao();

$appendQuery='';
foreach($_POST as $key=>$value){
  $$key =filter_var($_POST[$key],FILTER_SANITIZE_STRING);
  if($key == "_term") continue;
  $appendQuery.=' AND '. $key.'='.$$key;
}
//make available variables of _profile available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/_profile.php");
  include_once("../daos/_profile-dao.php");

  $profileDao = new ProfileDao(); 
  $profile =  $profileDao->select(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of users available in scope for use:
if(isset($_POST['ID']) && $_POST['ID']!=''){
  include_once("../classes/users.php");
  include_once("../daos/users-dao.php");

  $usersDao = new UsersDao(); 
  $users =  $usersDao->select(filter_var($_POST['ID'],FILTER_SANITIZE_NUMBER_INT)); 
}

if($appendQuery!= ""){
$objects = $dao->selectByWhereClause('( 1 '.$appendQuery.' )  ');
}else{
$objects = $dao->selectAll();
}

?>
 <h1 class="h3 mb-4 text-gray-800">Manage User Profiles</h1>  
<div class="mb-3">
  <button class="btn btn-primary" onclick="AlternativeProfile.addNewAlternativeProfileUserprofiles_admin({<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" id="add-new-_alternative-profile-user-profiles_admin"><em class="fa fa-plus"></em> Add New User Profile </button>
</div>
<table class="table table-striped" id="table-_alternative-profile--user-profiles_admin">
  <thead>
    <tr>
      <th>
        No.
      </th>
      <th>
        User
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
    foreach($objects as $alternativeProfile){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          $userId=$alternativeProfile->getUserId();
          include_once("../classes/users.php");
          include_once("../daos/users-dao.php");

          $fusersDao = new UsersDao(); 
          $fusers = $fusersDao->select($alternativeProfile->getUserId()); 
          echo  $fusers==null?"-": $fusers->toString();
        ?>
        </td>
        <td>
        <?php
          $profileId=$alternativeProfile->getProfileId();
          include_once("../classes/_profile.php");
          include_once("../daos/_profile-dao.php");

          $fprofileDao = new ProfileDao(); 
          $fprofile = $fprofileDao->select($alternativeProfile->getProfileId()); 
          echo  $fprofile==null?"-": $fprofile->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="AlternativeProfile.addNewAlternativeProfileUserprofiles_admin({ id:\''.$alternativeProfile->getId().'\',})"> <em class="fa fa-edit"></em> </a>';
          
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="AlternativeProfile.deleteAlternativeProfileUserprofiles_admin('.$alternativeProfile->getId().' )">  <em class="fa fa-trash"></em> </a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
