<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/patient-scheme.php");
include_once("../daos/patient-scheme-dao.php");

$patientSchemeEditDao = new PatientSchemeDao();
$patientSchemeEdit = new PatientScheme();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["patientId"]) || $_POST["patientId"]==''){ 
  exit(json_encode(array("title"=>"patientId required","status"=>"error","message"=>"The field patientId is required")));
}
if(!isset($_POST["insuranceProviderId"]) || $_POST["insuranceProviderId"]==''){ 
  exit(json_encode(array("title"=>"insuranceProviderId required","status"=>"error","message"=>"The field insuranceProviderId is required")));
}
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}

$patientSchemeEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$patientSchemeEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$patientSchemeEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$patientSchemeEdit->setPatientId(!isset($_POST["patientId"]) || $_POST["patientId"]==""?NULL:filter_var($_POST["patientId"],FILTER_SANITIZE_NUMBER_INT));
$patientSchemeEdit->setInsuranceProviderId(!isset($_POST["insuranceProviderId"]) || $_POST["insuranceProviderId"]==""?NULL:filter_var($_POST["insuranceProviderId"],FILTER_SANITIZE_NUMBER_INT));
$patientSchemeEdit->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $patientSchemeEditDao->update($patientSchemeEdit);
  }else{
    $tempObject = $patientSchemeEditDao->insert($patientSchemeEdit);
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

