<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/job-position.php");
include_once("../daos/job-position-dao.php");

$jobPositionEditDao = new JobPositionDao();
$jobPositionEdit = new JobPosition();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}

$jobPositionEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$jobPositionEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$jobPositionEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $jobPositionEditDao->update($jobPositionEdit);
  }else{
    $tempObject = $jobPositionEditDao->insert($jobPositionEdit);
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

