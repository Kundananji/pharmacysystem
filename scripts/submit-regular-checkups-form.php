<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/regular-checkups.php");
include_once("../daos/regular-checkups-dao.php");

$regularCheckupsEditDao = new RegularCheckupsDao();
$regularCheckupsEdit = new RegularCheckups();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["patientId"]) || $_POST["patientId"]==''){ 
  exit(json_encode(array("title"=>"patientId required","status"=>"error","message"=>"The field patient_id is required")));
}
if(!isset($_POST["temperature"]) || $_POST["temperature"]==''){ 
  exit(json_encode(array("title"=>"temperature required","status"=>"error","message"=>"The field temperature is required")));
}
if(!isset($_POST["bloodPressure"]) || $_POST["bloodPressure"]==''){ 
  exit(json_encode(array("title"=>"bloodPressure required","status"=>"error","message"=>"The field bloodPressure is required")));
}
if(!isset($_POST["weight"]) || $_POST["weight"]==''){ 
  exit(json_encode(array("title"=>"weight required","status"=>"error","message"=>"The field weight is required")));
}
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}
if(!isset($_POST["timeTested"]) || $_POST["timeTested"]==''){ 
  exit(json_encode(array("title"=>"timeTested required","status"=>"error","message"=>"The field timeTested is required")));
}

$regularCheckupsEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$regularCheckupsEdit->setPatientId(!isset($_POST["patientId"]) || $_POST["patientId"]==""?NULL:filter_var($_POST["patientId"],FILTER_SANITIZE_STRING));
$regularCheckupsEdit->setTemperature(!isset($_POST["temperature"]) || $_POST["temperature"]==""?NULL:filter_var($_POST["temperature"],FILTER_SANITIZE_STRING));
$regularCheckupsEdit->setBloodPressure(!isset($_POST["bloodPressure"]) || $_POST["bloodPressure"]==""?NULL:filter_var($_POST["bloodPressure"],FILTER_SANITIZE_STRING));
$regularCheckupsEdit->setWeight(!isset($_POST["weight"]) || $_POST["weight"]==""?NULL:filter_var($_POST["weight"],FILTER_SANITIZE_STRING));
$regularCheckupsEdit->setOther(!isset($_POST["other"]) || $_POST["other"]==""?NULL:filter_var($_POST["other"],FILTER_SANITIZE_STRING));
$regularCheckupsEdit->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));
$regularCheckupsEdit->setTimeTested(!isset($_POST["timeTested"]) || $_POST["timeTested"]==""?NULL:convertDate($_POST["timeTested"]));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $regularCheckupsEditDao->update($regularCheckupsEdit);
  }else{
    $tempObject = $regularCheckupsEditDao->insert($regularCheckupsEdit);
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

