<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/suppliers.php");
include_once("../daos/suppliers-dao.php");

$suppliersEditDao = new SuppliersDao();
$suppliersEdit = new Suppliers();

if(!isset($_POST["iD"]) || $_POST["iD"]==''){ 
  exit(json_encode(array("title"=>"iD required","status"=>"error","message"=>"The field ID is required")));
}
if(!isset($_POST["nAME"]) || $_POST["nAME"]==''){ 
  exit(json_encode(array("title"=>"nAME required","status"=>"error","message"=>"The field NAME is required")));
}
if(!isset($_POST["eMAIL"]) || $_POST["eMAIL"]==''){ 
  exit(json_encode(array("title"=>"eMAIL required","status"=>"error","message"=>"The field EMAIL is required")));
}
if(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==''){ 
  exit(json_encode(array("title"=>"contactNumber required","status"=>"error","message"=>"The field contact_number is required")));
}
if(!isset($_POST["aDDRESS"]) || $_POST["aDDRESS"]==''){ 
  exit(json_encode(array("title"=>"aDDRESS required","status"=>"error","message"=>"The field ADDRESS is required")));
}

$suppliersEdit->setID(!isset($_POST["iD"]) || $_POST["iD"]==""?NULL:filter_var($_POST["iD"],FILTER_SANITIZE_NUMBER_INT));
$suppliersEdit->setNAME(!isset($_POST["nAME"]) || $_POST["nAME"]==""?NULL:filter_var($_POST["nAME"],FILTER_SANITIZE_STRING));
$suppliersEdit->setEMAIL(!isset($_POST["eMAIL"]) || $_POST["eMAIL"]==""?NULL:filter_var($_POST["eMAIL"],FILTER_SANITIZE_STRING));
$suppliersEdit->setContactNumber(!isset($_POST["contactNumber"]) || $_POST["contactNumber"]==""?NULL:filter_var($_POST["contactNumber"],FILTER_SANITIZE_STRING));
$suppliersEdit->setADDRESS(!isset($_POST["aDDRESS"]) || $_POST["aDDRESS"]==""?NULL:filter_var($_POST["aDDRESS"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["ID"]) && (int)$_POST["ID"] > 0){
    $tempObject = $suppliersEditDao->update($suppliersEdit);
  }else{
    $tempObject = $suppliersEditDao->insert($suppliersEdit);
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

