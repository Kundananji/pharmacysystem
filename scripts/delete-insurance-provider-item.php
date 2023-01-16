<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/insurance-provider-dao.php");

$insuranceProviderDao = new InsuranceProviderDao();

if(isset($_POST["insuranceProviderId"]) && (int)$_POST["insuranceProviderId"] > 0){
  $insuranceProviderId = $_POST["insuranceProviderId"];
  if($insuranceProviderDao->delete($insuranceProviderId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


