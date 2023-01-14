<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/status-dao.php");

$statusDao = new StatusDao();

if(isset($_POST["statusId"]) && (int)$_POST["statusId"] > 0){
  $statusId = $_POST["statusId"];
  if($statusDao->delete($statusId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


