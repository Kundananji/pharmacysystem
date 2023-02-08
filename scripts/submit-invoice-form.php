<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/invoice.php");
include_once("../daos/invoice-dao.php");

$invoiceEditDao = new InvoiceDao();
$invoiceEdit = new Invoice();

if(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==''){ 
  exit(json_encode(array("title"=>"invoiceId required","status"=>"error","message"=>"The field invoiceId is required")));
}
if(!isset($_POST["invoiceDate"]) || $_POST["invoiceDate"]==''){ 
  exit(json_encode(array("title"=>"invoiceDate required","status"=>"error","message"=>"The field invoiceDate is required")));
}
if(!isset($_POST["patientId"]) || $_POST["patientId"]==''){ 
  exit(json_encode(array("title"=>"patientId required","status"=>"error","message"=>"The field patientId is required")));
}

$invoiceEdit->setInvoiceId(!isset($_POST["invoiceId"]) || $_POST["invoiceId"]==""?NULL:filter_var($_POST["invoiceId"],FILTER_SANITIZE_NUMBER_INT));
$invoiceEdit->setInvoiceNo(!isset($_POST["invoiceNo"]) || $_POST["invoiceNo"]==""?NULL:filter_var($_POST["invoiceNo"],FILTER_SANITIZE_STRING));
$invoiceEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$invoiceEdit->setInvoiceDate(!isset($_POST["invoiceDate"]) || $_POST["invoiceDate"]==""?NULL:convertDate($_POST["invoiceDate"]));
$invoiceEdit->setPatientId(!isset($_POST["patientId"]) || $_POST["patientId"]==""?NULL:filter_var($_POST["patientId"],FILTER_SANITIZE_NUMBER_INT));
$invoiceEdit->setTaxAmount(!isset($_POST["taxAmount"]) || $_POST["taxAmount"]==""?NULL:filter_var($_POST["taxAmount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$invoiceEdit->setAmount(!isset($_POST["amount"]) || $_POST["amount"]==""?NULL:filter_var($_POST["amount"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$invoiceEdit->setIsPaidFor(!isset($_POST["isPaidFor"]) || $_POST["isPaidFor"]==""?NULL:filter_var($_POST["isPaidFor"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["invoiceId"]) && (int)$_POST["invoiceId"] > 0){
    $tempObject = $invoiceEditDao->update($invoiceEdit);
  }else{
    $tempObject = $invoiceEditDao->insert($invoiceEdit);
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

