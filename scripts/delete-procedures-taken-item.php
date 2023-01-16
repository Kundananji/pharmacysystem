<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/procedures-taken-dao.php");

$proceduresTakenDao = new ProceduresTakenDao();

if(isset($_POST["proceduresTakenId"]) && (int)$_POST["proceduresTakenId"] > 0){
  $proceduresTakenId = $_POST["proceduresTakenId"];
  if($proceduresTakenDao->delete($proceduresTakenId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


