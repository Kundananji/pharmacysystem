<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/invoice-detail.php");
include_once("../daos/invoice-detail-dao.php");

$invoiceDetailEditDao = new InvoiceDetailDao();
$invoiceDetailEdit = new InvoiceDetail();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==''){ 
  exit(json_encode(array("title"=>"invoiceId required","status"=>"error","message"=>"The field invoiceId is required")));
}
if(!isset($_POST["quantity"]) || $_POST["quantity"]==''){ 
  exit(json_encode(array("title"=>"quantity required","status"=>"error","message"=>"The field quantity is required")));
}

$invoiceDetailEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$invoiceDetailEdit->setInvoiceId(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==""?NULL:filter_var($_POST["invoiceId"],FILTER_SANITIZE_NUMBER_INT));
$invoiceDetailEdit->setFeeId(!isset($_POST["feeId"]) || $_POST["feeId"]==""?NULL:filter_var($_POST["feeId"],FILTER_SANITIZE_NUMBER_INT));
$invoiceDetailEdit->setMedicineId(!isset($_POST["medicineId"]) || $_POST["medicineId"]==""?NULL:filter_var($_POST["medicineId"],FILTER_SANITIZE_NUMBER_INT));
$invoiceDetailEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$invoiceDetailEdit->setUnitPrice(!isset($_POST["unitPrice"]) || $_POST["unitPrice"]==""?NULL:filter_var($_POST["unitPrice"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$invoiceDetailEdit->setQuantity(!isset($_POST["quantity"]) || $_POST["quantity"]==""?NULL:filter_var($_POST["quantity"],FILTER_SANITIZE_NUMBER_INT));
$invoiceDetailEdit->setDiscount(!isset($_POST["discount"]) || $_POST["discount"]==""?NULL:filter_var($_POST["discount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$invoiceDetailEdit->setTotalAmount(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==""?NULL:filter_var($_POST["totalAmount"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $invoiceDetailEditDao->update($invoiceDetailEdit);
  }else{
    $tempObject = $invoiceDetailEditDao->insert($invoiceDetailEdit);
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

