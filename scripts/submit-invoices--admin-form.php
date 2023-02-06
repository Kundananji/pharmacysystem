<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/invoices.php");
include_once("../daos/invoices-dao.php");

//declare env variables for use
$env_dateNow = date("d/m/Y");
$env_timeNow = date("H:i:s");

$invoicesEditDao = new InvoicesDao();
$invoicesEdit = new Invoices();

if(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==''){ 
  exit(json_encode(array("title"=>"invoiceId required","status"=>"error","message"=>"The field invoice_id is required")));
}
if(!isset($_POST["item"]) || $_POST["item"]==''){ 
  exit(json_encode(array("title"=>"item required","status"=>"error","message"=>"The field item is required")));
}
if(!isset($_POST["description"]) || $_POST["description"]==''){ 
  exit(json_encode(array("title"=>"description required","status"=>"error","message"=>"The field description is required")));
}
if(!isset($_POST["unitPrice"]) || $_POST["unitPrice"]==''){ 
  exit(json_encode(array("title"=>"unitPrice required","status"=>"error","message"=>"The field unitPrice is required")));
}
if(!isset($_POST["quantity"]) || $_POST["quantity"]==''){ 
  exit(json_encode(array("title"=>"quantity required","status"=>"error","message"=>"The field quantity is required")));
}
if(!isset($_POST["netTotal"]) || $_POST["netTotal"]==''){ 
  exit(json_encode(array("title"=>"netTotal required","status"=>"error","message"=>"The field net_total is required")));
}
if(!isset($_POST["invoiceDate"]) || $_POST["invoiceDate"]==''){ 
  exit(json_encode(array("title"=>"invoiceDate required","status"=>"error","message"=>"The field invoice_date is required")));
}
if(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==''){ 
  exit(json_encode(array("title"=>"totalAmount required","status"=>"error","message"=>"The field total_amount is required")));
}
if(!isset($_POST["totalDiscount"]) || $_POST["totalDiscount"]==''){ 
  exit(json_encode(array("title"=>"totalDiscount required","status"=>"error","message"=>"The field total_discount is required")));
}

$invoicesEdit->setInvoiceId(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==""?NULL:filter_var($_POST["invoiceId"],FILTER_SANITIZE_NUMBER_INT));
$invoicesEdit->setFeeId(!isset($_POST["feeId"]) || $_POST["feeId"]==""?NULL:filter_var($_POST["feeId"],FILTER_SANITIZE_NUMBER_INT));
$invoicesEdit->setMedicineId(!isset($_POST["medicineId"]) || $_POST["medicineId"]==""?NULL:filter_var($_POST["medicineId"],FILTER_SANITIZE_NUMBER_INT));
$invoicesEdit->setItem(!isset($_POST["item"]) || $_POST["item"]==""?NULL:filter_var($_POST["item"],FILTER_SANITIZE_STRING));
$invoicesEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$invoicesEdit->setUnitPrice(!isset($_POST["unitPrice"]) || $_POST["unitPrice"]==""?NULL:filter_var($_POST["unitPrice"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$invoicesEdit->setQuantity(!isset($_POST["quantity"]) || $_POST["quantity"]==""?NULL:filter_var($_POST["quantity"],FILTER_SANITIZE_NUMBER_INT));
$invoicesEdit->setNetTotal(!isset($_POST["netTotal"]) || $_POST["netTotal"]==""?NULL:filter_var($_POST["netTotal"],FILTER_SANITIZE_STRING));
$invoicesEdit->setInvoiceDate(!isset($_POST["invoiceDate"]) || $_POST["invoiceDate"]==""?NULL:convertDate($_POST["invoiceDate"]));
$invoicesEdit->setCustomerId(!isset($_POST["customerId"]) || $_POST["customerId"]==""?NULL:filter_var($_POST["customerId"],FILTER_SANITIZE_NUMBER_INT));
$invoicesEdit->setTotalAmount(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==""?NULL:filter_var($_POST["totalAmount"],FILTER_SANITIZE_STRING));
$invoicesEdit->setTotalDiscount(!isset($_POST["totalDiscount"]) || $_POST["totalDiscount"]==""?NULL:filter_var($_POST["totalDiscount"],FILTER_SANITIZE_STRING));

try{
if(isset($_POST["invoice_id"]) && (int)$_POST["invoice_id"] > 0){
  $tempObject = $invoicesEditDao->update($invoicesEdit);
}else{
  $tempObject = $invoicesEditDao->insert($invoicesEdit);
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

