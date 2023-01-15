<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/customers.php");
include_once("../daos/customers-dao.php");

$customersEditDao = new CustomersDao();
$customersEdit = new Customers();

if(!isset($_POST["iD"]) || $_POST["iD"]==''){ 
  exit(json_encode(array("title"=>"iD required","status"=>"error","message"=>"The field ID is required")));
}
if(!isset($_POST["nAME"]) || $_POST["nAME"]==''){ 
  exit(json_encode(array("title"=>"nAME required","status"=>"error","message"=>"The field NAME is required")));
}
if(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==''){ 
  exit(json_encode(array("title"=>"contactNumber required","status"=>"error","message"=>"The field contact_number is required")));
}
if(!isset($_POST["aDDRESS"]) || $_POST["aDDRESS"]==''){ 
  exit(json_encode(array("title"=>"aDDRESS required","status"=>"error","message"=>"The field ADDRESS is required")));
}
if(!isset($_POST["doctorName"]) || $_POST["doctorName"]==''){ 
  exit(json_encode(array("title"=>"doctorName required","status"=>"error","message"=>"The field doctor_name is required")));
}
if(!isset($_POST["doctorAddress"]) || $_POST["doctorAddress"]==''){ 
  exit(json_encode(array("title"=>"doctorAddress required","status"=>"error","message"=>"The field doctor_address is required")));
}

$customersEdit->setID(!isset($_POST["iD"]) || $_POST["iD"]==""?NULL:filter_var($_POST["iD"],FILTER_SANITIZE_NUMBER_INT));
$customersEdit->setNAME(!isset($_POST["nAME"]) || $_POST["nAME"]==""?NULL:filter_var($_POST["nAME"],FILTER_SANITIZE_STRING));
$customersEdit->setContactNumber(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==""?NULL:filter_var($_POST["contactNumber"],FILTER_SANITIZE_STRING));
$customersEdit->setADDRESS(!isset($_POST["aDDRESS"]) || $_POST["aDDRESS"]==""?NULL:filter_var($_POST["aDDRESS"],FILTER_SANITIZE_STRING));
$customersEdit->setDoctorName(!isset($_POST["doctorName"]) || $_POST["doctorName"]==""?NULL:filter_var($_POST["doctorName"],FILTER_SANITIZE_STRING));
$customersEdit->setDoctorAddress(!isset($_POST["doctorAddress"]) || $_POST["doctorAddress"]==""?NULL:filter_var($_POST["doctorAddress"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["ID"]) && (int)$_POST["ID"] > 0){
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

