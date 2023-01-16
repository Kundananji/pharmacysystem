<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/invoice-dao.php");

$invoiceDao = new InvoiceDao();

if(isset($_POST["invoiceId"]) && (int)$_POST["invoiceId"] > 0){
  $invoiceId = $_POST["invoiceId"];
  if($invoiceDao->delete($invoiceId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


