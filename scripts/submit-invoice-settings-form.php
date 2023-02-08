<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/invoice-settings.php");
include_once("../daos/invoice-settings-dao.php");

$invoiceSettingsEditDao = new InvoiceSettingsDao();
$invoiceSettingsEdit = new InvoiceSettings();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["terms"]) || $_POST["terms"]==''){ 
  exit(json_encode(array("title"=>"terms required","status"=>"error","message"=>"The field terms is required")));
}
if(!isset($_POST["taxRate"]) || $_POST["taxRate"]==''){ 
  exit(json_encode(array("title"=>"taxRate required","status"=>"error","message"=>"The field taxRate is required")));
}

$invoiceSettingsEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$invoiceSettingsEdit->setTerms(!isset($_POST["terms"]) || $_POST["terms"]==""?NULL:filter_var($_POST["terms"],FILTER_SANITIZE_STRING));
$invoiceSettingsEdit->setTaxRate(!isset($_POST["taxRate"]) || $_POST["taxRate"]==""?NULL:filter_var($_POST["taxRate"],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $invoiceSettingsEditDao->update($invoiceSettingsEdit);
  }else{
    $tempObject = $invoiceSettingsEditDao->insert($invoiceSettingsEdit);
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

