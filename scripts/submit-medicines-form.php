<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/medicines.php");
include_once("../daos/medicines-dao.php");

$medicinesEditDao = new MedicinesDao();
$medicinesEdit = new Medicines();

if(!isset($_POST["iD"]) || $_POST["iD"]==''){ 
  exit(json_encode(array("title"=>"iD required","status"=>"error","message"=>"The field ID is required")));
}
if(!isset($_POST["nAME"]) || $_POST["nAME"]==''){ 
  exit(json_encode(array("title"=>"nAME required","status"=>"error","message"=>"The field NAME is required")));
}
if(!isset($_POST["pACKING"]) || $_POST["pACKING"]==''){ 
  exit(json_encode(array("title"=>"pACKING required","status"=>"error","message"=>"The field PACKING is required")));
}
if(!isset($_POST["genericName"]) || $_POST["genericName"]==''){ 
  exit(json_encode(array("title"=>"genericName required","status"=>"error","message"=>"The field GENERIC_NAME is required")));
}
if(!isset($_POST["supplierName"]) || $_POST["supplierName"]==''){ 
  exit(json_encode(array("title"=>"supplierName required","status"=>"error","message"=>"The field SUPPLIER_NAME is required")));
}

$medicinesEdit->setID(!isset($_POST["iD"]) || $_POST["iD"]==""?NULL:filter_var($_POST["iD"],FILTER_SANITIZE_NUMBER_INT));
$medicinesEdit->setNAME(!isset($_POST["nAME"]) || $_POST["nAME"]==""?NULL:filter_var($_POST["nAME"],FILTER_SANITIZE_STRING));
$medicinesEdit->setPACKING(!isset($_POST["pACKING"]) || $_POST["pACKING"]==""?NULL:filter_var($_POST["pACKING"],FILTER_SANITIZE_STRING));
$medicinesEdit->setGenericName(!isset($_POST["genericName"]) || $_POST["genericName"]==""?NULL:filter_var($_POST["genericName"],FILTER_SANITIZE_STRING));
$medicinesEdit->setSupplierName(!isset($_POST["supplierName"]) || $_POST["supplierName"]==""?NULL:filter_var($_POST["supplierName"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["ID"]) && (int)$_POST["ID"] > 0){
    $tempObject = $medicinesEditDao->update($medicinesEdit);
  }else{
    $tempObject = $medicinesEditDao->insert($medicinesEdit);
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

