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
  exit(json_encode(array("title"=>"patientId required","status"=>"error","message"=>"The field patientId is required")));
}
if(!isset($_POST["procedureId"]) || $_POST["procedureId"]==''){ 
  exit(json_encode(array("title"=>"procedureId required","status"=>"error","message"=>"The field procedureId is required")));
}
if(!isset($_POST["conductedBy"]) || $_POST["conductedBy"]==''){ 
  exit(json_encode(array("title"=>"conductedBy required","status"=>"error","message"=>"The field conductedBy is required")));
}
if(!isset($_POST["dateConducted"]) || $_POST["dateConducted"]==''){ 
  exit(json_encode(array("title"=>"dateConducted required","status"=>"error","message"=>"The field dateConducted is required")));
}
if(!isset($_POST["timeConducted"]) || $_POST["timeConducted"]==''){ 
  exit(json_encode(array("title"=>"timeConducted required","status"=>"error","message"=>"The field timeConducted is required")));
}

$proceduresTakenEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$proceduresTakenEdit->setPatientId(!isset($_POST["patientId"]) || $_POST["patientId"]==""?NULL:filter_var($_POST["patientId"],FILTER_SANITIZE_NUMBER_INT));
$proceduresTakenEdit->setProcedureId(!isset($_POST["procedureId"]) || $_POST["procedureId"]==""?NULL:filter_var($_POST["procedureId"],FILTER_SANITIZE_NUMBER_INT));
$proceduresTakenEdit->setDoctorId(!isset($_POST["doctorId"]) || $_POST["doctorId"]==""?NULL:filter_var($_POST["doctorId"],FILTER_SANITIZE_NUMBER_INT));
$proceduresTakenEdit->setConductedBy(!isset($_POST["conductedBy"]) || $_POST["conductedBy"]==""?NULL:filter_var($_POST["conductedBy"],FILTER_SANITIZE_NUMBER_INT));
$proceduresTakenEdit->setResultsDetails(!isset($_POST["resultsDetails"]) || $_POST["resultsDetails"]==""?NULL:filter_var($_POST["resultsDetails"],FILTER_SANITIZE_STRING));
$proceduresTakenEdit->setRemarks(!isset($_POST["remarks"]) || $_POST["remarks"]==""?NULL:filter_var($_POST["remarks"],FILTER_SANITIZE_STRING));
$proceduresTakenEdit->setDateConducted(!isset($_POST["dateConducted"]) || $_POST["dateConducted"]==""?NULL:convertDate($_POST["dateConducted"]));
$proceduresTakenEdit->setTimeConducted(!isset($_POST["timeConducted"]) || $_POST["timeConducted"]==""?NULL:filter_var($_POST["timeConducted"],FILTER_SANITIZE_STRING));

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

