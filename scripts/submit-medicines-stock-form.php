<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/medicines-stock.php");
include_once("../daos/medicines-stock-dao.php");

$medicinesStockEditDao = new MedicinesStockDao();
$medicinesStockEdit = new MedicinesStock();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["medicineId"]) || $_POST["medicineId"]==''){ 
  exit(json_encode(array("title"=>"medicineId required","status"=>"error","message"=>"The field medicineId is required")));
}
if(!isset($_POST["batchId"]) || $_POST["batchId"]==''){ 
  exit(json_encode(array("title"=>"batchId required","status"=>"error","message"=>"The field batch_id is required")));
}
if(!isset($_POST["expiryDate"]) || $_POST["expiryDate"]==''){ 
  exit(json_encode(array("title"=>"expiryDate required","status"=>"error","message"=>"The field expiry_date is required")));
}
if(!isset($_POST["quantity"]) || $_POST["quantity"]==''){ 
  exit(json_encode(array("title"=>"quantity required","status"=>"error","message"=>"The field quantity is required")));
}
if(!isset($_POST["amount"]) || $_POST["amount"]==''){ 
  exit(json_encode(array("title"=>"amount required","status"=>"error","message"=>"The field amount is required")));
}

$medicinesStockEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$medicinesStockEdit->setMedicineId(!isset($_POST["medicineId"]) || $_POST["medicineId"]==""?NULL:filter_var($_POST["medicineId"],FILTER_SANITIZE_NUMBER_INT));
$medicinesStockEdit->setBatchId(!isset($_POST["batchId"]) || $_POST["batchId"]==""?NULL:filter_var($_POST["batchId"],FILTER_SANITIZE_STRING));
$medicinesStockEdit->setExpiryDate(!isset($_POST["expiryDate"]) || $_POST["expiryDate"]==""?NULL:filter_var($_POST["expiryDate"],FILTER_SANITIZE_STRING));
$medicinesStockEdit->setQuantity(!isset($_POST["quantity"]) || $_POST["quantity"]==""?NULL:filter_var($_POST["quantity"],FILTER_SANITIZE_NUMBER_INT));
$medicinesStockEdit->setAmount(!isset($_POST["amount"]) || $_POST["amount"]==""?NULL:filter_var($_POST["amount"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $medicinesStockEditDao->update($medicinesStockEdit);
  }else{
    $tempObject = $medicinesStockEditDao->insert($medicinesStockEdit);
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

