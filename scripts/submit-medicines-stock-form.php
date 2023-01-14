<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/medicines-stock.php");
include_once("../daos/medicines-stock-dao.php");

$medicinesStockEditDao = new MedicinesStockDao();
$medicinesStockEdit = new MedicinesStock();

if(!isset($_POST["iD"]) || $_POST["iD"]==''){ 
  exit(json_encode(array("title"=>"iD required","status"=>"error","message"=>"The field ID is required")));
}
if(!isset($_POST["nAME"]) || $_POST["nAME"]==''){ 
  exit(json_encode(array("title"=>"nAME required","status"=>"error","message"=>"The field NAME is required")));
}
if(!isset($_POST["batchId"]) || $_POST["batchId"]==''){ 
  exit(json_encode(array("title"=>"batchId required","status"=>"error","message"=>"The field BATCH_ID is required")));
}
if(!isset($_POST["expiryDate"]) || $_POST["expiryDate"]==''){ 
  exit(json_encode(array("title"=>"expiryDate required","status"=>"error","message"=>"The field EXPIRY_DATE is required")));
}
if(!isset($_POST["qUANTITY"]) || $_POST["qUANTITY"]==''){ 
  exit(json_encode(array("title"=>"qUANTITY required","status"=>"error","message"=>"The field QUANTITY is required")));
}
if(!isset($_POST["mRP"]) || $_POST["mRP"]==''){ 
  exit(json_encode(array("title"=>"mRP required","status"=>"error","message"=>"The field MRP is required")));
}
if(!isset($_POST["rATE"]) || $_POST["rATE"]==''){ 
  exit(json_encode(array("title"=>"rATE required","status"=>"error","message"=>"The field RATE is required")));
}

$medicinesStockEdit->setID(!isset($_POST["iD"]) || $_POST["iD"]==""?NULL:filter_var($_POST["iD"],FILTER_SANITIZE_NUMBER_INT));
$medicinesStockEdit->setNAME(!isset($_POST["nAME"]) || $_POST["nAME"]==""?NULL:filter_var($_POST["nAME"],FILTER_SANITIZE_STRING));
$medicinesStockEdit->setBatchId(!isset($_POST["batchId"]) || $_POST["batchId"]==""?NULL:filter_var($_POST["batchId"],FILTER_SANITIZE_STRING));
$medicinesStockEdit->setExpiryDate(!isset($_POST["expiryDate"]) || $_POST["expiryDate"]==""?NULL:filter_var($_POST["expiryDate"],FILTER_SANITIZE_STRING));
$medicinesStockEdit->setQUANTITY(!isset($_POST["qUANTITY"]) || $_POST["qUANTITY"]==""?NULL:filter_var($_POST["qUANTITY"],FILTER_SANITIZE_NUMBER_INT));
$medicinesStockEdit->setMRP(!isset($_POST["mRP"]) || $_POST["mRP"]==""?NULL:filter_var($_POST["mRP"],FILTER_SANITIZE_STRING));
$medicinesStockEdit->setRATE(!isset($_POST["rATE"]) || $_POST["rATE"]==""?NULL:filter_var($_POST["rATE"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["ID"]) && (int)$_POST["ID"] > 0){
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

