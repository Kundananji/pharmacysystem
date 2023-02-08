<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/accounts-receipt-number-sequence-dao.php");

$accountsReceiptNumberSequenceDao = new AccountsReceiptNumberSequenceDao();

if(isset($_POST["accountsReceiptNumberSequenceId"]) && (int)$_POST["accountsReceiptNumberSequenceId"] > 0){
  $accountsReceiptNumberSequenceId = $_POST["accountsReceiptNumberSequenceId"];
  if($accountsReceiptNumberSequenceDao->delete($accountsReceiptNumberSequenceId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


