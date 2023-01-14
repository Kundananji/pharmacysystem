<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/_alternative-profile.php");
include_once("../daos/_alternative-profile-dao.php");

//declare env variables for use
$env_dateNow = date("d/m/Y");
$env_timeNow = date("H:i:s");

$alternativeProfileEditDao = new AlternativeProfileDao();
$alternativeProfileEdit = new AlternativeProfile();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["userId"]) || $_POST["userId"]==''){ 
  exit(json_encode(array("title"=>"userId required","status"=>"error","message"=>"The field userId is required")));
}
if(!isset($_POST["profileId"]) || $_POST["profileId"]==''){ 
  exit(json_encode(array("title"=>"profileId required","status"=>"error","message"=>"The field profileId is required")));
}

$alternativeProfileEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$alternativeProfileEdit->setUserId(!isset($_POST["userId"]) || $_POST["userId"]==""?NULL:filter_var($_POST["userId"],FILTER_SANITIZE_NUMBER_INT));
$alternativeProfileEdit->setProfileId(!isset($_POST["profileId"]) || $_POST["profileId"]==""?NULL:filter_var($_POST["profileId"],FILTER_SANITIZE_NUMBER_INT));

try{
if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
  $tempObject = $alternativeProfileEditDao->update($alternativeProfileEdit);
}else{
  $tempObject = $alternativeProfileEditDao->insert($alternativeProfileEdit);
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

