<?php
//include scripts
include("../config/database.php");
include_once("../classes/users.php");
include_once("../daos/users-dao.php");

$usersDao = new UsersDao();
$users = new Users();




if($_POST["email"]==null || $_POST["email"]==''){ 
  exit(json_encode(array("title"=>"email required","status"=>"error","message"=>"The field email is required")));
}
if($_POST["confirmPassword"]==null || $_POST["confirmPassword"]==''){ 
  exit(json_encode(array("title"=>"Confirm Password required","status"=>"error","message"=>"Please repeat the password to confirm it.")));
}
if($_POST["password"]==null || $_POST["password"]==''){ 
  exit(json_encode(array("title"=>"Password required","status"=>"error","message"=>"The field password is required")));
}

if($_POST["resetId"]==null || $_POST["resetId"]==''){ 
  exit(json_encode(array("title"=>"Request Invalid","status"=>"error","message"=>"Your request is invalid")));
}

$email =filter_var($_POST["email"],FILTER_SANITIZE_STRING);
$password =filter_var($_POST["password"],FILTER_SANITIZE_STRING);
$confirmPassword =filter_var($_POST["confirmPassword"],FILTER_SANITIZE_STRING);
$resetId =filter_var($_POST["resetId"],FILTER_SANITIZE_STRING);

$users = $usersDao->selectBy(array('email'),array($email),array("s"))[0];


if($users !=null){
  
  $hashedPassword = $users->getPassword();

  if($hashedPassword!=$resetId){
    exit(json_encode(array("title"=>"Request Expired","status"=>"error","message"=>"Your request is invalid or has expired.")));
  }

  $newHashedPassword = password_hash($password,PASSWORD_DEFAULT);
   
  //reset complete
  $users->setPassword($newHashedPassword);
  //update user with new password
  $tempObject = $usersDao->update($users);
 

  if($tempObject !=null){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Password has been successfully reset!")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Password has not been reset.")));
  }
}
else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Password has not been reset..")));
}


