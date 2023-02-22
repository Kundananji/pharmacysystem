<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/fee.php");
include_once("../daos/fee-dao.php");

$feeEditDao = new FeeDao();
$feeEdit = new Fee();

if(!isset($_POST["feeId"]) || $_POST["feeId"]==''){ 
  exit(json_encode(array("title"=>"feeId required","status"=>"error","message"=>"The field feeId is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["amount"]) || $_POST["amount"]==''){ 
  exit(json_encode(array("title"=>"amount required","status"=>"error","message"=>"The field amount is required")));
}
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}

$feeEdit->setFeeId(!isset($_POST["feeId"]) || $_POST["feeId"]==""?NULL:filter_var($_POST["feeId"],FILTER_SANITIZE_NUMBER_INT));
$feeEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$feeEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$feeEdit->setFeeCategoryId(!isset($_POST["feeCategoryId"]) || $_POST["feeCategoryId"]==""?NULL:filter_var($_POST["feeCategoryId"],FILTER_SANITIZE_NUMBER_INT));
$feeEdit->setAmount(!isset($_POST["amount"]) || $_POST["amount"]==""?NULL:filter_var($_POST["amount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$feeEdit->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["feeId"]) && (int)$_POST["feeId"] > 0){
    $tempObject = $feeEditDao->update($feeEdit);
  }else{
    $tempObject = $feeEditDao->insert($feeEdit);
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

