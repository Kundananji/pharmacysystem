<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/_user-tokens-dao.php");

$userTokensDao = new UserTokensDao();

if(isset($_POST["userTokensId"]) && (int)$_POST["userTokensId"] > 0){
  $userTokensId = $_POST["userTokensId"];
  if($userTokensDao->delete($userTokensId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


