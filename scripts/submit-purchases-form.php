<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/purchases.php");
include_once("../daos/purchases-dao.php");

$purchasesEditDao = new PurchasesDao();
$purchasesEdit = new Purchases();

if(!isset($_POST["supplierName"]) || $_POST["supplierName"]==''){ 
  exit(json_encode(array("title"=>"supplierName required","status"=>"error","message"=>"The field SUPPLIER_NAME is required")));
}
if(!isset($_POST["invoiceNumber"]) || $_POST["invoiceNumber"]==''){ 
  exit(json_encode(array("title"=>"invoiceNumber required","status"=>"error","message"=>"The field INVOICE_NUMBER is required")));
}
if(!isset($_POST["voucherNumber"]) || $_POST["voucherNumber"]==''){ 
  exit(json_encode(array("title"=>"voucherNumber required","status"=>"error","message"=>"The field VOUCHER_NUMBER is required")));
}
if(!isset($_POST["purchaseDate"]) || $_POST["purchaseDate"]==''){ 
  exit(json_encode(array("title"=>"purchaseDate required","status"=>"error","message"=>"The field purchase_date is required")));
}
if(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==''){ 
  exit(json_encode(array("title"=>"totalAmount required","status"=>"error","message"=>"The field total_amount is required")));
}
if(!isset($_POST["paymentStatus"]) || $_POST["paymentStatus"]==''){ 
  exit(json_encode(array("title"=>"paymentStatus required","status"=>"error","message"=>"The field PAYMENT_STATUS is required")));
}

$purchasesEdit->setSupplierName(!isset($_POST["supplierName"]) || $_POST["supplierName"]==""?NULL:filter_var($_POST["supplierName"],FILTER_SANITIZE_STRING));
$purchasesEdit->setInvoiceNumber(!isset($_POST["invoiceNumber"]) || $_POST["invoiceNumber"]==""?NULL:filter_var($_POST["invoiceNumber"],FILTER_SANITIZE_NUMBER_INT));
$purchasesEdit->setVoucherNumber(!isset($_POST["voucherNumber"]) || $_POST["voucherNumber"]==""?NULL:filter_var($_POST["voucherNumber"],FILTER_SANITIZE_NUMBER_INT));
$purchasesEdit->setPurchaseDate(!isset($_POST["purchaseDate"]) || $_POST["purchaseDate"]==""?NULL:filter_var($_POST["purchaseDate"],FILTER_SANITIZE_STRING));
$purchasesEdit->setTotalAmount(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==""?NULL:filter_var($_POST["totalAmount"],FILTER_SANITIZE_STRING));
$purchasesEdit->setPaymentStatus(!isset($_POST["paymentStatus"]) || $_POST["paymentStatus"]==""?NULL:filter_var($_POST["paymentStatus"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["VOUCHER_NUMBER"]) && (int)$_POST["VOUCHER_NUMBER"] > 0){
    $tempObject = $purchasesEditDao->update($purchasesEdit);
  }else{
    $tempObject = $purchasesEditDao->insert($purchasesEdit);
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

