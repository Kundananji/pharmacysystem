<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/staff.php");
include_once("../daos/staff-dao.php");

$staffEditDao = new StaffDao();
$staffEdit = new Staff();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["title"]) || $_POST["title"]==''){ 
  exit(json_encode(array("title"=>"title required","status"=>"error","message"=>"The field title is required")));
}
if(!isset($_POST["position"]) || $_POST["position"]==''){ 
  exit(json_encode(array("title"=>"position required","status"=>"error","message"=>"The field position is required")));
}
if(!isset($_POST["phoneNumber"]) || $_POST["phoneNumber"]==''){ 
  exit(json_encode(array("title"=>"phoneNumber required","status"=>"error","message"=>"The field phoneNumber is required")));
}
if(!isset($_POST["address"]) || $_POST["address"]==''){ 
  exit(json_encode(array("title"=>"address required","status"=>"error","message"=>"The field address is required")));
}
if(!isset($_POST["nationaility"]) || $_POST["nationaility"]==''){ 
  exit(json_encode(array("title"=>"nationaility required","status"=>"error","message"=>"The field nationaility is required")));
}
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}

$staffEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$staffEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$staffEdit->setTitle(!isset($_POST["title"]) || $_POST["title"]==""?NULL:filter_var($_POST["title"],FILTER_SANITIZE_STRING));
$staffEdit->setPosition(!isset($_POST["position"]) || $_POST["position"]==""?NULL:filter_var($_POST["position"],FILTER_SANITIZE_NUMBER_INT));
$staffEdit->setPhoneNumber(!isset($_POST["phoneNumber"]) || $_POST["phoneNumber"]==""?NULL:filter_var($_POST["phoneNumber"],FILTER_SANITIZE_STRING));
$staffEdit->setAddress(!isset($_POST["address"]) || $_POST["address"]==""?NULL:filter_var($_POST["address"],FILTER_SANITIZE_STRING));
$staffEdit->setNationaility(!isset($_POST["nationaility"]) || $_POST["nationaility"]==""?NULL:filter_var($_POST["nationaility"],FILTER_SANITIZE_STRING));
$staffEdit->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));
$staffEdit->setManNo(!isset($_POST["manNo"]) || $_POST["manNo"]==""?NULL:filter_var($_POST["manNo"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $staffEditDao->update($staffEdit);
  }else{
    $tempObject = $staffEditDao->insert($staffEdit);
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

