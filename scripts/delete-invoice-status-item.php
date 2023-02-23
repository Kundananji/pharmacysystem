<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/invoice-status-dao.php");

$invoiceStatusDao = new InvoiceStatusDao();

if(isset($_POST["invoiceStatusId"]) && (int)$_POST["invoiceStatusId"] > 0){
  $invoiceStatusId = $_POST["invoiceStatusId"];
  if($invoiceStatusDao->delete($invoiceStatusId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


