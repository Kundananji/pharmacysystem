<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/sales.php");
include_once("../daos/sales-dao.php");

$salesEditDao = new SalesDao();
$salesEdit = new Sales();

if(!isset($_POST["customerId"]) || $_POST["customerId"]==''){ 
  exit(json_encode(array("title"=>"customerId required","status"=>"error","message"=>"The field customer_id is required")));
}

$salesEdit->setCustomerId(!isset($_POST["customerId"]) || $_POST["customerId"]==""?NULL:filter_var($_POST["customerId"],FILTER_SANITIZE_NUMBER_INT));
$salesEdit->setInvoiceNumber(!isset($_POST["invoiceNumber"]) || $_POST["invoiceNumber"]==""?NULL:filter_var($_POST["invoiceNumber"],FILTER_SANITIZE_STRING));
$salesEdit->setMedicineName(!isset($_POST["medicineName"]) || $_POST["medicineName"]==""?NULL:filter_var($_POST["medicineName"],FILTER_SANITIZE_STRING));
$salesEdit->setBatchId(!isset($_POST["batchId"]) || $_POST["batchId"]==""?NULL:filter_var($_POST["batchId"],FILTER_SANITIZE_STRING));
$salesEdit->setExpiryDate(!isset($_POST["expiryDate"]) || $_POST["expiryDate"]==""?NULL:filter_var($_POST["expiryDate"],FILTER_SANITIZE_STRING));
$salesEdit->setQuantity(!isset($_POST["quantity"]) || $_POST["quantity"]==""?NULL:filter_var($_POST["quantity"],FILTER_SANITIZE_NUMBER_INT));
$salesEdit->setMrp(!isset($_POST["mrp"]) || $_POST["mrp"]==""?NULL:filter_var($_POST["mrp"],FILTER_SANITIZE_STRING));
$salesEdit->setDiscount(!isset($_POST["discount"]) || $_POST["discount"]==""?NULL:filter_var($_POST["discount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$salesEdit->setTotal(!isset($_POST["total"]) || $_POST["total"]==""?NULL:filter_var($_POST["total"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));

try{
  if(isset($_POST[""]) && (int)$_POST[""] > 0){
    $tempObject = $salesEditDao->update($salesEdit);
  }else{
    $tempObject = $salesEditDao->insert($salesEdit);
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

