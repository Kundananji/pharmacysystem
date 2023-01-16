<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/hospital-procedure-dao.php");

$hospitalProcedureDao = new HospitalProcedureDao();

if(isset($_POST["hospitalProcedureId"]) && (int)$_POST["hospitalProcedureId"] > 0){
  $hospitalProcedureId = $_POST["hospitalProcedureId"];
  if($hospitalProcedureDao->delete($hospitalProcedureId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


