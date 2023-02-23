<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/invoice.php");
include_once("../daos/invoice-dao.php");

$invoiceDao = new InvoiceDao();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id  is required")));
}
$invoice = $invoiceDao->select(filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
if(!isset($_POST["status"]) || $_POST["status"]==''){ 
  exit(json_encode(array("title"=>"status required","status"=>"error","message"=>"The field status is required")));
}

$invoice->setStatus(!isset($_POST["status"]) || $_POST["status"]==""?NULL:filter_var($_POST["status"],FILTER_SANITIZE_NUMBER_INT));

$tempObject = $invoiceDao->update($invoice);

if($tempObject !=null){
  exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully saved")));
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not saved")));
}

