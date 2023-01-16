<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/patients-details.php");
include_once("../daos/patients-details-dao.php");

$patientsDetailsEditDao = new PatientsDetailsDao();
$patientsDetailsEdit = new PatientsDetails();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["fileId"]) || $_POST["fileId"]==''){ 
  exit(json_encode(array("title"=>"fileId required","status"=>"error","message"=>"The field fileId is required")));
}
if(!isset($_POST["firstName"]) || $_POST["firstName"]==''){ 
  exit(json_encode(array("title"=>"firstName required","status"=>"error","message"=>"The field firstName is required")));
}
if(!isset($_POST["lastName"]) || $_POST["lastName"]==''){ 
  exit(json_encode(array("title"=>"lastName required","status"=>"error","message"=>"The field lastName is required")));
}
if(!isset($_POST["dateOfBirth"]) || $_POST["dateOfBirth"]==''){ 
  exit(json_encode(array("title"=>"dateOfBirth required","status"=>"error","message"=>"The field dateOfBirth is required")));
}
if(!isset($_POST["nationality"]) || $_POST["nationality"]==''){ 
  exit(json_encode(array("title"=>"nationality required","status"=>"error","message"=>"The field nationality is required")));
}
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}

$patientsDetailsEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$patientsDetailsEdit->setFileId(!isset($_POST["fileId"]) || $_POST["fileId"]==""?NULL:filter_var($_POST["fileId"],FILTER_SANITIZE_STRING));
$patientsDetailsEdit->setFirstName(!isset($_POST["firstName"]) || $_POST["firstName"]==""?NULL:filter_var($_POST["firstName"],FILTER_SANITIZE_STRING));
$patientsDetailsEdit->setLastName(!isset($_POST["lastName"]) || $_POST["lastName"]==""?NULL:filter_var($_POST["lastName"],FILTER_SANITIZE_STRING));
$patientsDetailsEdit->setAddress(!isset($_POST["address"]) || $_POST["address"]==""?NULL:filter_var($_POST["address"],FILTER_SANITIZE_STRING));
$patientsDetailsEdit->setContactNumber(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==""?NULL:filter_var($_POST["contactNumber"],FILTER_SANITIZE_STRING));
$patientsDetailsEdit->setDateOfBirth(!isset($_POST["dateOfBirth"]) || $_POST["dateOfBirth"]==""?NULL:convertDate($_POST["dateOfBirth"]));
$patientsDetailsEdit->setNationality(!isset($_POST["nationality"]) || $_POST["nationality"]==""?NULL:filter_var($_POST["nationality"],FILTER_SANITIZE_STRING));
$patientsDetailsEdit->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $patientsDetailsEditDao->update($patientsDetailsEdit);
  }else{
    $tempObject = $patientsDetailsEditDao->insert($patientsDetailsEdit);
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

