<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/payment-methods.php");
include_once("../daos/payment-methods-dao.php");

$paymentMethodsEditDao = new PaymentMethodsDao();
$paymentMethodsEdit = new PaymentMethods();

if(!isset($_POST["paymentMethodId"]) || $_POST["paymentMethodId"]==''){ 
  exit(json_encode(array("title"=>"paymentMethodId required","status"=>"error","message"=>"The field paymentMethodId is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["description"]) || $_POST["description"]==''){ 
  exit(json_encode(array("title"=>"description required","status"=>"error","message"=>"The field description is required")));
}
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}

$paymentMethodsEdit->setPaymentMethodId(!isset($_POST["paymentMethodId"]) || $_POST["paymentMethodId"]==""?NULL:filter_var($_POST["paymentMethodId"],FILTER_SANITIZE_NUMBER_INT));
$paymentMethodsEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$paymentMethodsEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$paymentMethodsEdit->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["paymentMethodId"]) && (int)$_POST["paymentMethodId"] > 0){
    $tempObject = $paymentMethodsEditDao->update($paymentMethodsEdit);
  }else{
    $tempObject = $paymentMethodsEditDao->insert($paymentMethodsEdit);
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

