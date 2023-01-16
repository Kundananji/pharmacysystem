<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/fee-dao.php");

$feeDao = new FeeDao();

if(isset($_POST["feeId"]) && (int)$_POST["feeId"] > 0){
  $feeId = $_POST["feeId"];
  if($feeDao->delete($feeId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


