<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/invoice-detail-dao.php");

$invoiceDetailDao = new InvoiceDetailDao();

if(isset($_POST["invoiceDetailId"]) && (int)$_POST["invoiceDetailId"] > 0){
  $invoiceDetailId = $_POST["invoiceDetailId"];
  if($invoiceDetailDao->delete($invoiceDetailId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


