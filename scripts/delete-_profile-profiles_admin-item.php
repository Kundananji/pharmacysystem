<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/_profile-dao.php");

$profileDao = new ProfileDao();

if(isset($_POST["profileId"]) && (int)$_POST["profileId"] > 0){
  $profileId = $_POST["profileId"];
  if($profileDao->delete($profileId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


