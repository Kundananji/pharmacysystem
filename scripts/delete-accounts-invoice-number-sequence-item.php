<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/accounts-invoice-number-sequence-dao.php");

$accountsInvoiceNumberSequenceDao = new AccountsInvoiceNumberSequenceDao();

if(isset($_POST["accountsInvoiceNumberSequenceId"]) && (int)$_POST["accountsInvoiceNumberSequenceId"] > 0){
  $accountsInvoiceNumberSequenceId = $_POST["accountsInvoiceNumberSequenceId"];
  if($accountsInvoiceNumberSequenceDao->delete($accountsInvoiceNumberSequenceId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


