<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/receipt-detail-dao.php");

$receiptDetailDao = new ReceiptDetailDao();

if(isset($_POST["receiptDetailId"]) && (int)$_POST["receiptDetailId"] > 0){
  $receiptDetailId = $_POST["receiptDetailId"];
  if($receiptDetailDao->delete($receiptDetailId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


