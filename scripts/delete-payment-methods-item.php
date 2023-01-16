<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/payment-methods-dao.php");

$paymentMethodsDao = new PaymentMethodsDao();

if(isset($_POST["paymentMethodsId"]) && (int)$_POST["paymentMethodsId"] > 0){
  $paymentMethodsId = $_POST["paymentMethodsId"];
  if($paymentMethodsDao->delete($paymentMethodsId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


