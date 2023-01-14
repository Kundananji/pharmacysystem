<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/menu.php");
include_once("../daos/menu-dao.php");

$menuEditDao = new MenuDao();
$menuEdit = new Menu();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["label"]) || $_POST["label"]==''){ 
  exit(json_encode(array("title"=>"label required","status"=>"error","message"=>"The field label is required")));
}
if(!isset($_POST["profileId"]) || $_POST["profileId"]==''){ 
  exit(json_encode(array("title"=>"profileId required","status"=>"error","message"=>"The field profileId is required")));
}

$menuEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$menuEdit->setIcon(!isset($_POST["icon"]) || $_POST["icon"]==""?NULL:filter_var($_POST["icon"],FILTER_SANITIZE_STRING));
$menuEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$menuEdit->setLabel(!isset($_POST["label"]) || $_POST["label"]==""?NULL:filter_var($_POST["label"],FILTER_SANITIZE_STRING));
$menuEdit->setUrl(!isset($_POST["url"]) || $_POST["url"]==""?NULL:filter_var($_POST["url"],FILTER_SANITIZE_STRING));
$menuEdit->setTarget(!isset($_POST["target"]) || $_POST["target"]==""?NULL:filter_var($_POST["target"],FILTER_SANITIZE_NUMBER_INT));
$menuEdit->setParentId(!isset($_POST["parentId"]) || $_POST["parentId"]==""?NULL:filter_var($_POST["parentId"],FILTER_SANITIZE_NUMBER_INT));
$menuEdit->setProfileId(!isset($_POST["profileId"]) || $_POST["profileId"]==""?NULL:filter_var($_POST["profileId"],FILTER_SANITIZE_NUMBER_INT));
$menuEdit->setIdName(!isset($_POST["idName"]) || $_POST["idName"]==""?NULL:filter_var($_POST["idName"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $menuEditDao->update($menuEdit);
  }else{
    $tempObject = $menuEditDao->insert($menuEdit);
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

