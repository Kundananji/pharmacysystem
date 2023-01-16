<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/hospital-procedure.php");
include_once("../daos/hospital-procedure-dao.php");

$hospitalProcedureEditDao = new HospitalProcedureDao();
$hospitalProcedureEdit = new HospitalProcedure();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["description"]) || $_POST["description"]==''){ 
  exit(json_encode(array("title"=>"description required","status"=>"error","message"=>"The field description is required")));
}
if(!isset($_POST["departmentId"]) || $_POST["departmentId"]==''){ 
  exit(json_encode(array("title"=>"departmentId required","status"=>"error","message"=>"The field departmentId is required")));
}
if(!isset($_POST["feeId"]) || $_POST["feeId"]==''){ 
  exit(json_encode(array("title"=>"feeId required","status"=>"error","message"=>"The field feeId is required")));
}

$hospitalProcedureEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$hospitalProcedureEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$hospitalProcedureEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$hospitalProcedureEdit->setDepartmentId(!isset($_POST["departmentId"]) || $_POST["departmentId"]==""?NULL:filter_var($_POST["departmentId"],FILTER_SANITIZE_NUMBER_INT));
$hospitalProcedureEdit->setFeeId(!isset($_POST["feeId"]) || $_POST["feeId"]==""?NULL:filter_var($_POST["feeId"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $hospitalProcedureEditDao->update($hospitalProcedureEdit);
  }else{
    $tempObject = $hospitalProcedureEditDao->insert($hospitalProcedureEdit);
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

