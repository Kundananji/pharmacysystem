<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/patients-dao.php");

$patientsDao = new PatientsDao();

if(isset($_POST["patientsId"]) && (int)$_POST["patientsId"] > 0){
  $patientsId = $_POST["patientsId"];
  if($patientsDao->delete($patientsId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


