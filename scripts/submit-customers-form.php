<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/customers.php");
include_once("../daos/customers-dao.php");

$customersEditDao = new CustomersDao();
$customersEdit = new Customers();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==''){ 
  exit(json_encode(array("title"=>"contactNumber required","status"=>"error","message"=>"The field contact_number is required")));
}
if(!isset($_POST["address"]) || $_POST["address"]==''){ 
  exit(json_encode(array("title"=>"address required","status"=>"error","message"=>"The field address is required")));
}
if(!isset($_POST["doctorName"]) || $_POST["doctorName"]==''){ 
  exit(json_encode(array("title"=>"doctorName required","status"=>"error","message"=>"The field doctor_name is required")));
}
if(!isset($_POST["doctorAddress"]) || $_POST["doctorAddress"]==''){ 
  exit(json_encode(array("title"=>"doctorAddress required","status"=>"error","message"=>"The field doctor_address is required")));
}

$customersEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$customersEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$customersEdit->setContactNumber(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==""?NULL:filter_var($_POST["contactNumber"],FILTER_SANITIZE_STRING));
$customersEdit->setAddress(!isset($_POST["address"]) || $_POST["address"]==""?NULL:filter_var($_POST["address"],FILTER_SANITIZE_STRING));
$customersEdit->setDoctorName(!isset($_POST["doctorName"]) || $_POST["doctorName"]==""?NULL:filter_var($_POST["doctorName"],FILTER_SANITIZE_STRING));
$customersEdit->setDoctorAddress(!isset($_POST["doctorAddress"]) || $_POST["doctorAddress"]==""?NULL:filter_var($_POST["doctorAddress"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $customersEditDao->update($customersEdit);
  }else{
    $tempObject = $customersEditDao->insert($customersEdit);
  }

  if($tempObject !=null){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully saved")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not saved")));
  }
}catch(Exception $ex){
  if(stripos($ex->getMessage(),"create_error")!==false){
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>str_ireplace("create_error:","",$ex->getMessage()))));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Sorry, an error occurred. Try again later")));
  }
}

