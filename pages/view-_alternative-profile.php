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
//make available variables of users available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/users.php");
  include_once("../daos/users-dao.php");

  $usersDao = new UsersDao(); 
  $users =  $usersDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/_alternative-profile-dao.php");
include("../classes/_alternative-profile.php");
include("../config/database.php");
$dao = new AlternativeProfiledao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">&nbsp;alternative&nbsp;profile</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="AlternativeProfile.addNewAlternativeProfile({})" id="add-new-_alternative-profile"><em class="fa fa-plus"></em> Add New AlternativeProfile </button></div>
<table class="table table-striped" id="table-_alternative-profile">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        Id
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
          echo $alternativeProfile->getId();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/users.php");
          include_once("../daos/users-dao.php");

          $fusersDao = new UsersDao(); 
          $fusers = $fusersDao->select($alternativeProfile->getUserId()); 
          echo  $fusers==null?"-": $fusers->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/_profile.php");
          include_once("../daos/_profile-dao.php");

          $fprofileDao = new ProfileDao(); 
          $fprofile = $fprofileDao->select($alternativeProfile->getProfileId()); 
          echo  $fprofile==null?"-": $fprofile->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="AlternativeProfile.addNewAlternativeProfile({id : \''.$alternativeProfile->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="AlternativeProfile.deleteAlternativeProfile('.$alternativeProfile->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
