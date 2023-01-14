<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/sales-dao.php");

$salesDao = new SalesDao();

if(isset($_POST["salesId"]) && (int)$_POST["salesId"] > 0){
  $salesId = $_POST["salesId"];
  if($salesDao->delete($salesId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


