<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/receipt.php");
include_once("../daos/receipt-dao.php");

$receiptEditDao = new ReceiptDao();
$receiptEdit = new Receipt();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["description"]) || $_POST["description"]==''){ 
  exit(json_encode(array("title"=>"description required","status"=>"error","message"=>"The field description is required")));
}
if(!isset($_POST["patientId"]) || $_POST["patientId"]==''){ 
  exit(json_encode(array("title"=>"patientId required","status"=>"error","message"=>"The field patientId is required")));
}
if(!isset($_POST["receiptNo"]) || $_POST["receiptNo"]==''){ 
  exit(json_encode(array("title"=>"receiptNo required","status"=>"error","message"=>"The field receiptNo is required")));
}
if(!isset($_POST["receiptDate"]) || $_POST["receiptDate"]==''){ 
  exit(json_encode(array("title"=>"receiptDate required","status"=>"error","message"=>"The field receiptDate is required")));
}
if(!isset($_POST["amount"]) || $_POST["amount"]==''){ 
  exit(json_encode(array("title"=>"amount required","status"=>"error","message"=>"The field amount is required")));
}
if(!isset($_POST["paymentMethodId"]) || $_POST["paymentMethodId"]==''){ 
  exit(json_encode(array("title"=>"paymentMethodId required","status"=>"error","message"=>"The field paymentMethodId is required")));
}

$receiptEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$receiptEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$receiptEdit->setPatientId(!isset($_POST["patientId"]) || $_POST["patientId"]==""?NULL:filter_var($_POST["patientId"],FILTER_SANITIZE_NUMBER_INT));
$receiptEdit->setReceiptNo(!isset($_POST["receiptNo"]) || $_POST["receiptNo"]==""?NULL:filter_var($_POST["receiptNo"],FILTER_SANITIZE_STRING));
$receiptEdit->setReceiptDate(!isset($_POST["receiptDate"]) || $_POST["receiptDate"]==""?NULL:convertDate($_POST["receiptDate"]));
$receiptEdit->setAmount(!isset($_POST["amount"]) || $_POST["amount"]==""?NULL:filter_var($_POST["amount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$receiptEdit->setPaymentMethodId(!isset($_POST["paymentMethodId"]) || $_POST["paymentMethodId"]==""?NULL:filter_var($_POST["paymentMethodId"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $receiptEditDao->update($receiptEdit);
  }else{
    $tempObject = $receiptEditDao->insert($receiptEdit);
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

