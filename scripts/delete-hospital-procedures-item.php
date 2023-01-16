<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/hospital-procedures-dao.php");

$hospitalProceduresDao = new HospitalProceduresDao();

if(isset($_POST["hospitalProceduresId"]) && (int)$_POST["hospitalProceduresId"] > 0){
  $hospitalProceduresId = $_POST["hospitalProceduresId"];
  if($hospitalProceduresDao->delete($hospitalProceduresId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


