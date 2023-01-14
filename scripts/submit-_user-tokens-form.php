<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../classes/_user-tokens.php");
include_once("../daos/_user-tokens-dao.php");

$userTokensEditDao = new UserTokensDao();
$userTokensEdit = new UserTokens();

if(!isset($_POST["id"]) || $_POST["id"]==''){ 
  exit(json_encode(array("title"=>"id required","status"=>"error","message"=>"The field id is required")));
}
if(!isset($_POST["selector"]) || $_POST["selector"]==''){ 
  exit(json_encode(array("title"=>"selector required","status"=>"error","message"=>"The field selector is required")));
}
if(!isset($_POST["hashedValidator"]) || $_POST["hashedValidator"]==''){ 
  exit(json_encode(array("title"=>"hashedValidator required","status"=>"error","message"=>"The field hashed_validator is required")));
}
if(!isset($_POST["userId"]) || $_POST["userId"]==''){ 
  exit(json_encode(array("title"=>"userId required","status"=>"error","message"=>"The field user_id is required")));
}
if(!isset($_POST["expiry"]) || $_POST["expiry"]==''){ 
  exit(json_encode(array("title"=>"expiry required","status"=>"error","message"=>"The field expiry is required")));
}

$userTokensEdit->setId(!isset($_POST["id"]) || $_POST["id"]==""?NULL:filter_var($_POST["id"],FILTER_SANITIZE_NUMBER_INT));
$userTokensEdit->setSelector(!isset($_POST["selector"]) || $_POST["selector"]==""?NULL:filter_var($_POST["selector"],FILTER_SANITIZE_STRING));
$userTokensEdit->setHashedValidator(!isset($_POST["hashedValidator"]) || $_POST["hashedValidator"]==""?NULL:filter_var($_POST["hashedValidator"],FILTER_SANITIZE_STRING));
$userTokensEdit->setUserId(!isset($_POST["userId"]) || $_POST["userId"]==""?NULL:filter_var($_POST["userId"],FILTER_SANITIZE_NUMBER_INT));
$userTokensEdit->setExpiry(!isset($_POST["expiry"]) || $_POST["expiry"]==""?NULL:convertDate($_POST["expiry"]));

try{
  if(isset($_POST["id"]) && (int)$_POST["id"] > 0){
    $tempObject = $userTokensEditDao->update($userTokensEdit);
  }else{
    $tempObject = $userTokensEditDao->insert($userTokensEdit);
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

