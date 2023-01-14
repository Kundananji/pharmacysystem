<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/_alternative-profile-dao.php");

$alternativeProfileDao = new AlternativeProfileDao();

if(isset($_POST["alternativeProfileId"]) && (int)$_POST["alternativeProfileId"] > 0){
  $alternativeProfileId = $_POST["alternativeProfileId"];
  if($alternativeProfileDao->delete($alternativeProfileId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


