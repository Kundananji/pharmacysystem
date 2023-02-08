<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/accounts-invoice-number-sequence.php");
include_once("../daos/accounts-invoice-number-sequence-dao.php");

$accountsInvoiceNumberSequenceEditDao = new AccountsInvoiceNumberSequenceDao();
$accountsInvoiceNumberSequenceEdit = new AccountsInvoiceNumberSequence();

if(!isset($_POST["sequenceId"]) || $_POST["sequenceId"]==''){ 
  exit(json_encode(array("title"=>"sequenceId required","status"=>"error","message"=>"The field sequenceId is required")));
}
if(!isset($_POST["year"]) || $_POST["year"]==''){ 
  exit(json_encode(array("title"=>"year required","status"=>"error","message"=>"The field year is required")));
}
if(!isset($_POST["invoiceNumber"]) || $_POST["invoiceNumber"]==''){ 
  exit(json_encode(array("title"=>"invoiceNumber required","status"=>"error","message"=>"The field invoiceNumber is required")));
}

$accountsInvoiceNumberSequenceEdit->setSequenceId(!isset($_POST["sequenceId"]) || $_POST["sequenceId"]==""?NULL:filter_var($_POST["sequenceId"],FILTER_SANITIZE_NUMBER_INT));
$accountsInvoiceNumberSequenceEdit->setYear(!isset($_POST["year"]) || $_POST["year"]==""?NULL:filter_var($_POST["year"],FILTER_SANITIZE_NUMBER_INT));
$accountsInvoiceNumberSequenceEdit->setInvoiceNumber(!isset($_POST["invoiceNumber"]) || $_POST["invoiceNumber"]==""?NULL:filter_var($_POST["invoiceNumber"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["sequenceId"]) && (int)$_POST["sequenceId"] > 0){
    $tempObject = $accountsInvoiceNumberSequenceEditDao->update($accountsInvoiceNumberSequenceEdit);
  }else{
    $tempObject = $accountsInvoiceNumberSequenceEditDao->insert($accountsInvoiceNumberSequenceEdit);
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

