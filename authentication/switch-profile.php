<?php
  session_start();
 
  include("../config/database.php");
  include("../config/authentication.php");
  include("../daos/_alternative-profile-dao.php");
  include("../classes/_alternative-profile.php");
  include("../daos/_profile-dao.php");
  include("../classes/_profile.php");

  $authentication = new Authentication();

  $userLoggedIn = $authentication->isUserLoggedIn();
  if(!$userLoggedIn){
    exit(json_encode(array("title"=>"No Session","status"=>"failure","message"=>"User has no current session")));
  }

  $user = $authentication->getUserById($_SESSION['user_id']);
  
  $alternativeProfileDao = new AlternativeProfiledao();
  $profileDao = new Profiledao();

  if(!isset($_POST['profileId'])){
    exit(json_encode(array("title"=>"Profile Missing","status"=>"failure","message"=>"Please specify the profile to switch to")));
  }

  $profileId = filter_var($_POST['profileId'],FILTER_SANITIZE_NUMBER_INT);

  //find out if the user has this profile on their account

  $altProfiles = $alternativeProfileDao->selectBy(array("userId","profileId"),array($_SESSION['user_id'],$profileId),array("i","i"));

  if( sizeof($altProfiles) == 0 && $profileId != $user['profile']){
    exit(json_encode(array("title"=>"Invalid Switch","status"=>"failure","message"=>"User unable to switch to specified profile")));
  }

  $profile = $profileDao->select($profileId);

  $_SESSION['user_profile']=$profile->getName();
  $_SESSION['user_profile_id']=$profile->getId();
  

   exit(json_encode(array("title"=>"Switch Successful","status"=>"success","message"=>"Successfully switched to ". $profile->getName())));
  

  