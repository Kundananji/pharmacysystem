<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/receipt-dao.php");

$receiptDao = new ReceiptDao();

if(isset($_POST["receiptId"]) && (int)$_POST["receiptId"] > 0){
  $receiptId = $_POST["receiptId"];
  if($receiptDao->delete($receiptId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


