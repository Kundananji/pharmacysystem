<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/accounts-receipt-number-sequence.php");
include_once("../daos/accounts-receipt-number-sequence-dao.php");

$accountsReceiptNumberSequenceEditDao = new AccountsReceiptNumberSequenceDao();
$accountsReceiptNumberSequenceEdit = new AccountsReceiptNumberSequence();

if(!isset($_POST["sequenceId"]) || $_POST["sequenceId"]==''){ 
  exit(json_encode(array("title"=>"sequenceId required","status"=>"error","message"=>"The field sequenceId is required")));
}
if(!isset($_POST["year"]) || $_POST["year"]==''){ 
  exit(json_encode(array("title"=>"year required","status"=>"error","message"=>"The field year is required")));
}
if(!isset($_POST["receiptNumber"]) || $_POST["receiptNumber"]==''){ 
  exit(json_encode(array("title"=>"receiptNumber required","status"=>"error","message"=>"The field receiptNumber is required")));
}

$accountsReceiptNumberSequenceEdit->setSequenceId(!isset($_POST["sequenceId"]) || $_POST["sequenceId"]==""?NULL:filter_var($_POST["sequenceId"],FILTER_SANITIZE_NUMBER_INT));
$accountsReceiptNumberSequenceEdit->setYear(!isset($_POST["year"]) || $_POST["year"]==""?NULL:filter_var($_POST["year"],FILTER_SANITIZE_NUMBER_INT));
$accountsReceiptNumberSequenceEdit->setReceiptNumber(!isset($_POST["receiptNumber"]) || $_POST["receiptNumber"]==""?NULL:filter_var($_POST["receiptNumber"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["sequenceId"]) && (int)$_POST["sequenceId"] > 0){
    $tempObject = $accountsReceiptNumberSequenceEditDao->update($accountsReceiptNumberSequenceEdit);
  }else{
    $tempObject = $accountsReceiptNumberSequenceEditDao->insert($accountsReceiptNumberSequenceEdit);
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

