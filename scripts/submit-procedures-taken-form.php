<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/procedures-taken.php");
include_once("../daos/procedures-taken-dao.php");

$proceduresTakenEditDao = new ProceduresTakenDao();
$proceduresTakenEdit = new ProceduresTaken();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["patientId"]) || $_POST["patientId"]==''){ 
  exit(json_encode(array("title"=>"patientId required","status"=>"error","message"=>"The field patient_id is required")));
}
if(!isset($_POST["department"]) || $_POST["department"]==''){ 
  exit(json_encode(array("title"=>"department required","status"=>"error","message"=>"The field department is required")));
}
if(!isset($_POST["procedureConducted"]) || $_POST["procedureConducted"]==''){ 
  exit(json_encode(array("title"=>"procedureConducted required","status"=>"error","message"=>"The field procedureConducted is required")));
}
if(!isset($_POST["doctorsName"]) || $_POST["doctorsName"]==''){ 
  exit(json_encode(array("title"=>"doctorsName required","status"=>"error","message"=>"The field doctorsName is required")));
}
if(!isset($_POST["labTech"]) || $_POST["labTech"]==''){ 
  exit(json_encode(array("title"=>"labTech required","status"=>"error","message"=>"The field labTech is required")));
}
if(!isset($_POST["fee"]) || $_POST["fee"]==''){ 
  exit(json_encode(array("title"=>"fee required","status"=>"error","message"=>"The field fee is required")));
}
if(!isset($_POST["timeTested"]) || $_POST["timeTested"]==''){ 
  exit(json_encode(array("title"=>"timeTested required","status"=>"error","message"=>"The field timeTested is required")));
}

$proceduresTakenEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$proceduresTakenEdit->setPatientId(!isset($_POST["patientId"]) || $_POST["patientId"]==""?NULL:filter_var($_POST["patientId"],FILTER_SANITIZE_STRING));
$proceduresTakenEdit->setDepartment(!isset($_POST["department"]) || $_POST["department"]==""?NULL:filter_var($_POST["department"],FILTER_SANITIZE_STRING));
$proceduresTakenEdit->setProcedureConducted(!isset($_POST["procedureConducted"]) || $_POST["procedureConducted"]==""?NULL:filter_var($_POST["procedureConducted"],FILTER_SANITIZE_STRING));
$proceduresTakenEdit->setResultsDetails(!isset($_POST["resultsDetails"]) || $_POST["resultsDetails"]==""?NULL:filter_var($_POST["resultsDetails"],FILTER_SANITIZE_STRING));
$proceduresTakenEdit->setDoctorsName(!isset($_POST["doctorsName"]) || $_POST["doctorsName"]==""?NULL:filter_var($_POST["doctorsName"],FILTER_SANITIZE_STRING));
$proceduresTakenEdit->setLabTech(!isset($_POST["labTech"]) || $_POST["labTech"]==""?NULL:filter_var($_POST["labTech"],FILTER_SANITIZE_STRING));
$proceduresTakenEdit->setFee(!isset($_POST["fee"]) || $_POST["fee"]==""?NULL:filter_var($_POST["fee"],FILTER_SANITIZE_NUMBER_INT));
$proceduresTakenEdit->setTimeTested(!isset($_POST["timeTested"]) || $_POST["timeTested"]==""?NULL:convertDate($_POST["timeTested"]));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $proceduresTakenEditDao->update($proceduresTakenEdit);
  }else{
    $tempObject = $proceduresTakenEditDao->insert($proceduresTakenEdit);
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

