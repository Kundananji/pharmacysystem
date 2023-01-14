<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/purchases-dao.php");

$purchasesDao = new PurchasesDao();

if(isset($_POST["purchasesId"]) && (int)$_POST["purchasesId"] > 0){
  $purchasesId = $_POST["purchasesId"];
  if($purchasesDao->delete($purchasesId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


