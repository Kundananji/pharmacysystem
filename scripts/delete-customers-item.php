<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/customers-dao.php");

$customersDao = new CustomersDao();

if(isset($_POST["customersId"]) && (int)$_POST["customersId"] > 0){
  $customersId = $_POST["customersId"];
  if($customersDao->delete($customersId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


