<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/_profile.php");
include_once("../daos/_profile-dao.php");

$profileEditDao = new ProfileDao();
$profileEdit = new Profile();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}
if(!isset($_POST["description"]) || $_POST["description"]==''){ 
  exit(json_encode(array("title"=>"description required","status"=>"error","message"=>"The field description is required")));
}
if(!isset($_POST["isActive"]) || $_POST["isActive"]==''){ 
  exit(json_encode(array("title"=>"isActive required","status"=>"error","message"=>"The field isActive is required")));
}
if(!isset($_POST["isDefault"]) || $_POST["isDefault"]==''){ 
  exit(json_encode(array("title"=>"isDefault required","status"=>"error","message"=>"The field isDefault is required")));
}

$profileEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$profileEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));
$profileEdit->setDescription(!isset($_POST["description"]) || $_POST["description"]==""?NULL:filter_var($_POST["description"],FILTER_SANITIZE_STRING));
$profileEdit->setIsActive(!isset($_POST["isActive"]) || $_POST["isActive"]==""?NULL:filter_var($_POST["isActive"],FILTER_SANITIZE_NUMBER_INT));
$profileEdit->setIsDefault(!isset($_POST["isDefault"]) || $_POST["isDefault"]==""?NULL:filter_var($_POST["isDefault"],FILTER_SANITIZE_NUMBER_INT));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $profileEditDao->update($profileEdit);
  }else{
    $tempObject = $profileEditDao->insert($profileEdit);
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

