<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/hospital-procedures.php");
include_once("../daos/hospital-procedures-dao.php");

$hospitalProceduresEditDao = new HospitalProceduresDao();
$hospitalProceduresEdit = new HospitalProcedures();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["description"]) || $_POST["description"]==''){ 
  exit(json_encode(array("title"=>"description required","status"=>"error","message"=>"The field description is required")));
}
if(!isset($_POST["fee"]) || $_POST["fee"]==''){ 
  exit(json_encode(array("title"=>"fee required","status"=>"error","message"=>"The field fee is required")));
}

$hospitalProceduresEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$hospitalProceduresEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$hospitalProceduresEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$hospitalProceduresEdit->setFee(!isset($_POST["fee"]) || $_POST["fee"]==""?NULL:filter_var($_POST["fee"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $hospitalProceduresEditDao->update($hospitalProceduresEdit);
  }else{
    $tempObject = $hospitalProceduresEditDao->insert($hospitalProceduresEdit);
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

