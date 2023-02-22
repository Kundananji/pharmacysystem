<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/fee-category.php");
include_once("../daos/fee-category-dao.php");

$feeCategoryEditDao = new FeeCategoryDao();
$feeCategoryEdit = new FeeCategory();

if(!isset($_POST["feeCategoryId"]) || $_POST["feeCategoryId"]==''){ 
  exit(json_encode(array("title"=>"feeCategoryId required","status"=>"error","message"=>"The field feeCategoryId is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}

$feeCategoryEdit->setFeeCategoryId(!isset($_POST["feeCategoryId"]) || $_POST["feeCategoryId"]==""?NULL:filter_var($_POST["feeCategoryId"],FILTER_SANITIZE_NUMBER_INT));
$feeCategoryEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["feeCategoryId"]) && (int)$_POST["feeCategoryId"] > 0){
    $tempObject = $feeCategoryEditDao->update($feeCategoryEdit);
  }else{
    $tempObject = $feeCategoryEditDao->insert($feeCategoryEdit);
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

