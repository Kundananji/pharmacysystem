<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/invoices-dao.php");

$invoicesDao = new InvoicesDao();

if(isset($_POST["invoicesId"]) && (int)$_POST["invoicesId"] > 0){
  $invoicesId = $_POST["invoicesId"];
  if($invoicesDao->delete($invoicesId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


