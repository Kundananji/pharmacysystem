<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/gender.php");
include_once("../daos/gender-dao.php");

$genderEditDao = new GenderDao();
$genderEdit = new Gender();

if(!isset($_POST["genderId"]) || $_POST["genderId"]==''){ 
  exit(json_encode(array("title"=>"genderId required","status"=>"error","message"=>"The field genderId is required")));
}
if(!isset($_POST["name"]) || $_POST["name"]==''){ 
  exit(json_encode(array("title"=>"name required","status"=>"error","message"=>"The field name is required")));
}

$genderEdit->setGenderId(!isset($_POST["genderId"]) || $_POST["genderId"]==""?NULL:filter_var($_POST["genderId"],FILTER_SANITIZE_NUMBER_INT));
$genderEdit->setName(!isset($_POST["name"]) || $_POST["name"]==""?NULL:filter_var($_POST["name"],FILTER_SANITIZE_STRING));

try{
  if(isset($_POST["genderId"]) && (int)$_POST["genderId"] > 0){
    $tempObject = $genderEditDao->update($genderEdit);
  }else{
    $tempObject = $genderEditDao->insert($genderEdit);
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

