<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/receipt.php");
include_once("../daos/receipt-dao.php");

$receiptEditDao = new ReceiptDao();
$receiptEdit = new Receipt();

if(!isset($_POST["receiptId"]) || $_POST["receiptId"]==''){ 
  exit(json_encode(array("title"=>"receiptId required","status"=>"error","message"=>"The field receiptId is required")));
}
if(!isset($_POST["amountPaid"]) || $_POST["amountPaid"]==''){ 
  exit(json_encode(array("title"=>"amountPaid required","status"=>"error","message"=>"The field amountPaid is required")));
}
if(!isset($_POST["paymentMethodId"]) || $_POST["paymentMethodId"]==''){ 
  exit(json_encode(array("title"=>"paymentMethodId required","status"=>"error","message"=>"The field paymentMethodId is required")));
}

$receiptEdit->setReceiptId(!isset($_POST["receiptId"]) || $_POST["receiptId"]==""?NULL:filter_var($_POST["receiptId"],FILTER_SANITIZE_NUMBER_INT));
$receiptEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$receiptEdit->setPatientId(!isset($_POST["patientId"]) || $_POST["patientId"]==""?NULL:filter_var($_POST["patientId"],FILTER_SANITIZE_NUMBER_INT));
$receiptEdit->setReceiptNo(!isset($_POST["receiptNo"]) || $_POST["receiptNo"]==""?NULL:filter_var($_POST["receiptNo"],FILTER_SANITIZE_STRING));
$receiptEdit->setInvoiceId(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==""?NULL:filter_var($_POST["invoiceId"],FILTER_SANITIZE_NUMBER_INT));
$receiptEdit->setReceiptDate(!isset($_POST["receiptDate"]) || $_POST["receiptDate"]==""?NULL:convertDate($_POST["receiptDate"]));
$receiptEdit->setInvoiceAmount(!isset($_POST["invoiceAmount"]) || $_POST["invoiceAmount"]==""?NULL:filter_var($_POST["invoiceAmount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$receiptEdit->setAmountPaid(!isset($_POST["amountPaid"]) || $_POST["amountPaid"]==""?NULL:filter_var($_POST["amountPaid"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$receiptEdit->setPaymentMethodId(!isset($_POST["paymentMethodId"]) || $_POST["paymentMethodId"]==""?NULL:filter_var($_POST["paymentMethodId"],FILTER_SANITIZE_NUMBER_INT));
$receiptEdit->setChangeAmount(!isset($_POST["changeAmount"]) || $_POST["changeAmount"]==""?NULL:filter_var($_POST["changeAmount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));

try{
  if(isset($_POST["receiptId"]) && (int)$_POST["receiptId"] > 0){
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

