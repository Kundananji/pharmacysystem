<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/medicines.php");
include_once("../daos/medicines-dao.php");

$medicinesEditDao = new MedicinesDao();
$medicinesEdit = new Medicines();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["packing"]) || $_POST["packing"]==''){ 
  exit(json_encode(array("title"=>"packing required","status"=>"error","message"=>"The field packing is required")));
}
if(!isset($_POST["genericName"]) || $_POST["genericName"]==''){ 
  exit(json_encode(array("title"=>"genericName required","status"=>"error","message"=>"The field generic_name is required")));
}
if(!isset($_POST["supplierName"]) || $_POST["supplierName"]==''){ 
  exit(json_encode(array("title"=>"supplierName required","status"=>"error","message"=>"The field supplier_name is required")));
}

$medicinesEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$medicinesEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$medicinesEdit->setPacking(!isset($_POST["packing"]) || $_POST["packing"]==""?NULL:filter_var($_POST["packing"],FILTER_SANITIZE_STRING));
$medicinesEdit->setGenericName(!isset($_POST["genericName"]) || $_POST["genericName"]==""?NULL:filter_var($_POST["genericName"],FILTER_SANITIZE_STRING));
$medicinesEdit->setSupplierName(!isset($_POST["supplierName"]) || $_POST["supplierName"]==""?NULL:filter_var($_POST["supplierName"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
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

