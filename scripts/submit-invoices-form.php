<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/invoices.php");
include_once("../daos/invoices-dao.php");

$invoicesEditDao = new InvoicesDao();
$invoicesEdit = new Invoices();

if(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==''){ 
  exit(json_encode(array("title"=>"invoiceId required","status"=>"error","message"=>"The field INVOICE_ID is required")));
}
if(!isset($_POST["netTotal"]) || $_POST["netTotal"]==''){ 
  exit(json_encode(array("title"=>"netTotal required","status"=>"error","message"=>"The field NET_TOTAL is required")));
}
if(!isset($_POST["invoiceDate"]) || $_POST["invoiceDate"]==''){ 
  exit(json_encode(array("title"=>"invoiceDate required","status"=>"error","message"=>"The field INVOICE_DATE is required")));
}
if(!isset($_POST["customerId"]) || $_POST["customerId"]==''){ 
  exit(json_encode(array("title"=>"customerId required","status"=>"error","message"=>"The field CUSTOMER_ID is required")));
}
if(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==''){ 
  exit(json_encode(array("title"=>"totalAmount required","status"=>"error","message"=>"The field TOTAL_AMOUNT is required")));
}
if(!isset($_POST["totalDiscount"]) || $_POST["totalDiscount"]==''){ 
  exit(json_encode(array("title"=>"totalDiscount required","status"=>"error","message"=>"The field TOTAL_DISCOUNT is required")));
}

$invoicesEdit->setInvoiceId(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==""?NULL:filter_var($_POST["invoiceId"],FILTER_SANITIZE_NUMBER_INT));
$invoicesEdit->setNetTotal(!isset($_POST["netTotal"]) || $_POST["netTotal"]==""?NULL:filter_var($_POST["netTotal"],FILTER_SANITIZE_STRING));
$invoicesEdit->setInvoiceDate(!isset($_POST["invoiceDate"]) || $_POST["invoiceDate"]==""?NULL:convertDate($_POST["invoiceDate"]));
$invoicesEdit->setCustomerId(!isset($_POST["customerId"]) || $_POST["customerId"]==""?NULL:filter_var($_POST["customerId"],FILTER_SANITIZE_NUMBER_INT));
$invoicesEdit->setTotalAmount(!isset($_POST["totalAmount"]) || $_POST["totalAmount"]==""?NULL:filter_var($_POST["totalAmount"],FILTER_SANITIZE_STRING));
$invoicesEdit->setTotalDiscount(!isset($_POST["totalDiscount"]) || $_POST["totalDiscount"]==""?NULL:filter_var($_POST["totalDiscount"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["INVOICE_ID"]) && (int)$_POST["INVOICE_ID"] > 0){
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

