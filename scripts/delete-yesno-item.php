<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/yesno-dao.php");

$yesnoDao = new YesnoDao();

if(isset($_POST["yesnoId"]) && (int)$_POST["yesnoId"] > 0){
  $yesnoId = $_POST["yesnoId"];
  if($yesnoDao->delete($yesnoId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


