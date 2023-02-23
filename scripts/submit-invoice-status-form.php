<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/invoice-status.php");
include_once("../daos/invoice-status-dao.php");

$invoiceStatusEditDao = new InvoiceStatusDao();
$invoiceStatusEdit = new InvoiceStatus();

if(!isset($_POST["invoiceStatusId"]) || $_POST["invoiceStatusId"]==''){ 
  exit(json_encode(array("title"=>"invoiceStatusId required","status"=>"error","message"=>"The field invoiceStatusId is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}

$invoiceStatusEdit->setInvoiceStatusId(!isset($_POST["invoiceStatusId"]) || $_POST["invoiceStatusId"]==""?NULL:filter_var($_POST["invoiceStatusId"],FILTER_SANITIZE_NUMBER_INT));
$invoiceStatusEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["invoiceStatusId"]) && (int)$_POST["invoiceStatusId"] > 0){
    $tempObject = $invoiceStatusEditDao->update($invoiceStatusEdit);
  }else{
    $tempObject = $invoiceStatusEditDao->insert($invoiceStatusEdit);
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

