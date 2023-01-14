<li class="nav-item dropdown no-arrow">
 <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'];?><?php echo isset($_SESSION['user_profile'])?("(".$_SESSION['user_profile'].")"):"";?></span><img class="img-profile rounded-circle"
        src="img/undraw_profile.svg">       
 </a>
 <!-- Dropdown - User Information -->
 <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
     aria-labelledby="userDropdown"><a class="dropdown-item" href="javascript:void(0)"" onclick="UserAuthentication.AccountSettingsForm()">
  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
  Account Settings
</a>

<?php
include_once("daos/_alternative-profile-dao.php");
include_once("classes/_alternative-profile.php");
include_once("daos/_profile-dao.php");
include_once("classes/_profile.php");
$alternativeProfileDao = new AlternativeProfiledao();
$profileDao = new Profiledao();
$currentProfile = $profileDao->select($_SESSION['user_profile_id']);
$defaultProfile = $profileDao->select($user['profile']);
$altProfiles = $alternativeProfileDao->selectBy(array("userId"),array($_SESSION['user_id']),array("i"));
if(sizeof($altProfiles) > 0){
  echo'<h6 class="text-center mt-3">Switch Profiles</h6>';
echo'<div class="dropdown-divider"></div>';
foreach($altProfiles as $altProfile){
$profile = $profileDao->select($altProfile->getProfileId()); 
if($currentProfile->getId() == $profile->getId()){continue;} 
?>
  <a class="dropdown-item" href="javascript:void(0)"" onclick="UserAuthentication.switchProfile({profileId: <?php echo $profile->getId();?>})">
    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
     Switch To <?php echo $profile->getName();?>
  </a>
<?php
}
if($currentProfile->getId() != $defaultProfile->getId()){ 
?>
  <a class="dropdown-item" href="javascript:void(0)"" onclick="UserAuthentication.switchProfile({profileId: <?php echo $defaultProfile->getId();?>})">
    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
     Switch To <?php echo $defaultProfile->getName();?>
  </a>
<?php }
}
?>

     <div class="dropdown-divider"></div>
     <a class="dropdown-item" href="javascript:void(0)"" data-toggle="modal" data-target="#logoutModal">
         <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
         Logout
     </a>
     </div>
</li>