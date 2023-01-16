<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/receipt-detail.php");
include_once("../daos/receipt-detail-dao.php");

$receiptDetailEditDao = new ReceiptDetailDao();
$receiptDetailEdit = new ReceiptDetail();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["receiptId"]) || $_POST["receiptId"]==''){ 
  exit(json_encode(array("title"=>"receiptId required","status"=>"error","message"=>"The field receiptId is required")));
}
if(!isset($_POST["item"]) || $_POST["item"]==''){ 
  exit(json_encode(array("title"=>"item required","status"=>"error","message"=>"The field item is required")));
}
if(!isset($_POST["description"]) || $_POST["description"]==''){ 
  exit(json_encode(array("title"=>"description required","status"=>"error","message"=>"The field description is required")));
}
if(!isset($_POST["quantity"]) || $_POST["quantity"]==''){ 
  exit(json_encode(array("title"=>"quantity required","status"=>"error","message"=>"The field quantity is required")));
}
if(!isset($_POST["unitPrice"]) || $_POST["unitPrice"]==''){ 
  exit(json_encode(array("title"=>"unitPrice required","status"=>"error","message"=>"The field unitPrice is required")));
}
if(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==''){ 
  exit(json_encode(array("title"=>"totalAmount required","status"=>"error","message"=>"The field totalAmount is required")));
}

$receiptDetailEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$receiptDetailEdit->setReceiptId(!isset($_POST["receiptId"]) || $_POST["receiptId"]==""?NULL:filter_var($_POST["receiptId"],FILTER_SANITIZE_NUMBER_INT));
$receiptDetailEdit->setItem(!isset($_POST["item"]) || $_POST["item"]==""?NULL:filter_var($_POST["item"],FILTER_SANITIZE_NUMBER_INT));
$receiptDetailEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_NUMBER_INT));
$receiptDetailEdit->setQuantity(!isset($_POST["quantity"]) || $_POST["quantity"]==""?NULL:filter_var($_POST["quantity"],FILTER_SANITIZE_NUMBER_INT));
$receiptDetailEdit->setUnitPrice(!isset($_POST["unitPrice"]) || $_POST["unitPrice"]==""?NULL:filter_var($_POST["unitPrice"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$receiptDetailEdit->setTotalAmount(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==""?NULL:filter_var($_POST["totalAmount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$receiptDetailEdit->setInvoiceDetailId(!isset($_POST["invoiceDetailId"]) || $_POST["invoiceDetailId"]==""?NULL:filter_var($_POST["invoiceDetailId"],FILTER_SANITIZE_NUMBER_INT));
$receiptDetailEdit->setFeeId(!isset($_POST["feeId"]) || $_POST["feeId"]==""?NULL:filter_var($_POST["feeId"],FILTER_SANITIZE_NUMBER_INT));
$receiptDetailEdit->setMedicineId(!isset($_POST["medicineId"]) || $_POST["medicineId"]==""?NULL:filter_var($_POST["medicineId"],FILTER_SANITIZE_NUMBER_INT));
$receiptDetailEdit->setDiscount(!isset($_POST["discount"]) || $_POST["discount"]==""?NULL:filter_var($_POST["discount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $receiptDetailEditDao->update($receiptDetailEdit);
  }else{
    $tempObject = $receiptDetailEditDao->insert($receiptDetailEdit);
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

