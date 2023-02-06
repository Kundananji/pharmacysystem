<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/users.php");
include_once("../daos/users-dao.php");

//declare env variables for use
$env_dateNow = date("d/m/Y");
$env_timeNow = date("H:i:s");

$usersEditDao = new UsersDao();
$usersEdit = new Users();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["username"]) || $_POST["username"]==''){ 
  exit(json_encode(array("title"=>"username required","status"=>"error","message"=>"The field username is required")));
}
if(!isset($_POST["firstName"]) || $_POST["firstName"]==''){ 
  exit(json_encode(array("title"=>"firstName required","status"=>"error","message"=>"The field firstName is required")));
}
if(!isset($_POST["lastName"]) || $_POST["lastName"]==''){ 
  exit(json_encode(array("title"=>"lastName required","status"=>"error","message"=>"The field lastName is required")));
}
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}

$usersEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$usersEdit->setUsername(!isset($_POST["username"]) || $_POST["username"]==""?NULL:filter_var($_POST["username"],FILTER_SANITIZE_STRING));
$usersEdit->setFirstName(!isset($_POST["firstName"]) || $_POST["firstName"]==""?NULL:filter_var($_POST["firstName"],FILTER_SANITIZE_STRING));
$usersEdit->setLastName(!isset($_POST["lastName"]) || $_POST["lastName"]==""?NULL:filter_var($_POST["lastName"],FILTER_SANITIZE_STRING));
$usersEdit->setPassword(!isset($_POST["password"]) || $_POST["password"]==""?NULL:filter_var($_POST["password"],FILTER_SANITIZE_STRING));
$usersEdit->setAddress(!isset($_POST["address"]) || $_POST["address"]==""?NULL:filter_var($_POST["address"],FILTER_SANITIZE_STRING));
$usersEdit->setEmail(!isset($_POST["email"]) || $_POST["email"]==""?NULL:filter_var($_POST["email"],FILTER_SANITIZE_STRING));
$usersEdit->setContactNumber(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==""?NULL:filter_var($_POST["contactNumber"],FILTER_SANITIZE_STRING));
$usersEdit->setIsLoggedIn(!isset($_POST["isLoggedIn"]) || $_POST["isLoggedIn"]==""?NULL:filter_var($_POST["isLoggedIn"],FILTER_SANITIZE_NUMBER_INT));
$usersEdit->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));
$usersEdit->setProfile(!isset($_POST["profile"]) || $_POST["profile"]==""?NULL:filter_var($_POST["profile"],FILTER_SANITIZE_NUMBER_INT));

try{
if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
  $tempObject = $usersEditDao->update($usersEdit);
}else{
  $tempObject = $usersEditDao->insert($usersEdit);
}

if($tempObject !=null){
  exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully saved")));
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not saved")));
}
}catch(Exception $ex){
  if(stripos($ex->getMessage(),"create_error")!==false){
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>str_ireplace("create_error:","",$ex->getMessage()))));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Sorry, an error occurred. Try again later")));
  }
}

